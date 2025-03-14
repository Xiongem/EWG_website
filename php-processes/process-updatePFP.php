<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

echo'connected successfully'.'<br>';

// prepare and bind
$userID = $_SESSION["user_id"];

echo"$userID";

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET pfp=? WHERE id=$userID");
$stmt->bind_param("s",
                        $_POST["choose-pfp"]);
    echo "stmt prepared and bound!".'<br>';

if ($stmt -> execute()) {
    header("Location: /profile.php");
    // echo "Record updated successfully";
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>