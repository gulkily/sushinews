<?php

include_once('utilities.php');

header('Content-Type:application/xml; charset=utf-8');



if (isset($offset)) {
    $limit = 100;
} else {
    $limit = 100;
}

$items = getItems($limit);

$header = array(
    'title' => 's.n',
    'atom_link' => 'http://sushi.local/xmlgen3.php',
    'link' => 'http://sushi.local/',
    'description' => 'news edited by you!',
    'language' => 'en-US',
    'lastBuildDate' => time()
);

?>
<?='<?'?>xml version="1.0" encoding="ISO-8859-1"<?='?>'?>

<rdf:RDF
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns="http://purl.org/rss/1.0/"
    xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/"
    xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"
    >

    <channel rdf:about="<?=getOwnUrl()?>">
        <title><?=$header['title']?></title>
        <link><?=$header['link']?></link>
        <description><?=$header['description']?></description>
        <pubDate><?=date('D, d M Y H:i:s O', $header['lastBuildDate'])?></pubDate>
        <items>
            <rdf:Seq>
                <?
                foreach($items as $item) {
                    ?>
                    <rdf:li rdf:resource="<?=htmlspecialchars(getItemUrl($item['id']))?>" />
                <?
                }
                ?>
            </rdf:Seq>
        </items>

        <?/*<!-- <image rdf:resource="" /> -->*/?>
    </channel>

    <?
    foreach($items as $item) {
        ?>
        <item rdf:about="<?=getItemUrl($item['id'])?>">
            <guid><?=$item['guid'] . '/' . $item['id']?></guid>
            <pubDate><?=date('D, d M Y H:i:s 0', strtotime($item['publish_timestamp']))?></pubDate>
            <title><?=$item['title']?></title>
            <link><?=getItemUrl($item['id'])?></link>
            <description><?=htmlspecialchars(nl2br(htmlspecialchars($item['body'])))?></description>
        </item>

    <?
    }
    ?>

</rdf:RDF>