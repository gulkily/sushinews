<?php

if(!@include_once("config/env.php")) {
    echo("Please create config/env.php. You can use env.default.php as a starting point.");

    throw new Exception("Please create config/env.php. You can use env.default.php as a starting point.");
}

include_once('module/utilities.php');
include_once('module/sherlock.php');
include_once('module/items.php');

$sherlock = new SherlockSession($db);
$sherlock->populateFromGlobals();
$sherlock->storeSession();

$action = getParam('action');

if (!$action) {
    $action = 'index';
}

if (isset($action)) {
    switch($action) {
        case 'mirror':
            include_once('template/header.php');
            include_once('template/footer.php');
            include_once('template/mirror.php');

            printHeader();

            printMirrorInfo();

            printFooter();

            break;
        case 'edit':
            include_once('template/header.php');
            include_once('template/edit.php');
            include_once('template/footer.php');

            $itemId = intval(getParam('id'));

            if ($itemId) {
                $stmt = $dbp->prepare("SELECT title, body, summary, guid, id FROM item WHERE id=:id");
                $stmt->execute(array(
                    ':id' => $itemId
                ));

                printHeader();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    printEditForm($row['title'], $row['summary'], $row['body'], $row['guid'], $row['id']);
                }

                printFooter();
            }

            break;
        case 'submit':
            include_once('template/header.php');
            include_once('template/edit.php');
            include_once('template/footer.php');

            printHeader();

            printEditForm();

            printFooter();


            break;
        case 'item':
            $itemId = intval(getParam('id'));
            $itemData = getItem($itemId);

            $linkedItems = getItemsByGuid($itemData['guid'], 20);

            include('template/header.php');
            printHeader();

            include('template/item.php');

            printOneItem($itemData, $linkedItems);

            include('template/footer.php');
            printFooter();

            break;
        case 'compare':
            $one = intval(getParam('one'));
            $two = intval(getParam('two'));
            $itemDataOne = getItem($one);
            $itemDataTwo = getItem($two);

            $linkedItems = getItemsByGuid($itemDataOne['guid'], 20);

            include('template/header.php');
            printHeader();

            include('template/item.php');

            printTwoItems(array($itemDataOne, $itemDataTwo), $linkedItems);

            include('template/footer.php');
            printFooter();

            break;

        case 'index':
            $items = getItems(20);

            include_once('template/item.php');

            include_once('template/header.php');

            include_once('template/footer.php');

            printHeader();

            beginItemList();
            foreach ($items as $item) {
                printItemSummary($item);
            }
            endItemList();
            printFooter();

            break;
        case 'moderate':
            include_once('template/item.php');
            include_once('template/header.php');
            include_once('template/footer.php');

            $eligible = get_cache(
                'voting/eligible',
                60,
                "select guid from ( select guid, count(guid) as gcount from item group by guid) guids where gcount > 1",
                'get_col'
            );

            $rand = rand(0, count($eligible) - 1);

            $guid = $eligible[$rand];

            $versions = get_cache("versions/$guid", 60, "select id from item where guid = '$guid'", 'get_col');

            shuffle($versions);

            $chosen[] = array_pop($versions);
            $chosen[] = array_pop($versions);

            $itemDataOne = getItem($chosen[0]);
            $itemDataTwo = getItem($chosen[1]);

            $linkedItems = getItemsByGuid($guid);

            printHeader();

            printTwoItems(array($itemDataOne, $itemDataTwo), $linkedItems);

            printFooter();

            break;
        default:
    }
}

queue_cache('','','',1);
