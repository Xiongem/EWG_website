<?php
if (isset($_POST['newGoal']) && isset($_POST['startDate'] && isset($_POST['goalDate'])) {
    $goal = $_POST["newGoal"];
    $startDate = $_POST["startDate"];
    $goalDate = $_POST["goalDate"];

    // $now = time();
    $start_date = strtotime($startDate);
    $end_date = strtotime($goalDate);
    $datediff = $end_date  - $start_date;
    $interval = round($datediff / (60 * 60 * 24));

    $recommend = round($goal / $interval);
    echo "Recommended daily goal: $recommend";
} else {
    echo "something went wrong";
}