<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Forgot Password</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/login_theme.css">
    <link rel="website icon" type="png" href="images/comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <h1>Forgot Password</h1>
    <div class="form-wrapper">
        <div class="form-contents">
            <h3 id="instruct">Enter the email address associated with your account 
                to receive a one-time email to reset your password.</h3>
            <form id="forget-form" method="post" action="php-processes/send-password-reset">
                <div class="fuck-you">
                    <div class="forget-info-wrapper">
                        <input type="username" name="username" id="username" placeholder="username">
                        <input type="email" name="email" id="forget-email" placeholder="email address">
                        <button id="submit" class="submit-btn">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>