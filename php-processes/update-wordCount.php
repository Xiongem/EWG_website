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

$markReach = false;

$newGoal = str_replace( ',', '', $updateCount );
if( is_numeric( $newGoal ) ) {
    $updateCount = $newGoal;
}

$sql = "SELECT * FROM current_project WHERE users_id='$userID' AND current_state='current' AND id=$projectID";
        $result = $_SESSION["conn"]->query($sql);
        $count = $result->fetch_assoc();
            $currentCount = $count["current_count"];
            $dailyGoal = $count["daily_goal"];
            $firstDaily = $count["first-daily"];
            $dailyStreak = $count["daily_goal_streak"];
            $dailyWords = $count["daily_words"];
            $reached = $count["reached"];

$sql = "SELECT points FROM users WHERE id=$userID";
        $result = $_SESSION["conn"]->query($sql);
        $user = $result->fetch_assoc();
            $points = $user["points"];




//? REPLACE
if ($choice == "replace") {
    $replaceCount = $updateCount - $currentCount;
    $dailyCount = $dailyWords + $replaceCount;
    if ($replaceCount > 250) {
        $addPoints = round($replaceCount/250);
    } else {
        $addPoints = $points;
    }

    //? upticks the daily goal count
    if ($reached == 0 && $dailyCount >= $dailyGoal) {
        $dailyStreak = $dailyStreak + 1;
        $markReach = true;
        $sql = "UPDATE current_project SET `reached`= 1 WHERE users_id=$userID AND current_state='current' AND id=$projectID";
            $stmt = $_SESSION["conn"]->prepare($sql);
            $stmt->execute();
    } else {
        $dailyStreak = $dailyStreak;
    }
    $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=?, `daily_words`=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isiii",
                                $updateCount,
                                $update_date,
                                $streak,
                                $dailyStreak,
                                $dailyCount);

        if ($stmt -> execute()) {
            //do nothing, I'm not finished
        } else {
            die("an unexpected error occured");
        }
} elseif ($choice == "add") {
    $newCount = $currentCount + $updateCount;
    $dailyCount = $updateCount + $dailyWords;

    if ($newCount > 250) {
        $addPoints = round($updateCount/250);
    } else {
        $addPoints = $points;
    }

    if ($reached == 0 && $dailyCount >= $dailyGoal) {
        $dailyStreak = $dailyStreak + 1;
        $markReach = true;
        $sql = "UPDATE current_project SET `reached`= 1 WHERE users_id=$userID AND current_state='current' AND id=$projectID";
            $stmt = $_SESSION["conn"]->prepare($sql);
            $stmt->execute();
    } else {
        $dailyStreak = $dailyStreak;
    }
    $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=?, update_date=?, streak=?, daily_goal_streak=?, `daily_words`=? WHERE users_id=$userID AND current_state='current' AND id=$projectID");
        $stmt->bind_param("isiii",
                                $newCount,
                                $update_date,
                                $streak,
                                $dailyStreak,
                                $dailyCount);

        if ($stmt -> execute()) {
            //do nothing, bitch
        } else {
            die("an unexpected error occured");
        }
} else {
    die("an unexpected error occured");
}


if ($addPoints > 0) {
    if ($markReach == true) {
        $newPoints = $addPoints + 5;
        $updatePoints = $points + $newPoints;
    } else {
        $newPoints = $addPoints;
        $updatePoints = $points + $newPoints;
    }

    $sql = "UPDATE users SET `points`= $updatePoints WHERE id=$userID";
                $stmt = $_SESSION["conn"]->prepare($sql);
                
        if ($stmt -> execute()) {
            header("Location: /index.php");
            exit;
        } else {
            die("an unexpected error occured");
        }
}

// $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET points=? WHERE id=$userID");
//         $stmt->bind_param("i",
//                                 $updatePoints);

//         if ($stmt -> execute()) {
//             header("Location: /index.php");
//             exit;
//         } else {
//             die("an unexpected error occured");
//         }


$stmt -> close();
mysqli_close($conn);
?>