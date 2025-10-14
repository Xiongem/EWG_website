<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

//echo'connected successfully'.'<br>';

$userID = htmlspecialchars($_SESSION["user_id"]);
$projectID = $_POST["projectID"];
echo $projectID;

// prepare and bind


?>
