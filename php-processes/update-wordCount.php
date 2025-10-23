<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$choice = $_POST["wordCount"];
$streak = $_SESSION["streak"];
$intervals = $_SESSION["intervals"];
$update_date = $_SESSION["update_date"];
$projectID = $_POST["projectID"];

$updateCount = $_POST["updateWordCount"];
$newGoal = str_replace( ',', '', $updateCount );
if( is_numeric( $newGoal ) ) {
    $updateCount = $newGoal;
}

$sql = "SELECT `current_count`, `daily_goal`, `first-daily` FROM current_project WHERE users_id='$userID' AND current_state='current' AND id=$projectID";
        $result = $_SESSION["conn"]->query($sql);
        $count = $result->fetch_assoc();
            $currentCount = $count["current_count"];
            $dailyGoal = $count["daily_goal"];
            $firstDaily = $count["first-daily"];
            $dailyStreak = $count["daily_goal_streak"];
            echo "$count['daily_goal_streak']"."<br>";
if ($intervals == 1 && $updateCount >= $dailyGoal) {
    $dailyStreak = $dailyStreak + 1;
} elseif ($intervals >= 2) {
    $dailyStreak = 1;
} else {
    $dailyStreak = $dailyStreak;
}

    $newCount = $currentCount + $updateCount;

//* if user has reached their daily goal for the first time
if ($firstDaily !== "unlocked" && $updateCount >= $dailyGoal) {
    $firstDaily = "unlocked";
    echo "first option";
    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, `first-daily`=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isisi",
                                $updateCount,
                                $update_date,
                                $streak,
                                $firstDaily,
                                $dailyStreak);

        if ($stmt -> execute()) {
            // header("Location: /index.php");
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

        if ($stmt -> execute()) {
            // header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } else {
        die("an unexpected error occured");
    }
} elseif ($firstDaily == "unlocked" && $updateCount >= $dailyGoal) {
    //* User has reached their daily goal after the first time
    echo "second option"."<br>";
    echo $dailyStreak;
    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isii",
                                $updateCount,
                                $update_date,
                                $streak,
                                $dailyStreak);

        if ($stmt -> execute()) {
            // header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } elseif ($choice == "add") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isii",
                                $newCount,
                                $update_date,
                                $streak,
                                $dailyStreak);

        if ($stmt -> execute()) {
            // header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } else {
        die("an unexpected error occured");
    }
} else {
    //* User has not reached their daily goal
    echo "third option";
    if ($choice == "replace") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isi",
                                $updateCount,
                                $update_date,
                                $streak);

        if ($stmt -> execute()) {
            // header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
    } elseif ($choice == "add") {
        $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isi",
                                $newCount,
                                $update_date,
                                $streak);

        if ($stmt -> execute()) {
            // header("Location: /index.php");
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