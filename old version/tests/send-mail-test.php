<?php

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

echo'successfully connected'.'<br>';

$email = $_POST["email"];


// if(isset($email)) {
    $mail = require '/php-processes/mailer.php';

    $mail -> setFrom("noreply@elsewherewriters.com");
    $mail -> addAddress($email);
    $mail -> setSubject("Password Reset");
    $mail -> Body = <<<END

        Click <a href="">here</a> 
        to reset your password.

    END;

    Try {
        $mail ->send();
    } catch(Exception $e) {
        echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
    }

// }

echo"Message sent, please check your inbox.";