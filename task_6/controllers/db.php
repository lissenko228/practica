<?php

ini_set('display_errors',1);
// error_reporting(E_ALL);
session_start();
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$connect=mysqli_connect('localhost', 'root', '', 'tasklist');

?>