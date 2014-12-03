<?php

function printEditForm($title = '', $summary = '', $body = '', $guid = '', $parentid = '') {
    if ($guid || $parentid) {
        $password = md5($guid . '-' . $parentid . '-' . SECRET_SALT);
    } else {
        $password = '';
    }
?>


<form action="/new.php" method="post">
    <input type="hidden" name="password" value="<?=$password?>">
    <div class="row">
        <div class="large-12 columns">

            <label for="title"><strong>Story Title:</strong> This should be descriptive, concise, and true. Please edit it down and avoid sensationalization.</label>
            <input type="text" id="title" name="title" value="<?=$title?>" required>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <label for="body"><strong>Article Body:</strong> The entire article, including the first paragraph.</label>
            <textarea cols="80" rows="20" name="body" id="body" required><?=$body?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns" style="display: none">
            <label for="summary"><strong>Summary:</strong> One paragraph.</label>
            <textarea cols="20" rows="20" name="summary" id="summary"><?=$summary?></textarea>
        </div>
    </div>
    <div class="row">
        <div class="large-4 columns">
            <input type="submit" class="medium button" value="Submit" title="Go ahead!">
        </div>
        <div class="large-4 columns" style="display: none">
            <label for="guid"><strong>Story GUID:</strong> Do not write below this line.</label>
            <input type="text" name="guid" id="guid" readonly value="<?=$guid?>">
        </div>
        <div class="large-4 columns" style="display: none">
            <label for="guid"><strong>Parent Story:</strong> Do not write below this line.</label>
            <input type="text" name="parentstory" id="parentstory" readonly value="<?=$parentid?>">
        </div>
    </div>
</form>


<?php
}