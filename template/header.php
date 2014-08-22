<?php
function printHeader($username = null) {
?>
<!doctype html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8" />
    <title><?=SITE_NAME?></title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/sushi.css" />
    <script src="js/vendor/modernizr.js"></script>
</head>
<body>

<div class="row">
    <div class="large-12 columns">
        <h1><a href="/"><?=SITE_NAME?></a></h1>
    </div>
</div>
<div class="row">
    <div class="large-12 columns">
        <a href="/" class="topmenu">News</a>
        <a href="/?action=submit" class="topmenu">Submit News</a>
        <a href="/moderate" class="topmenu">Moderate</a>
        <a href="/?action=mirror" class="topmenu">Mirror This</a>
        <a href="/" class="topmenu">About</a>
    </div>
</div>

<br>
<?php
}