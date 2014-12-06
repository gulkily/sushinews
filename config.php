<?php

function getConfig($key) {
    static $config;

    if (!isset($config)) {
        if (!cache_expired('config')) {
            $config = get_cache('config');
        } else {
            global $db;
            $rows = $db->get_results("SELECT * FROM config");

            if (count($rows)) {
                $config = array();

                foreach ($rows as $row) {
                    $config[$row->key] = $row->value;
                }
            } else {
                $config = array();
            }

            put_cache('config', $config);
        }
    }

    if (!isset($config[$key])) {
        $config[$key] = getConfigDefault($key);
        //putConfig($key, $config[$key]);
    }

    return $config[$key];
}

function putConfig($key, $value) {
    global $dbp;

    $stmt = $dbp->prepare("INSERT INTO config(`key`, `value`) VALUES(:key, :value)");

    $stmt->execute(array(':key' => $key, ':value' => $value));

    delete_cache('config', 1);
}

function getConfigDefault($key) {
    switch($key) {
        case 'guid_seed':
        case 'secret_salt':
            return generateSalt();
            break;
        case 'site_domain':
            return $_SERVER['HTTP_HOST'];
            break;
        case 'site_name':
            return 'rusrs';
            break;
        case 'site_path':
            return '/'; //@todo this should be generated from current url if possible
            break;
        default:
            return null;
    }
}
