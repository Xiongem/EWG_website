<?php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

// prepare and bind
$userID = $_SESSION["user_id"];

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET username=?, email=? WHERE id=$userID");
$stmt->bind_param("ss",
                    $_POST["username"],
                    $_POST["email"]);
    echo "stmt prepared and bound!".'<br>';

if ($stmt -> execute()) {
    header("Location: /profile.php");
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>