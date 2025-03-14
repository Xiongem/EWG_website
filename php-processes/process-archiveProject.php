<?php

ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();

$userID = $_SESSION["user_id"];
$archived = "archived";

// prepare and bind
$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_state=? WHERE users_id=$userID AND current_state='current'");
$stmt->bind_param("s",
                    $archived);

if ($stmt -> execute()) {
        header("Location: /projects.php");
        exit;
    } else {
        die("an unexpected error occured");
}



$stmt -> close();
mysqli_close($conn);

?>