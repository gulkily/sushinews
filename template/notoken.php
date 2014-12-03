<?php

function printNoToken() {

    ?>
    <div class="row">
        <div class="large-12 columns">
            <p>
            Sorry, but you cannot moderate because you don't have a token.
            </p>

            <p>
            <a href="/?action=moderate&token=welcome">Get Token</a>
            </p>
        </div>
    </div>
<?php
}
?>