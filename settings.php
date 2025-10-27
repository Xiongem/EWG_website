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
        $timezone = $user["timezone"];

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        function checkName(){
            var username=document.getElementById( "username" ).value;
            
            if(username){
                $.ajax({
                type: 'post',
                url: 'php-processes/checkData',
                data: {
                    username: username,
                },
                success: function (data) {
                    $( '#user-availability-status' ).html(data);
                }
                });
            }
            else{
                $( '#user-availability-status' ).html("");
                console.log("Something went wrong")
                return false;
            }
        }
        function checkEmail(){
            var email=document.getElementById( "email" ).value;
            
            if(email){
                $.ajax({
                type: 'post',
                url: 'php-processes/checkData',
                data: {
                    email: email,
                },
                success: function (data) {
                    $( '#email-availability-status' ).html(data);
                }
                });
            }
            else{
                $( '#email-availability-status' ).html("");
                console.log("Something went wrong")
                return false;
            }
        }
    </script>
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
                    <a href="php-processes/delete-account.php" id="delete">Delete My Account</a>
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
                <form action="php-processes/update-account" method="post">
                    <div class="account-content">
                        <div class="form-content">
                            <label>Change Your Username:</label>
                            <input type="text" name="username" id="username" value="<?=$username?>" onchange="checkName();">
                            <span id="user-availability-status"></span>
                        </div>
                        <div class="form-content">
                            <label>Change Your Email Address:</label>
                            <input type="email" name="email" id="email" value="<?=$email?>" onchange="checkEmail();">
                            <span id="email-availability-status"></span>
                        </div>
                        <a href="forgot-password.html">Reset Your Password</a>
                    </div>
                    <div class="timezone-wrapper">
                        <label for="imezone">Choose Your Timezone:</label>
                        <select id="timezone" name="timezone" class="form-select">
                            <option value="Pacific/Midway">(GMT-11:00) Midway Island</option>
                            <option value="America/Adak">(GMT-10:00) Hawaii-Aleutian</option>
                            <option value="Etc/GMT+10">(GMT-10:00) Hawaii</option>
                            <option value="Pacific/Marquesas">(GMT-09:30) Marquesas Islands</option>
                            <option value="Pacific/Gambier">(GMT-09:00) Gambier Islands</option>
                            <option value="America/Anchorage">(GMT-09:00) Alaska</option>
                            <option value="America/Ensenada">(GMT-08:00) Tijuana, Baja California</option>
                            <option value="Etc/GMT+8">(GMT-08:00) Pitcairn Islands</option>
                            <option value="America/Los_Angeles">(GMT-08:00) Pacific Time (US & Canada)</option>
                            <option value="America/Denver">(GMT-07:00) Mountain Time (US & Canada)</option>
                            <option value="America/Chihuahua">(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                            <option value="America/Dawson_Creek">(GMT-07:00) Arizona</option>
                            <option value="America/Belize">(GMT-06:00) Saskatchewan, Central America</option>
                            <option value="America/Cancun">(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                            <option value="Chile/EasterIsland">(GMT-06:00) Easter Island</option>
                            <option value="America/Chicago">(GMT-06:00) Central Time (US & Canada)</option>
                            <option value="America/New_York">(GMT-05:00) Eastern Time (US & Canada)</option>
                            <option value="America/Havana">(GMT-05:00) Cuba</option>
                            <option value="America/Bogota">(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                            <option value="America/Caracas">(GMT-04:30) Caracas</option>
                            <option value="America/Santiago">(GMT-04:00) Santiago</option>
                            <option value="America/La_Paz">(GMT-04:00) La Paz</option>
                            <option value="Atlantic/Stanley">(GMT-04:00) Faukland Islands</option>
                            <option value="America/Campo_Grande">(GMT-04:00) Brazil</option>
                            <option value="America/Goose_Bay">(GMT-04:00) Atlantic Time (Goose Bay)</option>
                            <option value="America/Glace_Bay">(GMT-04:00) Atlantic Time (Canada)</option>
                            <option value="America/St_Johns">(GMT-03:30) Newfoundland</option>
                            <option value="America/Araguaina">(GMT-03:00) UTC-3</option>
                            <option value="America/Montevideo">(GMT-03:00) Montevideo</option>
                            <option value="America/Miquelon">(GMT-03:00) Miquelon, St. Pierre</option>
                            <option value="America/Godthab">(GMT-03:00) Greenland</option>
                            <option value="America/Argentina/Buenos_Aires">(GMT-03:00) Buenos Aires</option>
                            <option value="America/Sao_Paulo">(GMT-03:00) Brasilia</option>
                            <option value="America/Noronha">(GMT-02:00) Mid-Atlantic</option>
                            <option value="Atlantic/Cape_Verde">(GMT-01:00) Cape Verde Is.</option>
                            <option value="Atlantic/Azores">(GMT-01:00) Azores</option>
                            <option value="Europe/Belfast">(GMT) Greenwich Mean Time : Belfast</option>
                            <option value="Europe/Dublin">(GMT) Greenwich Mean Time : Dublin</option>
                            <option value="Europe/Lisbon">(GMT) Greenwich Mean Time : Lisbon</option>
                            <option value="Europe/London">(GMT) Greenwich Mean Time : London</option>
                            <option value="Africa/Abidjan">(GMT) Monrovia, Reykjavik</option>
                            <option value="Europe/Amsterdam">(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                            <option value="Europe/Belgrade">(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                            <option value="Europe/Brussels">(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                            <option value="Africa/Algiers">(GMT+01:00) West Central Africa</option>
                            <option value="Africa/Windhoek">(GMT+01:00) Windhoek</option>
                            <option value="Asia/Beirut">(GMT+02:00) Beirut</option>
                            <option value="Africa/Cairo">(GMT+02:00) Cairo</option>
                            <option value="Asia/Gaza">(GMT+02:00) Gaza</option>
                            <option value="Africa/Blantyre">(GMT+02:00) Harare, Pretoria</option>
                            <option value="Asia/Jerusalem">(GMT+02:00) Jerusalem</option>
                            <option value="Europe/Minsk">(GMT+02:00) Minsk</option>
                            <option value="Asia/Damascus">(GMT+02:00) Syria</option>
                            <option value="Europe/Moscow">(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                            <option value="Africa/Addis_Ababa">(GMT+03:00) Nairobi</option>
                            <option value="Asia/Tehran">(GMT+03:30) Tehran</option>
                            <option value="Asia/Dubai">(GMT+04:00) Abu Dhabi, Muscat</option>
                            <option value="Asia/Yerevan">(GMT+04:00) Yerevan</option>
                            <option value="Asia/Kabul">(GMT+04:30) Kabul</option>
                            <option value="Asia/Yekaterinburg">(GMT+05:00) Ekaterinburg</option>
                            <option value="Asia/Tashkent">(GMT+05:00) Tashkent</option>
                            <option value="Asia/Kolkata">(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                            <option value="Asia/Katmandu">(GMT+05:45) Kathmandu</option>
                            <option value="Asia/Dhaka">(GMT+06:00) Astana, Dhaka</option>
                            <option value="Asia/Novosibirsk">(GMT+06:00) Novosibirsk</option>
                            <option value="Asia/Rangoon">(GMT+06:30) Yangon (Rangoon)</option>
                            <option value="Asia/Bangkok">(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                            <option value="Asia/Krasnoyarsk">(GMT+07:00) Krasnoyarsk</option>
                            <option value="Asia/Hong_Kong">(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                            <option value="Asia/Irkutsk">(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                            <option value="Australia/Perth">(GMT+08:00) Perth</option>
                            <option value="Australia/Eucla">(GMT+08:45) Eucla</option>
                            <option value="Asia/Tokyo">(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                            <option value="Asia/Seoul">(GMT+09:00) Seoul</option>
                            <option value="Asia/Yakutsk">(GMT+09:00) Yakutsk</option>
                            <option value="Australia/Adelaide">(GMT+09:30) Adelaide</option>
                            <option value="Australia/Darwin">(GMT+09:30) Darwin</option>
                            <option value="Australia/Brisbane">(GMT+10:00) Brisbane</option>
                            <option value="Australia/Hobart">(GMT+10:00) Hobart</option>
                            <option value="Asia/Vladivostok">(GMT+10:00) Vladivostok</option>
                            <option value="Australia/Lord_Howe">(GMT+10:30) Lord Howe Island</option>
                            <option value="Etc/GMT-11">(GMT+11:00) Solomon Is., New Caledonia</option>
                            <option value="Asia/Magadan">(GMT+11:00) Magadan</option>
                            <option value="Pacific/Norfolk">(GMT+11:30) Norfolk Island</option>
                            <option value="Asia/Anadyr">(GMT+12:00) Anadyr, Kamchatka</option>
                            <option value="Pacific/Auckland">(GMT+12:00) Auckland, Wellington</option>
                            <option value="Etc/GMT-12">(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                            <option value="Pacific/Chatham">(GMT+12:45) Chatham Islands</option>
                            <option value="Pacific/Tongatapu">(GMT+13:00) Nuku'alofa</option>
                            <option value="Pacific/Kiritimati">(GMT+14:00) Kiritimati</option>
                        </select>
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
    //* Loads correct timezone selection on page load
    var timeZone = "<?=$timezone?>";
    var selected = document.getElementById('timezone');
    selected.value = timeZone;

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