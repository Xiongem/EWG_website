<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();
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
    <title>Announcements</title>
   <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/announcements.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
</head>
<body>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="announce">
        <h1 id="announce-title">Announcements</h1>
        <div class="announce-container">
            <div class="announce-contents">
                <h2>Beta Testing is now open!</h2>
                <p>
                    Feel free to use the site like normal. If you come across a problem
                    or something doesn't look right, report the issue to <a href="contact.php">contact us</a> or message
                    the creator on discord.
                    <br><br>
                    We thank you for your help and patience while all the kinks in the code are worked out.
                </p>
                <div class="sign-off">
                    <p>Happy writing! - The Elsewhere Writers Guild Developer</p>
                </div>
            </div>
            <div class="announce-contents">
                <h2>New Updates and Improvements</h2>
                <div class="list-wrapper">
                    <ul>
                        <li>The website now has a mobile view version!</li>
                        <li>Users can now work on up to 5 projects at once</li>
                        <li>Many badges have been automated and can be earned by making certain progress on projects</li>
                        <li>Users can now choose between dark and light theme versions for three diffrent colors</li>
                        <li>Projects can be deleted, archived, or finished</li>
                    </ul>
                </div>
            </div>
            <div class="announce-contents hide">
                <h2>No Announcements Yet</h2>
                <img src="../images/pngs/hot-dog.png" class="spin">
            </div>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
</body>
</html> 