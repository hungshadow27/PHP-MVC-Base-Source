<?php

if ($_SERVER['SERVER_NAME'] == 'localhost') {
    define('DBNAME', 'electronic_store');
    define('DBHOST', 'localhost');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');
    define('ROOT', 'http://localhost/electronic-store');
} else {
    define('DBNAME', 'electronic_store');
    define('DBHOST', '127.0.0.1:3306');
    define('DBUSER', 'root');
    define('DBPASS', '');
    define('DBDRIVER', '');
    define('ROOT', 'https://b0c7-113-185-51-251.ngrok-free.app/electronic-store');
}
