<?php

ob_start();
session_start();

$servername = "localhost";
$database = "u792691800_ewg_data";
$username = "u792691800_Xiongem97";
$password = "Hi5gem97*";

// Create connection
 
$conn = mysqli_connect($servername, $username, $password, $database);
 
// Check connection
 
if (!$conn) {
 
    die("Connection failed: " . mysqli_connect_error());
 
}

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

$password_hash = password_hash($_POST["pwd"], PASSWORD_DEFAULT);


// prepare and bind
$stmt = $conn -> prepare("INSERT INTO users (username, email, password_hash) VALUES (?, ?, ?)");
$stmt->bind_param("sss",
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



$stmt -> close();
mysqli_close($conn);
?>
