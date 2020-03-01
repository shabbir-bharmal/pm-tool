<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(0);

session_start();

define('WROOT', 'http://localhost/pm_tool');

include_once 'database.php';

$db                       = new Database();
$db_connection            = $db->connect();
