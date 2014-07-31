<?php
    include_once('module/utilities.php');

    if (isset($_POST)) {
        $title = getParam('title');
        $summary = getParam('summary');
        $body = getParam('body');
        $guid = getParam('guid');
        $parent_id = getParam('parentstory');

        if ($title && $summary && $body) {
            $newItemId = createNewItem($title, $summary, $body, $parent_id, $guid);

            if ($newItemId) {
                header('Location: ' . getItemUrl($newItemId));//@todo get site domain
            }
        }
    }