<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(E_ERROR);

session_start();

// Web and File Roots
define('W_ROOT', 'http://pm_tool.local');
define('F_ROOT', 'D:/Xampp/htdocs/pm_tool/');

// SMTP Settings
define('SMTP_HOST', 'malta.metanet.ch');
define('SMTP_USERNAME', 'pm@mastaz.ch');
define('SMTP_PW', 'B*x1ao56');
define('SMTP_PORT', 465);

// Require necessary files
include_once F_ROOT.'database.php';
include_once F_ROOT.'lib/Mailer.php';

$db            = new Database();
$mailer        = new Mailer();
$db_connection = $db->connect();
