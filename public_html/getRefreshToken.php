<?php

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\OAuth;
//Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;

//Load Composer's autoloader
require '../private_html/vendor/autoload.php';


require '../private_html/vendor/phpmailer/phpmailer/get_oauth_token.php';