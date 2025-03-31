<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

// use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require "vendor/autoload.php";
// require($_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/phpmailer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/phpmailer/phpmailer/src/phomailer.php');
// $mail = new PHPMailer(true);
$mail = new PHPMailer\PHPMailer\PHPMailer(); 
try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.hostinger.com";
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "admin@elsewherewriters.com";
    $mail->Password = "Hi5gem601*";

    $mail->isHTML(true);
} catch(Exception $e) {
    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
}


return $mail;
