<?php
define('W_ROOT', 'http://localhost/pm_tool');
session_start();
session_destroy();
header("location: ".W_ROOT);