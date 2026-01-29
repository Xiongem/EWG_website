<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = $_SESSION["user_id"];

$stmt = $_SESSION["conn"] -> prepare("DELETE FROM users WHERE id=?");
$stmt->bind_param("i",
                        $userID);
        //echo "params bound"."<br>";
//execute statement
if ($stmt -> execute()) {
    function logout() {
        if (isset($_SESSION['loggedin'])) {
        unset($_SESSION['loggedin']);     // unset $_SESSION variable for the run-time 
            $_SESSION['loggedin'] = "false";
        } 
    }
    
    session_unset();
    session_destroy();
    
    header("Location: /login.php");
        exit;
    } else {
        die("unexpected error");
}

$stmt -> close();
mysqli_close($conn);
?>