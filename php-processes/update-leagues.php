<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');


session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

$userID = $_SESSION["user_id"];

$sql = "SELECT * FROM users WHERE id=$userID";
    $result = $_SESSION["conn"]->query($sql);
    $user = $result->fetch_assoc();
        $joinedLeague = $user["league"];

if ($_POST["changeLeague"] == "casual") {
    $league = "Casual";
} elseif ($_POST["changeLeague"] == "speedster") {
    $league = "Speedster";
} else {
    $league = $joinedLeague;
}

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET league=? WHERE id=$userID");
    $stmt->bind_param("s",
                            $league);

if ($stmt -> execute()) {
    header("Location: /competition.php");
    exit;
} else {
    die("an unexpected error occured");
}