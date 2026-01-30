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

// prepare and bind
$stmt = $conn -> prepare("UPDATE users SET bio=?, `fav-1`=?, `fav-2`=?, `fav-3`=? WHERE id=?");
$stmt->bind_param("ssssi",
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
