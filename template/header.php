<?php
function getMenuItems() {
    $items = array(
        'index' => 'Home',
        'submit' => 'Submit',
        'moderate' => 'Moderate',
//        'mirror' => 'Mirror',
        'about' => 'About'
    );

    return $items;
}

function printHeader($username = null) {
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=SITE_NAME?></title>
    <link rel="stylesheet" href="<?=SITE_PATH?>css/foundation.css" />
    <link rel="stylesheet" href="<?=SITE_PATH?>css/sushi.css" />
    <script src="<?=SITE_PATH?>js/vendor/modernizr.js"></script>
    <script src="<?=SITE_PATH?>js/sushi.js"></script>
</head>
<body>

<div class="row">
    <div class="large-12 columns">
        <h1><a href="/"><?=SITE_NAME?></a></h1>
    </div>
</div>
<div class="row">
    <div class="large-12 columns" id="topmenu">
        <?php foreach(getMenuItems() as $action => $item) { echo ('<a href="' . getLink($action) . '">' . $item . '</a>'); } ?>
    </div>
</div>

<br>
<?php
}