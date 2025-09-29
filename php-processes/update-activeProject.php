<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$notActive = 'not active';
$active = 'active';
$projectID = $_POST["project"];

$stmt = $_SESSION["conn"] -> prepare(
    "UPDATE current_project SET `display`= ? WHERE `users_id`= $userID AND current_state='current' AND display='active';
    
    UPDATE current_project SET `display`= ? WHERE `users_id`= $userID AND current_state='current' AND id= $projectID;
    ");
        $stmt->bind_param("sss",
                                $notActive,
                                $active);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
$stmt -> close();
mysqli_close($conn);
?>