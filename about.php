<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
if (empty($_SESSION["pfp"])) {
    $pfp_set = "images\pfp-icon.svg";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.svg"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG About</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/about_theme.css">
    <link rel="website icon" type="svg" href="images\comp-cat-beta.svg">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
        </div>
    </header>
    <?php makePopup() ?>
    <div class="about-container">
        <div class="fuck-you">
            <div class="about-contents">
                <h1>
                    Welcome to the Elsewhere Writers Guild
                </h1>
                <p>Whether you're new to writing or you've written a thousand stories, you're always welcome in the guild. 
                    <br>Here we share our progress, encourage and uplift each other, or just take solace in the fact that we're not suffering the process of writing alone.</p>
                <p>We weird. We write. We unite to fight the plots in our heads and torment our characters.</p>
                <div class="fuck-you">
                    <div class="elmo">
                        <img src="images\gifs\burn-elmo.gif">
                    </div>
                </div> 
            </div>
        </div>
    </div>
    <?php makeFooter() ?>
</body>
</html>