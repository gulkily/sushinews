<?php

function printModerationInfo() {

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
?>