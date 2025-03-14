<?php

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

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

$password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);


// prepare and bind
$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET password_hash=? WHERE id=?");
$stmt->bind_param("ss",
                        $password_hash,
                        $_POST["email"]);

    if ($stmt -> execute()) {
        header("Location: /login.php");
        // echo "Record updated successfully";
        exit;
    } else {
        die("an unexpected error occured");
    }
    $stmt -> close();
    mysqli_close($conn);
?>