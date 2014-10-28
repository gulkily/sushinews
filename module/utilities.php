<?php

include_once('config/env.php');
include_once('module/ez_sql.php');
include_once('module/cache.php');


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
//function getClientVotes() {
//    if (!$_COOKIE['voted']) {
//        return array();
//    } else {
//
//    }
//}

function getVotingHash($client_id, $item_id, $tag) {
    return md5($client_id . $item_id . $tag . SECRET_SALT);
}

function getVoterId() {
    static $voter_id;
    static $voter;

    if (isset($_COOKIE['voter_id'])) {
        $voter_id = $_COOKIE['voter_id'];

        $voter = explode(',', $voter_id);
    }

    // @todo some sanity checks here
    if ($voter[1] == md5($voter[0] . $_SERVER['REMOTE_ADDR'] . SECRET_SALT)) {
        return $voter[1];
    } else {
        $host = $_SERVER['REMOTE_ADDR'];
        $host .= round(time() / 3600);
        $host = md5(host);

        global $db;
        $last_assignment = $db->get_var("SELECT last_assigment FROM voter_id_rate WHERE host = '$host'"); // @todo escape

        // @todo actually verify that it wasn't too recent

        $query = "INSERT INTO voter_id_rate(host, last_assigment) VALUES('$host', NOW())";
        $db->query($query);

        $voter_id = md5(rand(0,100000) . time()); // @todo make this more random

        $cookie = $voter_id . ',' . md5($voter_id . $_SERVER['REMOTE_ADDR'] . SECRET_SALT);

        setcookie('voter_id', $cookie);

        return $voter_id;
    }
}

function verifyVotingHash($client_id, $item_id, $tag, $hash) {
    if (md5($client_id . $item_id . $tag . SECRET_SALT) == $hash) {
        return true;
    } else {
        return false;
    }
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

function getLink($action, $params = array(), $format = 'relative') {
    // generates a link to a resource
    // $action is the action parameter, which helps organize the validation
    // $params are all the other parameters, as an array
    // $format can be relative (starting with ./), absolute (starting with /), or global (starting with http://)
    $params['action'] = $action;

    if ($format == 'relative') {
        $link = './?';
    } elseif ($format == 'absolute') {
        $link = SITE_PREFIX . SITE_DOMAIN . SITE_PATH . '?';
    }

    //$link .= 'action=' . urlencode($action);

    // currently unvalidated
    if (count($params)) {
        foreach($params as $key => $value) {
            $link .= '&' . urlencode($key) . '=' . urlencode($value);
        }
    }

    return $link;

}

function getToken() {
    return md5('todo');
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

function getUserId() {
    return 1;
}

function getOwnUrl() {
    return ($_SERVER['HTTP_HOST']);
}

function createUser() {
    // returns hash for cookie
}