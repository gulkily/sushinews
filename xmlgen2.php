<?php

include_once('utilities.php');

//header('Content-Type: text/xml');


if (isset($offset)) {
    $limit = 100;
} else {
    $limit = 100;
}

$items = getItems($limit);

$header = array(
    'title' => 's.n',
    'atom_link' => 'http://sushi.local/xmlgen.php',
    'link' => 'http://sushi.local/',
    'description' => 'news edited by you!',
    'language' => 'en-US',
    'lastBuildDate' => 'Thu, 17 Jul 2014 17:10:07 +0000'

);

function printItem($item) {

    /*
     * Array
(
    [title] => Малайзийский Boeing 777 потерпел крушение в Донецкой области
    [body] => 17 июля 2014 года недалеко от российско-украинской границы в Донецкой области потерпел крушение малайзийский Boeing 777-200ER (номер 9M-MRD; рейс 17), на борту которого находилось 280 пассажиров и 15 членов экипажа. Среди пассажиров было 80 детей. Советник главы МВД Украины Антон Геращенко подтвердил гибель всех 280 пассажиров и членов экипажа. Граждан России на борту самолёта не было. Российские источники также подтверждают крушение. Власти Украины возложили ответственность за сбитый самолёт на пророссийских «террористов», ведущих бои в Донецкой и Луганской областях и несколько дней целенаправленно сбивающих самолёты над контролируемой территорией. Сепаратисты категорически отвергают обвинения, указывая, что вооружения, способного сбивать подобные самолёты на такой высоте, у них нет.

    [summary] => 17 июля 2014 года недалеко от российско-украинской границы в Донецкой области потерпел крушение малайзийский Boeing 777-200ER (номер 9M-MRD; рейс 17), на борту которого находилось 280 пассажиров и 15 членов экипажа. Среди пассажиров было 80 детей.
    [id] => 105
    [guid] => cc1c995e911cc9db0e214e74085669dc
)

     */

?>

    <item>
        <title><?=$item['title']?></title>
        <link><?=getItemUrl($item['id'])?></link>
        <comments><?=getCommentUrl($item['id'])?></comments>
        <pubDate><?=$item['publish_timestamp']?></pubDate>

        <guid isPermaLink="false"><?=$item['guid'] . '/' . $item['id']?></guid>
        <description><![CDATA[<?=htmlspecialchars($item['body'])?>]]></description>
    </item>

<?php
}

header('Content-Type: application/rss+xml; charset=utf-8');
echo '<?xml version="1.0" encoding="utf-8"?>';
?>

<rss version="2.0"
     xmlns:content="http://purl.org/rss/1.0/modules/content/"
     xmlns:wfw="http://wellformedweb.org/CommentAPI/"
     xmlns:dc="http://purl.org/dc/elements/1.1/"
     xmlns:atom="http://www.w3.org/2005/Atom"
     xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
     xmlns:slash="http://purl.org/rss/1.0/modules/slash/"
    >


    <channel>
        <title><?=$header['title']?></title>
        <atom:link href="<?=$header['atom_link']?>" rel="self" type="application/rss+xml" />
        <link><?=$header['link']?></link>
        <description><?=$header['description']?></description>
        <lastBuildDate><?=$header['lastBuildDate']?></lastBuildDate>
        <language><?=$header['language']?></language>
<?php

foreach($items as $item) {
    printItem($item);
}

?>

    </channel>