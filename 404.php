<?php
ob_start();
session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$userID = htmlspecialchars($_SESSION["user_id"]);
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
        <title>Page Not Found</title>
        <link rel="stylesheet" href="/css/EWG_theme.css">
        <link rel="website icon" type="webp" href="\comp-cat-beta.webp">
        <script src="/javascript/script.js"></script>
        <script src="/javascript/dropDown.js"></script>
    </head>
    <body>
        <header>
            <?php makeNav() ?>
            <?php makeDropDown() ?>
        </header>
    <div class="not-found">
        <h1 style="font-size: 60px;">OOPS!</h1><br>
        <h1>Looks like the page you're<br>looking for isn't here</h1>
    </div>
    <?php makeFooter() ?>
</body>
</html>