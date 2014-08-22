<?php

include_once('config/env.php');
include_once('module/utilities.php');
include_once('module/sherlock.php');

$sherlock = new SherlockSession($db);
$sherlock->populateFromGlobals();
$sherlock->storeSession();

//$sherlock->getRelatedSession()

$action = getParam('action');

if (!$action) {
    $action = 'index';
}

if (isset($action)) {
    switch($action) {
        case 'mirror':
            include('template/header.php');

            printHeader();

            include('template/mirror.php');

            printMirrorInfo();

            include('template/footer.php');

            printFooter();

            break;
        case 'edit':
            $itemId = intval(getParam('id'));

            if ($itemId) {
                $stmt = $dbp->prepare("SELECT title, body, summary, guid, id FROM item WHERE id=:id");
                $stmt->execute(array(
                    ':id' => $itemId
                ));

                include('template/header.php');
                printHeader();

                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    include('template/edit.php');

                    printEditForm($row['title'], $row['summary'], $row['body'], $row['guid'], $row['id']);
                }

                include('template/footer.php');
                printFooter();

            }

            break;
        case 'submit':

            include('template/header.php');
            printHeader();

            include('template/edit.php');

            printEditForm();

            include('template/footer.php');
            printFooter();


            break;
        case 'item':
            $itemId = intval(getParam('id'));
            $itemData = getItem($itemId);

            $linkedItems = getItemsByGuid($itemData['guid'], 20);

            //$stmt = $db->prepare("SELECT * FROM item WHERE id=:id AND name=:name");
//            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            //$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

            //$stmt = $db->prepare("SELECT * FROM item WHERE id=:id AND name=:name");
//            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
//            $stmt->bindValue(':name', $name, PDO::PARAM_STR);
            //$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

            include('template/header.php');
            printHeader();

            include('template/item.php');

            printTwoItems(array($itemDataOne, $itemDataTwo), $linkedItems);

            include('template/footer.php');
            printFooter();

            break;

        case 'index':
            $items = getItems(20);

            include('template/item.php');

            include('template/header.php');
            printHeader();

            beginItemList();
            foreach ($items as $item) {
                printItemSummary($item);
            }
            endItemList();
            include('template/footer.php');
            printFooter();

            break;
        default:
    }
}

queue_cache('','','',1);
