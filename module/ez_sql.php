<?
        define("EZSQL_DB_USER", "root");                 // <-- mysql db user
        define("EZSQL_DB_PASSWORD", "admin");               // <-- mysql db password
        define("EZSQL_DB_HOST", "localhost");        // <-- mysql server host
        define("EZSQL_DB_NAME", "sushinews");         // <-- mysql db pname

        include_once('ez_sql_core.php');
        include_once('ez_sql_mysql.php');

        $db = new ezSQL_mysql(EZSQL_DB_USER, EZSQL_DB_PASSWORD, EZSQL_DB_NAME, EZSQL_DB_HOST);

        $dbp = new PDO('mysql:host=' . EZSQL_DB_HOST . ';dbname=' . EZSQL_DB_NAME . ';charset=utf8', EZSQL_DB_USER, EZSQL_DB_PASSWORD);
?>
