<?php
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