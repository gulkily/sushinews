<?php


if(!@include_once("config/env.php")) {
    echo("Please create config/env.php. You can use env.default.php as a starting point.");

    throw new Exception("Please create config/env.php. You can use env.default.php as a starting point.");
}

include_once('module/utilities.php');
include_once('module/sherlock.php');
include_once('module/items.php');

updateAllItemScores();