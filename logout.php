<?php
define('WROOT', 'http://localhost/pm_tool');
session_start();
session_destroy();
header("location: ".WROOT);

?>