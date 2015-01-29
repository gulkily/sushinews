<?php

function getItemExport($hash = null) {
    global $db;

    //if (!isHash($hash)) return null;

    $fields = "hash, title, body, id, publish_timestamp";

    if ($hash) {
        $query = "SELECT $fields FROM item WHERE id > (SELECT id FROM item WHERE hash = '$hash') ORDER BY id";
    } else {
        $query = "SELECT $fields FROM item ORDER BY id";
    }

    $items = $db->get_results($query, ARRAY_A);

    $items_encoded = array();

    foreach($items as $item) {
        $item_e = array();
        foreach ($item as $key => $value) {
            if ($key == 'title' || $key == 'body') {
                $item_e[$key] = base64_encode($value);
            } else {
                $item_e[$key] = $value;
            }
        }
        $items_encoded[] = $item_e;
    }

    return $items_encoded;
}

function pullNodeList($node) {
    $feedUrl = $node['url'] . '?action=getNodes';

    $result = getUrl($feedUrl);

    $nodes = json_decode($result, 1);

    foreach ($nodes as $node) {
        print_r($node);
    }
}

function pullNodeFeed($node) {
    $feedUrl = $node['url'] . '?action=json';

    if ($node['last_item'] && isHash($node['last_item'])) {
        $feedUrl .= '?last=' . $node['last_item'];
    }

    $result = getUrl($feedUrl);

    $items = json_decode($result, 1);

    foreach ($items as $item) {
        print_r($item);
        print_r($node);
        //function createNewItem($title, $summary, $body, $parent_id = null, $group = null, $publish_timestamp = null)
        createNewItem($item['title'], $item['summary'], $item['body']);
        touchNode($node['id'], $item['hash']);
    }
}

function getUrl($url) {
    //
////  Initiate curl
//    $ch = curl_init();
//// Disable SSL verification
//    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
//// Will return the response, if false it print the response
//    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//// Set the url
//    curl_setopt($ch, CURLOPT_URL,$feedUrl);
//// Execute
//    $result=curl_exec($ch);
//// Closing
//    curl_close($ch);

    $result = file_get_contents($url);

    return $result;

}

function touchNode($nodeId, $lastItem) {
    global $db;

    $query = "UPDATE node SET last_accessed = NOW(), last_item_hash = '$lastItem' WHERE id = $nodeId";

    $db->query($query);
}

function getNodeList() {
    global $db;

    $nodes = $db->get_results("SELECT url, domain FROM node", ARRAY_A);
//
//
//    $nodes_encoded = array();
//
//    foreach ($nodes as $node) {
//        $node_e = array();
//        foreach ($node as $key => $value) {
//            $node_e = base64_encode($value);
//        }
//        $nodes_encoded[] = $node_e;
//    }

    return $nodes;
}

function getNextNode() {
    global $db;

    $nextNode = $db->get_row("SELECT * FROM node ORDER BY last_accessed LIMIT 1", ARRAY_A);

    return $nextNode;
}