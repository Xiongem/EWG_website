<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

if (empty($_POST["username"])) {
    die("Username is required");
}

if (! filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    die("Valid email is required");
}

if (strlen($_POST["pwd"]) < 8) {
    die("Password must be at least 8 characters");
}

if ( ! preg_match("/[a-z]/i", $_POST["pwd"])) {
    die("Password must contain at least one letter");
}

if ( ! preg_match("/[0-9]/i", $_POST["pwd"])) {
    die("Password must contain at least one number");
}

if ($_POST["pwd"] !== $_POST["confirm_pwd"]) {
    die("Passwords must match");
}

