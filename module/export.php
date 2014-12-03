<?php

include_once('config/env.php');
include_once('module/ez_sql.php');
include_once('module/utilities.php');
include_once('module/items.php');

function writeMysqlDump($path, $filename) {

    $tables_data = array(
        'item',
        'item_tag',
        'source',
        'tag',
        'user',
    );

    //data dump using insert ignore to sushinews_data.sql
    shell_exec('mysqldump --insert-ignore -u'.EZSQL_DB_USER.' -p'.EZSQL_DB_PASSWORD.' '.EZSQL_DB_NAME.' >' . $path . $filename . '_data.sql ' . implode(' ', $tables_data));
//
//    //dump database schema to sushinews_schema.sql
//    shell_exec('mysqldump --disable-extended-insert --compact -d -uroot -padmin sushinews >' . $path . $filename . '_schema.sql');
//    shell_exec('mysqldump --disable-extended-insert --compact -uroot -padmin sushinews config node tag >>' . $path . $filename . '_schema.sql');

    // gzip the data file
    shell_exec('gzip -f -9 ' . $path . $filename . '_data.sql');
}

function writeMysqlSchema($path, $filename) {
    global $db;
    $db->query("SET sql_mode = 'ANSI';");

    $sql = "";

    $tables = $db->get_col("SHOW FULL TABLES WHERE table_type LIKE '%TABLE%'");
    $data_tables = array('config', 'node', 'tag'); //@todo still need to add these

    foreach ($tables as $table) {
        $query = $db->get_var("SHOW CREATE TABLE $table", 1);
        $sql .= $query . ";\n\n";
    }

    $file = @fopen($path . $filename . '_schema.sql', 'w');
    if ($file) {
        fwrite($file, $sql);
        fclose($file);
    }
}

function writeHtmlArchive($path, $filename) {
    $items = getItems(100000);

    $zip = new ZipArchive();

    $tempFiles = array();

    $destination = $path . $filename;
    $overwrite = true;

    if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
        return false;
    }

    $output = '<html><head><meta charset="utf-8" /><title>s.n.</title></head>';
    $output .= '<body>';

    foreach ($items as $item) {
        $output .= '<h3><a href="' . $item['group_id'] . '_' . $item['id'] . '.html">' . $item['title'] . '</a></h3>';
        $output .= '<p>' . $item['summary'] . '</p>';
    }

    $output .= '</body>';

    file_put_contents($path . "index.html", $output);

    $tempFiles[] = 'index.html';

    $zip->addFile($path . 'index.html', 'index.html');

    foreach($items as $item) {
        $filename = $item['group_id'] . '_' . $item['id'] . ".html";
        $tempFiles[] = $filename;

        $output = '<html><head><meta charset="utf-8" /><title>s.n.</title></head>';
        $output .= '<body>';

        $output .= '<h3>' . $item['title'] . '</h3>';
        $output .= '<p>' . nl2br($item['body']) . '</p>';

        $output .= '</body>';

        file_put_contents($path . $filename, $output);

        $zip->addFile($path . $filename, $filename);
    }

    $zip->close();

    foreach($tempFiles as $file) {
        unlink ($path . $file);
    }

}
