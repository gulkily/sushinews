<?php

class SetupClass {
    function getLastDatabaseVersion() {
        return 2;
    }

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

        $this->setDatabaseVersion($this->getLastDatabaseVersion());

        //@todo this is a work in progress, since it doesn't work for some mysterious reason
    }

    function getDatabaseVersion() {
        global $db;

        $query = "SELECT value FROM config WHERE key = 'db_version'";

        $databaseVersion = intval($db->get_var($query));

        return $databaseVersion;
    }

    function setDatabaseVersion($newVersion) {
        global $db;

        $newVersion = intval($newVersion);

        $query = "INSERT INTO config(key, value) VALUES('db_version', $newVersion) ON DUPLICATE KEY UPDATE";

        $db->query($query);
    }

    function upgradeDatabase($currentVersion, $newVersion) {

        if ($currentVersion + 1 !== $newVersion) {
            return;
        }

        $queries = array();


        switch($currentVersion) {
            case 1:
                $queries[] = "ALTER TABLE `config` ADD PRIMARY KEY `key` (`key`), DROP INDEX `key`;";
                break;
            case 2:
                $queries[] = "ALTER TABLE `item_tag` ADD `vote_timestamp` datetime NOT NULL AFTER `voter_id`;";
                $queries[] = "ALTER TABLE `item_tag` ADD UNIQUE `item_id_tag_id_voter_id` (`item_id`, `tag_id`, `voter_id`), DROP INDEX `item_id_tag_id_client_id`; ";
                break;
        }

        global $db;

        foreach ($queries as $query) {
            $db->query($query);
        }

        setDatabaseVersion($newVersion);

    }
}