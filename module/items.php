<?php

function createNewItem($title, $summary, $body, $parent_id = null, $guid = null, $publish_timestamp = null) {
    global $dbp;

    if (!$guid) {
        $guid = md5(time() . GUID_SEED);
    }

    if ($publish_timestamp) {
        $publish_timestamp_string = date("Y-m-d H:i:s", $publish_timestamp);
    } else {
        $publish_timestamp_string = date("Y-m-d H:i:s", time());
    }

    $stmt = $dbp->prepare(
        "
        INSERT INTO item(guid, title, summary, body, publish_timestamp, parent_id)
        VALUES(:guid, :title, :summary, :body, :publish_timestamp, :parent_id)
        "
    );

    $stmt->bindParam(':guid', $guid);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':summary', $summary);
    $stmt->bindParam(':body', $body);
    $stmt->bindParam(':publish_timestamp', $publish_timestamp_string);
    $stmt->bindParam(':parent_id', $parent_id);

    $stmt->execute();

    $newItemId = $dbp->lastInsertId();

    return $newItemId;
}

function getItems($limit = 20) {
    global $dbp;

    $limit = intval($limit);

    $stmt = $dbp->prepare("SELECT title, body, summary, id, guid, publish_timestamp FROM item_best_v ORDER BY score DESC, publish_timestamp DESC LIMIT $limit");

    $items = get_cache_dbp("items/$limit", 60, $stmt);

    return $items;
}

function updateAllItemScores() {
    global $db;

    $query = "
        SELECT
        item.id item_id,
        ifnull(SUM(tag.weight), 0) score,
        COUNT(item_tag.tag_id) vote_count
        FROM item
        LEFT JOIN item_tag ON item.id = item_tag.item_id
        LEFT JOIN tag ON item_tag.tag_id = tag.id
        GROUP BY item.id
        ORDER BY vote_count
    ";

    $newItemScores = $db->get_results($query);

    foreach ($newItemScores as $newItemScore) {
        $score = $newItemScore->score;
        $item = $newItemScore->item_id;

        $query = "UPDATE item SET score = $score WHERE id = $item";
        $db->query($query);
    }

    // @todo this is sub-optimal and should also be broken down to only update __ at a time

}

function updateItemScore($item_id) {
    global $db;


    $item_id = intval($item_id);
    if (!$item_id) return;

    $query = "SELECT SUM(tag.weight) score FROM tag, item_tag WHERE item_tag.item_id = $item_id AND tag.id = item_tag.tag_id GROUP BY item_tag.item_id";
    $item_score = $db->get_var($query);

    $item_score = intval($item_score);

    $query = "UPDATE item SET score = $item_score WHERE id = $item_id";
    $db->query($query);
/*
    global $dbp;

    $tags = $dbp->prepare("SELECT SUM(tag.weight) score FROM tag, item_tag WHERE item_tag.item_id = :id AND tag.id = item_tag.tag_id GROUP BY item_tag.item_id");
    $tags->bindParam(':id', $item_id);

    $score = get_cache_dbp("itemscore/$item_id", 0, $tags);

    $update = $dbp->prepare("UPDATE item SET score = :score WHERE id = :item_id");
    $update->execute(array(':score' => $score[0]['score'], ':item_id' => $item_id));
*/
}


function getItemsByGuid($guid, $limit = 20) {
    global $dbp;

    $limit = intval($limit);

    $stmt = $dbp->prepare("SELECT title, body, summary, id, guid FROM item WHERE guid = :guid ORDER BY publish_timestamp DESC LIMIT $limit"); //@todo $limit should be passed in through pdo :limit
    //$stmt->execute(array(':guid' => $guid));

    $stmt->bindParam(':guid', $guid);

    $items = get_cache_dbp("related/$guid", 60, $stmt);

    return $items;
}

function getItemUrl($item_id, $format = 'relative') {
    return getLink('item', array('id' => $item_id), $format);
}

function getCommentUrl($item_id) {
    return "http://www.reddit.com/submit?url=" . urlencode(getItemUrl($item_id));
}

function getAvailableTagList() {
    global $dbp;

    $stmt = $dbp->prepare("SELECT id, name, weight, active FROM tag WHERE active = 1 ORDER BY weight DESC, name");

    $tags = get_cache_dbp("alltags_weight", 60, $stmt);

    return $tags;

}

function getItem($item_id) {
    global $dbp;

    $itemId = intval($item_id);
    if (!$itemId) return;

    $stmt = $dbp->prepare("SELECT title, body, summary, id, guid, publish_timestamp, UNIX_TIMESTAMP(publish_timestamp) publish_timestamp_u FROM item WHERE id=:id");
    $stmt->bindParam(':id', $itemId);

    $item = get_cache_dbp("item/$itemId", 60, $stmt);

    $itemData = array();

    if (count($item) > 0) {
        $row = $item[0];

        $tags = $dbp->prepare("SELECT name, COUNT(name) tag_count FROM tag, item_tag WHERE item_tag.item_id = :id AND tag.id = item_tag.tag_id GROUP BY name");
        $tags->bindParam(':id', $itemId);

        $tags = get_cache_dbp("itemtags/$itemId", 60, $tags);

        $itemTags = array();

        foreach ($tags as $tag) {
            $itemTags[] = array('name' => $tag['name'], 'count' => $tag['tag_count']);
        }

        $itemData = array(
            'title' => $row['title'],
            'summary' => $row['summary'],
            'body' => $row['body'],
            'id' => $row['id'],
            'tags' => $itemTags,
            'publish_timestamp' => $row['publish_timestamp'],
            'publish_timestamp_u' => $row['publish_timestamp_u'],
            'guid' => $row['guid']
        );
    }

    return $itemData;
}
