<?php

// Please rename this file to env.php and set up the parameters below

// The fields marked with a *** are mandatory and must be set before running the site

// *** This is the path to where the cache lives and must be writable
define('CACHE_PATH', "");
if (CACHE_PATH === '') die ('Please set the CACHE_PATH global in env.php');

// *** This is the path to where the mirror dumps are made and must be writable
define('MIRROR_PATH', "");
if (MIRROR_PATH === '') die ('Please set the CACHE_PATH global in env.php');

// This is the name of the site
define('SITE_NAME', '');
define('SITE_PATH', '/');
define('SITE_PREFIX', 'http://');

// Set this to localhost if using sockets or 127.0.0.1 if using TCP
define("EZSQL_DB_HOST", "localhost");        // <-- mysql server host
define("EZSQL_DB_USER", "root");                 // <-- mysql db user
define("EZSQL_DB_PASSWORD", "admin");               // <-- mysql db password
define("EZSQL_DB_NAME", "sushinews");         // <-- mysql db pname
