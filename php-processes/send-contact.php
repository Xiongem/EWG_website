<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

$email = $_POST["email"];
$username = $_POST["username"];
$message = $_POST["message"];

if ($email && $username && $message) {
    $mail = require($_SERVER['DOCUMENT_ROOT'] . '/mailer.php');
    $mail -> setFrom("noreply@elsewherewriters.com");
    $mail -> addAddress("admin@elsewherewriters.com");
    $mail-> Subject = "Contact Requested";
    $mail -> Body = <<<END

        <strong>$username</strong> is reaching out about:<br>
        $message 
        <br><br>

        Email: $email

    END;

    Try {
        $mail ->send();
    } catch(Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }
header("Location: /index.php");
} else {
    header("Location: /contact.php?result=fail");
}