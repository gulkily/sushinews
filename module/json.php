<?php

function getJson($items) {
    return json_encode($items);
}

function getItemsFromJson($itemsJson) {
    return json_decode($itemsJson);
}