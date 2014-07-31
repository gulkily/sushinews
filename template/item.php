<?php

function beginItemList() {
?>

    <div class="row">
    <div class="large-12 columns">
    <div class="panel">

<?php
}

function endItemList() {
?>
    </div>
    </div>
    </div>

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
    <div class="row">
        <div class="large-12 columns">
            <div class="panel">


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
?>
            </div>
        </div>
    </div>

<?php
}

function printTwoItems($items, $relatedItems) {
    ?>
    <div class="row">
        <div class="large-6 columns">
            <div class="panel">


                <?php

                printItem($items[0]);

                ?>
            </div>
        </div>
        <div class="large-6 columns">
            <div class="panel">


                <?php

                printItem($items[1]);

                ?>
            </div>
        </div>
    </div>

<?php
}

function printItem(array $itemData) {
    $self_domain = 'sushi.local'; //@todo this shouldn't be defined here

    ?>
    <form>
            <h3>
                <a href="<?=getItemUrl($itemData['id'])?>">
    <?=htmlspecialchars($itemData['title'])?>
    </a>
    </h3>
    <p><?=($itemData['body']?nl2br(htmlspecialchars($itemData['body'])):htmlspecialchars($itemData['summary']))?></p>
    <p>
        <a href="/?action=edit&id=<?=$itemData['id']?>">Edit This Story</a>
        <br>
        Tagged: <? printTagList($itemData['tags']); ?>
        <br>
        Add Tags: <? printAvailableTagsList($itemData['id']); ?>
    <br>
        Share: <a href="<?=getItemUrl($itemData['id'])?>" class="sharelink"><?=getItemUrl($itemData['id'])?></a>
    </p>
    </form>

    <?php

}

function printAvailableTagsList($item_id) {
    $tags = getAvailableTagList();

    foreach ($tags as $tag) {
        echo('<a href="addtag.php?item_id='.$item_id.'&tag='.$tag['name'].'" class="addtag">' . $tag['name'] . "</a> ");
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