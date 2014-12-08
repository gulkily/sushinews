<?php

function getTables() {
    global $db;

    $tables = $db->get_col("SHOW TABLES");

    return $tables;
}

function populateDatabase() {
    global $db;

    $schema = file_get_contents(getConfigDefault('mirror_path') . '/sushinews_schema.sql');

    $queries = explode(';', $schema);

    foreach ($queries as $query) {
        $db->query($query);
    }

    //@todo this is a work in progress, since it doesn't work for some mysterious reason
}