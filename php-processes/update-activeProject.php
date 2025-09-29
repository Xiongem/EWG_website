<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$notActive = 'not active';
$active = 'active';
// $projectID = $_POST["project"];

$stmt1 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `display`= ? WHERE `users_id`= $userID AND current_state='current' AND display='active';");
    
$stmt2 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `display`= ? WHERE `users_id`= $userID AND current_state='current' AND id=?;");
    
        $stmt1->bind_param("s",$notActive);
        $stmt2->bind_param("si",$active, $_POST["project"]);
        if ($stmt1 -> execute() && $stmt2 -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }
$stmt -> close();
mysqli_close($conn);
?>