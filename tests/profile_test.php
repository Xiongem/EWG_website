<?php
session_start();
require "php-processes/utilities.php";

dbConnect();


if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
    //echo "Welcome to the member's area, " . htmlspecialchars($_SESSION["user_id"]) . "!";
} else {
    header("Location: index.php");
}

$user_pic = $pfp;
$default = "images\pfp-icon.png";

if (file_exists($user_pic)) {
    $profile_picture = $user_pic;
} else{
    $profile_picture = $default;
}

$userID = htmlspecialchars($_SESSION["user_id"]);

$sql = "SELECT bio, favs FROM users WHERE id=$userID";


$result = $_SESSION["conn"]->query($sql);

$user = $result->fetch_assoc();

$bio = $user["bio"];
$favs = $user["favs"];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://elsewherewriters.com/index.html">
    <title>EWG Profile</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/profile_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <header>
        <div class="logo">
            <img src="images\comp-cat-beta.png" alt="cat-using-computer">
        </div>
        <nav class="nav-menu">
                        <a href="home.php">Home</a>
                        <!--<a href="projects.html">Projects</a>-->
                            <div class="dropdown2">
                                <a href="#" onclick="myFunction2()" class="dropbtn2">Projects</a>
                                <div id="myDropdown2" class="dropdown-content2">
                                  <a href="new-project.php">Create New<br>Project <img class="drpdwn-icon2" id="new-icon" src="images\add.png"></a>
                                  <a href="projects.php">Current/Past<br>Projects <img class="drpdwn-icon2" id="project-icon" src="images\writing.png"></a>
                                </div>
                            </div> 
                        <a href="announcements.php">Announcements</a>
                        <a href="about.php">About</a>
        </nav>
        <div>
            <div class="dropdown">
                <img id="pfp" src="images\pfp-icon.png" alt="profile-picture-icon" onclick="myFunction()" class="dropbtn">
                <div id="myDropdown" class="dropdown-content">
                    <a href="profile.php">Profile <img class="drpdwn-icon" id="profile-icon" src="images\user.png"></a>
                    <a href="settings.php">Settings <img class="drpdwn-icon" id="setting-icon" src="images\settings.png"></a>
                    <a href="index.php">Logout <img class="drpdwn-icon" id="logout-icon" src="images\logout.png"></a>
                </div>
            </div> 
        </div>
    </header>
    <!--<a href="javascript:toggle()"><img name="togglepicture" src="images\toggle\toggle1.png" border="0"></a>-->
    <div class="profile-container">
        <div class="pfp-contents">
            <img class="profile-pfp" src="images\pfp-icon.png">
            <h1>Username</h1>
            <div class="favs-container">
                <h2>Favs</h2>
                    <p>Authors
                        <br>
                        Books
                    </p>
            </div>
        </div>
        <div class="bio-container">
            <div class="bio-contents">
                <h2>Bio</h2>
                <?php echo("<p>$bio</p>");?>
                <!--Who are you?
                    <br>
                    What do you want peeps to know about you?-->
                
            </div>
            <div class="current-container">
                <h1>Current Project</h1>
                <div class="current-content">
                    <img src="images/project-image.png">
                    <div class="current-2">
                        <h2>Title:</h2>
                        <p>About the project</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="add-new-container">
        <div class="add-new-contents">
            <a href="profile-create.html"><button>Update Your Profile</button></a>
            <!--onclick="goProfileUpdate()"-->
        </div>
    </div>
    <div class="badge-showcase-container">
        <h1>Badge Showcase</h1>
        <div class="badge-area-content">
            <div class="badge-prject-contents">
                <h2>Current Project Badges</h2>
                <!--ROW 1-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="start-1st-project-popup">
                            <h3>Started Your Project</h3>
                            <p>Off you pop!</p>
                        </div>
                        <img class="badge1" id="start-1st-project" src="images/badges/1st-project-mono.png" onclick="toggleImage1()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="first-daily-popup">
                            <h3>First Daily</h3>
                            <p>Reached your daily goal for<br>the first time on this project</p>
                        </div>
                        <img class="badge1" id="first-daily" src="images/badges/first-daily-mono.png" onclick="toggleImage2()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="quarter-quomplete-popup">
                            <h3>Quarter Quomplete</h3>
                            <p>Reached the 25% mark!<br>That's a quarter of the way!</p>
                        </div>
                        <img class="badge1 elementToHover" id="quarter-quomplete" src="images/badges/quarter-quomplete-mono.png" onclick="toggleImage3()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="half-way-popup">
                            <h3>Half-Way There,<br>Woah! Livin' on a-</h3>
                            <p>Reached the 50% mark<br>on your current project.<br>Good job!</p>
                        </div>
                        <img class="badge1" id="half-way" src="images/badges/half-way-mono.png" onclick="toggleImage4()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="all-downhill-popup">
                            <h3>All Downhill From<br>Here</h3>
                            <p>Reached 75%!<br>You're so close!</p>
                        </div>
                        <img class="badge1" id="all-downhill" src="images/badges/place-hold-pur.png" onclick="toggleImage5()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="cross-finish-popup">
                            <h3>Crossed the Finish<br>Line!</h3>
                            <p>Reached 100% on<br>your current project!<br><br>YOU DID IT, YAY!!!</p>
                        </div>
                        <img class="badge1" id="cross-finish" src="images/badges/place-hold-pur.png" onclick="toggleImage6()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="on-track-popup">
                            <h3>Stayed on Track</h3>
                            <p>Reached your daily goal<br>every day over the<br>course of the project</p>
                        </div>
                        <img class="badge1" id="on-track" src="images/badges/place-hold-pur.png" onclick="toggleImage7()">
                    </div>
                </div>
                <!--ROW 2-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="out-gate-popup">
                            <h3>Out the Gate on<br>Day 1</h3>
                            <p>A timely start!</p>
                        </div>
                        <img class="badge1" id="out-gate" src="images/badges/place-hold-pur.png" onclick="toggleImage8()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-2-days-popup">
                            <h3>2-Day Streak</h3>
                            <p>The start of a beautiful streak</p>
                        </div>
                        <img class="badge1" id="streak-2-days" src="images/badges/place-hold-pur.png" onclick="toggleImage9()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-3-days-popup">
                            <h3>3-Day Streak</h3>
                            <p>Third time's the charm</p>
                        </div>
                        <img class="badge1" id="streak-3-days" src="images/badges/place-hold-pur.png" onclick="toggleImage10()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-7-days-popup">
                            <h3>7-Day Streak</h3>
                            <p>One whole week!</p>
                        </div>
                        <img class="badge1" id="streak-7-days" src="images/badges/place-hold-pur.png" onclick="toggleImage11()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-14-days-popup">
                            <h3>14-Day Streak</h3>
                            <p>TWO whole weeks!!</p>
                        </div>
                        <img class="badge1" id="streak-14-days" src="images/badges/place-hold-pur.png" onclick="toggleImage12()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-21-days-popup">
                            <h3>21-Day Streak</h3>
                            <p>THREE WHOLE WEEKS!!!</p>
                        </div>
                        <img class="badge1" id="streak-21-days" src="images/badges/place-hold-pur.png" onclick="toggleImage13()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="every-day-streak-popup">
                            <h3>Every Day Streak</h3>
                            <p>Congrats,<br>you've worked on<br>your project every day!</p>
                        </div>
                        <img class="badge1" id="every-day-streak" src="images/badges/place-hold-pur.png" onclick="toggleImage14()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="back-it-up-popup">
                            <h3>Back It Up!</h3>
                            <p>You never know when<br>The Horrors will hit your<br>computer, but you're ready!<br>Project backed up!</p>
                        </div>
                        <img class="badge1" id="back-it-up" src="images/badges/place-hold-pur.png" onclick="toggleImage15()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="outline-popup">
                            <h3>Know Where You're Going</h3>
                            <p>You've got a plan and you're<br>sticking to it!<br>Start your project with an outline.</p>
                        </div>
                        <img class="badge1" id="outline" src="images/badges/place-hold-pur.png" onclick="toggleImage16()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="journey-popup">
                            <h3>It's All About the Journey</h3>
                            <p>The only plan you have<br>is to explore and discover<br>the project along the way</p>
                        </div>
                        <img class="badge1" id="journey" src="images/badges/place-hold-pur.png" onclick="toggleImage17()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="dual-wielder-popup">
                            <h3>Dual Wielder</h3>
                            <p>Your special sauce is<br>??% planning and ??% exploration,<br>you'll never tell how much of each</p>
                        </div>
                        <img class="badge1" id="dual-wielder" src="images/badges/place-hold-pur.png" onclick="toggleImage18()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="gathering-popup">
                            <h3>Guildhall Gathering</h3>
                            <p>You participated in<br>a Write In or Sprint!</p>
                        </div>
                        <img class="badge1" id="gathering" src="images/badges/place-hold-pur.png" onclick="toggleImage19()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="hear-ye-popup">
                            <h3>Hear Ye! Hear Ye!</h3>
                            <p>You've told someone about your goal,<br>whether it be a close friend<br>or the whole world!</p>
                        </div>
                        <img class="badge1" id="hear-ye" src="images/badges/place-hold-pur.png" onclick="toggleImage20()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="breakthrough-popup">
                            <h3>Breakthrough Moment</h3>
                            <p>Whatever was giving<br>you trouble on this project,<br>you've just figured it out!</p>
                        </div>
                        <img class="badge1" id="breakthrough" src="images/badges/place-hold-pur.png" onclick="toggleImage21()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="starting-fresh-popup">
                            <h3>Starting Fresh</h3>
                            <p>Created a brand new project!</p>
                        </div>
                        <img class="badge1" id="starting-fresh" src="images/badges/place-hold-pur.png" onclick="toggleImage22()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="ever-persist-popup">
                            <h3>Ever Persistent</h3>
                            <p>You Returned to a WIP!</p>
                        </div>
                        <img class="badge1" id="ever-persist" src="images/badges/place-hold-pur.png" onclick="toggleImage23()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="touch-grass-popup">
                            <h3>Touched Grass</h3>
                            <p>You made sure to go<br>outside and get some of that<br>sweet, sweeet vitamin D.</p>
                        </div>
                        <img class="badge1" id="touch-grass" src="images/badges/place-hold-pur.png" onclick="toggleImage24()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="business-popup">
                            <h3>Took Care of Business</h3>
                            <p>You took care of your other<br>responsibilities, like dishes or<br>homework. All those boring things<br>no one wants to do.</p>
                        </div>
                        <img class="badge1" id="business" src="images/badges/place-hold-pur.png" onclick="toggleImage25()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="tears-wept-popup">
                            <h3>Tears Were Wept</h3>
                            <p>Either the creation or the process<br>itself made you cry.</p>
                        </div>
                        <img class="badge1" id="tears-wept" src="images/badges/place-hold-pur.png" onclick="toggleImage26()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="overachiever-popup">
                            <h3>Overachiever!</h3>
                            <p>Went well over your project goal!</p>
                        </div>
                        <img class="badge1" id="overachiever" src="images/badges/place-hold-pur.png" onclick="toggleImage27()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="finish-him-popup">
                            <h3><em>Finish Him</em></h3>
                            <p>You fully completed this<br>project during this challenge.<br>WIP no more!</p>
                        </div>
                        <img class="badge1" id="finish-him" src="images/badges/place-hold-pur.png" onclick="toggleImage28()">
                    </div>
                </div>
            </div>
            <div class="badge-alltime-container">
                <h2>All-Time Badges</h2>
                <!--ROW 1-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-1-project-popup">
                            <h3>Completed 1 Project</h3>
                        </div>
                        <img class="badge1" id="complete-1-project" src="images/badges/place-hold-pur.png" onclick="toggleImage29()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-5-project-popup">
                            <h3>Completed 5 Projects</h3>
                        </div>
                        <img class="badge1" id="complete-5-project" src="images/badges/place-hold-pur.png" onclick="toggleImage30()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-10-project-popup">
                            <h3>Completed 10 Projects</h3>
                        </div>
                        <img class="badge1" id="complete-10-project" src="images/badges/place-hold-pur.png" onclick="toggleImage31()">
                    </div>
                </div>
                <!--ROW 2-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-fiend-popup">
                            <h3>Streak Fiend</h3>
                            <p>Completed a project with<br>a perfect streak!</p>
                        </div>
                        <img class="badge1" id="streak-fiend" src="images/badges/place-hold-pur.png" onclick="toggleImage32()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streaks-on-streaks-popup">
                            <h3>Streaks on Streaks</h3>
                            <p>Completed multiple projects<br>with perfect streaks<br><strong>IN A ROW!</strong></p>
                        </div>
                        <img class="badge1" id="streaks-on-streaks" src="images/badges/place-hold-pur.png" onclick="toggleImage33()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="vet-streaker-popup">
                            <h3>Veteran Streaker</h3>
                            <p>Completed multiple projects<br>with perfect streaks!</p>
                        </div>
                        <img class="badge1" id="vet-streaker" src="images/badges/place-hold-pur.png" onclick="toggleImage34()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="vet-guild-popup">
                            <h3>Veteran Guildmember</h3>
                            <p>You've participated multiple years<br>in a row!</p>
                        </div>
                        <img class="badge1" id="vet-guild" src="images/badges/place-hold-pur.png" onclick="toggleImage35()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="start-first-project-popup">
                            <h3>Started Your First Project</h3>
                            <p>Year</p>
                        </div>
                        <img class="badge1" id="start-first-project" src="images/badges/place-hold-pur.png" onclick="toggleImage36()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="spicy-spicy-popup">
                            <h3>Spicy, Spicy</h3>
                            <p>Started a project that you can<br>never show your parents.<br>You nasty!</p>
                        </div>
                        <img class="badge1" id="spicy-spicy" src="images/badges/spicy-spicy-mono.png" onclick="toggleImage37()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="tears-alltime-popup">
                            <h3>Tears Were Wept</h3>
                            <p>One or more of your projects<br>has made you cry.</p>
                        </div>
                        <img class="badge1" id="tears-alltime" src="images/badges/place-hold-pur.png" onclick="toggleImage38()">
                    </div>
                </div>
            </div>
        </div>
    </div>
            <h3 style="text-align: center;">Click on a badge to award it to yourself! Click on it again to remove it.</h3>
        <footer>
            <!--Make sure to keep the credit to Kohaku for the use of the cat computer logo-->
            <p id="copyright">&copy;2024. All rights reserved. Logo by <a href="https://kohacu.com/20181205post-22321/">Kohaku!</a></p>
        </footer>
        <script>
            const elementToHover1 = document.
                getElementById('quarter-quomplete');
            const elementToPopup1 = document.
                getElementById('quarter-quomplete-popup');
    
            elementToHover1.addEventListener('mouseenter',
                () => {
                    elementToPopup1.style.display = 'block';
                });
    
            elementToHover1.addEventListener('mouseleave',
                () => {
                    elementToPopup1.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover2 = document.
                getElementById('first-daily');
            const elementToPopup2 = document.
                getElementById('first-daily-popup');
    
            elementToHover2.addEventListener('mouseenter',
                () => {
                    elementToPopup2.style.display = 'block';
                });
    
            elementToHover2.addEventListener('mouseleave',
                () => {
                    elementToPopup2.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover3 = document.
                getElementById('start-1st-project');
            const elementToPopup3 = document.
                getElementById('start-1st-project-popup');
    
            elementToHover3.addEventListener('mouseenter',
                () => {
                    elementToPopup3.style.display = 'block';
                });
    
            elementToHover3.addEventListener('mouseleave',
                () => {
                    elementToPopup3.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover4 = document.
                getElementById('half-way');
            const elementToPopup4 = document.
                getElementById('half-way-popup');
    
            elementToHover4.addEventListener('mouseenter',
                () => {
                    elementToPopup4.style.display = 'block';
                });
    
            elementToHover4.addEventListener('mouseleave',
                () => {
                    elementToPopup4.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover5 = document.
                getElementById('all-downhill');
            const elementToPopup5 = document.
                getElementById('all-downhill-popup');
    
            elementToHover5.addEventListener('mouseenter',
                () => {
                    elementToPopup5.style.display = 'block';
                });
    
            elementToHover5.addEventListener('mouseleave',
                () => {
                    elementToPopup5.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover6 = document.
                getElementById('cross-finish');
            const elementToPopup6 = document.
                getElementById('cross-finish-popup');
    
            elementToHover6.addEventListener('mouseenter',
                () => {
                    elementToPopup6.style.display = 'block';
                });
    
            elementToHover6.addEventListener('mouseleave',
                () => {
                    elementToPopup6.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
const elementToHover7 = document.
                getElementById('on-track');
            const elementToPopup7 = document.
                getElementById('on-track-popup');
    
            elementToHover7.addEventListener('mouseenter',
                () => {
                    elementToPopup7.style.display = 'block';
                });
    
            elementToHover7.addEventListener('mouseleave',
                () => {
                    elementToPopup7.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover8 = document.
                getElementById('out-gate');
            const elementToPopup8 = document.
                getElementById('out-gate-popup');
    
            elementToHover8.addEventListener('mouseenter',
                () => {
                    elementToPopup8.style.display = 'block';
                });
    
            elementToHover8.addEventListener('mouseleave',
                () => {
                    elementToPopup8.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover9 = document.
                getElementById('streak-2-days');
            const elementToPopup9 = document.
                getElementById('streak-2-days-popup');
    
            elementToHover9.addEventListener('mouseenter',
                () => {
                    elementToPopup9.style.display = 'block';
                });
    
            elementToHover9.addEventListener('mouseleave',
                () => {
                    elementToPopup9.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover10 = document.
                getElementById('streak-3-days');
            const elementToPopup10 = document.
                getElementById('streak-3-days-popup');
    
            elementToHover10.addEventListener('mouseenter',
                () => {
                    elementToPopup10.style.display = 'block';
                });
    
            elementToHover10.addEventListener('mouseleave',
                () => {
                    elementToPopup10.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover11 = document.
                getElementById('streak-7-days');
            const elementToPopup11 = document.
                getElementById('streak-7-days-popup');
    
            elementToHover11.addEventListener('mouseenter',
                () => {
                    elementToPopup11.style.display = 'block';
                });
    
            elementToHover11.addEventListener('mouseleave',
                () => {
                    elementToPopup11.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover12 = document.
                getElementById('streak-14-days');
            const elementToPopup12 = document.
                getElementById('streak-14-days-popup');
    
            elementToHover12.addEventListener('mouseenter',
                () => {
                    elementToPopup12.style.display = 'block';
                });
    
            elementToHover12.addEventListener('mouseleave',
                () => {
                    elementToPopup12.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover13 = document.
                getElementById('streak-21-days');
            const elementToPopup13 = document.
                getElementById('streak-21-days-popup');
    
            elementToHover13.addEventListener('mouseenter',
                () => {
                    elementToPopup13.style.display = 'block';
                });
    
            elementToHover13.addEventListener('mouseleave',
                () => {
                    elementToPopup13.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover14 = document.
                getElementById('every-day-streak');
            const elementToPopup14 = document.
                getElementById('every-day-streak-popup');
    
            elementToHover14.addEventListener('mouseenter',
                () => {
                    elementToPopup14.style.display = 'block';
                });
    
            elementToHover14.addEventListener('mouseleave',
                () => {
                    elementToPopup14.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover15 = document.
                getElementById('back-it-up');
            const elementToPopup15 = document.
                getElementById('back-it-up-popup');
    
            elementToHover15.addEventListener('mouseenter',
                () => {
                    elementToPopup15.style.display = 'block';
                });
    
            elementToHover15.addEventListener('mouseleave',
                () => {
                    elementToPopup15.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover16 = document.
                getElementById('outline');
            const elementToPopup16 = document.
                getElementById('outline-popup');
    
            elementToHover16.addEventListener('mouseenter',
                () => {
                    elementToPopup16.style.display = 'block';
                });
    
            elementToHover16.addEventListener('mouseleave',
                () => {
                    elementToPopup16.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover17 = document.
                getElementById('journey');
            const elementToPopup17 = document.
                getElementById('journey-popup');
    
            elementToHover17.addEventListener('mouseenter',
                () => {
                    elementToPopup17.style.display = 'block';
                });
    
            elementToHover17.addEventListener('mouseleave',
                () => {
                    elementToPopup17.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover18 = document.
                getElementById('dual-wielder');
            const elementToPopup18 = document.
                getElementById('dual-wielder-popup');
    
            elementToHover18.addEventListener('mouseenter',
                () => {
                    elementToPopup18.style.display = 'block';
                });
    
            elementToHover18.addEventListener('mouseleave',
                () => {
                    elementToPopup18.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover19 = document.
                getElementById('gathering');
            const elementToPopup19 = document.
                getElementById('gathering-popup');
    
            elementToHover19.addEventListener('mouseenter',
                () => {
                    elementToPopup19.style.display = 'block';
                });
    
            elementToHover19.addEventListener('mouseleave',
                () => {
                    elementToPopup19.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover20 = document.
                getElementById('hear-ye');
            const elementToPopup20 = document.
                getElementById('hear-ye-popup');
    
            elementToHover20.addEventListener('mouseenter',
                () => {
                    elementToPopup20.style.display = 'block';
                });
    
            elementToHover20.addEventListener('mouseleave',
                () => {
                    elementToPopup20.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover21 = document.
                getElementById('breakthrough');
            const elementToPopup21 = document.
                getElementById('breakthrough-popup');
    
            elementToHover21.addEventListener('mouseenter',
                () => {
                    elementToPopup21.style.display = 'block';
                });
    
            elementToHover21.addEventListener('mouseleave',
                () => {
                    elementToPopup21.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover22 = document.
                getElementById('starting-fresh');
            const elementToPopup22 = document.
                getElementById('starting-fresh-popup');
    
            elementToHover22.addEventListener('mouseenter',
                () => {
                    elementToPopup22.style.display = 'block';
                });
    
            elementToHover22.addEventListener('mouseleave',
                () => {
                    elementToPopup22.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover23 = document.
                getElementById('ever-persist');
            const elementToPopup23 = document.
                getElementById('ever-persist-popup');
    
            elementToHover23.addEventListener('mouseenter',
                () => {
                    elementToPopup23.style.display = 'block';
                });
    
            elementToHover23.addEventListener('mouseleave',
                () => {
                    elementToPopup23.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover24 = document.
                getElementById('touch-grass');
            const elementToPopup24 = document.
                getElementById('touch-grass-popup');
    
            elementToHover24.addEventListener('mouseenter',
                () => {
                    elementToPopup24.style.display = 'block';
                });
    
            elementToHover24.addEventListener('mouseleave',
                () => {
                    elementToPopup24.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover25 = document.
                getElementById('business');
            const elementToPopup25 = document.
                getElementById('business-popup');
    
            elementToHover25.addEventListener('mouseenter',
                () => {
                    elementToPopup25.style.display = 'block';
                });
    
            elementToHover25.addEventListener('mouseleave',
                () => {
                    elementToPopup25.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover26 = document.
                getElementById('tears-wept');
            const elementToPopup26 = document.
                getElementById('tears-wept-popup');
    
            elementToHover26.addEventListener('mouseenter',
                () => {
                    elementToPopup26.style.display = 'block';
                });
    
            elementToHover26.addEventListener('mouseleave',
                () => {
                    elementToPopup26.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover27 = document.
                getElementById('overachiever');
            const elementToPopup27 = document.
                getElementById('overachiever-popup');
    
            elementToHover27.addEventListener('mouseenter',
                () => {
                    elementToPopup27.style.display = 'block';
                });
    
            elementToHover27.addEventListener('mouseleave',
                () => {
                    elementToPopup27.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover28 = document.
                getElementById('finish-him');
            const elementToPopup28 = document.
                getElementById('finish-him-popup');
    
            elementToHover28.addEventListener('mouseenter',
                () => {
                    elementToPopup28.style.display = 'block';
                });
    
            elementToHover28.addEventListener('mouseleave',
                () => {
                    elementToPopup28.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover29 = document.
                getElementById('complete-1-project');
            const elementToPopup29 = document.
                getElementById('complete-1-project-popup');
    
            elementToHover29.addEventListener('mouseenter',
                () => {
                    elementToPopup29.style.display = 'block';
                });
    
            elementToHover29.addEventListener('mouseleave',
                () => {
                    elementToPopup29.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover30 = document.
                getElementById('complete-5-project');
            const elementToPopup30 = document.
                getElementById('complete-5-project-popup');
    
            elementToHover30.addEventListener('mouseenter',
                () => {
                    elementToPopup30.style.display = 'block';
                });
    
            elementToHover30.addEventListener('mouseleave',
                () => {
                    elementToPopup30.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover31 = document.
                getElementById('complete-10-project');
            const elementToPopup31 = document.
                getElementById('complete-10-project-popup');
    
            elementToHover31.addEventListener('mouseenter',
                () => {
                    elementToPopup31.style.display = 'block';
                });
    
            elementToHover31.addEventListener('mouseleave',
                () => {
                    elementToPopup31.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover32 = document.
                getElementById('streak-fiend');
            const elementToPopup32 = document.
                getElementById('streak-fiend-popup');
    
            elementToHover32.addEventListener('mouseenter',
                () => {
                    elementToPopup32.style.display = 'block';
                });
    
            elementToHover32.addEventListener('mouseleave',
                () => {
                    elementToPopup32.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover33 = document.
                getElementById('streaks-on-streaks');
            const elementToPopup33 = document.
                getElementById('streaks-on-streaks-popup');
    
            elementToHover33.addEventListener('mouseenter',
                () => {
                    elementToPopup33.style.display = 'block';
                });
    
            elementToHover33.addEventListener('mouseleave',
                () => {
                    elementToPopup33.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover34 = document.
                getElementById('vet-streaker');
            const elementToPopup34 = document.
                getElementById('vet-streaker-popup');
    
            elementToHover34.addEventListener('mouseenter',
                () => {
                    elementToPopup34.style.display = 'block';
                });
    
            elementToHover34.addEventListener('mouseleave',
                () => {
                    elementToPopup34.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover35 = document.
                getElementById('vet-guild');
            const elementToPopup35 = document.
                getElementById('vet-guild-popup');
    
            elementToHover35.addEventListener('mouseenter',
                () => {
                    elementToPopup35.style.display = 'block';
                });
    
            elementToHover35.addEventListener('mouseleave',
                () => {
                    elementToPopup35.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover36 = document.
                getElementById('start-first-project');
            const elementToPopup36 = document.
                getElementById('start-first-project-popup');
    
            elementToHover36.addEventListener('mouseenter',
                () => {
                    elementToPopup36.style.display = 'block';
                });
    
            elementToHover36.addEventListener('mouseleave',
                () => {
                    elementToPopup36.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover37 = document.
                getElementById('spicy-spicy');
            const elementToPopup37 = document.
                getElementById('spicy-spicy-popup');
    
            elementToHover37.addEventListener('mouseenter',
                () => {
                    elementToPopup37.style.display = 'block';
                });
    
            elementToHover37.addEventListener('mouseleave',
                () => {
                    elementToPopup37.style.display = 'none';
                });
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
            const elementToHover38 = document.
                getElementById('tears-alltime');
            const elementToPopup38 = document.
                getElementById('tears-alltime-popup');
    
            elementToHover38.addEventListener('mouseenter',
                () => {
                    elementToPopup38.style.display = 'block';
                });
    
            elementToHover38.addEventListener('mouseleave',
                () => {
                    elementToPopup38.style.display = 'none';
                });
        </script>
</body>
</html>