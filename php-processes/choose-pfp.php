<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

// prepare and bind
$userID = $_SESSION["user_id"];

if ($_POST["choose-pfp"] !== "") {
    $stmt = $_SESSION["conn"] -> prepare("UPDATE users SET pfp=? WHERE id=$userID");
    $stmt->bind_param("s",
                            $_POST["choose-pfp"]);

    if ($stmt -> execute()) {
        unset($_SESSION['pfpCreate']);
        header("Location: /index.php");
        exit;
    } else {
        die("an unexpected error occured");
    }
} else {
    $_SESSION['pfpCreate'] = false;
    header("Location: /choose-pfp.php");
}

$stmt -> close();
mysqli_close($conn);
?>