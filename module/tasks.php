<?php

function doTask($taskName) {
    switch($taskName) {
        case 'export':
            include_once('module/export.php');

            writeHtmlArchive('./mirror/', 'mirror_all.zip');
            writeMysqlDump('./mirror/', 'sushinews');

            break;
        default:
            break;
    }
}