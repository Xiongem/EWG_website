<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$goal = $_POST["goal"];
$goalDate = $_POST["goalDate"];
$your_date = strtotime($goalDate);