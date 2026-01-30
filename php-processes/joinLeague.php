<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');


// session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

$userID = $_SESSION['user_id'];

if(isset($_POST['chooseLeague'])) {
    if ($_POST['chooseLeague'] == "casual") {
        $league = "Casual";
        $joined = 1;
    } elseif ($_POST['chooseLeague'] == "speedster") {
        $league = "Speedster";
        $joined = 1;
    } else {
        $league = "";
        $joined = 0;
    }
}

$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET joined=?, league=? WHERE id=$userID");
    $stmt->bind_param("is",
                            $joined,
                            $league);

if ($stmt -> execute()) {
    header("Location: /competition.php");
    exit;
} else {
    die("an unexpected error occured");
}