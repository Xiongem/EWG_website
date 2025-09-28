<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
forceLogin();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Update Profile</title>
    <link rel="stylesheet" href="mf-css/style.css">
    <link rel="stylesheet" href="mf-css/profile.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="update-wrapper">
        <h1>Update Your Profile</h1>
        <form>
            <label for="user-bio">Bio: tell everyone about yourself</label>
            <textarea id="user-bio" name="user-bio" minlength="1" maxlength="300" placeholder="Max length: 300 characters"></textarea>
            
            <label>Favorites: what are you interested in?</label>
            <div class="fav-wrapper">
                <label for="fav-1">1:</label>
                <input type="text" id="fav-1" name="fav-1" class="favs" minlength="1" maxlength="100">
            </div>
            <div class="fav-wrapper">
                <label for="fav-2">2:</label>
                <input type="text" id="fav-2" name="fav-2" class="favs" minlength="1" maxlength="100">
            </div>
            <div class="fav-wrapper">
                <label for="fav-3">3:</label>
                <input type="text" id="fav-3" name="fav-3" class="favs" minlength="1" maxlength="100">
            </div>

            <div class="button-wrapper">
                <button type="submit" id="updateSubmit">Update</button>
            </div>
        </form>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
</body>
</html>