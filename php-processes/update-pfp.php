<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

// prepare and bind
$userID = $_SESSION["user_id"];

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET pfp=? WHERE id=$userID");
$stmt->bind_param("s",
                        $_POST["choose-pfp"]);

if ($stmt -> execute()) {
    header("Location: /profile.php?name=$username");
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>