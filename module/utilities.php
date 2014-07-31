<?php
include_once('env.php');
include_once('ez_sql.php');
include_once('cache.php');



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

function getParam($name) {
    if (isset($_GET[$name])) {
        $param = $_GET[$name];
    } elseif (isset($_POST[$name])) {
        $param = $_POST[$name];
    } else {
        $param = '';
    }

    return $param;
}

function getItems($limit = 20) {
    global $dbp;

    $limit = intval($limit);

    $stmt = $dbp->prepare("SELECT title, body, summary, id, guid, publish_timestamp FROM item ORDER BY score DESC, publish_timestamp DESC LIMIT $limit"); //@todo $limit should be passed in through pdo :limit

    $items = get_cache_dbp("items/$limit", 60, $stmt);

    return $items;
}

function updateItemScore($item_id) {
    global $dbp;

    $tags = $dbp->prepare("SELECT SUM(tag.weight) score FROM tag, item_tag WHERE item_tag.item_id = :id AND tag.id = item_tag.tag_id GROUP BY item_tag.item_id");
    $tags->bindParam(':id', $item_id);

    $score = get_cache_dbp("itemscore/$item_id", 0, $tags);

    $update = $dbp->prepare("UPDATE item SET score = :score WHERE item_id = :item_id");
    $update->execute(array(':score' => $score[0]['score'], ':item_id' => $item_id));
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

function getItemUrl($item_id) {
//    return "http://sushi.local/?action=item&id=" . $item_id;
    return "http://" . getOwnUrl() . "/" . $item_id;

}

function getCommentUrl($item_id) {
    return "http://www.reddit.com/submit?url=" . urlencode(getItemUrl($item_id));
}

function getAvailableTagList() {
    global $dbp;

    $stmt = $dbp->prepare("SELECT * FROM tag");

    $tags = get_cache_dbp("alltags", 60, $stmt);

    return $tags;

}

function getItem($item_id) {
    global $dbp;

    $itemId = intval($item_id);
    if (!$itemId) return;

    $stmt = $dbp->prepare("SELECT title, body, summary, id, guid FROM item WHERE id=:id");
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
            'guid' => $row['guid']
        );
    }

    return $itemData;
}

function getLink($action, $text = null, $id = null, $class = null) {

}

function getToken() {
    return md5('todo');
}

function getTagId($tag_name) {
    global $dbp;

    $tag = strtolower(trim($tag_name));

    $stmt = $dbp->prepare("SELECT id FROM tag WHERE name = :tag LIMIT 1");
    $stmt->bindValue(':tag', $tag);

    $tag_id = get_cache_dbp('tagid/' . md5($tag_name), 60, $stmt);

    return $tag_id[0]['id'];

}

function addTagToItem($item_id, $tag_name, $client_id) {
    global $dbp;

    $item = intval($item_id);
    $tag = strtolower(trim($tag_name));
    $client_id = intval($client_id);

    if (!$item || !$tag) {
        return;
    }

    $tag_id = getTagId($tag);

    if (!$tag_id) {
        return;
    }

    $stmt = $dbp->prepare("INSERT INTO item_tag(item_id, tag_id, client_id) VALUES(:item_id, :tag_id, :client_id)");

    $stmt->execute(array(':item_id' => $item, ':tag_id' => $tag_id, ':client_id' => $client_id));
}

function getTopics() {

}

function getUserId() {
    return 1;
}

function getOwnUrl() {
    return ($_SERVER['HTTP_HOST']);
}

function createUser() {
    // returns hash for cookie

}