<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();

echo'connected successfully'.'<br>';

// prepare and bind
$userID = $_SESSION["user_id"];
$username = $_SESSION["username"];

$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=? WHERE users_id=$userID AND current_state='current'");
$stmt->bind_param("i",
                        $_POST["newCount"]);
    echo "stmt prepared and bound!".'<br>';

if ($stmt -> execute()) {
    header("Location: /projects.php?userNAME=$username");
    // echo "Record updated successfully";
    exit;
} else {
    die("an unexpected error occured");
}


$stmt -> close();
mysqli_close($conn);
?>
