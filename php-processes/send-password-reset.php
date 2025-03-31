<?php

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
require($_SERVER['DOCUMENT_ROOT'] . '/mailer.php');
dbConnect();

echo'successfully connected'.'<br>';

$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s",time() + 60 * 30);

echo'variables made'.'<br>';

$sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
$stmt = $_SESSION["conn"] -> prepare($sql);
$stmt->bind_param("sss", $token_hash, $expiry, $email);
$stmt -> execute() ;

echo'params bound and sql executed'.'<br>';
// FIXME: figure out what's causing this to not work 
// if($_SESSION["conn"]->affected_rows) {
    $mail = require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/mailer.php');
    echo'connected to mailer.php'.'<br>';

    $mail -> setFrom("noreply@elsewherewriters.com");
    echo'from set'.'<br>';
    $mail -> addAddress($email);
    echo'address added'.'<br>';
    $mail -> setSubject("Password Reset");
    echo'subject set'.'<br>';
    $mail -> Body = <<<END

        Click <a href="http://elsewherewriters.com/reset-password.php?token=$token">here</a> 
        to reset your password.

    END;
    echo'body set'.'<br>';
    Try {
        $mail ->send();
    } catch(Exception $e) {
        echo "Message could not be sent. Mail Sending error: {$mail->ErrorInfo}";
    }

// }

echo "Message sent, please check your inbox.";