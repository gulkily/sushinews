<?php

function beginItemList() {
?>

<?php
}

function endItemList() {
?>

<?php
}

function printTagList($tags) {

    // tags is an array of array(name, count, type, weight)

    if (!count($tags)) { //@todo do proper type and sanity checks
        return;
    }


    foreach ($tags as $tag) {
    ?>
            <a href="/?action=tag&tag=<?=$tag['name']?>"><?=htmlspecialchars($tag['name'])?> (<?=$tag['count']?>)</a>
    <?php
    }
}

function printRelatedItems(array $relatedItems, $sourceItemId) {
?>
    <p>There Are Other Versions of This Story:</p>
<ul>

<?php
    foreach ($relatedItems as $item) {
        if ($item['id'] != $sourceItemId) {
?>
     <li><a href="/?action=compare&one=<?=$item['id']?>&two=<?=$sourceItemId?>"><?=htmlspecialchars($item['title'])?></a></li>
<?php
        }
    }
?>
</ul>
<?php
}

function printOneItem($itemData, $relatedItems) {
    ?>
                <?php

                printItem($itemData);

                if (count($relatedItems) > 1) {

                ?>
                <p>
                    <?php
                    printRelatedItems($relatedItems, $itemData['id']);
                    ?>
                </p>

<?php
                }
}

function printTwoItems($items, $relatedItems) {
    ?>

                <?php

                printItem($items[0]);

                printAvailableTagList($items[0]['id'])

                ?>


                <?php

                printItem($items[1]);

                printAvailableTagList($items[1]['id']);

                ?>

<?php
}

function printItem(array $itemData) {
    $self_domain = SITE_DOMAIN;

    ?>
    <form>
            <h3>
                <a href="<?=getItemUrl($itemData['id'])?>">
    <?=htmlspecialchars($itemData['title'])?>
    </a>
    </h3>
    <p><?=($itemData['body']?nl2br(htmlspecialchars($itemData['body'])):htmlspecialchars($itemData['summary']))?></p>
    <p>
        <a href="<?=getLink('edit', array('id' => $itemData['id']))?>">Edit This Story</a>
        Tags: <? printTagList($itemData['tags']); ?>

    <br>
        Share: <a href="<?=getItemUrl($itemData['id'])?>" class="sharelink"><?=getItemUrl($itemData['id'])?></a>
    </p>
    </form>

    <?php

}

function printAvailableTagList($item_id) {
    $tags = getAvailableTagList();

    global $sherlock;
    $client_id = $sherlock->getClientId();

    foreach ($tags as $tag) {
        $hash = getVotingHash($client_id, $item_id, $tag['name']);

        if (isset($lastWeight) && $lastWeight != $tag['weight']) {
            echo('<br>');
        }

        echo('<a href="addtag.php?item_id='.$item_id.'&tag='.$tag['name'].'&hash='.$hash.'" class="addtag" onClick="return addtag(this, '.$item_id.', \''.$tag['name'].'\', \''.$hash.'\');"><nobr>');
        echo(($tag['weight']<0?'&ndash;':'+') . '&nbsp;');
        echo($tag['name']);
        echo("</nobr></a> ");

        $lastWeight = $tag['weight'];
    }
}

function printItemSummary(array $itemData) {
    $self_domain = 'sushi.local'; //@todo fix this FIX IT!

    ?>

        <h3>
            <a href="<?=getItemUrl($itemData['id'])?>">
                <?=htmlspecialchars($itemData['title'])?>
            </a>
        </h3>
        <p><?=htmlspecialchars($itemData['summary'])?></p>


<?php

}

?>