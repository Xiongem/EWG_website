<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$choice = $_POST["wordCount"];
$streak = $_SESSION["streak"];
$update_date = $_SESSION["update_date"];
$projectID = $_POST["projectID"];

$updateCount = $_POST["updateWordCount"];
$newGoal = str_replace( ',', '', $updateCount );
if( is_numeric( $newGoal ) ) {
    $updateCount = $newGoal;
}

$sql = "SELECT `current_count`, `daily_goal`, `daily_goal_streak`, `first-daily` FROM current_project WHERE users_id='$userID' AND current_state='current' AND id=$projectID";
        $result = $_SESSION["conn"]->query($sql);
        $count = $result->fetch_assoc();
            $currentCount = $count["current_count"];
            $dailyGoal = $count["daily_goal"];
            $firstDaily = $count["first-daily"];
            $dailyStreak = $count["daily_goal_streak"];
            

    $newCount = $currentCount + $updateCount;

//* if user has reached their daily goal for the first time
if ($updateCount >= $dailyGoal && $firstDaily !== "unlocked") {
    $firstDaily = "unlocked";
    $dailyStreak = 1;

    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, `first-daily`=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isisi",
                                $updateCount,
                                $update_date,
                                $streak,
                                $firstDaily,
                                $dailyStreak);

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } elseif ($choice == "add") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, `first-daily`=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isisi",
                                $newCount,
                                $update_date,
                                $streak,
                                $firstDaily,
                                $dailyStreak);
            echo "stmt prepared and bound!".'<br>';

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } else {
        die("an unexpected error occured");
    }
} elseif ($updateCount >= $dailyGoal && $firstDaily == "unlocked") {
    //* User has reached their daily goal for the first time
    if ($update_date == date("Y-m-d")) {
    $newDailyStreak = $dailyStreak + 1;
    } else {
        $newDailyStreak = $dailyStreak;
    }

    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isii",
                                $updateCount,
                                $update_date,
                                $streak,
                                $newDailyStreak);

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } elseif ($choice == "add") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isii",
                                $newCount,
                                $update_date,
                                $streak,
                                $newDailyStreak);
            echo "stmt prepared and bound!".'<br>';

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } else {
        die("an unexpected error occured");
    }
} else {
    //* User has not reached their daily goal
    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isi",
                                $updateCount,
                                $update_date,
                                $streak);

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } elseif ($choice == "add") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isi",
                                $newCount,
                                $update_date,
                                $streak);
            echo "stmt prepared and bound!".'<br>';

        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } else {
        die("an unexpected error occured");
    }
}

$stmt -> close();
mysqli_close($conn);
?>