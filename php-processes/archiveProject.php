<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$projectID = $_GET["projectID"];
$archived = "archived";
$inactive = "inactive";

$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_state=?, `display`=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
$stmt->bind_param("ss",                      
                        $archived,
                        $inactive);
    echo "stmt prepared and bound!".'<br>';

if ($stmt -> execute()) {
    header("Location: /archives.php");
    exit;
} else {
    die("an unexpected error occured");
}