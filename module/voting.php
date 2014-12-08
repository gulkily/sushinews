<?php

function getVotingHash($client_id, $item_id, $tag) {
    return md5($client_id . $item_id . $tag . getConfig('secret_salt'));
}

function getVoterId() {
    static $voter;

    if (isset($_COOKIE['voter_id'])) {
        $voter_id = $_COOKIE['voter_id'];

        $voter = explode(',', $voter_id);
    }

    // @todo some sanity checks here
    if ($voter[1] == md5($voter[0] . $_SERVER['REMOTE_ADDR'] . getConfig('secret_salt'))) {
        return $voter[1];
    } else {
        return 0;
    }
}

function setVoterIdCookie($voter_id) {
    $cookie = $voter_id . ',' . md5($voter_id . $_SERVER['REMOTE_ADDR'] . getConfig('secret_salt'));

    if (!headers_sent()) setcookie('voter_id', $cookie);

    $_COOKIE['voter_id'] = $cookie;
}

function unsetVoterIdCookie() {
    if (!headers_sent()) setcookie('voter_id', '', time() - 3600);

    unset($_COOKIE['voter_id']);
}

function generateVoterId() {
    $host = $_SERVER['REMOTE_ADDR'];
    $host .= round(time() / 3600);
    $host = md5($host);

    global $db;
    $last_assignment = $db->get_var("SELECT last_assignment FROM voter_id_rate WHERE host = '$host' AND DATE_ADD(last_assignment, INTERVAL 15 SECOND) > NOW()"); // @todo escape

    if ($last_assignment === null) {
        $query = "INSERT INTO voter_id_rate(host, last_assignment) VALUES('$host', NOW())";
        $db->query($query);

        $voter_id = md5(rand(0,100000) . time()); // @todo make this more random

        return $voter_id;
    } else {
        return null;
    }
}

function verifyVotingHash($client_id, $item_id, $tag, $hash) {
    if (md5($client_id . $item_id . $tag . getConfig('secret_salt')) == $hash) {
        return true;
    } else {
        return false;
    }
}