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

function printItemTabs($itemId) {
?>
    <div class="panel">

    <?php

    $tabs = array(
        'item' => 'Article',
        'edit' => 'Edit',
    );

    foreach ($tabs as $key => $caption) {
        echo('<a class="itemtab" href="' . getLink($key, array('id' => $itemId)) . '">' . $caption . '</a></li>');
    }

    ?>
    </div>
    <?php
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
            <?php
            printItemTabs($itemData['id']);

            ?>
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

                printAvailableTagList($items[0]['id'])

                ?>
            </div>
        </div>
        <div class="large-6 columns">
            <div class="panel">


                <?php

                printItem($items[1]);

                printAvailableTagList($items[1]['id']);

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
        Tags: <? printTagList($itemData['tags']); ?>

    <br>
        Share: <a href="<?=getItemUrl($itemData['id'], 'absolute')?>" class="sharelink"><?=getItemUrl($itemData['id'], 'absolute')?></a>
    </p>
    </form>

    <?php

}

function printAvailableTagList($item_id) {
    $tags = getAvailableTagList();

    global $sherlock;
    $client_id = $sherlock->getClientId();
//    $client_id = 1; //temporary duct tape @todo

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