<?php
header('Content-Type: text/html; charset=ISO-8859-1');
error_reporting(E_ERROR);
#ini_set('display_errors', 0);

session_start();

// Web and File Roots
define('W_ROOT', 'http://localhost/pm_tool');
define('F_ROOT', '/var/www/html/pm_tool/');

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