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
$stmt = $conn -> prepare("UPDATE users SET password_hash=? WHERE id=?");
$stmt->bind_param("si",
                    $_POST["username"],
                    $_POST["email"],
                    $password_hash);

if ($stmt -> execute()) {
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                    $conn->real_escape_string($_POST["username"]));

    $result = $conn->query($sql);

    $user = $result->fetch_assoc();

        $_SESSION['loggedin'] = true;
        $_SESSION["user_id"] = $user["id"];

        header("Location: /profile-create.html");
        exit;
    } else {
        die("email already taken");
}