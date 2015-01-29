<?
include_once('')

?>
<?='<?'?>xml version="1.0" encoding="ISO-8859-1"<?='?>'?>

<rdf:RDF
    xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#"
    xmlns="http://purl.org/rss/1.0/"
    xmlns:taxo="http://purl.org/rss/1.0/modules/taxonomy/"
    xmlns:syn="http://purl.org/rss/1.0/modules/syndication/"
    >

    <channel rdf:about="http://qdb.us/">
        <title>QDB: <?=$page_params['page_title']?></title>
        <link>http://qdb.us/</link>
        <description>Amusing reader-submitted quotes from Internet Relay Chat</description>
        <pubDate><?=date('D, d M Y H:i:s O')?></pubDate>
        <items>
            <rdf:Seq>
                <?
                foreach($quotes as $quote) {
                    ?>
                    <rdf:li rdf:resource="http://qdb.us/<?=$quote->quote_id?>" />
                <?
                }
                ?>
            </rdf:Seq>
        </items>

        <?/*<!-- <image rdf:resource="" /> -->*/?>
    </channel>

    <?
    foreach($quotes as $quote) {
        ?>
        <item rdf:about="<?='http://qdb.us/'.$quote->quote_id?>">
            <guid><?='http://qdb.us/'.$quote->quote_id?></guid>
            <pubDate><?=date('D, d M Y H:i:s 0', $quote->mod_timestamp)?></pubDate>
            <title><?='#'.$quote->quote_id?></title>
            <link><?='http://qdb.us/'.$quote->quote_id?></link>
            <description><?=$tt_o?><?=htmlspecialchars(nl2br(str_replace('  ', ' &nbsp;', htmlspecialchars($quote->quote))))?><? if ($quote->comment) echo(htmlspecialchars('<br><i>Comment:</i> '.htmlspecialchars($quote->comment)));?><?=$tt_c?></description>
        </item>

    <?
    }
    ?>

</rdf:RDF>