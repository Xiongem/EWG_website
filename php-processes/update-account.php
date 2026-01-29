<?php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

// prepare and bind
$userID = $_SESSION["user_id"];
$username = $_POST["username"];

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET username=?, email=?, `timezone`=? WHERE id=$userID");
$stmt->bind_param("sss",
                    $_POST["username"],
                    $_POST["email"],
                    $_POST["timezone"]);

if ($stmt -> execute()) {
    header("Location: /profile.php?name=$username");
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>