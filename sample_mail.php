<?php
// Include config
include_once 'config.php';

include_once F_ROOT.'lib/Mailer.php';
$mail = new Mailer();
$mail->sendFeatureRequestEmail();