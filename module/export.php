<?php

include_once('ez_sql.php');
include_once('utilities.php');

function writeMysqlDump($path, $filename) {
    shell_exec('mysqldump -uroot -padmin sushinews >' . $path . $filename);
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

function writeSiteDump() {

}

writeHtmlArchive('/home/ilya/sushi/mirror/', 'mirror_all.zip');
writeMysqlDump('/home/ilya/sushi/mirror/', 'sushinews.sql');

//check to make sure the file exists
//return file_exists($destination);


//
//    $stmt = $dbp->prepare("
//        SELECT item, id INTO OUTFILE
//        '/home/ilya/sushi/mirror/test.sql'
//        FROM item
//    ");
//
//    $stmt->execute();


//
//    $db->query("SELECT * INTO OUTFILE '/home/ilya/sushi/mirror/test.sql' FROM item");