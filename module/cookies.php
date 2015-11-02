<?php

function isThereAPackage($cookies) {

}

function getSizeOfStoredCookies() {
    $cookies = $_COOKIE;

    if (count($cookies) == 0) {
        return 0;
    } else {
        $cookieSize = 0;

        foreach ($cookies as $cookie) {
            $cookieSize += strlen($cookie);

        }

        return $cookieSize;
    }
}

function clearCookies() {
    // @todo careful here!


}
//
//function savePackage() {
//    $piece_length = 1024;
//
//    $name = sha1(rand()); //todo fixme
//
//    $data = base64_encode(json_encode($data));
//
//    $data = str_split($data, $piece_length);
//
//    $count = count($data);
//
//    foreach ($data as $key => $cookie) {
//        setcookie($name.'.'.$count.'.'.$key, $cookie);
//    }
//
//}

function createPackageFromItem($itemId) {
    global $db;

    $itemId = intval($itemId);

    if (!$itemId) return;

    $items = $db->get_results("SELECT hash, title, body, summary, language, author FROM item WHERE id = $itemId");

    if (count($items) == 0) return;

    $item = (array) $items[0];

    $itemJson = json_encode($item);

    createPackage($item['hash'], $itemJson);
}

function createPackage($name, $data) {
    global $db;

    $name = $db->escape($name);

    $chunkSize = 1024;

    $data = base64_encode($data);
    $dataSplit = str_split($data, $chunkSize);

    $result = $db->query("INSERT INTO package(name) VALUES('$name')");

    if ($result) {

        $packageId = intval($db->insert_id);

        $pieceNo = 0;
        foreach ($dataSplit as $chunk) {
            $pieceNo++;
            $query[] = "INSERT INTO package_piece(package_id, piece_no, data) VALUES('$packageId', '$pieceNo', '$chunk')";
        }

        foreach ($query as $q) {
            $db->query($q);
        }
    }
}
//
//if (getSizeOfStoredCookies()) {
//    echo getSizeOfStoredCookies();
//
//} else {
//    savePackage();
//}