<?php
require "vendor/autoload.php"; 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->SMTPDebug = 2;
    $mail->SMTPAuth = true;

    $mail->Host = "smtp.hostinger.com";
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    $mail->Username = "admin@elsewherewriters.com";
    $mail->Password = "Hi5gem601*";

    $mail->isHTML(true);
} catch(Exception $e) {
    echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
}


return $mail;
