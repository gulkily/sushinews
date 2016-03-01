<?php

if(!@include_once("config.php")) {
    echo("Please create config.php. You can use config.default.php as a starting point.");

    throw new Exception("Please create config.php. You can use config.default.php as a starting point.");
}

include_once('module/config.php');
include_once('module/utilities.php');
//include_once('module/sherlock.php');
include_once('module/items.php');

if (!get_cache('config')) {
    include_once('module/setup.php');

    $setupClass = new SetupClass();

    if ($setupClass->getTables() == 0) {
        $setupClass->populateDatabase();
    }
}


//include_once('module/setup.php');

//$setupClass = new SetupClass();
//$setupClass->upgradeDatabase(1, 2);

//$sherlock = new SherlockSession($db);
//$sherlock->populateFromGlobals();
//$sherlock->storeSession();
//
$action = getParam('action');

if (!$action) {
    $action = 'index';
}

if (isset($action)) {
    switch($action) {
        case 'node':
            include_once('module/node.php');

            if (!getParam('since')) {
                $itemList = getItemExport(getParam('since'));
            } else {
                if (isHash(getParam('since'))) {
                    $itemList = getItemExport(getParam('since'));
                } else {
                    die('Check parameter and try again');
                }
            }

            echo json_encode($itemList, JSON_UNESCAPED_UNICODE);

            break;

        case 'alltasks':
            if ($_SERVER['SERVER_ADDR'] == '::1' || getVoterId()) { //@todo make this less accessible
                include_once('module/tasks.php');
                $tasks = getTasksMenu();
                foreach($tasks as $task) {
                    doTask($task);

                }
                echo "done";
            }
            break;

        case 'about':
            include_once('template/header.php');
            include_once('template/about.php');
            include_once('template/footer.php');

            printHeader('About');

            printAbout();

            printFooter();

            break;
        case 'mirror':
            include_once('template/header.php');
            include_once('template/footer.php');
            include_once('template/mirror.php');

            printHeader('Mirroring This Site');

            printMirrorInfo();

            printFooter();

            break;
        case 'edit':
            include_once('template/header.php');
            include_once('template/edit.php');
            include_once('template/footer.php');

            $itemId = intval(getParam('id'));

            if ($itemId) {
                $stmt = $dbp->prepare("SELECT title, body, summary, group_id, id FROM item WHERE id=:id");
                $stmt->execute(array(
                    ':id' => $itemId
                ));

                printHeader('Edit Item ' . $itemId);

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    printEditForm($row['title'], $row['summary'], $row['body'], $row['group_id'], $row['id']);
                }

                printFooter();
            }

            break;
        case 'submit':
            include_once('template/header.php');
            include_once('template/edit.php');
            include_once('template/footer.php');

            printHeader('Submit a Story');

            printEditForm();

            printFooter();


            break;
        case 'item':
            $itemId = intval(getParam('id'));

            if (!$itemId) {
                die("No such item (1)");
            }

            $itemData = getItemById($itemId);

            if (!$itemData) {
                die("No such item (2)");
            }

            $linkedItems = getItemsByGroup($itemData['group_id'], 20);

            include('template/header.php');
            printHeader($itemData['title']);

            include('template/item.php');

            printOneItem($itemData, $linkedItems);

            include('template/footer.php');
            printFooter();

            break;
        case 'compare':
            $one = intval(getParam('one'));
            $two = intval(getParam('two'));
            $itemDataOne = getItemById($one);
            $itemDataTwo = getItemById($two);

            $linkedItems = getItemsByGroup($itemDataOne['group_id'], 20);

            include('template/header.php');
            printHeader("Compare items $one vs $two");;

            include('template/item.php');

            printTwoItems(array($itemDataOne, $itemDataTwo), $linkedItems);

            include('template/footer.php');
            printFooter();

            break;

        case 'json': //@todo change this to something more descriptive
            $params = array();
            $params['limit'] = 20;

            $lastItem = getParam('last');

            if ($lastItem) {
                if (isHash($lastItem)) {
                    $params['since'] = $lastItem;
                }
            }

            $items = getItems($params);

            header('Content-Type: application/json');
            echo(json_encode($items));

            ob_flush();

            if (getParam('me')) {
                include_once('module/node.php');
                addNode(getParam('me'));
            }

            break;

        case 'getScores':
            include_once('module/node.php');

            $since = intval(getParam('since'));
/*
            $items =
select item.id, sum(item.score) item_score, max(item_tag.vote_timestamp) last_vote
from item_tag, item
where
item_tag.item_id = item.id
and unix_timestamp(item_tag.vote_timestamp) > 1115847323
group by item.id
order by last_vote

*/
            break;

        case 'getNodes':
            include_once('module/node.php');

            $nodes = getNodeList();

            header('Content-Type: application/json');
            echo(json_encode($nodes));

            break;

        case 'index':
            $items = getItems(array('limit' => 20));

            include_once('template/item.php');

            include_once('template/header.php');

            include_once('template/footer.php');

            printHeader("Front Page");

            beginItemList();
            foreach ($items as $item) {
                printItemSummary($item);
            }
            endItemList();
            printFooter();

            break;
        case 'moderate':
            include_once('template/header.php');
            include_once('template/footer.php');

            $showModWelcome = 0;

            if (isPost() && getParam('token') == 'welcome') {
                $voter_id = generateVoterId();
                setVoterIdCookie($voter_id);

                put_ticket(array("You now have a moderation token and can moderate."), getLink('moderate'));
            }

            if (getParam('token') == 'remove') {
                $voter_id = null;
                unsetVoterIdCookie();
            }

            if (!getVoterId()) {
                include_once('template/notoken.php');

                printHeader("Moderation");
                printNoToken();
                printFooter();

                break;
            }

            include_once('template/item.php');

            include_once('template/moderation.php');

            $eligible = get_cache(
                'voting/eligible',
                60,
                "select group_id from ( select group_id, count(group_id) as gcount from item group by group_id) groups where gcount > 1",
                'get_col'
            );

            if (!count($eligible)) {
                echo("Sorry, there is nothing for you to moderate at this time.");
                //@todo make this pretty
            } else {

                $rand = rand(0, count($eligible) - 1);

                $group = $eligible[$rand];

                $versions = get_cache("versions/$group", 60, "select id from item where group_id = '$group'", 'get_col');

                shuffle($versions);

                $chosen[] = array_pop($versions);
                $chosen[] = array_pop($versions);

                $itemDataOne = getItemById($chosen[0]);
                $itemDataTwo = getItemById($chosen[1]);

                $linkedItems = getItemsByGroup($group);

                printHeader("Moderation");

                if ($showModWelcome) {
                    printModerationWelcome();
                }

                printTwoItems(array($itemDataOne, $itemDataTwo), $linkedItems);

                if (!$showModWelcome) {
                    printModerationFooter();
                }
            }

            printFooter();

            break;
        default:
    }

}

queue_cache('','','',1);

srand(time());
if (rand(1, 10) == 5) {
    include_once('module/tasks.php');
    ob_flush();
    $task = getRandomTask();
    doTask($task);
}


