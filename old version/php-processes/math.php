<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

if (isset($_POST['goal'])&& isset($_POST['goalDate'])) {
    $goal = $_POST["goal"];
    $goalDate = $_POST["goalDate"];

    $now = time();
    $your_date = strtotime($goalDate);
    $datediff = $your_date - $now;
    $interval = round($datediff / (60 * 60 * 24));

    $recommend = round($goal / $interval);
    echo "Recommended goal: $recommend";
} else {
    echo "something went wrong";
}