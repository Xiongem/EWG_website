<?php
ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
require($_SERVER['DOCUMENT_ROOT'] . '/mailer.php');
require($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

$mail = new PHPMailer\PHPMailer\PHPMailer;
dbConnect();

$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s",time() + 60 * 30);

$sql = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
    $stmt = $_SESSION["conn"] -> prepare($sql);
    $stmt->bind_param("sss", 
                            $token_hash, $expiry, $email);
    $stmt -> execute() ;

if($_SESSION["conn"]->affected_rows) {
    $mail = require($_SERVER['DOCUMENT_ROOT'] . '/mailer.php');

    $mail -> setFrom("noreply@elsewherewriters.com");
    $mail -> addAddress($email);
    $mail->Subject = "Password Reset";
    $mail -> Body = <<<END
        Hello, 
        <br><br>
        A request was made to reset your password. <br>
        Your password reset token will expire in 30 minutes. <br>
        Click <a href="http://elsewherewriters.com/reset-password.php?token=$token">here</a> to reset your password.
        <br><br>
        If you did not make this request, please ignore this email or contact support at support@elsewherewriters.com.
        <br><br>
        This process is automated, please do not reply to this email.
    END;
    Try {
        $mail ->send();
    } catch(Exception $e) {
        echo "Message could not be sent. Mail Sending error: {$mail->ErrorInfo}";
    }
}

// echo "Message sent, please check your inbox.";
header("Location: /reset-success.html");