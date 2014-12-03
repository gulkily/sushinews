<?php
include_once('module/utilities.php');
include_once('module/items.php');

    if (isset($_POST)) {
        $title = trim(getParam('title'));
        $summary = trim(getParam('summary'));
        $body = trim(getParam('body'));
        $guid = getParam('guid');
        $parent_id = getParam('parentstory');

        if ($guid || $parent_id) {
            // this could be prettier, but it's enough
            if (!getParam('password')) die();
            if (getParam('password') != md5($guid . '-' . $parentid . '-' . SECRET_SALT)) die();
        }

        if (!$summary && $body) {
            $body_lines = explode("\n", trim($body));
            $summary = $body_lines[0];

            $body_new = '';

            $comma = 0;

            foreach ($body_lines as $line) {
                $line = trim($line);

                if ($line) {
                    if ($comma) {
                        $body_new .= "\n\n";
                    } else {
                        $comma = 1;
                    }

                    $body_new .= $line;
                }
            }

            $body = $body_new;
        }

        if ($title && $summary && $body) {
            $newItemId = createNewItem($title, $summary, $body, $parent_id, $guid);

            if ($newItemId) {
                header('Location: ' . getItemUrl($newItemId));
            }
        }
    }