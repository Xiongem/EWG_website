<?php
if (isset($_POST['newGoal'])&& isset($_POST['goalDate'])) {
    $goal = $_POST["newGoal"];
    $goalDate = $_POST["goalDate"];

    $now = time();
    $your_date = strtotime($goalDate);
    $datediff = $your_date - $now;
    $interval = round($datediff / (60 * 60 * 24));

    $recommend = round($goal / $interval);
    echo "Recommended daily goal: $recommend";
} else {
    echo "something went wrong";
}