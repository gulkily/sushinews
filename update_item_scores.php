<?php

if(!@include_once("config.php")) {
    echo("Please create config.php. You can use config.default.php as a starting point.");

    throw new Exception("Please create config.php. You can use config.default.php as a starting point.");
}

include_once('module/utilities.php');
//include_once('module/sherlock.php');
include_once('module/items.php');

updateAllItemScores();