<?php

function printNoToken() {

    ?>
    <div class="row">
        <div class="large-12 columns">
            <div class="panel">
            <p>
                In order to moderate, you must have a token.
            </p>

            <form action="<?=getLink('moderate')?>" method="POST">
                <input type="text" value="welcome" name="token">
                <input type="submit" value="Get Token">
            </form>
            </p>
        </div>
    </div>
    </div>
<?php
}
?>


<?php
