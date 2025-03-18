<?php

ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();

//echo'connected successfully'.'<br>';

$userID = $_SESSION["user_id"];

// prepare and bind
$stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET genre=?, title=?, info=?, goal=?, goal_date=?, daily_goal=? 
                                        WHERE users_id=$userID AND current_state='current'");
$stmt->bind_param("sssiss",
                        $_POST["switch"],
                        $_POST["newProjectTitle"],
                        $_POST["info"],
                        $_POST["goal"],
                        $_POST["goal_date"],
                        $_POST["daily_goal"]);
//echo'params bound'.'<br>';
if ($stmt -> execute()) {
        header("Location: /projects.php");
        //echo'successfully updated project!'.'<br>';
        exit;
    } else {
        die("an unexpected error occured");
}



$stmt -> close();
mysqli_close($conn);

?>
