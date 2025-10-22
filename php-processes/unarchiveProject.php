<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$projectID = $_GET["projectID"];
$current = "current";

$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_state=? WHERE users_id=$userID AND current_state='archived' AND id=$projectID");
$stmt->bind_param("s",
                        $current);
    echo "stmt prepared and bound!".'<br>';

if ($stmt -> execute()) {
    header("Location: /project.php?projectID=$projectID");
    exit;
} else {
    die("an unexpected error occured");
}