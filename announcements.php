<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
if (empty($_SESSION["pfp"])) {
    $pfp_set = "images\pfp-icon.webp";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG Announcements</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/announce_theme.css">
    <link rel="website icon" type="webp" href="images\comp-cat-beta.webp">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
    </header>
    <?php makePopup() ?>
    <div class="announce">
        <h1>Announcements</h1>
        <div class="announce-container">
            <div class="announce-contents hide">
                <h1>Beta Testing is now open!</h1>
                <p>
                    Feel free to use the site like normal. All we ask is that if you come across a problem
                    or something doesn't look right, report the issue to <a href="">contact us</a> or message
                    the creator on discord.
                    <br><br>
                    We thank you for your help and patience while we work out all the kinks in the code.
                </p>
                <div class="sign-off">
                    <p>Happy writing! - The Elsewhere Writers Guild Staff</p>
                </div>
            </div>
            <div class="announce-contents spin">
                <h1>No Announcements Yet</h1>
                <img src="images\hot-dog.png">
            </div>
        </div>
    </div>
    <?php makeFooter() ?>
</body>
</html>