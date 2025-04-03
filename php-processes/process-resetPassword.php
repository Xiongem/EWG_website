<?php

ob_start();

require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

$sql = "SELECT * FROM users WHERE reset_token_hash = ?";
$stmt = $_SESSION["conn"] -> prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt -> execute() ;
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($user === null) {
    die("token not found");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("token has expired");
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

$password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);


// prepare and bind
$stmt = $_SESSION["conn"] -> prepare("UPDATE users SET password_hash=? WHERE email=?");
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