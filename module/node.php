<?php

function getItemExport($hash = null) {
    global $db;

    //if (!isHash($hash)) return null;

    $fields = "hash, title, body, id, publish_timestamp, score";

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

    $result = grabUrl($feedUrl);

    if ($result) {

        $nodes = json_decode($result, 1);

        if (count($nodes)) {
            foreach ($nodes as $node) {
                addNode($node['url']);
            }
        }
    }
}

function pushNodeList($node) {
    $pushUrl = $node['url'] . '?action=putNodes';

    $postData = array();
    $postData['nodes'] = json_encode(getGoodNodeList());
    $postData['items'] = json_encode(getItemExport());//@todo add last accessed hash

    postUrl($pushUrl, $postData);

//
//    $result = grabUrl($feedUrl);
//
//    $nodes = json_decode($result, 1);
//
//    foreach ($nodes as $node) {
//        addNode($node['url']);
//    }
}

function pullNodeFeed($node) {
    $feedUrl = $node['url'] . '?action=json';

    $feedUrl .= '&me=' . urlencode(getLink('json'));

    if ($node['last_item_hash'] && isHash($node['last_item_hash'])) {
        $feedUrl .= '&last=' . $node['last_item_hash'];
    }

    $result = grabUrl($feedUrl);

    $items = json_decode($result, 1);

    if (count($items)) {
        foreach ($items as $item) {
            $existingItem = getItemIdByHash($item['hash']);
            if (!$existingItem) {
                $newItem = createNewItem($item['title'], $item['summary'], $item['body']);
            } else {
                $newItem = $existingItem;
            }

            if ($newItem) {
                addNodeItemScore($newItem, $node['id'], $item['score']);
            } else {
            }

            touchNode($node['id'], $item['hash']);
        }

        delete_cache('items/*', 1);

    }
}

function addNode($nodeUrl) {
    global $db;

    $nodeExists = $db->get_var("SELECT COUNT(id) FROM node WHERE url = '".$db->escape($nodeUrl)."'");

    if (!$nodeExists) {
        $db->query("INSERT INTO node(url) VALUES('".$db->escape($nodeUrl)."')");
    }
}

function grabUrl($url, $params = array()) {
    $curl = curl_init();

    if ($curl) {
        curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
        // @todo remove hard-coded useragent
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, 60);
        curl_setopt($curl, CURLOPT_HTTPGET, 1);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE);

        if (isset($params['use_tor']) && $params['use_tor']) {
            curl_setopt($curl, CURLOPT_PROXY, 'http://127.0.0.1:9050/');
            curl_setopt($curl, CURLOPT_PROXYTYPE, 7);
        }

        $result = curl_exec($curl);

        return $result;
    } else {
        return null;
    }
}

function postUrl($url, $postData) {
    //$url = 'http://server.com/path';
    //$data = array('key1' => 'value1', 'key2' => 'value2');

    $options = array(
        'http' => array(
            'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
            'method'  => 'POST',
            'content' => http_build_query($postData),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    var_dump($result);

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
function getGoodNodeList() {
    global $db;

    $query = "UPDATE node SET access_delay = MAX(access_delay - 1, 0)";
    $db->query($query);

    $nodes = $db->get_results("SELECT url, domain FROM node WHERE score >= 0", ARRAY_A);

    return $nodes;
}

function getNextNode() {
    global $db;

    $nextNode = $db->get_row("SELECT * FROM node ORDER BY last_pull LIMIT 1", ARRAY_A);

    return $nextNode;
}