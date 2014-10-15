<?php

// Please rename this file to env.php and set up the parameters below

// The fields marked with a *** are mandatory and must be set before running the site

// *** Fill this field with random text at least 128 characters long
define('GUID_SEED', "");

// *** Fill this field with random text at least 128 characters long
define('SECRET_SALT', '');

// *** This is the path to where the cache lives and must be writable
define('CACHE_PATH', "");

// *** This is the domain the site lives on @todo autoconfig this while running the site from HTTP_HOST
define('SITE_DOMAIN', 'sushi.local');

// This is the name of the site
define('SITE_NAME', '');
define('SITE_PATH', '/');
define('SITE_PREFIX', 'http://');

define("EZSQL_DB_USER", "root");                 // <-- mysql db user
define("EZSQL_DB_PASSWORD", "admin");               // <-- mysql db password
define("EZSQL_DB_HOST", "localhost");        // <-- mysql server host
define("EZSQL_DB_NAME", "sushinews");         // <-- mysql db pname