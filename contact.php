<?php
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
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/contact_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
</head>
<body>
   <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
   </header>
   <main>
    <div class="contact-container">
            <h1 id="heading">Contact Us</h1>
            <h2>Let us know what's going on.</h2>
            <form action="send-contact.php" method="post">
                <div class="wrapper">
                    <div class="user-info">
                        <div class="contact-contents">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username">
                        </div>
                        <div class="contact-contents">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" placeholder="required" require>
                        </div>
                    </div>
                    <div class="message-contents contact-contents">
                        <label for="message">Message</label>
                        <textarea name="message" id="message" require></textarea>
                    </div>
                </div>
                <div class="contact-buttons">
                    <input type="submit" id="submit" value="Submit">
                </div>
            </form>
    </div>
   </main>
</body>
</html>