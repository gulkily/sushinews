<?php

function doTask($taskName) {
    switch($taskName) {
        case 'pull_node':
            include_once('module/node.php');

            $nextNode = getNextNode();

            pullNodeFeed($nextNode);
            pullNodeList($nextNode);

            break;

        case 'export':
            include_once('module/export.php');

            writeHtmlArchive(getConfig('mirror_path') . '/', 'mirror_all.zip');
            writeMysqlDump(getConfig('mirror_path') . '/', 'sushinews');
            writeMysqlSchema(getConfig('mirror_path') . '/', 'sushinews');
            writeJsonArchive(getConfig('mirror_path') . '/', 'sushinews');

            break;

        case 'update_scores':
            updateAllItemScores(1000); //@todo needs the limit in the function

            break;

        case 'cleanup_tables':
            global $db;

            $db->query("DELETE FROM voter_id_rate WHERE DATE_ADD(last_assignment, INTERVAL 5 MINUTE) < NOW()");

            break;

        case 'update_cache':
            batch_cache(10, 1);

            break;


        default:
            break;
    }
}

function getTasksMenu() {
    $possibleTasks = array(
        'export',
        'update_scores',
        'cleanup_tables',
        'update_cache',
        'pull_node'
    );

    return $possibleTasks;
}

function getRandomTask() {
    $possibleTasks = getTasksMenu();

    srand(time());
    $index = rand(1, count($possibleTasks)) - 1;

    $task = $possibleTasks[$index];

    return $task;
}