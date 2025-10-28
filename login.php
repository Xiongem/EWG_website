<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    // $servername = "localhost";
    // $database = "u792691800_ewg_data";
    // $username = "u792691800_Xiongem97";
    // $password = "Hi5gem97*";

    // // Create connection
    
    // $conn = mysqli_connect($servername, $username, $password, $database);
    
    // // Check connection
    
    // if (!$conn) {
    
    //     die("Connection failed: " . mysqli_connect_error());
    
    // }

    ob_start();
    require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
    dbConnect();

    //query
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                    $_SESSION["conn"]->real_escape_string($_POST["username"]));

    $result = $_SESSION["conn"]->query($sql);

    $user = $result->fetch_assoc();

    if ($user) {

        if (password_verify($_POST["pwd"], $user["password_hash"])){

          session_start();

          $_SESSION['loggedin'] = true;
          $_SESSION["user_id"] = $user["id"];

            header("Location: index.php");
          exit;
        }
    }

    $is_invalid = true;

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!-- <div class="announce-wrapper">
        <h1>Attention!</h1>
        <h3>The Website is currently down for maintenance. Please check back later.</h3>
    </div> -->
    <div class="login-wrapper">
        <div class="login-container">
            <div id="login-title">
                <h1>Welcome to the</h1>
                <h1 class="website-title">Elsewhere Writers Guild</h1>
            </div>
            <form method="post">
                <label for="username">Username:</label>
                <input class="input-login" type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST["username"] ?? "") ?>">
                <label for="password">Password:</label>
                <input class="input-login" type="password" id="pwd" name="pwd" required autocomplete="new-password">
                <div class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox" onclick="showPassword()">
                    <label for="checkbox">Show Password</label>
                </div>
                <div class="button" id="submit-button">
                    <input type="submit" value="Login" id="submit">
                </div>
            </form>
                <?php if ($is_invalid): ?>
                    <em>Invalid login</em>
                <?php endif; ?>
            <div class="forgot-password">
                <a href="forgot-password.html">Forgot your password?</a>
                <a href="account-create.html">Create a new account</a>
            </div>
        </div>
    </div>
</body>
</html>