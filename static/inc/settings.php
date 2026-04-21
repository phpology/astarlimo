<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('display_errors', 1);
//set_time_limit(600);
date_default_timezone_set('Europe/London');

DEFINE('SERVER_URL', 'https://'.$_SERVER['SERVER_NAME']);

//smtp details
DEFINE('SMTP_HOST', 'auth.smtp.1and1.co.uk');
DEFINE('SMTP_USERNAME', 'smtp@astartuktuk.co.uk');
DEFINE('SMTP_PASSWORD', 'tu7tu72021!#~');
DEFINE('EMAIL_TO', 'raj@phpology.co.uk');

require('functions.php');

require('../vendor/autoload.php');