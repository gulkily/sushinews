<?php

include_once('config/env.php');
include_once('module/ez_sql.php');
include_once('module/utilities.php');
include_once('module/items.php');

function writeMysqlDump($path, $filename) {

    $tables_data = array(
        'item',
        'item_tag',
        'record_client_count',
        'source',
        'tag',
        'user',
    );

    $tables = array(
        'cache_queue',
        'client_record_v',
        'client_session',
        'client_session_t',
        'client_variable',
        'fp_client',
        'fp_field',
        'fp_record',
        'fp_session',
        'item_best_v',
        'session',
        'session_record',
        'session_record_active',
        'sherlock_config',
    );

    //data dump using insert ignore to sushinews_data.sql
    shell_exec('mysqldump --insert-ignore -uroot -padmin sushinews >' . $path . $filename . '_data.sql ' . implode(' ', $tables_data));

    //dump database schema to sushinews_schema.sql
    shell_exec('mysqldump -d -uroot -padmin sushinews >' . $path . $filename . '_schema.sql');

    // gzip the data file
    shell_exec('gzip -f -9 ' . $path . $filename . '_data.sql');
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
        $output .= '<h3><a href="' . $item['guid'] . '_' . $item['id'] . '.html">' . $item['title'] . '</a></h3>';
        $output .= '<p>' . $item['summary'] . '</p>';
    }

    $output .= '</body>';

    file_put_contents($path . "index.html", $output);

    $tempFiles[] = 'index.html';

    $zip->addFile($path . 'index.html', 'index.html');

    foreach($items as $item) {
        $filename = $item['guid'] . '_' . $item['id'] . ".html";
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
