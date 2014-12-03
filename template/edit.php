<?php

function printEditForm($title = '', $summary = '', $body = '', $group_id = '', $parentid = '') {
    if ($group_id || $parentid) {
        $password = md5($group_id . '-' . $parentid . '-' . SECRET_SALT);
    } else {
        $password = '';
    }
?>


<form action="/new.php" method="post">
    <input type="hidden" name="password" value="<?=$password?>">
    <div class="row">
        <div class="large-12 columns">

            <label for="title"><strong>Story Title:</strong> Descriptive, yet concise. Avoid sensationalizing.</label>
            <input type="text" id="title" name="title" value="<?=$title?>" required>
        </div>
    </div>
    <div class="row">
        <div class="large-12 columns">
            <label for="body"><strong>Story Text:</strong> The first paragraph will also be the summary. Markdown supported.</label>
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
            <label for="group"><strong>Story:</strong> Do not write below this line.</label>
            <input type="text" name="group" id="group" readonly value="<?=$group?>">
        </div>
        <div class="large-4 columns" style="display: none">
            <label for="parentstory"><strong>Parent Story:</strong> Do not write below this line.</label>
            <input type="text" name="parentstory" id="parentstory" readonly value="<?=$parentid?>">
        </div>
    </div>
</form>


<?php
}