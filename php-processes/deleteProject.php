<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$projectID = $_GET["projectID"];
$userID = $_SESSION["user_id"];

$stmt = $_SESSION["conn"] -> prepare("DELETE FROM current_project WHERE id=? AND users_id=?");
$stmt->bind_param("ii",
                        $projectID,
                        $userID);
                        
//execute statement
if ($stmt -> execute()) {
    header("Location: /index.php");
        exit;
    } else {
        die("unexpected error");
}

$stmt -> close();
mysqli_close($conn);
?>