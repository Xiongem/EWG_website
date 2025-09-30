<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];
$choice = $_POST["wordCount"];

if ($choice == "replace") {
    $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=? WHERE users_id=$userID AND current_state='current' AND display='active'");
    $stmt->bind_param("i",
                            $_POST["updateWordCount"]);
        echo "stmt prepared and bound!".'<br>';

    if ($stmt -> execute()) {
        header("Location: /index.php");
        exit;
    } else {
        die("an unexpected error occured");
    }
} elseif ($choice == "add") {
    $sql = "SELECT current_count FROM current_project WHERE users_id=$userID AND current_state='current' AND display='active'";
        $result = $_SESSION["conn"]->query($sql);
        $count = $result->fetch_assoc();
            $currentCount = $count["current_count"];

    $newCount = $currentCount + $_POST["updateWordCount"];

    $stmt = $_SESSION["conn"] -> prepare("UPDATE current_project SET current_count=? WHERE users_id=$userID AND current_state='current' AND display='active'");
    $stmt->bind_param("i",
                            $newCount);
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

$stmt -> close();
mysqli_close($conn);
?>