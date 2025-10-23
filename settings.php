<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
forceLogin();

$userID = htmlspecialchars($_SESSION["user_id"]);

    $sql = "SELECT * FROM users WHERE id=$userID";
    $result = $_SESSION["conn"]->query($sql);
    $user = $result->fetch_assoc();
        $pfp = $user["pfp"];
        $username = $user["username"];
        $email = $user["email"];

        //* Setting pfp
        if ($pfp) {
            $pfp_set = $pfp;
        } else {
            $pfp_set = "images/pfp-icon.webp";
        }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG Settings</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/settings.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div id="warning" class="warning">
        <div class="warning-wrapper">
            <div class="warning-content">
                <h1 class="warning-text"><strong>Delete Your Account?</strong></h1>
                <p class="warning-text">This is <strong><em>permanent</em></strong> and cannot be reversed.
                <br><br>
                Are you <strong>certain</strong> you want to delete your account?</p>
            </div>
            <div class="button-wrapper-warning">
                <div class="delete">
                    <a id="delete">Delete My Account</a>
                </div>
                <div id="hide-warning" onclick="hideWarning()">Back to Safety</div>
            </div>
        </div>
    </div>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="settings-wrapper">
        <div class="settings-container">
            <div class="tab">
                <div class="tab-link active" onclick="clickHandle(event, 'appearance')">
                    <p>Appearance</p>
                </div>
                <div class="tab-link" onclick="clickHandle(event, 'account')">
                    <p>Account</p>
                </div>
                <div class="tab-link" onclick="clickHandle(event, 'dangerZone')">
                    <p>Danger Zone</p>
                </div>
            </div>

            <div id="appearance" class="tabcontent active">
                <div class="appearance-contents">
                    <div class="pfp-change-wrapper">
                        <img id="change-pfp-image" src="<?=$pfp_set?>">
                        <a href="update-pfp.html" class="update-button">Update Profile Picture</a>
                    </div>
                    <div class="theme-change-wrapper">
                        <div class="theme-change-button">
                            <a>Set Theme</a>
                            <div class="theme-change-dropdown" id="theme-change-dropdown">
                                <p class="setTheme" onclick="setTheme('dark1')">Dark Purple</p>
                                <p class="setTheme" onclick="setTheme('dark2')">Dark Blue</p>
                                <p class="setTheme" onclick="setTheme('dark3')">Dark Red</p>
                                <p class="setTheme" onclick="setTheme('light1')">Light Purple</p>
                                <p class="setTheme" onclick="setTheme('light2')">Light Blue</p>
                                <p class="setTheme" onclick="setTheme('light3')">Light Red</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="account" class="tabcontent">
                <form action="" method="post">
                    <div class="account-content">
                        <div class="form-content">
                            <label>Change Your Username:</label>
                            <input type="text" name="username" id="username" value="<?=$username?>">
                        </div>
                        <div class="form-content">
                            <label>Change Your Email Address:</label>
                            <input type="email" name="email" id="email" value="<?=$email?>">
                        </div>
                        <a href="">Reset Your Password</a>
                    </div>
                    <div class="button-wrapper">
                        <button type="submit" id="save">Save</button>
                    </div>
                </form>                
            </div>

            <div id="dangerZone" class="tabcontent">
                <div class="dangerZone-content">
                    <div class="dangerZone-wrapper">
                        <h2>Delete your account?</h2>
                        <h3>Warning: Deleting your account is permanent 
                            and cannot be reversed! Proceed with caution!</h3>
                    </div>
                
                    <div class="button-wrapper">
                        <button onclick="showWarning()" class="delete">Delete My Account</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
<script>
    function clickHandle(evt, settingTab) {
        let i, tabcontent, tablinks;

  // This is to clear the previous clicked content.
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

  // Set the tab-link to be "active-tab".
    tablinks = document.getElementsByClassName("tab-link");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

  // Display the clicked tab and set it to active.
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].className = tabcontent[i].className.replace(" active", "");
    }
    document.getElementById(settingTab).style.display = "flex";
    evt.currentTarget.className += " active";
    console.log(settingTab);
}
</script>
</body>
</html>