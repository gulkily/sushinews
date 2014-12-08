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

function importItems($blob) {
    echo $blob;
}

function getNodeList() {
    global $db;

    $nodes = $db->get_results("SELECT url, domain FROM node");

    $nodes_encoded = array();

    foreach ($nodes as $node) {
        $node_e = array();
        foreach ($node as $key => $value) {
            $node_e = base64_encode($value);
        }
        $nodes_encoded[] = $node_e;
    }

    return $nodes_encoded;
}

function getNextNode() {
    global $db;

    $nextNode = $db->get_row("SELECT * FROM node ORDER BY last_accessed LIMIT 1");

    return $nextNode;
}