<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
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
    //query
    $sql = sprintf("SELECT * FROM users
                    WHERE username = '%s'",
                    $conn->real_escape_string($_POST["username"]));

    $result = $conn->query($sql);

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
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG Login</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/login_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
</head>
<body>
  <div class="body">
    <div class="login">
      <h1>Welcome to the
                <br>
          Elsewhere Writers Guild</h1>
      <form method="post">
          <label for="username">Username</label><br>
          <input type="text" id="username" name="username" required value="<?= htmlspecialchars($_POST["username"] ?? "") ?>"><br>
          <label for="password">Password</label><br>
          <input type="password" id="pwd" name="pwd" required autocomplete="new-password"><br>
          <input type="checkbox" class="checkbox" onclick="showPassword()" style="margin-bottom: 2em;">Show Password<br>
          <div class="btn" id="submit-button">
            <input type="submit" value="Login" id="submit">
          </div>
      </form>
        <?php if ($is_invalid): ?>
          <em>Invalid login<em>
        <?php endif; ?>
      <div class="forget">
        <a href="forgot-password.php">Forgot your password?</a>
        <a href="account-create.html">Create a new account</a>
      </div>
    </div>
  </div>
</body>
</html>