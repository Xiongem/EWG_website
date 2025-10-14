<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

//echo'connected successfully'.'<br>';

$userID = htmlspecialchars($_SESSION["user_id"]);
$projectID = $_POST["projectID"];

// prepare and bind
$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET genre=?, title=?, info=?, goal=?, goal_date=?, daily_goal=? 
                                        WHERE users_id=$userID AND current_state='current' AND id=$projectID");
$stmt->bind_param("sssisi",
                        $_POST["genre"],
                        $_POST["title"],
                        $_POST["summary"],
                        $_POST["goalNumber"],
                        $_POST["endDate"],
                        $_POST["dailyGoal"]);
//echo'params bound'.'<br>';
if ($stmt -> execute()) {
        header("Location: /project.php?projectID=$projectID");
        //echo'successfully updated project!'.'<br>';
        exit;
    } else {
        die("an unexpected error occured");
}



$stmt -> close();
mysqli_close($conn);

?>
