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

$username = $user["username"];
$genre = $_POST["genre"];
$title = $_POST["title"];
$info = $_POST["summary"];
$current_count = 0;
$goal = $_POST["goalNumber"];
$date = $_POST["endDate"];
$dailyGoal = $_POST["dailyGoal"];
$current_state = "current";
$display = "active";
$notActive = "inactive";

// echo"$username, $genre, $title, $info, $current_count, $goal, $date, $dailyGoal"."<br>";

if (!isset($_POST["endDate"])) {
    $_POST["endDate"] = "00000-00-00";
}
if (!isset($_POST["dailyGoal"])) {
    $_POST["dailyGoal"] = 0;
}

$newGoal = str_replace( ',', '', $goal );
if( is_numeric( $newGoal ) ) {
    $goal = $newGoal;
}
$newDailyGoal = str_replace( ',', '', $dailyGoal );
if( is_numeric( $newDailyGoal ) ) {
    $dailyGoal = $newDailyGoal;
}

$stmt1 = $_SESSION["conn"] -> prepare("UPDATE current_project SET `display`=? WHERE `users_id`= $userID AND display='active';");

$stmt2 = $_SESSION["conn"] -> prepare("INSERT INTO current_project 
                        (username, genre, title, info, current_count, display, goal, `start_date`,  goal_date, daily_goal, current_state, users_id) 
                        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    //echo "stmt prepared"."<br>";
    //bind params
    $stmt1->bind_param("s",
                        $notActive);
    $stmt2->bind_param("ssssisissisi",
                        $username,
                        $_POST["genre"],
                        $_POST["title"],
                        $_POST["summary"],
                        $current_count,
                        $display,
                        $goal,
                        $_POST["startDate"],
                        $_POST["endDate"],
                        $dailyGoal,
                        $current_state,
                        $_SESSION["user_id"]);
        //echo "params bound"."<br>";
//execute statement
if ($stmt1 -> execute() && $stmt2 -> execute()) {
    header("Location: /index.php");
        exit;
    } else {
        die("unexpected error");
}

$stmt -> close();
mysqli_close($conn);