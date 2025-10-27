<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();


$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET `timezone`=?, `bio`=?, `fav-1`=?, `fav-2`=?, `fav-3`=? WHERE id=?");
$stmt->bind_param("sssssi",
                    $_POST["timezone"],
                    $_POST["bio"],
                    $_POST["fav-1"],
                    $_POST["fav-2"],
                    $_POST["fav-3"],
                    $_SESSION["user_id"]);

if ($stmt -> execute()) {
        header("Location: /choose-pfp.html");
        exit;
    } else {
        die("an unexpected error occured");
}



$stmt -> close();
mysqli_close($conn);
?>