<?php
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
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/reset-password">
    <title>Reset Password</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <div class="reset-pass-wrapper">
        <div class="reset-pass-content">
            <form id="reset" action="php-processes/resetPassword" method="post">
                <input type="hidden" name="token" value="<?=htmlspecialchars($token)?>">
                <label for="pwd">Password:</label>
                <input type="password"
                    autocomplete="new-password" 
                    name="pwd" 
                    id="pwd" 
                    class="input"
                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"
                    title="Must contain at least one number and one uppercase and lowercase letter, 
                        and at least 8 or more characters"
                    required>

                <label for="confirm_pwd">Confirm Password:</label>
                <input type="password"
                    autocomplete="new-password" 
                    name="confirm_pwd" 
                    id="confirm_pwd"  
                    class="input"
                    required>
                    <!-- onkeyup="check();" -->
                <div class="show-password-wrapper">
                    <div class="show-password">
                        <input type="checkbox" class="checkbox" onclick="showPassword()">
                        <p>Show Password</p>
                    </div>
                    <span id="passwordError" class="error"></span>
                </div>
                <div id="submit-button">
                    <button value="Submit" class="submit-btn" id="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
        <!-- <script>
            document.getElementById('signup').addEventListener('input', function () {
                validateForm();
            });
    
            function validateForm() {
                const username = document.getElementById('username').value;
                const password = document.getElementById('pwd').value;
                const confirmPassword = document.getElementById('confirm_pwd').value;
                const submitBtn = document.getElementById('submitBtn');
                const errorElement = document.getElementById('passwordError');
    
                let isValid = true;
    
                if (!username || !password || !confirmPassword) {
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
        </script> -->
</body>
</html>