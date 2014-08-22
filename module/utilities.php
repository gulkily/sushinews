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


function getLink($action, $text = null, $id = null, $class = null) {

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

function addTagToItem($item_id, $tag_name, $client_id) {
    global $dbp;

    $item = intval($item_id);
    $tag = strtolower(trim($tag_name));
    $client_id = intval($client_id);

    if (!$item || !$tag) {
        return;
    }

    $tag_id = getTagId($tag);

    if (!$tag_id) {
        return;
    }

    $stmt = $dbp->prepare("INSERT INTO item_tag(item_id, tag_id, client_id) VALUES(:item_id, :tag_id, :client_id)");

    $stmt->execute(array(':item_id' => $item, ':tag_id' => $tag_id, ':client_id' => $client_id));
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