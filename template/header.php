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

function printHeader($title = null) {
    $title = htmlspecialchars($title);
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=($title ? $title . ' - ' : '')?><?=getConfig('site_name')?></title>
    <link rel="stylesheet" href="<?=getConfig('site_path')?>css/foundation.css" />
    <link rel="stylesheet" href="<?=getConfig('site_path')?>css/sushi.css" />
    <script src="<?=getConfig('site_path')?>js/vendor/modernizr.js"></script>
    <script src="<?=getConfig('site_path')?>js/sushi.js"></script>
</head>
<body>

<div class="row" id="topmenu">
    <div class="large-8 columns" id="menu">
        <?php foreach(getMenuItems() as $action => $item) { echo ('<a href="' . getLink($action) . '">' . $item . '</a>'); } ?>
    </div>
    <div class="large-4 columns" id="sitename">
        <span><a href="/"><?=getConfig('site_name')?></a></span>
    </div>

</div>
<?php
    // @todo move this part out of the template, messages should be passed to the template as a parameter
    if (getParam('ticket')) {
        $messages = get_ticket(getParam('ticket'));

        if (is_array($messages) && count($messages)) {
            foreach($messages as $message) {
                echo('<div class="row top-message">' . $message . '</div>'); //@note, $message is not escaped because it is always system-generated, or should be
            }
        }
    }
?>
<br>
<?php
}