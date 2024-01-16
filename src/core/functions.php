<?php
function show($stuff)
{
    echo "<pre>";
    print_r($stuff);
    echo "</pre>";
}

function showError($errno, $errstr, $errfile, $errline)
{
    echo "<h1>Có lỗi: .$errno</h1>";
    echo "<h2>Thông báo lỗi: .$errstr</h2>";
    echo "<h2>File: .$errfile</h2>";
    echo "<h2>Dòng: .$errline</h2>";
}
function redirect($path)
{
    header("Location: " . ROOT . "/" . $path);
    die;
}
function get_date($date)
{
    return date("jS M, Y", strtotime($date));
}
function getCurrentDateTime()
{
    // Get current UTC time
    $utcDateTime = new DateTime('now', new DateTimeZone('UTC'));

    // Set the time zone to UTC+7
    $utcDateTime->setTimezone(new DateTimeZone('Asia/Bangkok'));

    // Format the date and time
    $currentDateTime = $utcDateTime->format('Y-m-d H:i:s');
    return $currentDateTime;
}
