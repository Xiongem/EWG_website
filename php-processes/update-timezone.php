<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

// prepare and bind
$userID = $_SESSION["user_id"];

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `timezone`=? WHERE id=$userID");
$stmt->bind_param("s",
                    $_POST["timezone"]);

if ($stmt -> execute()) {
    header("Location: /index.php");
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>