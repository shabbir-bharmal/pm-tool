<?php
define('W_ROOT', 'https://pm.mastaz.ch');
session_start();
session_destroy();
header("location: ".W_ROOT);