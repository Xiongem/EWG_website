<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

$projectID = $_GET["projectID"];
$userID = $_SESSION["user_id"];
$completed = "completed";

$sql = "SELECT * FROM users WHERE id=$userID";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $numberCompleted = $user["projects_completed"];

    //* increase the number of finished projects for the user when they complete a project by one
    $newNumber = $numberCompleted + 1;


$stmt1 = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_state=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
$stmt2 = $_SESSION["conn"] -> prepare("UPDATE users SET projects_completed=? WHERE id=$userID");
$stmt1->bind_param("s",
                        $completed);
$stmt2->bind_param("s",
                        $newNumber);

if ($stmt1 -> execute() && $stmt2 -> execute()) {
    header("Location: /project.php?projectID=$projectID");
    exit;
} else {
    die("an unexpected error occured");
}