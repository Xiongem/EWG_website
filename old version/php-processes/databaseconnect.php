<?php
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
echo "Connected successfully";
mysqli_close($conn);
?>
