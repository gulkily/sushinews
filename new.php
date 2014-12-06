<?php
include_once('module/utilities.php');
include_once('module/items.php');

    if (isPost()) {
        $title = trim(getParam('title'));
        $summary = trim(getParam('summary'));
        $body = trim(getParam('body'));
        $group = getParam('group');
        $parent_id = getParam('parentstory');

        if ($group || $parent_id) {
            // this could be prettier, but it's enough
            // if the password doesn't match up for an existing article, something is wrong
            if (!getParam('password') || getParam('password') != md5($group . '-' . $parent_id . '-' . SECRET_SALT)) die("Something went wrong...");
        }

        if(!preg_match('/^[a-f0-9]{32}$/i', $group)) {
            die(); //this needs to be fixed when replacing md5 with something better
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

            $oldItemId = getItemByHash(md5($title . $summary . $body));

            if ($oldItemId) {
                put_ticket(array("An exact copy of this item already exists. Here it is!"), getItemUrl($oldItemId, 'absolute'));
            }

            $newItemId = createNewItem($title, $summary, $body, $parent_id, $group);

            if ($newItemId) {
                delete_cache('items/*', 1);
                if ($group) {
                    delete_cache("related/$group", 1);
                }

                header('Location: ' . getItemUrl($newItemId));
            }
        } else {
            echo ("You forgot something...");
            // @todo make this more user-friendly
        }
    }