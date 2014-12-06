<?php

include_once('config/env.php');
include_once('module/ez_sql.php');
include_once('module/cache.php');
include_once('module/voting.php');

function getParam($name) {
    if (isset($_GET[$name])) {
        $param = $_GET[$name];
    } elseif (isset($_POST[$name])) {
        $param = $_POST[$name];
    } else {
        $param = '';
    }

    return $param;
}

//
//function getConfigLine($name, $value) {
//    return "define ('" . $name . "','" . $value . "');\n";
//}
//
//function verifyEnv() {
//    // verifies environment
//    // returns null if current config [ IS VALID ] and [ MATCHES env.php ]
//    // -otherwise-
//    // returns a version of env.php to make both true
//
//    $validConfig = "<?php\n";
//
//    $validSoFar = true;
//
//    if (isset(GUID_SEED)) {
//        $validConfig .= getConfigLine('GUID_SEED', GUID_SEED);
//    } else {
//        $validConfig .= getConfigLine('GUID_SEED', md5(sha1(time() . $_REQUEST['REMOTE_ADDR'] . $_REQUEST['HTTP_HOST'])));
//        $validSoFar = false;
//    }
//
//    define('GUID_SEED', "dsfadsfadsfadsfq43rq4rqfx4rdfadsf");
//    define('CACHE_PATH', "/home/ilya/sushi/cache");
//    define('SITE_NAME', 'sushi news');
//    define('SECRET_SALT', '4rx34rfadjkfadslfjklaewfj19895489fj83rfj8');
//    define('SITE_BASE', 'sushi.local');
//    define('SITE_BASE_PATH', '/');
//}

function isPost() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        return true;
    } else {
        return false;
    }
}

function generateSalt() {
    //@todo make this actually crypto-safe; just a placeholder for now

    mt_srand();
    $length = rand(20,40);
    $c = 0;
    $salt = '';
    while ($c < $length) {
        $c++;
        $salt .= rand(0,9);
    }

    return $salt;
}

function put_ticket($messages, $redirect = null) {
    mt_srand();
    do {
        $ticket_id = rand(1000000000,9999999999);
    } while (cache_expired("ticket/$ticket_id") != -1);

    put_cache("ticket/$ticket_id", $messages);

    if ($redirect) {
        if (strpos($redirect, '?') === false) {
            Header("Location: $redirect?ticket=$ticket_id");
        } else {
            Header("Location: $redirect&ticket=$ticket_id");
        }
        exit;
    } else {
        return $ticket_id;
    }
}

function get_ticket($ticket_id) {
    $ticket_id = intval($ticket_id);
    if ($ticket_id) {
        $messages = get_cache("ticket/$ticket_id");
        delete_cache("ticket/$ticket_id", 1);
        return $messages;
    } else {
        return null;
    }
}

function getPrettyLink($action, $params = array(), $format = 'relative') {
    switch ($action) {
        case 'index':
            $link = '';
            return $link;

            break;

        case 'moderate':
            $link = $action;
            if (count($params)) {
                $link .= '?' . getQueryString($params);
            }
            return $link;

            break;
        case 'about':
        case 'submit':
            $link = $action;
            return $link;

            break;
        case 'item':
        case 'edit':
            $id = intval($params['id']);
            if ($id) {
                $link = $action . '/'. $id;
                return $link;
            }
            break;

        default:
    }

    return null;
}

function getLink($action, $params = array(), $format = 'relative') {
    // generates a link to a resource
    // $action is the action parameter, which helps organize the validation
    // $params are all the other parameters, as an array
    // $format can be relative (starting with ./), absolute (starting with /), or global (starting with http://)

    // if pretty links are enabled, see if we can generate one of those first
    // for now this only works for relative links @todo


    // determine the link prefix first
    if ($format == 'relative') {
        $prefix = getConfig('site_path');
    } elseif ($format == 'absolute') {
        $prefix = SITE_PREFIX . getConfig('site_domain') . getConfig('site_path');
    } else {
        die();
    }

    if (getConfig('pretty_links')) {
        $link = getPrettyLink($action, $params, $format);

        if ($link === '' || $link) {
            return $prefix . $link;
        }
    }

    $prefix .= '?';

    $params['action'] = $action;

    $queryString = getQueryString($params);

    return $prefix . $queryString;
}

function getQueryString($params) {
    $queryString = '';

    // currently unvalidated @todo
    if (count($params)) {
        $comma = 0;
        foreach($params as $key => $value) {
            if ($comma == 0) $comma = 1; else $queryString .= '&';
            $queryString .= urlencode($key) . '=' . urlencode($value);
        }
    }

    return $queryString;
}

function getTagId($tag_name) {
    global $dbp;

    $tag = strtolower(trim($tag_name));

    $stmt = $dbp->prepare("SELECT id FROM tag WHERE name = :tag LIMIT 1");
    $stmt->bindValue(':tag', $tag);

    $tag_id = get_cache_dbp('tagid/' . md5($tag_name), 60, $stmt);

    return $tag_id[0]['id'];
}

function addTagToItem($item_id, $tag_name, $voter_id) {
    global $dbp;

    $item = intval($item_id);
    $tag = strtolower(trim($tag_name));

    if (!$item || !$tag) {
        return;
    }

    $tag_id = getTagId($tag);

    if (!$tag_id) {
        return;
    }

    $stmt = $dbp->prepare("INSERT INTO item_tag(item_id, tag_id, voter_id) VALUES(:item_id, :tag_id, :voter_id)");

    $stmt->execute(array(':item_id' => $item, ':tag_id' => $tag_id, ':voter_id' => $voter_id));
}

function getOwnUrl() {
    return ($_SERVER['HTTP_HOST']);
}

function concise_timestamp($timestamp) {
    if (date('Ymd',time()) == date('Ymd',$timestamp)) {
        return date('H:i', $timestamp);
    }
    if (date('Y', time()) == date('Y', $timestamp)) {
        return date('M j', $timestamp);
    }
    return date('M j \'y', $timestamp);
}

function hsh($string) {
    //centralized hashing function so that we can replace md5

    return md5($string);
}