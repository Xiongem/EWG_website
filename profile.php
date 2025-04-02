<?php
// error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');
//DB connection
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
// forceLogin();
dbConnect();
//assigns the user's id for all the sql
// $userID = htmlspecialchars($_SESSION["user_id"]);
$userNAME = $_GET["userNAME"];
//queries the user's profile data
$sql = "SELECT * FROM users WHERE username='$userNAME'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $username = $user["username"];
    $userID = $user["id"];
    $bio = $user["bio"];
    $fav1 = $user["fav-1"];
    $fav2 = $user["fav-2"];
    $fav3 = $user["fav-3"];
    $pfp = $user["pfp"];
if (empty($pfp)) {
    $pfp_set = "images\pfp-icon.png";
} else{
    $pfp_set = $pfp;
}
//echos project info if there is any or default values if not
$sql = "SELECT * FROM current_project WHERE username='$userNAME' AND current_state='current'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $genre = $user["genre"];
    $title = $user["title"];
    $date = $user["goal_date"];
    $default = "images/genre-covers/placeholder.jpg";

if (isset($user["genre"])){
    $sql = "SELECT created_at FROM current_project WHERE username='$userNAME'";
    $result = $_SESSION["conn"]->query($sql);
    $dates = $result->fetch_assoc();
        
    $oldestDate = min($dates);
}


if (empty($genre)) {
    $genre_picture = $default;
    $info = "Looks like you haven't started a project yet.<br><br>Click <a href=\"new-project.php\">here</a> to get started.";
    $current_count = 0;
    $goal = 0;
} else{
    $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.jpg';
    $info = $user["info"];
    $current_count = $user["current_count"];
    $goal = $user["goal"];
}
//sets width of progress bar
if (empty($current_count) || empty($goal)) {
    $progress = 3;
} elseif (floor($current_count / $goal * 100)<=3) {
    $progress = 3;
} else {
    $progress = floor($current_count / $goal * 100);
}
//echos correct badge src
$sql = "SELECT `start-1st-project`, `first-daily`, `quarter-quomplete`, `half-way`, `all-downhill`, 
`cross-finish`, `on-track`, `out-gate`, `streak-two`, `streak-three`, `streak-seven`, 
`streak-fourteen`, `streak-twentyOne`, `every-streak`, `back-it-up`, `outline`, `journey`, 
`dual-wielder`, `gathering`, `hear-ye`, `breakthrough`, `starting-fresh`, `ever-persist`, 
`touch-grass`, `business`, `tears-wept`, `overachiever`, `finish-him` FROM current_project WHERE username='$userNAME' AND current_state='current'";
    $result = $_SESSION["conn"]->query($sql);
    $badge = $result->fetch_assoc();
        $badge1 = $badge["start-1st-project"];
        $badge2 = $badge["first-daily"];
        $badge3 = $badge["quarter-quomplete"];
        $badge4 = $badge["half-way"];
        $badge5 = $badge["all-downhill"];
        $badge6 = $badge["cross-finish"];
        $badge7 = $badge["on-track"];
        $badge8 = $badge["out-gate"];
        $badge9 = $badge["streak-two"];
        $badge10 = $badge["streak-three"];
        $badge11 = $badge["streak-seven"];
        $badge12 = $badge["streak-fourteen"];
        $badge13 = $badge["streak-twentyOne"];
        $badge14 = $badge["every-streak"];
        $badge15 = $badge["back-it-up"];
        $badge16 = $badge["outline"];
        $badge17 = $badge["journey"];
        $badge18 = $badge["dual-wielder"];
        $badge19 = $badge["gathering"];
        $badge20 = $badge["hear-ye"];
        $badge21 = $badge["breakthrough"];
        $badge22 = $badge["starting-fresh"];
        $badge23 = $badge["ever-persist"];
        $badge24 = $badge["touch-grass"];
        $badge25 = $badge["business"];
        $badge26 = $badge["tears-wept"];
        $badge27 = $badge["overachiever"];
        $badge28 = $badge["finish-him"];
            $default1="images/badges/start-1st-project-mono.png";
            $default2= "images/badges/first-daily-mono.png";
            $default3= "images/badges/quarter-quomplete-mono.png";
            $default4= "images/badges/half-way-mono.png";
            $default5= "images/badges/all-downhill-mono.png";
            $default6= "images/badges/cross-finish-mono.png";
            $default7= "images/badges/on-track-mono.png";
            $default8= "images/badges/out-gate-mono.png";
            $default9= "images/badges/streak-two-mono.png";
            $default10= "images/badges/streak-three-mono.png";
            $default11= "images/badges/streak-seven-mono.png";
            $default12= "images/badges/streak-fourteen-mono.png";
            $default13= "images/badges/streak-twentyOne-mono.png";
            $default14= "images/badges/every-streak-mono.png";
            $default15= "images/badges/back-it-up-mono.png";
            $default16= "images/badges/outline-mono.png";
            $default17= "images/badges/journey-mono.png";
            $default18= "images/badges/dual-wielder-mono.png";
            $default19= "images/badges/gathering-mono.png";
            $default20= "images/badges/hear-ye-mono.png";
            $default21= "images/badges/breakthrough-mono.png";
            $default22= "images/badges/starting-fresh-mono.png";
            $default23= "images/badges/ever-persist-mono.png";
            $default24= "images/badges/touch-grass-mono.png";
            $default25= "images/badges/business-mono.png";
            $default26= "images/badges/tears-wept-mono.png";
            $default27= "images/badges/overachiever-mono.png";
            $default28= "images/badges/finish-him-mono.png";
            
$sql = "SELECT `complete-one-project`, `complete-five-project`, `complete-ten-project`, `streak-fiend`, 
`hydra-slayer`, `vet-streaker`, `vet-guild`, `start-first-project`, `spicy-spicy`, 
`tears-alltime` FROM users WHERE username='$userNAME'";
    $result = $_SESSION["conn"]->query($sql);
    $badge = $result->fetch_assoc();
        $badge29 = $badge["complete-one-project"];
        $badge30 = $badge["complete-five-project"];
        $badge31 = $badge["complete-ten-project"];
        $badge32 = $badge["streak-fiend"];
        $badge33 = $badge["hydra-slayer"];
        $badge34 = $badge["vet-streaker"];
        $badge35 = $badge["vet-guild"];
        $badge36 = $badge["start-first-project"];
        $badge37 = $badge["spicy-spicy"];
        $badge38 = $badge["tears-alltime"];
            $default29= "images/badges/complete-one-project-mono.png";
            $default30= "images/badges/complete-five-project-mono.png";
            $default31= "images/badges/complete-ten-project-mono.png";
            $default32= "images/badges/streak-fiend-mono.png";
            $default33= "images/badges/hydra-slayer-mono.png";
            $default34= "images/badges/vet-streaker-mono.png";
            $default35= "images/badges/vet-guild-mono.png";
            $default36= "images/badges/start-first-project-mono.png";
            $default37= "images/badges/spicy-spicy-mono.png";
            $default38= "images/badges/tears-alltime-mono.png";
$_SESSION["overlay"] = $badge["hydra-slayer"];
// echo $userNAME;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>EWG Profile</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/profile_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/badges.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
    </header>
<div id="summaryPopup" class="summaryPopup">
    <div class="sum-container">
        <?= $info ?>
    </div>
</div>
    <div class="profile-container">
        <div class="pfp-contents">
            <div class="pfp-wrapper" onclick="pfpChange()">
                <img id="overlay" class="pfp-overlay profile-pfp" src="images/hydra-slayer-overlay.png">
                <a href="choose-pfp.html"><img class="profile-pfp" src="<?=$pfp_set?>"></a>
            </div>
            <?php echo ("<h1>$username</h1>")?>
            <div class="favs-container">
                <h2 id="favs">Favs:</h2>
                <?php echo("<p>$fav1<br><br>
                            $fav2<br><br>
                            $fav3</p>");?>
                    <!--<p>Authors
                        <br>
                        Books
                    </p>-->
            </div>
        </div>
        <div class="bio-container">
            <div class="add-new-container" id="add-new-container">
                <div class="add-new-contents">
                    <a href="update-profile.php"><button>Update Your Profile</button></a>
                </div>
            </div>
            <div class="bio-contents">
                <h2>Bio</h2>
                <?php echo("<p>$bio</p>")?>
            </div>
            <div class="current-container">
                <h1>Current Project</h1>
                <div class="current-content">
                    <a id="goProjects" href="projects.php"><img src= <?=$genre_picture?>></a>
                        <div class="current-2">
                        <a  href="projects.php"><?php echo "<h2>$title</h2>"?></a>
                            <p class="summary" id="summary"><?= $info?></p>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="badge-showcase-container">
        <h1>Badge Showcase</h1>
        <div class="badge-area-content">
            <div class="badge-prject-contents">
                <h2>Current Project Badges</h2>
                <h3 id="badge-instruct">Click on a badge to award it to yourself! Click on it again to remove it.</h3>
                <!--ROW 1-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="start-1st-project-popup">
                            <h3>Started Your Project</h3>
                            <p>Off you pop!</p>
                        </div>
                        <img class="badge1 pulse" id="start-1st-project" src="<?php if(!empty($badge1)) {
                            echo $badge1;
                        }else{
                            echo $default1;
                        } ?>" onclick="toggleImage1()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="first-daily-popup">
                            <h3>First Daily</h3>
                            <p>Reached your daily goal for<br>the first time on this project</p>
                        </div>
                        <img class="badge1 pulse" id="first-daily" src="<?php if(!empty($badge2)) {
                            echo $badge2;
                        }else{
                            echo $default2;
                        } ?>" onclick="toggleImage2()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="quarter-quomplete-popup">
                            <h3>Quarter Quomplete</h3>
                            <p>Reached the 25% mark!<br>That's a quarter of the way!</p>
                        </div>
                        <img class="badge1 pulse elementToHover" id="quarter-quomplete" src="<?php if(!empty($badge3)) {
                            echo $badge3;
                        }else{
                            echo $default3;
                        } ?>" onclick="toggleImage3()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="half-way-popup">
                            <h3>Half-Way There,<br>Woah! Livin' on a-</h3>
                            <p>Reached the 50% mark<br>on your current project.<br>Good job!</p>
                        </div>
                        <img class="badge1 pulse" id="half-way" src="<?php if(!empty($badge4)) {
                            echo $badge4;
                        }else{
                            echo $default4;
                        } ?>" onclick="toggleImage4()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="all-downhill-popup">
                            <h3>All Downhill From<br>Here</h3>
                            <p>Reached 75%!<br>You're so close!</p>
                        </div>
                        <img class="badge1 pulse" id="all-downhill" src="<?php if(!empty($badge5)) {
                            echo $badge5;
                        }else{
                            echo $default5;
                        } ?>" onclick="toggleImage5()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="cross-finish-popup">
                            <h3>Crossed the Finish<br>Line!</h3>
                            <p>Reached 100% on<br>your current project!<br><br>YOU DID IT, YAY!!!</p>
                        </div>
                        <img class="badge1 pulse" id="cross-finish" src="<?php if(!empty($badge6)) {
                            echo $badge6;
                        }else{
                            echo $default6;
                        } ?>" onclick="toggleImage6()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="on-track-popup">
                            <h3>Stayed on Track</h3>
                            <p>Reached your daily goal<br>every day over the<br>course of the project</p>
                        </div>
                        <img class="badge1 pulse" id="on-track" src="<?php if(!empty($badge7)) {
                            echo $badge7;
                        }else{
                            echo $default7;
                        } ?>" onclick="toggleImage7()">
                    </div>
                </div>
                <!--ROW 2-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="out-gate-popup">
                            <h3>Out the Gate on<br>Day 1</h3>
                            <p>A timely start!</p>
                        </div>
                        <img class="badge1 pulse" id="out-gate" src="<?php if(!empty($badge8)) {
                            echo $badge8;
                        }else{
                            echo $default8;
                        } ?>" onclick="toggleImage8()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-two-popup">
                            <h3>2-Day Streak</h3>
                            <p>The start of a beautiful streak</p>
                        </div>
                        <img class="badge1 pulse" id="streak-two" src="<?php if(!empty($badge9)) {
                            echo $badge9;
                        }else{
                            echo $default9;
                        } ?>" onclick="toggleImage9()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-three-popup">
                            <h3>3-Day Streak</h3>
                            <p>Third time's the charm</p>
                        </div>
                        <img class="badge1 pulse" id="streak-three" src="<?php if(!empty($badge10)) {
                            echo $badge10;
                        }else{
                            echo $default10;
                        } ?>" onclick="toggleImage10()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-seven-popup">
                            <h3>7-Day Streak</h3>
                            <p>One whole week!</p>
                        </div>
                        <img class="badge1 pulse" id="streak-seven" src="<?php if(!empty($badge11)) {
                            echo $badge11;
                        }else{
                            echo $default11;
                        } ?>" onclick="toggleImage11()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-fourteen-popup">
                            <h3>14-Day Streak</h3>
                            <p>TWO whole weeks!!</p>
                        </div>
                        <img class="badge1 pulse" id="streak-fourteen" src="<?php if(!empty($badge12)) {
                            echo $badge12;
                        }else{
                            echo $default12;
                        } ?>" onclick="toggleImage12()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-twentyOne-popup">
                            <h3>21-Day Streak</h3>
                            <p>THREE WHOLE WEEKS!!!</p>
                        </div>
                        <img class="badge1 pulse" id="streak-twentyOne" src="<?php if(!empty($badge13)) {
                            echo $badge13;
                        }else{
                            echo $default13;
                        } ?>" onclick="toggleImage13()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="every-streak-popup">
                            <h3>Every Day Streak</h3>
                            <p>Congrats,<br>you've worked on<br>your project every day!</p>
                        </div>
                        <img class="badge1 pulse" id="every-streak" src="<?php if(!empty($badge14)) {
                            echo $badge14;
                        }else{
                            echo $default14;
                        } ?>" onclick="toggleImage14()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="back-it-up-popup">
                            <h3>Back It Up!</h3>
                            <p>You never know when<br>The Horrors will hit your<br>computer, but you're ready!<br>Project backed up!</p>
                        </div>
                        <img class="badge1 pulse" id="back-it-up" src="<?php if(!empty($badge15)) {
                            echo $badge15;
                        }else{
                            echo $default15;
                        } ?>" onclick="toggleImage15()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="outline-popup">
                            <h3>Know Where You're Going</h3>
                            <p>You've got a plan and you're<br>sticking to it!<br>Start your project with an outline.</p>
                        </div>
                        <img class="badge1 pulse" id="outline" src="<?php if(!empty($badge16)) {
                            echo $badge16;
                        }else{
                            echo $default16;
                        } ?>" onclick="toggleImage16()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="journey-popup">
                            <h3>It's All About the Journey</h3>
                            <p>The only plan you have<br>is to explore and discover<br>the project along the way</p>
                        </div>
                        <img class="badge1 pulse" id="journey" src="<?php if(!empty($badge17)) {
                            echo $badge17;
                        }else{
                            echo $default17;
                        } ?>" onclick="toggleImage17()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="dual-wielder-popup">
                            <h3>Dual Wielder</h3>
                            <p>Your special sauce is<br>??% planning and ??% exploration,<br>you'll never tell how much of each</p>
                        </div>
                        <img class="badge1 pulse" id="dual-wielder" src="<?php if(!empty($badge18)) {
                            echo $badge18;
                        }else{
                            echo $default18;
                        } ?>" onclick="toggleImage18()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="gathering-popup">
                            <h3>Guildhall Gathering</h3>
                            <p>You participated in<br>a Write In or Sprint!</p>
                        </div>
                        <img class="badge1 pulse" id="gathering" src="<?php if(!empty($badge19)) {
                            echo $badge19;
                        }else{
                            echo $default19;
                        } ?>" onclick="toggleImage19()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="hear-ye-popup">
                            <h3>Hear Ye! Hear Ye!</h3>
                            <p>You've told someone about your goal,<br>whether it be a close friend<br>or the whole world!</p>
                        </div>
                        <img class="badge1 pulse" id="hear-ye" src="<?php if(!empty($badge20)) {
                            echo $badge20;
                        }else{
                            echo $default20;
                        } ?>" onclick="toggleImage20()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="breakthrough-popup">
                            <h3>Breakthrough Moment</h3>
                            <p>Whatever was giving<br>you trouble on this project,<br>you've just figured it out!</p>
                        </div>
                        <img class="badge1 pulse" id="breakthrough" src="<?php if(!empty($badge21)) {
                            echo $badge21;
                        }else{
                            echo $default21;
                        } ?>" onclick="toggleImage21()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="starting-fresh-popup">
                            <h3>Starting Fresh</h3>
                            <p>Created a brand new project!</p>
                        </div>
                        <img class="badge1 pulse" id="starting-fresh" src="<?php if(!empty($badge22)) {
                            echo $badge22;
                        }else{
                            echo $default22;
                        } ?>" onclick="toggleImage22()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="ever-persist-popup">
                            <h3>Ever Persistent</h3>
                            <p>You Returned to a WIP!</p>
                        </div>
                        <img class="badge1 pulse" id="ever-persist" src="<?php if(!empty($badge23)) {
                            echo $badge23;
                        }else{
                            echo $default23;
                        } ?>" onclick="toggleImage23()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="touch-grass-popup">
                            <h3>Touched Grass</h3>
                            <p>You made sure to go<br>outside and get some of that<br>sweet, sweeet vitamin D.</p>
                        </div>
                        <img class="badge1 pulse" id="touch-grass" src="<?php if(!empty($badge24)) {
                            echo $badge24;
                        }else{
                            echo $default24;
                        } ?>" onclick="toggleImage24()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="business-popup">
                            <h3>Took Care of Business</h3>
                            <p>You took care of your other<br>responsibilities, like dishes or<br>homework. All those boring things<br>no one wants to do.</p>
                        </div>
                        <img class="badge1 pulse" id="business" src="<?php if(!empty($badge25)) {
                            echo $badge25;
                        }else{
                            echo $default25;
                        } ?>" onclick="toggleImage25()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="tears-wept-popup">
                            <h3>Tears Were Wept</h3>
                            <p>Either the creation or the process<br>itself made you cry.</p>
                        </div>
                        <img class="badge1 pulse" id="tears-wept" src="<?php if(!empty($badge26)) {
                            echo $badge26;
                        }else{
                            echo $default26;
                        } ?>" onclick="toggleImage26()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="overachiever-popup">
                            <h3>Overachiever!</h3>
                            <p>Went well over your project goal!</p>
                        </div>
                        <img class="badge1 pulse" id="overachiever" src="<?php if(!empty($badge27)) {
                            echo $badge27;
                        }else{
                            echo $default27;
                        } ?>" onclick="toggleImage27()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="finish-him-popup">
                            <h3><em>Finish Him</em></h3>
                            <p>You fully completed this<br>project during this challenge.<br>WIP no more!</p>
                        </div>
                        <img class="badge1 pulse" id="finish-him" src="<?php if(!empty($badge28)) {
                            echo $badge28;
                        }else{
                            echo $default28;
                        } ?>" onclick="toggleImage28()">
                    </div>
                </div>
            </div>
            <div class="badge-alltime-container">
                <h2 id="all-time-header">All-Time Badges</h2>
                <!--ROW 1-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-one-project-popup">
                            <h3>Completed 1 Project</h3>
                        </div>
                        <img class="badge1 pulse" id="complete-one-project" src="<?php if(!empty($badge29)) {
                            echo $badge29;
                        }else{
                            echo $default29;
                        } ?>" onclick="toggleImage29()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-five-project-popup">
                            <h3>Completed 5 Projects</h3>
                        </div>
                        <img class="badge1 pulse" id="complete-five-project" src="<?php if(!empty($badge30)) {
                            echo $badge30;
                        }else{
                            echo $default30;
                        } ?>" onclick="toggleImage30()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="complete-ten-project-popup">
                            <h3>Completed 10 Projects</h3>
                        </div>
                        <img class="badge1 pulse" id="complete-ten-project" src="<?php if(!empty($badge31)) {
                            echo $badge31;
                        }else{
                            echo $default31;
                        } ?>" onclick="toggleImage31()">
                    </div>
                </div>
                <!--ROW 2-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="streak-fiend-popup">
                            <h3>Streak Fiend</h3>
                            <p>Completed a project with<br>a perfect streak!</p>
                        </div>
                        <img class="badge1 pulse" id="streak-fiend" src="<?php if(!empty($badge32)) {
                            echo $badge32;
                        }else{
                            echo $default32;
                        } ?>" onclick="toggleImage32()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="hydra-slayer-popup">
                            <h3>Hydra Slayer</h3>
                            <p>Slaying the hydra is no easy feat.<br>To earn this badge, you must write at least<br>500 works within a 5 minute writing sprint.</p>
                        </div>
                        <img class="badge1 pulse" id="hydra-slayer" src="<?php if(!empty($badge33)) {
                            echo $badge33;
                        }else{
                            echo $default33;
                        } ?>" onclick="toggleImage33()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="vet-streaker-popup">
                            <h3>Veteran Streaker</h3>
                            <p>Completed multiple projects<br>with perfect streaks!</p>
                        </div>
                        <img class="badge1 pulse" id="vet-streaker" src="<?php if(!empty($badge34)) {
                            echo $badge34;
                        }else{
                            echo $default34;
                        } ?>" onclick="toggleImage34()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="vet-guild-popup">
                            <h3>Veteran Guildmember</h3>
                            <p>You've participated multiple years<br>in a row!</p>
                        </div>
                        <img class="badge1 pulse" id="vet-guild" src="<?php if(!empty($badge35)) {
                            echo $badge35;
                        }else{
                            echo $default35;
                        } ?>" onclick="toggleImage35()">
                    </div>
                </div>
                <!--ROW 3-->
                <div class="badge-rows-pro">
                    <div class="pop-container">
                        <div class="elementToPopup" id="start-first-project-popup">
                            <h3>Started Your First Project</h3>
                            <p><?= $oldestDate ?></p>
                        </div>
                        <img class="badge1 pulse" id="start-first-project" src="<?php if(!empty($badge36)) {
                            echo $badge36;
                        }else{
                            echo $default36;
                        } ?>" onclick="toggleImage36()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="spicy-spicy-popup">
                            <h3>Spicy, Spicy</h3>
                            <p>Started a project that you can<br>never show your parents.<br>You nasty!</p>
                        </div>
                        <img class="badge1 pulse" id="spicy-spicy" src="<?php if(!empty($badge37)) {
                            echo $badge37;
                        }else{
                            echo $default37;
                        } ?>" onclick="toggleImage37()">
                    </div>
                    <div class="pop-container">
                        <div class="elementToPopup" id="tears-alltime-popup">
                            <h3>Tears Were Wept</h3>
                            <p>One or more of your projects<br>has made you cry.</p>
                        </div>
                        <img class="badge1 pulse" id="tears-alltime" src="<?php if(!empty($badge38)) {
                            echo $badge38;
                        }else{
                            echo $default38;
                        } ?>" onclick="toggleImage38()">
                    </div>
                </div>
            </div>
        </div>
    </div>
            <h3 style="text-align: center;">Click on a badge to award it to yourself! Click on it again to remove it.</h3>
    <?php makeFooter() ?>
        <script>
        
        if (!empty(<?= $_SESSION["user_id"] ?>)) {
            var getUserID = <?= $userID ?>;
            var sessionUserID = <?= $_SESSION["user_id"] ?>;
                if (getUserID != sessionUserID ||empty(sessionUserID)) {
                    document.getElementById('add-new-container').style.display = 'none';
                }
        } else {
            var sessionUserID = null;
        }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
imgsrc = document.getElementById("hydra-slayer").src;
if(imgsrc == "https://www.elsewherewriters.com/images/badges/hydra-slayer-color.png"){
    document.getElementById('overlay').classList.remove("hide");
    document.getElementById('overlay').classList.add("show");
}else{
    document.getElementById('overlay').classList.remove("show");
    document.getElementById('overlay').classList.add("hide");
}
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
const summary = document.getElementById('summary');
const summaryPopup = document.getElementById('summaryPopup');
if (summary.scrollHeight > summary.offsetHeight) {
    summary.addEventListener('mouseenter',
        () => {
    summaryPopup.style.display = 'block';
        });
            
    summary.addEventListener('mouseleave',
        () => {
    summaryPopup.style.display = 'none';
        }); 
}        
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
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
                getElementById('streak-two');
            const elementToPopup9 = document.
                getElementById('streak-two-popup');
    
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
                getElementById('streak-three');
            const elementToPopup10 = document.
                getElementById('streak-three-popup');
    
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
                getElementById('streak-seven');
            const elementToPopup11 = document.
                getElementById('streak-seven-popup');
    
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
                getElementById('streak-fourteen');
            const elementToPopup12 = document.
                getElementById('streak-fourteen-popup');
    
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
                getElementById('streak-twentyOne');
            const elementToPopup13 = document.
                getElementById('streak-twentyOne-popup');
    
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
                getElementById('every-streak');
            const elementToPopup14 = document.
                getElementById('every-streak-popup');
    
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
                getElementById('complete-one-project');
            const elementToPopup29 = document.
                getElementById('complete-one-project-popup');
    
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
                getElementById('complete-five-project');
            const elementToPopup30 = document.
                getElementById('complete-five-project-popup');
    
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
                getElementById('complete-ten-project');
            const elementToPopup31 = document.
                getElementById('complete-ten-project-popup');
    
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
                getElementById('hydra-slayer');
            const elementToPopup33 = document.
                getElementById('hydra-slayer-popup');
    
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
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
        </script>
</body>
</html>