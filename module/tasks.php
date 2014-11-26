<?php

function doTask($taskName) {
    switch($taskName) {
        case 'export':
            include_once('module/export.php');

            writeHtmlArchive('./mirror/', 'mirror_all.zip');
            writeMysqlDump('./mirror/', 'sushinews');

            break;

        case 'update_scores':
            updateAllItemScores(1000); //@todo needs the limit in the function

            break;

        default:
            break;
    }
}

function getRandomTask() {
    $possibleTasks = array(
        'export',
        'update_scores'
    );

    $task = array_rand($possibleTasks);

    return $task;
}