<?php
session_start();

require "./src/core/init.php";
error_reporting(E_ALL);
ini_set('display_errors', 1);
set_error_handler('showError');

$app = new App();
$app->loadController();
