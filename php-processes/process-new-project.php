<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');
ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];

$sql = "SELECT username FROM users WHERE id=$userID";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();

//echo"user ID acquired"."<br>";

$sql = "SELECT current_state FROM current_project WHERE users_id=$userID";
$result = $_SESSION["conn"]->query($sql);
$projectStatus = $result->fetch_assoc();

$status = $projectStatus["current_state"];

//echo "$status"."<br>";

$username = $user["username"];
$genre = $_POST["switch"];
$title = $_POST["newProjectTitle"];
$info = $_POST["info"];
$current_count = 0;
$goal = $_POST["goal"];
$date = $_POST["goal_date"];
$dailyGoal = $_POST["daily_goal"];
$current_state = "current";

echo"$username, $genre, $title, $info, $current_count, $goal, $date, $dailyGoal"."<br>";

// Insert new project data
if ($status == "current") {
    die("You already have a current project. Please archive your current project before starting another.");
} else if ($status == "" || $status == "archived") {
    $stmt = $_SESSION["conn"] -> prepare("INSERT INTO current_project 
                        (username, genre, title, info, current_count, goal, goal_date, daily_goal, current_state, users_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //echo "stmt prepared"."<br>";
    //bind params
    $stmt->bind_param("ssssiiissi",
                        $username,
                        $_POST["switch"],
                        $_POST["newProjectTitle"],
                        $_POST["info"],
                        $current_count,
                        $_POST["goal"],
                        $_POST["goal_date"],
                        $_POST["daily_goal"],
                        $current_state,
                        $_SESSION["user_id"]);
        //echo "params bound"."<br>";
} else {
    die("unexpected error");
}
//execute statement
if ($stmt -> execute()) {
    header("Location: /projects.php");
        exit;
    } else {
        die("unexpected error");
}

$stmt -> close();
mysqli_close($conn);

?>