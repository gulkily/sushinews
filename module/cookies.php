<?php

include_once('module/config.php');
include_once('module/utilities.php');


function getPackages($cookies) {
    $packages = array();
    $pieceCounts = array();

    if (count($cookies)) {
        foreach($cookies as $key => $cookie) {
            if (substr($key, 0, 9) == "sushiroll") {
                $keyData = explode('_', $key);

                if (count($keyData) == 4) {
                    $packageName = $keyData[1];
                    $pieceIndex = $keyData[2];
                    $pieceCount = $keyData[3];

                    $packages[$packageName][$pieceIndex] = $cookie;
                    $pieceCounts[$packageName][] = $pieceCount;
                }
            }
        }

        if (count($packages)) {
            $decodedPackages = array();

            foreach($packages as $key => $data) {
                $pieceCount = array_unique($pieceCounts[$key]);
                if (count($pieceCount) == 1) {
                    $pieceCount = $pieceCount[0];

                    if (count($data) == $pieceCount) {
                        $data = implode('', $data);

                        $data = base64_decode($data);

                        $data = json_decode($data);

                        $decodedPackages[] = (array) $data;
                    }
                }
            }

            return $decodedPackages;
        }
    }
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

function putPackageFromItem($name) {
    global $db;

    $name = $db->escape($name);

    $package = $db->get_row("SELECT * FROM package WHERE name = '$name'");

    if ($package) {
        $packageId = intval($package->id);
        $packageName = $package->name;

        $packageData = $db->get_results("SELECT * FROM package_data WHERE package_id = $packageId");
    }

    putPackage($packageName, $packageData);
}

function putPackage($packageName, $packageData) {
    $chunkSize = 1024;

    $data = base64_encode(json_encode($packageData));
    $dataSplit = str_split($data, $chunkSize);

    $pieceCount = count($packageData);
    $cookieNumber = 0;

    print_r($packageData);

    foreach ($dataSplit as $key => $cookie) {
        $cookieNumber++;

        $cookieName = 'sushiroll_' . $packageName . '_' . $cookieNumber . '_' . $pieceCount;
        $cookieData = $cookie;

        setcookie($cookieName, $cookieData, time() + 86400, '/');
    }
}

function removePackage($cookies, $name) {

}

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
            $query[] = "INSERT INTO package_data(package_id, piece_no, data) VALUES('$packageId', '$pieceNo', '$chunk')";
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