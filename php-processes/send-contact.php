<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$email = $_POST["email"];
$username = $_POST["username"];
$message = $_POST["message"];

    $mail = require($_SERVER['DOCUMENT_ROOT'] . 'mailer.php');
    $mail -> setFrom($email);
    $mail -> addAddress("admin@elsewherewriters.com");
    $mail -> setSubject("Contact Requested");
    $mail -> Body = <<<END

        $username is reaching out about:
        $message

    END;

    Try {
        $mail ->send();
    } catch(Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }