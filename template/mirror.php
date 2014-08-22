<?php

function printMirrorInfo() {
?>

    <div class="row">
    <div class="large-12 columns">
    <div class="panel">

        <p>Make this site available to more people by re-hosting it!</p>

        <ol>
            <li>Download the site dump using one of the links below.</li>
            <li>Upload it to your own server or hosting account.</li>
            <li>Your mirror will continue to pull updates from this site.</li>
        </ol>

        <p>The following versions of the site are available:</p>

        <table border="0">
            <tr>
                <td>
                    <strong><a href="mirror/static/mirror_all.zip">Static HTML</a></strong><br>
                    Just the text. Great for offline reading and easy mirroring.
                </td>
            </tr>
            <tr>
                <td>
                    <strong>MySQL Database Dump</strong><br>
                    To be used with a copy of the site scripts to replicate the entire site.
                </td>
            </tr>
        </table>

<!--        <table border="0">-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <b>Static HTML</b><br>-->
<!--                    Just the text. Great for offline reading and easy mirroring.-->
<!--                </td>-->
<!--                <td><a href="mirror/static/mirror_7days.zip">Last 7 days</a></td>-->
<!--                <td><a href="mirror/static/mirror_3months.zip">Last 3 months</a></td>-->
<!--                <td><a href="mirror/static/mirror_all.zip">Everything</a></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <b>PHP & SQLite</b><br>-->
<!--                    Easy setup. Low performance under load.-->
<!--                </td>-->
<!--                <td><a href="mirror/sqlite/mirror_7days.zip">Last 7 days</a></strike></td>-->
<!--                <td></font><a href="mirror/sqlite/mirror_3months.zip">Last 3 months</a></td>-->
<!--                <td><a href="mirror/sqlite/mirror_all.zip">Everything</a></td>-->
<!--            </tr>-->
<!--            <tr>-->
<!--                <td>-->
<!--                    <b>PHP & MySQL</b><br>-->
<!--                    Full functionality, more complicated setup, better performance under load.-->
<!--                </td>-->
<!--                <td><a href="mirror/mysql/mirror_7days.zip">Last 7 days</a></td>-->
<!--                <td><a href="mirror/mysql/mirror_3months.zip">Last 3 months</a></td>-->
<!--                <td><a href="mirror/mysql/mirror_all.zip">Everything</a></td>-->
<!--            </tr>-->
<!--        </table>-->

        <p>The data dumps are created every 15 minutes.</p>

    </div>
    </div>
    </div>

<?php
}

?>