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

function printItemTabs($itemData) {
?>
    <div class="panel">
        <div class="columns large-6">

    <?php

    $tabs = array(
        'item' => 'Article',
        'edit' => 'Edit',
    );

    foreach ($tabs as $key => $caption) {
        echo('<a class="itemtab" href="' . getLink($key, array('id' => $itemData['id'])) . '">' . $caption . '</a></li>');
    }

    ?>

        </div>
        <div class="columns large-6" style="text-align: right">
            <?=$itemData['publish_timestamp']?>
        </div>
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
            printItemTabs($itemData);

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

    // include the Diff class
    require_once('module/class.Diff.php');

    if ($items[0]['id'] > $items[1]['id']) {
        $first = 1;
        $second = 0;
    } else {
        $first = 0;
        $second = 1;
    }

//    foreach(array('title', 'summary', 'body') as $element) {
//        $diff[$element] = Diff::compare($items[0]['body'], $items[1]['body']);
//    }
//
//    print_r($diff);
//
    echo("<table class=\"diff\">\n");

    foreach(array('title', 'summary', 'body') as $element) {
        echo(Diff::toTable(Diff::compare($items[$first][$element], $items[$second][$element]), $element));
    }

    echo('<tr><td>');
    echo('<a href="'.getItemUrl($items[$first]['id'], 'absolute').'">'.getItemUrl($items[$first]['id'], 'absolute').'</a>');
    echo('</td><td>');
    echo('<a href="'.getItemUrl($items[$second]['id'], 'absolute').'">'.getItemUrl($items[$second]['id'], 'absolute').'</a>');
    echo('</td></tr>');

    echo('<tr><td>');
    printAvailableTagList($items[$first]['id']);
    echo('</td><td>');
    printAvailableTagList($items[$second]['id']);
    echo('</td></tr>');

    echo("</table>\n");

    ?>

<?php
}

function printItem(array $itemData) {
    $Parsedown = new Parsedown();

    $self_domain = SITE_DOMAIN;

    ?>
    <form>
            <h3>
                <a href="<?=getItemUrl($itemData['id'])?>">
    <?=htmlspecialchars($itemData['title'])?>
    </a>
    </h3>
    <p><?=$Parsedown->text(htmlspecialchars($itemData['body']))?></p>
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

//    global $sherlock;
    $client_id = getVoterId();

//    $client_id = 1; //temporary duct tape @todo

    foreach ($tags as $tag) {
        $hash = getVotingHash($client_id, $item_id, $tag['name']);

        if (isset($lastWeight) && $lastWeight != $tag['weight']) {
            echo('<br>');
        }

        echo('<a href="addtag.php?item_id='.$item_id.'&tag='.$tag['name'].'&hash='.$hash.'" class="addtag" onClick="return addtag(this, '.$item_id.', \''.$tag['name'].'\', \''.$hash.'\');">');
        echo(($tag['weight']<0?'&ndash;':'+') . '&nbsp;');
        echo($tag['name']);
        echo("</a>");

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