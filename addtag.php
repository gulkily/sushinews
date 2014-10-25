<?php
include_once('config/env.php');
include_once('module/utilities.php');
include_once('module/items.php');
include_once('module/sherlock.php');

$sherlock = new SherlockSession($db);
$sherlock->populateFromGlobals();
$sherlock->storeSession();
$client_id = $sherlock->getClientId();

if (isset($_POST)) {
    $item_id = getParam('item_id');
    $tag = getParam('tag');
    $hash = getParam('hash');

    if (verifyVotingHash($sherlock->getClientId(), $item_id, $tag, $hash)) {

        addTagToItem($item_id, $tag, $client_id);

        updateItemScore($item_id);

        echo('ok');
    } else {
        echo('fail');
    }
}