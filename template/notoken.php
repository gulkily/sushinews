<?php

function printNoToken() {

    ?>
    <div class="row">
        <div class="large-12 columns">
            <p>
                In order to moderate, you have to get a token.
            </p>

            <p>
                <a href="/?action=moderate&token=welcome">Get Token</a>
            </p>
        </div>
    </div>
<?php
}
?>