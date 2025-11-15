<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$result = $_GET["result"];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/contact">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">
    <!-- //* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="captchaPopupWrapper" id="captchaPopupWrapper" onload="generate()">
        <div class="captchPopup">
            <!-- <div id="user-input" class="inline">
                <input type="text" 
                    id="capSubmit" 
                    placeholder="Captcha code" />
            </div>

            <div class="inline" onclick="generate()">
                <i class="fa fa-sync"></i>
            </div>

            <div id="image" 
                class="inline" 
                selectable="False">
            </div>
            <input type="submit" 
                id="btn" 
                onclick="printmsg()" />
            <p id="key"></p> -->
            <div class="center">
                <h3>Enter CAPTCHA to proceed</h3>
                <div id="captchaBackground">
                    <canvas id="captcha">captcha text</canvas>
                    <input id="textBox" type="text" name="text">

                    <div id="buttons">
                        <input id="submitButton" type="submit">
                        <button id="refreshButton" type="submit">Refresh</button>
                    </div>

                    <span id="output"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="contact-wrapper">
        <div class="contact-content">
            <h1>Contact Us</h1>
            <h3>Let us know what's going on</h3>
            <?php if ($result == "fail") {?>
                <p class="fail">Message failed to send</p>
                <p class="fail">Please check all sections are filled in.</p>
            <?php } ?>
            <form method="post" action="php-processes/send-contact">
                <div class="content-wrapper">
                    <div class="user-wrapper">
                        <label for="username">Username/Name:</label>
                        <input class="input" type="text" id="username" name="username" placeholder="required" required>
                        <label for="email">Email:</label>
                        <input class="input" type="email" id="email" name="email" placeholder="required" required>
                    </div>
                    <div class="message-wrapper">
                        <label for="message">Message:</label>
                        <textarea name="message" id="message" required></textarea>
                    </div>
                </div>
                <div class="contact-button">
                    <input type="submit" id="submit" value="Submit">
                </div>
                <script>
                    document.getElementById("submit").disabled = true;
                </script>
            </form>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
    <script>
        //* generates and verified captcha to prevent bots submitting contact forms
        let captchaText = document.getElementById('captcha');
        var ctx = captchaText.getContext("2d");
        ctx.font = "30px Roboto";
        ctx.fillStyle = "#08e5ff";

        let userText = document.getElementById('textBox');
        let submitButton = document.getElementById('submitButton');
        let output = document.getElementById('output');
        let refreshButton = document.getElementById('refreshButton');

        var captchaStr = "";

        let alphaNums = ['A', 'B', 'C', 'D', 'E', 'F', 'G',
                        'H', 'I', 'J', 'K', 'L', 'M', 'N', 
                        'O', 'P', 'Q', 'R', 'S', 'T', 'U', 
                        'V', 'W', 'X', 'Y', 'Z', 'a', 'b', 
                        'c', 'd', 'e', 'f', 'g', 'h', 'i', 
                        'j', 'k', 'l', 'm', 'n', 'o', 'p', 
                        'q', 'r', 's', 't', 'u', 'v', 'w', 
                        'x', 'y', 'z', '0', '1', '2', '3', 
                        '4', '5', '6', '7', '8', '9'];
        
        function generate_captcha() {
            let emptyArr = [];

            for (let i = 1; i <= 7; i++) {
                emptyArr.push(alphaNums[Math.floor(Math.random() * alphaNums.length)]);
            }

            captchaStr = emptyArr.join('');

            ctx.clearRect(0, 0, captchaText.width, captchaText.height);
            ctx.fillText(captchaStr, captchaText.width/4, captchaText.height/2);

            output.innerHTML = "";
        }

        generate_captcha();

        function check_captcha() {
            if (userText.value === captchaStr) {
                // output.className = "correctCaptcha";
                // output.innerHTML = "Correct!";
                document.getElementById("captchaPopupWrapper").style.display = "none";
                showBackground();
                var verified = true;
            } else {
                output.className = "incorrectCaptcha";
                output.innerHTML = "Incorrect, please try again!";
            }
        }

        if (verified === true) {
            document.getElementById("submit").disabled = false;
        }

        userText.addEventListener('keyup', function(e) {
            if (e.key === 'Enter') {
                check_captcha();
            }
        });

        submitButton.addEventListener('click', check_captcha);

        refreshButton.addEventListener('click', generate_captcha);
        // var captcha;
        // var verified = false;
        // function generate() {
            
        //     // Clear old input
        //     document.getElementById("capSubmit").reset();

        //     // Access the element to store
        //     // the generated captcha
        //     captcha = document.getElementById("image");
        //     let uniquechar = "";

        //     const randomchar =
        // "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";

        //     // Generate captcha for length of
        //     // 5 with random character
        //     for (let i = 1; i < 5; i++) {
        //         uniquechar += randomchar.charAt(
        //             Math.random() * randomchar.length)
        //     }

        //     // Store generated input
        //     captcha.innerHTML = uniquechar;
        // }

        // function printmsg() {
        //     const usr_input = document
        //         .getElementById("capSubmit").value;

        //     // Check whether the input is equal
        //     // to generated captcha or not
        //     if (usr_input == captcha.innerHTML) {
        //         document.getElementById("captchaPopupWrapper").style.display = "none";
        //         showBackground();
        //         var verified = true;
        //     }
        //     else {
        //         let s = document.getElementById("key")
        //             .innerHTML = "not Matched";
        //         generate();
        //     }
        // }
        // generate();

        // if (verified === true) {
        //     document.getElementById("submit").disabled = false;
        // }
</script>
</body>
</html>