<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME', 'dbname'); //edit name database
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');
    define('ROOT', 'http://localhost/myproject'); //edit name project
} else {
    define('DBNAME', 'dbname');
    define('DBHOST', '127.0.0.1:3306');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');
    define('ROOT', 'https://mywebsite.com/myproject'); //edit name project
}
