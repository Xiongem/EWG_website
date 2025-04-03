<?php
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

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

echo "token has not expired"
?>
<!-- <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option of NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.svg"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/login_theme.css">
    <link rel="website icon" type="svg" href="images\comp-cat-beta.svg">
    <script src="javascript/script.js"></script>
    <script>
        document.getElementById('signup').addEventListener('input', function () {
            validateForm();
        });


        //checks if password and confirm password match
        function validateForm() {
        const password = document.getElementById('pwd').value;
        const confirmPassword = document.getElementById('confirm_pwd').value;
        const submitBtn = document.getElementById('submit');
        const errorElement = document.getElementById('passwordError');

        let isValid = true;

        if (!password || !confirmPassword) {
            isValid = false;
        }

        if (password !== confirmPassword) {
            errorElement.textContent = 'Passwords do not match';
            errorElement.classList.remove('success');
            errorElement.classList.add('error');
            isValid = false;
        } else {
            errorElement.textContent = 'Passwords match';
            errorElement.classList.remove('error');
            errorElement.classList.add('success');
        }
        }
    </script>
</head>
<body>
    <div class="body">
        <div class="login">
            <h1>Reset Your Password</h1>
            <div class="fuck-you">
                <form action="php-processes/process-resetPassword" method="post" id="signup">
                    <input required placeholder="Email" name="email" id="email" type="email">
                    <br>
                    <input required placeholder="Password" autocomplete="new-password" name="pwd" id="pwd" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters">
                    <br>
                    <input required placeholder="Confirm Password" autocomplete="new-password" type="password" name="confirm_pwd" id="confirm_pwd"  onkeyup='check();' /> 
                    <br>
                    <input type="checkbox" class="checkbox" onclick="showPassword()">Show Password<br>
                    <span id="passwordError" class="error"></span>
                    <div id="submit-button">
                        <button value="Submit" class="submit-btn" id="submit">Submit</button>
                    </div>
                </form>
                <script>
                    document.getElementById('signup').addEventListener('input', function () {
                        validateForm();
                    });
            
                    function validateForm() {
                        const password = document.getElementById('pwd').value;
                        const confirmPassword = document.getElementById('confirm_pwd').value;
                        const submitBtn = document.getElementById('submitBtn');
                        const errorElement = document.getElementById('passwordError');
            
                        let isValid = true;
            
                        if (!password || !confirmPassword) {
                            isValid = false;
                        }
            
                        if (password !== confirmPassword) {
                            errorElement.textContent = 'Passwords do not match';
                            errorElement.classList.remove('success');
                            errorElement.classList.add('error');
                            isValid = false;
                        } else {
                            errorElement.textContent = 'Passwords match';
                            errorElement.classList.remove('error');
                            errorElement.classList.add('success');
                        }
                    }
                </script>
            </div>
        </div>
    </div>
</body>
</html> -->