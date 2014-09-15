<?php
function getMenuItems() {
    return array(
        '/' => 'News',
        '/submit' => 'Submit',
        '/moderate' => 'Moderate',
        '/mirror' => 'Mirror',
        '/about' => 'About'
    );
}

function printHeader($username = null) {
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=SITE_NAME?></title>
    <link rel="stylesheet" href="css/sushi.css" />
    <script src="js/sushi.js"></script>
</head>
<body>

<?php foreach(getMenuItems() as $url => $item) { echo ('<a href="' . $url . '">' . $item . '</a>'); } ?>

<br>
<?php
}