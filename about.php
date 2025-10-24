<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
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
    <title>About</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/about.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="about-wrapper">
        <div class="about-container">
            <h1>Welcome to the Elsewhere Writers Guild</h1>
            <div class="about-content">
                <p>Whether you're new to writing or you've written a thousand stories, you're always welcome in the guild.</p>
                <p>The guild exists as a way for writers to find external motivation while undergoing the arduous process of writing.</p>
                <p>Here you can create projects, update your word count, and earn badges for your progress.</p>
                <p>Right now the guild is small, but there are many ideas brewing for the future.</p>
                <p>May the words flow easily for you while a part of the guild.</p>
                <p>-- The Elsewhere Writers Guild Creator</p>
            </div>
            <div class="elmo hide">
                <img src="../images/gifs/burn-elmo.gif">
            </div>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
</body>
</html>