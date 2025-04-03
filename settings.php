<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();

$userID = htmlspecialchars($_SESSION["user_id"]);

$sql = "SELECT * FROM users WHERE id=$userID";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $pfp = $user["pfp"];
    $username = $user["username"];
    $email = $user["email"];
if (empty($pfp)) {
    $pfp_set = "images\pfp-icon.png";
} else{
    $pfp_set = $pfp;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://elsewherewriters.com/images/comp-cat-beta.svg"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG Settings</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/settings_theme.css">
    <link rel="stylesheet" href="css/login_theme.css">
    <link rel="website icon" type="svg" href="images\comp-cat-beta.svg">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
<div id="warning" class="popup2">
    <div class="fuck-you2">
        <div class="popup-content2">
            <h1><strong>Delete Your Account?</strong></h1>
            <p>This is <strong><em>permanent</em></strong> and cannot be undone.
            <br><br>
            Are you <strong>certain</strong> you want to delete your account?</p>
                <div class="danger-buttons">
                    <div class="safety" onclick="hideWarning()">
                        <a class="safety-button" >Back to Safety</a>
                    </div>
                    <div class="delete-btn">
                        <a href="php-processes/delete-account.php" class="delete">Delete Account</a>
                    </div>
                </div>
        </div>
    </div>
</div>
    <div class="setting-container">
        <div class="setting-contents">
            <div class="tab">
                <div class="tab-link" onclick="clickHandle(event, 'appearance')">
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
                <div class="appear-contents">
                    <div class="setting-pfp-change">
                        <img src="<?=$pfp_set?>" class="badge1">
                        <button onclick="goChoosePfp()">Change Profile Picture</button><br>
                    </div>
                    <div class="themes-contents">
                        <div class="dropdown2 Themes">
                            <a href="#" onclick="myFunction2()" class="dropbtn2 Theme-container">Set Theme</a>
                                <div id="myDropdown2" class="dropdown-content2">
                                    <p class="setTheme" onclick="setTheme('light1')">Light-1</p>
                                    <p class="setTheme" onclick="setTheme('light2')">Light-2</p>
                                    <p class="setTheme" onclick="setTheme('dark1')">Dark-1</p>
                                    <p class="setTheme" onclick="setTheme('dark2')">Dark-2</p>
                                    <p class="setTheme" onclick="setTheme('dark3')">Dark-3</p>
                                </div>
                        </div>
                    </div>
                </div>
                <div class="set-but-container">
                    <div class="setting-buttons">
                        <div class="cancel" onclick="goBack()">
                            <a class="cancel-button" >Cancel</a>
                        </div>
                        <button onclick="goExtraBack()" class="save-button">Save</button>
                    </div>
                </div>
            </div>

            <div id="account" class="tabcontent">
                <form action="php-processes/updateUserInfo" method="post">
                    <div class="form-content">
                        <label for="username">Username:</label><br>
                            <input type="text" name="username" id="username" value="<?=$username?>"><br>
                        <label for="email">Email Address:</label><br>
                            <input type="email" name="email" id="email" value="<?=$email?>"><br>
                        <a href="forgot-password.php">Reset your password</a>
                    </div>
                    <div class="setting-buttons">
                        <div class="cancel"onclick="goBack()">
                            <a class="cancel-button" >Cancel</a>
                        </div>
                        <button type="submit" class="save-button">Save</button>
                    </div>
                </form>
            </div>

            <div id="dangerZone" class="tabcontent">
                <div class="danger-container">
                    <div class="danger-contents">
                        <h1>Delete your account?</h1>
                        <h3>Warning: Deleting your account is permanent 
                            and cannot be undone! Proceed with caution!</h3>
                    </div>
                    <div class="anchor">
                        <div class="danger-buttons">
                            <div class="safety" onclick="goBack()">
                                <a class="safety-button" >Back to Safety</a>
                            </div>
                            <button onclick="showWarning()" class="delete">Delete Account</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <footer>
        <!--Make sure to keep the credit to Kohaku for the use of the cat computer logo-->
        <p id="copyright">&copy;2024. All rights reserved. Logo by <a href="https://kohacu.com/20181205post-22321/">Kohaku!</a></p>
    </footer>
    <script>
function clickHandle(evt, settingTab) {
  let i, tabcontent, tablinks;

  // This is to clear the previous clicked content.
  tabcontent = document.getElementsByClassName("tabcontent");
  for (i = 0; i < tabcontent.length; i++) {
    tabcontent[i].style.display = "none";
  }

  // Set the tab to be "active".
  tablinks = document.getElementsByClassName("tab-link");
  for (i = 0; i < tablinks.length; i++) {
    tablinks[i].className = tablinks[i].className.replace(" active", "");
  }

  // Display the clicked tab and set it to active.
  document.getElementById(settingTab).style.display = "block";
  evt.currentTarget.className += " active";
}
</script>
</body>
</html>