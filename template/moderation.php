<?php

function printModerationWelcome() {

    ?>
    <div class="row">
        <div class="large-12 columns">
            <div class="panel">

                <p>Welcome to the moderation interface! Thank you for taking it upon yourself to moderate.</p>

                <p>Below are two different versions of an article. Please review them and vote accordingly.</p>

                <p><a href="<?=getLink('moderate', array('token' => 'remove'))?>">Stop Moderating</a></p>

            </div>
        </div>
    </div>
<?php
}

    function printModerationFooter() {

    ?>
    <div class="row">
        <div class="large-12 columns">
            <div class="panel">

                <p>Thank you for taking it upon yourself to moderate.</p>

                <p>To see another story, just reload this page press <a href="<?getLink('moderate', array('random' => rand(11111111,99999999)))?>" class="addtag tp">Next Article</a></p>

                <p>If you would like to remove your cookie, please click the following:</p>

                <p><a href="<?=getLink('moderate', array('token' => 'remove'))?>">Stop Moderating</a></p>

            </div>
        </div>
    </div>
<?php
}
?>