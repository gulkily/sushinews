<?php
include_once('config/env.php');
include_once('module/utilities.php');
include_once('module/sherlock.php');

$sherlock = new SherlockSession($db);
$sherlock->populateFromGlobals();
$sherlock->storeSession();
$client_id = $sherlock->getClientId();

if (isset($_POST)) {
    $item_id = getParam('item_id');
    $tag = getParam('tag');

    addTagToItem($item_id, $tag, $client_id);

    updateItemScore($item_id);

    header("Location: " . getItemUrl($item_id));
}