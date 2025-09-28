<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$name = $_GET["name"];

$sql = "SELECT * FROM users WHERE username='$name'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $username = $user["username"];
    $userID = $user["id"];
    $bio = $user["bio"];
    $fav1 = $user["fav-1"];
    $fav2 = $user["fav-2"];
    $fav3 = $user["fav-3"];
    $pfp = $user["pfp"];

echo $bio;
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
    <title>Profile</title>
    <link rel="stylesheet" href="mf-css/style.css">
    <link rel="stylesheet" href="mf-css/profile.css">
    <link rel="stylesheet" href="mf-css/progressBar.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="profile-wrapper">
        <a id="profileUpdate" href="updateProfile.php"><i class="fa fa-gear"></i></a>
            <div class="user-container">
                <img src="../images/dragon/dragon-0.webp" alt="profile image" id="profilePicture">
                <h1 id="username"><?php echo $username ?></h1>
            </div>
            <div class="profile-container">
                <div class="fav-container">
                    <h2>Favs:</h2>
                    <p><?php $fav1 ?></p>
                    <p><?php $fav2 ?></p>
                    <p><?php $fav3 ?></p>
                </div>
                <div class="bio-container">
                    <h2>Bio:</h2>
                    <p> <?php $bio ?> </p>
                </div>
            </div>
    </div>
    <div class="main-wrapper">
        <div class="current-project-wrapper">
            <div class="current-project-container">
                <div id="area-title">
                    <h1>Current Project</h1>
                </div>
                <div class="progress-info-container">
                    <div id="project-img">
                        <img src="../images/genre-covers/placeholder(v3).webp" id="theme-img">
                    </div>
                    <div id="project-title">
                        <h2>Title</h2>
                    </div>
                    <div id="project-summary">
                        <!-- <p>Looks like you don't have any active projects.
                            <br><br>
                            Click <a href="newProject.html">here</a> to get started!
                        </p> -->
                        <p id="summary-text">
                            Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex 
                            sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis 
                            convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus 
                            fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada 
                            lacinia integer nunc posuere ut hendrerit semper vel class aptent taciti 
                            sociosqu ad litora torquent per conubia nostra inceptos himenaeos orci 
                            varius natoque penatibus et magnis dis parturient montes nascetur
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--* BADGES-->
        <div class="badge-container">
            <div class="slider-container">
                <i class="fa fa-lock" alt="lock icon"></i>
                <label class="switch">
                    <input type="checkbox" id="badgeEdit" onclick="disableBadgePopups()">
                    <span class="slider round"></span>
                </label>
                <i class="fa fa-unlock" alt="unlocked icon"></i>
            </div>
            <h1 id="badge-title">All Time Badges</h1>
            <!--* Completed one project-->
            <div class="badge-wrapper">
                <img src="../images/badges/complete-one-project-mono.webp" id="complete-one-project" class="badge pulse">
                <div class="badgeToPopup" id="complete-one-project-popup">
                    <h4>Completed 1 Project</h4>
                    <p>Congrats on finishing your first project!</p>
                </div>
            </div>
            <!--* Completed 5 projects-->
            <div class="badge-wrapper">
                <img src="../images/badges/complete-five-project-mono.webp" id="complete-five-project" class="badge pulse">
                <div class="badgeToPopup" id="complete-five-project-popup">
                    <h4>Completed 5 Projects!</h4>
                    <p>Give yourself a firm pat on the back!</p>
                </div>
            </div>
            <!--* Completed 10 projects-->
            <div class="badge-wrapper">
                <img src="../images/badges/complete-ten-project-mono.webp" id="complete-ten-project" class="badge pulse">
                <div class="badgeToPopup" id="complete-ten-project-popup">
                    <h4>Completed 10 Projects?!</h4>
                    <p>I don't know about you, but this seems super impressive!</p>
                </div>
            </div>
            <!--* Streak fiend-->
            <div class="badge-wrapper">
                <img src="../images/badges/streak-fiend-mono.webp" id="streak-fiend" class="badge pulse">
                <div class="badgeToPopup" id="streak-fiend-popup">
                    <h4>Streak Fiend</h4>
                    <p>Completed a project with a perfect streak!</p>
                </div>
            </div>
            <!--* Veteran Streaker-->
            <div class="badge-wrapper">
                <img src="../images/badges/vet-streaker-mono.webp" id="vet-streaker" class="badge pulse">
                <div class="badgeToPopup" id="vet-streaker-popup">
                    <h4>Veteran Streaker</h4>
                    <p>Completed multiple projects with perfect streaks!</p>
                </div>
            </div>
            <!--* Hydra Slayer-->
            <div class="badge-wrapper">
                <img src="../images/badges/hydra-slayer-mono.webp" id="hydra-slayer" class="badge pulse">
                <div class="badgeToPopup" id="hydra-slayer-popup">
                    <h4>Hydra Slayer</h4>
                    <p>Slaying the hydra is no easy feat.<br>
                        To earn this badge, you must write at least 
                        500 words within a 5 minute writing sprint.</p>
                </div>
            </div>
            <!--* veteran guildmember-->
            <div class="badge-wrapper">
                <img src="../images/badges/vet-guild-mono.webp" id="vet-guild" class="badge pulse">
                <div class="badgeToPopup" id="vet-guild-popup">
                    <h4>Veteran Guildmember</h4>
                    <p>You've participated in the yearly challenge multiple years in a row!</p>
                </div>
            </div>
            <!--* First project start date-->
            <div class="badge-wrapper">
                <img src="../images/badges/start-first-project-mono.webp" id="start-first-project" class="badge pulse">
                <div class="badgeToPopup" id="start-first-project-popup">
                    <h4>Started Your First Project</h4>
                    <p>PHP data goes here</p>
                </div>
            </div>
            <!--* Spicy-->
            <div class="badge-wrapper">
                <img src="../images/badges/spicy-spicy-mono.webp" id="spicy-spicy" class="badge pulse">
                <div class="badgeToPopup" id="spicy-spicy-popup">
                    <h4>Spicy, Spicy</h4>
                    <p>Started a project that you can never show your parents. Ya nasty!</p>
                </div>
            </div>
            <!--* Tears-->
            <div class="badge-wrapper">
                <img src="../images/badges/tears-alltime-mono.webp" id="tears-alltime" class="badge pulse">
                <div class="badgeToPopup" id="tears-alltime-popup">
                    <h4>Tears Were Wept</h4>
                    <p>One or more of your projects has made you cry.</p>
                </div>
            </div>
        <p id="instruction">To give yourself a badge, simply activate the toggle and click on a badge. 
                        Click on it again to remove it.</p>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
    <script>
        // BADGE POPUPS
    const badge1 = document.getElementById('complete-one-project');
    const Popup1 = document.getElementById('complete-one-project-popup');
    badge1.addEventListener('mouseenter',
        () => {
            console.log("hello");
        Popup1.classList.add('showFlex');
        });
        
    badge1.addEventListener('mouseleave',
        () => {
        Popup1.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge2 = document.getElementById('complete-five-project');
    const Popup2 = document.getElementById('complete-five-project-popup');
    badge2.addEventListener('mouseenter',
        () => {
        Popup2.classList.add('showFlex');
        });
        
    badge2.addEventListener('mouseleave',
        () => {
        Popup2.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge3 = document.getElementById('complete-ten-project');
    const Popup3 = document.getElementById('complete-ten-project-popup');
    badge3.addEventListener('mouseenter',
        () => {
        Popup3.classList.add('showFlex');
        });
        
    badge3.addEventListener('mouseleave',
        () => {
        Popup3.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge4 = document.getElementById('streak-fiend');
    const Popup4 = document.getElementById('streak-fiend-popup');
    badge4.addEventListener('mouseenter',
        () => {
        Popup4.classList.add('showFlex');
        });
        
    badge4.addEventListener('mouseleave',
        () => {
        Popup4.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge5 = document.getElementById('vet-streaker');
    const Popup5 = document.getElementById('vet-streaker-popup');
    badge5.addEventListener('mouseenter',
        () => {
        Popup5.classList.add('showFlex');
        });
        
    badge5.addEventListener('mouseleave',
        () => {
        Popup5.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge6 = document.getElementById('hydra-slayer');
    const Popup6 = document.getElementById('hydra-slayer-popup');
    badge6.addEventListener('mouseenter',
        () => {
        Popup6.classList.add('showFlex');
        });
        
    badge6.addEventListener('mouseleave',
        () => {
        Popup6.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge7 = document.getElementById('vet-guild');
    const Popup7 = document.getElementById('vet-guild-popup');
    badge7.addEventListener('mouseenter',
        () => {
        Popup7.classList.add('showFlex');
        });
        
    badge7.addEventListener('mouseleave',
        () => {
        Popup7.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge8 = document.getElementById('start-first-project');
    const Popup8 = document.getElementById('start-first-project-popup');
    badge8.addEventListener('mouseenter',
        () => {
        Popup8.classList.add('showFlex');
        });
        
    badge8.addEventListener('mouseleave',
        () => {
        Popup8.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge9 = document.getElementById('spicy-spicy');
    const Popup9 = document.getElementById('spicy-spicy-popup');
    badge9.addEventListener('mouseenter',
        () => {
        Popup9.classList.add('showFlex');
        });
        
    badge9.addEventListener('mouseleave',
        () => {
        Popup9.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const badge10 = document.getElementById('tears-alltime');
    const Popup10 = document.getElementById('tears-alltime-popup');
    badge10.addEventListener('mouseenter',
        () => {
        Popup10.classList.add('showFlex');
        });
        
    badge10.addEventListener('mouseleave',
        () => {
        Popup10.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    function disableBadgePopups() {
    var popup = document.getElementsByClassName("badgeToPopup");
    var slider = document.getElementById("badgeEdit").checked;
        if (slider == true) {
            var i;
            for (i = 0; i < popup.length; i++) {
                popup[i].classList.add('hide');
            }
        } else {
            var i;
            for (i = 0; i < popup.length; i++) {
                popup[i].classList.remove('hide');
            }
        }
    }
    </script>
</body>
</html>