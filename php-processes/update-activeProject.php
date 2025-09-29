<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$notActive = 'not active';

$stmt = $_SESSION["conn"] -> prepare(
    "UPDATE current_project SET `display`= ? WHERE username='$username' AND current_state='current' AND display='active';
    UPDATE current_project SET `display`= ? WHERE username='$username' AND current_state='current' AND display='active';
    ");
        $stmt->bind_param("ss",
                                $notActive,
                                $_POST["title"]);
        if ($stmt -> execute()) {
            exit;
        } else {
            die("an unexpected error occured");
        }

$sql = "UPDATE current_project SET `display`= 'not active' WHERE username='$username' AND current_state='current' AND display='active'";