<?php
include_once('config.php');
include_once('module/utilities.php');
include_once('module/items.php');
include_once('module/config.php');

$client_id = getVoterId();

if ($client_id && isset($_POST)) {
    $item_id = getParam('item_id');
    $tag = getParam('tag');
    $hash = getParam('hash');

    if (getVotingHash($client_id, $item_id, $tag) === $hash) {

        addTagToItem($item_id, $tag, $client_id);

        updateItemScore($item_id);

        echo('ok');
    } else {
        echo('fail');
    }
}