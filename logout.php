<?php
include_once 'config.php';
session_destroy();
header("location: ".W_ROOT);