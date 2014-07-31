<?
	function get_cache_filename($cachename) {
		return CACHE_PATH . (substr($cachename,0,1)=='/'?'':'/') . $cachename;
	}

	function get_cache_list($path = '', $readable = 0) {
		$path = get_cache_filename($path);

		$caches_glob = glob($path.'*', GLOB_MARK);

		$caches = array();

		foreach($caches_glob as $cache) {
			if ($readable) {
				$caches[] = array (
					'filename' => substr($cache, strlen(CACHE_PATH)),
					'filesize' => (is_dir($cache)?'--':number_format(filesize($cache), 0, '.', ',')),
					'mtime' => date('Y-m-d H:i:s', filemtime($cache)),
					'atime' => date('Y-m-d H:i:s', fileatime($cache)),
				);
			} else {
				$caches[] = array (
					'filename' => substr($cache, strlen(CACHE_PATH)),
					'filesize' => (is_dir($cache)?null:filesize($cache)),
					'mtime' => filemtime($cache),
					'atime' => fileatime($cache),
				);
			}
		}

		return $caches;
	}

	function put_cache($cachename, $object, $rlevel = 0) {
		if ($rlevel > 10) {
            //@todo fixme there is a bug here where if a file exists where a directory should be created it will die
			die('Something is wrong...');
		}

		$filename = get_cache_filename($cachename);
		$tmp = getmypid().'.tmp';

		$object_s = serialize($object);
		$file = @fopen($filename.$tmp, 'w');

		if (!$file) {
		// if we don't have a handle, we probably need to create some directories
			$path = $filename;
			while (!$file && $path != '') {
				$path = explode('/', $path);
				array_pop($path);
				$path = implode('/', $path);
				mkdir($path, 0777);
				$file = @fopen($filename.$tmp, 'w');
			}

			if (!$file) {
			// now that we have a directory and a file handle, try again
				return put_cache($cachename, $object, $rlevel+1);
			}
		}

		if ($file) {
			fwrite($file, $object_s);
			fclose($file);
			rename($filename.$tmp, $filename);
		}
	}

	function get_cache_timestamp($cachename) {
		$filename = get_cache_filename($cachename);

		if (file_exists($filename)) {
			$cache_timestamp = filemtime($filename);

			return $cache_timestamp;
		} else {
			return null;
		}

	}

	function cache_expired($cachename, $threshold = 60) {
        // check if cache has expired and needs to be renewed
        $filename = get_cache_filename($cachename);

		if (file_exists($filename)) {
			$cache_timestamp = filemtime($filename);

			$timediff = time() - $cache_timestamp;
			if ($timediff < $threshold)
				return 0;
			else
				return $timediff - $threshold;
		} else {
			return -1;
		}
	}

	function write_queue_cache() {
        // this will call the queue_cache() function with $write = 1 to write all the caches to queue to the database
		queue_cache('', '', '', 1);
	}

	function queue_cache($cache_name, $query, $function, $write = 0) {
        // if $write == 0, adds the query to the static array of queries to add to the cache queue
        // if $write == 1, flushes the array to the cache queue in the database

		static $caches;


		if ($write) {
            global $dbp;

			if (count($caches) > 0) {

                foreach ($caches as $cache) {
                    $stmt = $dbp->prepare("
                        INSERT INTO cache_queue(cache_name, query, function, add_timestamp)
                        VALUES (:cache_name, :query, :function, NOW())
                    ");

                    $stmt->execute($cache);
                }
			}
            $caches = array();
		} else {
			$caches[] = array(
                ':cache_name' => $cache_name,
                ':query' => $query,
                ':function' => $function
            );
		}
    }

	function get_cache($cachename, $refresh_rate = 60, $query = '', $function = 'get_results', $force_refresh = 0) {
		if (!$function) $function = 'get_results';

		global $cache_db_hit; //fixme
		$cache_db_hit = 0;

		if ($cachename) $filename = get_cache_filename($cachename);
		else $filename = get_cache_filename(md5($query));

		$ce = cache_expired($cachename, $refresh_rate);

		if (!$force_refresh && cache_expired($cachename, $refresh_rate) > 0 && $query) {
			queue_cache($cachename, $query, $function);
		}

		if (($force_refresh && $ce || $ce < 0)  && $cachename != '' && $query) {
			global $db;

			$results_array = $db->$function($query);

			if (!mysql_error()) {
				$cache_db_hit = 1;
				put_cache($cachename, $results_array);

				return $results_array;
			} elseif ($ce > 0) {
				return get_cache($cachename, $refresh_rate, $query, $function, 0);
			}
		} elseif (file_exists($filename)) {
			$flen = filesize($filename);
			$file = fopen($filename, 'r');

			if ($flen > 0) {
				$results_array = fread($file, $flen);
				fclose($file);
				return unserialize($results_array);
			} else {
				return null;
			}
		}
	}

    function get_cache_dbp($cache_name, $refresh_rate = 60, PDOStatement $statement = null, $force_refresh = 1) {
        $refresh_rate = 0;//@todo remove this
        global $cache_db_hit; //fixme
        $cache_db_hit = 0;

        if ($cache_name) $filename = get_cache_filename($cache_name);
        else $filename = get_cache_filename(md5($query));

        $ce = cache_expired($cache_name, $refresh_rate);

        if (!$force_refresh && cache_expired($cache_name, $refresh_rate) > 0 && $statement) {
            //queue_cache($cache_name, $statement->queryString, 'dbp');
        }

        if (($force_refresh && $ce || $ce < 0)  && $cache_name != '' && $statement) {
            if ($statement->execute()) {
                $results_array = array();

                while($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                    $results_array[] = $row;
                }

                $cache_db_hit = 1;
                put_cache($cache_name, $results_array);

                return $results_array;
            } elseif ($ce > 0) {
                return get_cache_dbp($cache_name, $refresh_rate, $statement, 0);
            }
        } elseif (file_exists($filename)) {
            $flen = filesize($filename);
            $file = fopen($filename, 'r');

            if ($flen > 0) {
                $results_array = fread($file, $flen);
                fclose($file);
                return unserialize($results_array);
            } else {
                return null;
            }
        }
    }

	function delete_cache($cachename, $delete = 0) {
       /* expires a $cachename if $delete is 0, actually deletes the file if 1 */
		$filename = get_cache_filename($cachename);
		$files = glob($filename);

		if (count($files)) {
			foreach($files as $filename) {
				if (file_exists($filename)) {
					if ($delete) {
						unlink($filename);
					} else {
						touch($filename, time()-31536000);
					}
				}
			}
		}
	}

	function batch_cache($count = 50, $max_runtime = 10) {
		global $db;
        global $dbp;
		$start = time();

        $stmt = $dbp->prepare("
            SELECT
                cache_name,
                MIN(add_timestamp)
                first_req,
                COUNT(cache_name) req_count,
                FUNCTION func,
                MAX(query) query
            FROM cache_queue
            GROUP BY cache_name, FUNCTION
            ORDER BY req_count DESC, first_req
            LIMIT :count
        ");

		if ($stmt->execute(array(':count' => $count))) {
			while($cache = $stmt->fetch(PDO::FETCH_OBJ)) {
				if (time() - $start >= $max_runtime) {
					$not_cached[] = $cache->cache_name;
				} else {
					$qry_start = time();

                    if ($cache->func == 'dbp') {
                        $stmt = $dbp->prepare($cache->query);
                        get_cache_dbp($cache->cache_name, 0, $stmt, 1);
                    } else {
                        get_cache($cache->cache_name, 0, $cache->query, $cache->func, 1);
                        // $db; @todo
                    }

                    $qry_end = time();

                    $stmtDel = $dbp->prepare("DELETE QUICK FROM cache_queue WHERE cache_name = :cache_name");
                    $stmtDel->execute(array(':cache_name' => $cache->cache_name));

					$cached[] = $cache->cache_name;
				}
			}
			return array('cached' => $cached, 'not_cached' => $not_cached);
		}
	}

	function cache_queue_count($group = true) {
		global $db;

		if ($group) {
			$to_cache = $db->get_var("SELECT COUNT(DISTINCT cache_name) FROM cache_queue");
		} else {
			$to_cache = $db->get_var("SELECT COUNT(*) FROM cache_queue");
		}

		return $to_cache;
	}

?>