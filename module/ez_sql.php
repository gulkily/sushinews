<?
//    if (defined(EZSQL_DB_HOST)) {
        include_once('ez_sql_core.php');
        include_once('ez_sql_mysql.php');

        // You may notice that we are creating two database connections here.
        // This is done for two reasons:
        // 1) Legacy, and because not everything can be rewritten at once
        // 2) Some things are still easier to do (carefully) without parametrized queries
        // Hopefully it won't always be this way, but for now it's a small price to pay

        $db = new ezSQL_mysql(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        $dbp = new PDO('mysql:host=' . EZSQL_DB_HOST . ';dbname=' . EZSQL_DB_NAME . ';charset=utf8', EZSQL_DB_USER, EZSQL_DB_PASSWORD);
//    } else {
//
//    }
?>
