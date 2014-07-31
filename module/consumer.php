<?php

include_once('simplepie/autoloader.php');

$feed = new SimplePie();

//$feed->set_cache_location('mysql://root:admin@localhost:3306/sushinews');

//$feed->set_feed_url("https://en.wikinews.org/w/index.php?title=Special:NewsFeed&feed=atom&namespace=0&count=15");
$feed->set_feed_url("http://sushi.local/xmlgen3.php");

$feed->init();
$feed->handle_content_type();

foreach($feed->get_items(0, 30) as $item) {
    print_r($item);
}
