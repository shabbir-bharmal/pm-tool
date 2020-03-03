<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(0);

session_start();

define('W_ROOT', 'http://localhost/pm_tool');
define('F_ROOT', '/var/www/html/pm_tool/');

include_once F_ROOT.'database.php';

$db                       = new Database();
$db_connection            = $db->connect();
