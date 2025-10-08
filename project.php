<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

$title = $_GET["project"];

$sql = "SELECT * FROM current_project WHERE title='$title'";
$result = $_SESSION["conn"]->query($sql);
$project = $result->fetch_assoc();
    $genre = $project["genre"];
    $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.webp';
    $current_count = $project["current_count"];
    $goal = $project["goal"];
    $info = $project["info"];
    $goalDate = $project["goal_date"];
    $dailyGoal = $project["daily_goal"];
    $progress = floor($current_count / $goal * 100);
        $now = time();
        $your_date = strtotime($goalDate);
        $datediff = $your_date - $now;
        $interval = round($datediff / (60 * 60 * 24)); 
            if ($goalDate == "0000-00-00" || !$goalDate) {
                $days = "No Goal Date Set";
            } elseif (isset($goalDate)&& $goalDate !== "0000-00-00") {
                $days = $interval;
                if ($days == 0) {
                    $days = "Final Day!";
                } elseif ($days < 0) {
                    $days = "Project Past Due!";
                }
            }
    //* Percentage bar math
    if (empty($current_count) || empty($goal)) {
        $progress = 4;
        $percentage = 0;
    } elseif (floor($current_count / $goal * 100)<=4) {
        $progress = 4;
        $percentage = $percentage;
    } else {
        $progress = floor($current_count / $goal * 100);
        $percentage = $progress;
    }
    //* Badges
    $badge1 = $project["quarter-quomplete"];
    $badge2 = $project["half-way"];
    $badge3 = $project["all-downhill"];
    $badge4 = $project["cross-finish"];
    $badge5 = $project["streak-two"];
    $badge6 = $project["streak-three"];
    $badge7 = $project["streak-seven"];
    $badge8 = $project["streak-fourteen"];
    $badge9 = $project["streak-twentyOne"];
    $badge10 = $project["first-daily"];
    $badge11 = $project["every-streak"];
    $badge12 = $project["on-track"];
    $badge13 = $project["outline"];
    $badge14 = $project["journey"];
    $badge15 = $project["dual-wielder"];
    $badge16 = $project["starting-fresh"];
    $badge17 = $project["ever-persist"];
    $badge18 = $project["back-it-up"];
    $badge19 = $project["gathering"];
    $badge20 = $project["hear-ye"];
    $badge21 = $project["breakthrough"];
    $badge22 = $project["touch-grass"];
    $badge23 = $project["business"];
    $badge24 = $project["tears-wept"];
    $badge25 = $project["finish-him"];
        //* Default Badges
        $default1 = "images/badges/quarter-quomplete-mono.webp";
        $default2 = "images/badges/half-way-mono.webp";
        $default3 = "images/badges/all-downhill-mono.webp";
        $default4 = "images/badges/cross-finish-mono.webp";
        $default5 = "images/badges/streak-two-mono.webp";
        $default6 = "images/badges/streak-three-mono.webp";
        $default7 = "images/badges/streak-seven-mono.webp";
        $default8 = "images/badges/streak-fourteen-mono.webp";
        $default9 = "images/badges/streak-twentyOne-mono.webp";
        $default10 = "images/badges/first-daily-mono.webp";
        $default11 = "images/badges/every-streak-mono.webp";
        $default12 = "images/badges/on-track-mono.webp";
        $default13 = "images/badges/outline-mono-v2.webp";
        $default14 = "images/badges/journey-mono.webp";
        $default15 = "images/badges/dual-wielder-mono.webp";
        $default16 = "images/badges/starting-fresh-mono.webp";
        $default17 = "images/badges/ever-persist-mono.webp";
        $default18 = "images/badges/back-it-up-mono.webp";
        $default19 = "images/badges/gathering-mono.webp";
        $default20 = "images/badges/hear-ye-mono.webp";
        $default21 = "images/badges/breakthrough-mono.webp";
        $default22 = "images/badges/touch-grass-mono.webp";
        $default23 = "images/badges/business-mono.webp";
        $default24 = "images/badges/tears-wept-mono.webp";
        $default25 = "images/badges/cross-finish-mono.webp";
?>
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/project">
    <title>Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/project.css">
    <link rel="stylesheet" href="css/progressBar.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="archive-wrapper">
        <div class="archive-button" id="notArchived">
            <p>Archive Project</p>
        </div>
        <h3 class="hide" id="archived">Archived</h3>
    </div>
    <!--* PROGRESS BAR-->
    <div class="pb-wrapper">
        <div class="pb-background">
            <h1>Project Progress</h1>
            <div class="progress-bar">
                <div class="border"></div>
                <div id="percentage" class="percentage clickable"></div>
            </div>
            <div class="progress-info-wrapper">
                <div id="current" class="progress-info">
                    <h2>Current:</h2>
                    <p><?= $current_count ?>/<?= $goal ?></p>
                </div>
                <?php if (isset($goalDate) && $goalDate !== "0000-00-00") {?>
                <!-- //* displays days left only if user has a goal date set -->
                <div id="daysLeft" class="progress-info">
                    <h2>Days Left:</h2>
                    <p><?= $days ?></p>
                </div>
                <?php } ?>
                <div id="dailyGoal" class="progress-info">
                    <h2>Daily Goal:</h2>
                    <p><?= $dailyGoal ?></p>
                </div>
                <div id="goal" class="progress-info">
                    <h2>Percentage:</h2>
                    <p><?= $percentage ?>%</p>
                </div>
            </div>
        </div>
    </div>
    <!--* CURRENT PROJECT OVERVIEW AND INFO-->
    <div class="main-wrapper">
        <div class="current-project-wrapper">
            <div class="current-project-container">
                <div id="area-title">
                    <h1>Your Project</h1>
                </div>
                <div class="progress-info-container">
                    <div id="project-img">
                        <img src="<?= $genre_picture ?>" id="theme-img">
                    </div>
                    <div id="project-title">
                        <h2><?= $title ?></h2>
                    </div>
                    <div id="project-summary">
                        <p id="summary-text">
                            <?= $info ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- //* BADGES-->
        <div class="badge-container">
            <h1 id="badge-title">Badges</h1>
            <h4 class="instruction">These badges are earned automatically</h4>
        <!-- //* Automatic Badges -->
            <div class="auto-badges">
            <!-- //* Row One -->
                <div class="auto-row rows">
                    <!-- //* Quarter Quomplete-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge1) {
                            echo $badge1;
                        }else{
                            echo $default1;
                        } ?>" id="quarter-quomplete" class="badge">
                        <div class="badgeToPopup" id="quarter-quomplete-popup">
                            <h4>Quarter Quomplete</h4>
                            <p>Reached the 25% mark! That's a quarter of the way there!</p>
                        </div>
                    </div>
                    <!-- //* Half Way-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge2) {
                            echo $badge2;
                        }else{
                            echo $default2;
                        } ?>" id="half-way" class="badge">
                        <div class="badgeToPopup" id="half-way-popup">
                            <h4>Half-Way There, Woah!<br>Livin' on a-</h4>
                            <p>Reached the 50% mark<br>on your current project.<br>Good job!</p>
                        </div>
                    </div>
                    <!-- //* All Downhill-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge3) {
                            echo $badge3;
                        }else{
                            echo $default3;
                        } ?>" id="all-downhill" class="badge">
                        <div class="badgeToPopup" id="all-downhill-popup">
                            <h4>All Downhill From Here</h4>
                            <p>Reached 75%!<br>You're so close!</p>
                        </div>
                    </div>
                    <!-- //* Cross Finish-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge4) {
                            echo $badge4;
                        }else{
                            echo $default4;
                        } ?>" id="cross-finish" class="badge">
                        <div class="badgeToPopup" id="cross-finish-popup">
                            <h4>Crossed the Finish Line!</h4>
                            <p>Reached 100% on your current project!<br>YOU DID IT, YAY!!!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Two -->
                <div class="auto-row rows">
                    <!-- //* 2 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge5) {
                            echo $badge5;
                        }else{
                            echo $default5;
                        } ?>" id="streak-two" class="badge">
                        <div class="badgeToPopup" id="streak-two-popup">
                            <h4>2-Day Streak</h4>
                            <p>The start of a beautiful streak</p>
                        </div>
                    </div>
                    <!-- //* 3 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge6) {
                            echo $badge6;
                        }else{
                            echo $default6;
                        } ?>" id="streak-three" class="badge">
                        <div class="badgeToPopup" id="streak-three-popup">
                            <h3>3-Day Streak</h3>
                            <p>Third time's the charm</p>
                        </div>
                    </div>
                    <!-- //* 7 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge7) {
                            echo $badge7;
                        }else{
                            echo $default7;
                        } ?>" id="streak-seven" class="badge">
                        <div class="badgeToPopup" id="streak-seven-popup">
                            <h4>7-Day Streak</h4>
                            <p>One whole week!</p>
                        </div>
                    </div>
                    <!-- //* 14 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge8) {
                            echo $badge8;
                        }else{
                            echo $default8;
                        } ?>" id="streak-fourteen" class="badge">
                        <div class="badgeToPopup" id="streak-fourteen-popup">
                            <h4>14-Day Streak</h4>
                            <p>TWO whole weeks!!</p>
                        </div>
                    </div>
                    <!-- //* 21 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge9) {
                            echo $badge9;
                        }else{
                            echo $default9;
                        } ?>" id="streak-twentyOne" class="badge">
                        <div class="badgeToPopup" id="streak-twentyOne-popup">
                            <h4>21-Day Streak</h4>
                            <p>THREE WHOLE WEEKS!!!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Three -->
                <div class="auto-row rows">
                    <!-- //* First Daily-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge10) {
                            echo $badge10;
                        }else{
                            echo $default10;
                        } ?>" id="first-daily" class="badge">
                        <div class="badgeToPopup" id="first-daily-popup">
                            <h4>First Daily</h4>
                            <p>Reached your daily goal for the first time on this project</p>
                        </div>
                    </div>
                    <!-- //* Full Streak-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge11) {
                            echo $badge11;
                        }else{
                            echo $default11;
                        } ?>" id="every-streak" class="badge">
                        <div class="badgeToPopup" id="every-streak-popup">
                            <h4>Every Day Streak</h4>
                            <p>Congrats, you've worked on your project every day!</p>
                        </div>
                    </div>
                    <!-- //* Stayed on Track-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge12) {
                            echo $badge12;
                        }else{
                            echo $default12;
                        } ?>" id="on-track" class="badge">
                        <div class="badgeToPopup" id="on-track-popup">
                            <h4>Stayed on Track</h4>
                            <p>Reached your daily goal every day over the course of the project</p>
                        </div>
                    </div>
                </div>
            </div>
        <!-- //* Toggleable Badges -->
            <div class="toggle-badges">
                <h4 class="instruction">You can award yourself these badges</h4>
            <!-- //* Row One -->
                <div class="toggle-row rows">
                    <!-- //* Outlined-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge13) {
                            echo $badge13;
                        }else{
                            echo $default13;
                        } ?>" id="outline" class="badge">
                        <div class="badgeToPopup" id="outline-popup">
                            <h4>Know Where Ya Goin'</h4>
                            <p>Started your project with an outline.</p>
                        </div>
                    </div>
                    <!-- //* Pantser/Journey-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge14) {
                            echo $badge14;
                        }else{
                            echo $default14;
                        } ?>" id="journey" class="badge">
                        <div class="badgeToPopup" id="journey-popup">
                            <h4>It's All About The Journey</h4>
                            <p>The only plan you have is to explore and discover the project along the way</p>
                        </div>
                    </div>
                    <!-- //* Dual Wielding-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge15) {
                            echo $badge15;
                        }else{
                            echo $default15;
                        } ?>" id="dual-wielder" class="badge">
                        <div class="badgeToPopup" id="dual-wielder-popup">
                            <h4>Dual Wielder</h4>
                            <p>Your special sauce is ??% planning and ??% exploration, you'll never tell how much of each</p>
                        </div>
                    </div>
                    <!-- //* Fresh Project-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge16) {
                            echo $badge16;
                        }else{
                            echo $default16;
                        } ?>" id="starting-fresh" class="badge">
                        <div class="badgeToPopup" id="starting-fresh-popup">
                            <h4>Starting Fresh</h4>
                            <p>Created a brand new project!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Two -->
                <div class="toggle-row rows">
                    <!-- //* Returning to WIP-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge17) {
                            echo $badge17;
                        }else{
                            echo $default17;
                        } ?>" id="ever-persist" class="badge">
                        <div class="badgeToPopup" id="ever-persist-popup">
                            <h4>Ever Persistent</h4>
                            <p>You Returned to a WIP!</p>
                        </div>
                    </div>
                    <!-- //* Backed up Project-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge18) {
                            echo $badge18;
                        }else{
                            echo $default18;
                        } ?>" id="back-it-up" class="badge">
                        <div class="badgeToPopup" id="back-it-up-popup">
                            <h4>Back It Up!</h4>
                            <p>You never know when The Horrors will hit your computer, but you're 
                                ready!<br>Project backed up!</p>
                        </div>
                    </div>
                    <!-- //* Guild Hall Gathering-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge19) {
                            echo $badge19;
                        }else{
                            echo $default19;
                        } ?>" id="gathering" class="badge">
                        <div class="badgeToPopup" id="gathering-popup">
                            <h4>Guildhall Gathering</h4>
                            <p>You participated in a Write In or Sprint!</p>
                        </div>
                    </div>
                    <!-- //* Hear Ye-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge20) {
                            echo $badge20;
                        }else{
                            echo $default20;
                        } ?>" id="hear-ye" class="badge">
                        <div class="badgeToPopup" id="hear-ye-popup">
                            <h4>Hear Ye! Hear Ye!</h4>
                            <p>You've told someone about your goal, whether a close friend or the whole world!</p>
                        </div>
                    </div>
                    <!-- //* Breakthrough-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge21) {
                            echo $badge21;
                        }else{
                            echo $default21;
                        } ?>" id="breakthrough" class="badge">
                        <div class="badgeToPopup" id="breakthrough-popup">
                            <h4>Breakthrough Moment</h4>
                            <p>Whatever was giving you trouble on this project, you've just figured it out!</p>
                        </div>
                    </div>
                </div>
            <!-- //* Row Three -->
                <div class="toggle-row rows">
                    <!-- //* Touch Grass-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge22) {
                            echo $badge22;
                        }else{
                            echo $default22;
                        } ?>" id="touch-grass" class="badge">
                        <div class="badgeToPopup" id="touch-grass-popup">
                            <h4>Touched Grass</h4>
                            <p>You made sure to go outside and get some of that sweet, sweeet vitamin D.</p>
                        </div>
                    </div>
                    <!-- //* Took Care of Business-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge23) {
                            echo $badge23;
                        }else{
                            echo $default23;
                        } ?>" id="business" class="badge">
                        <div class="badgeToPopup" id="business-popup">
                            <h4>Took Care of Business</h4>
                            <p>You took care of your other responsibilities, like dishes or homework. All those boring things no one wants to do.</p>
                        </div>
                    </div>
                    <!-- //* Tears Were Wept-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge24) {
                            echo $badge24;
                        }else{
                            echo $default24;
                        } ?>" id="tears-wept" class="badge">
                        <div class="badgeToPopup" id="tears-wept-popup">
                            <h4>Tears Were Wept</h4>
                            <p>Either the creation or the process itself made you cry.</p>
                        </div>
                    </div>
                    <!-- //* Finished Project-->
                    <div class="badge-wrapper">
                        <img src="<?php if($badge25) {
                            echo $badge25;
                        }else{
                            echo $default25;
                        } ?>" id="finish-him" class="badge">
                        <div class="badgeToPopup" id="finish-him-popup">
                            <h4><em>Finish Him</em></h4>
                            <p>You fully completed this project during this challenge.<br>WIP no more!</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- <div class="instruction-wrapper">
                <p class="instruction">
                    To give yourself a badge, simply activate the toggle and click on a badge. 
                    Click again to remove the badge.
                </p>
                <div class="slider-container">
                    <i class="fa fa-lock" alt="lock icon"></i>
                    <label class="switch">
                        <input type="checkbox" id="badgeEdit" value="off" onclick="clickCheckbox()">
                        <span class="slider round"></span>
                    </label>
                    <i class="fa fa-unlock" alt="unlocked icon"></i>
                </div>
            </div> -->
        </div>
    </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
    <script>
// BADGE POPUPS
    const elementToHover1 = document.getElementById('first-daily');
    const elementToPopup1 = document.getElementById('first-daily-popup');
    elementToHover1.addEventListener('mouseenter',
        () => {
        elementToPopup1.classList.add('showFlex');
        });
        
    elementToHover1.addEventListener('mouseleave',
        () => {
        elementToPopup1.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover2 = document.getElementById('quarter-quomplete');
    const elementToPopup2 = document.getElementById('quarter-quomplete-popup');
    elementToHover2.addEventListener('mouseenter',
        () => {
        elementToPopup2.classList.add('showFlex');
        });
        
    elementToHover2.addEventListener('mouseleave',
        () => {
        elementToPopup2.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover3 = document.getElementById('half-way');
    const elementToPopup3 = document.getElementById('half-way-popup');
    elementToHover3.addEventListener('mouseenter',
        () => {
        elementToPopup3.classList.add('showFlex');
        });
        
    elementToHover3.addEventListener('mouseleave',
        () => {
        elementToPopup3.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover4 = document.getElementById('all-downhill');
    const elementToPopup4 = document.getElementById('all-downhill-popup');
    elementToHover4.addEventListener('mouseenter',
        () => {
        elementToPopup4.classList.add('showFlex');
        });
        
    elementToHover4.addEventListener('mouseleave',
        () => {
        elementToPopup4.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover5 = document.getElementById('cross-finish');
    const elementToPopup5 = document.getElementById('cross-finish-popup');
    elementToHover5.addEventListener('mouseenter',
        () => {
        elementToPopup5.classList.add('showFlex');
        });
        
    elementToHover5.addEventListener('mouseleave',
        () => {
        elementToPopup5.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover6 = document.getElementById('streak-two');
    const elementToPopup6 = document.getElementById('streak-two-popup');
    elementToHover6.addEventListener('mouseenter',
        () => {
        elementToPopup6.classList.add('showFlex');
        });
        
    elementToHover6.addEventListener('mouseleave',
        () => {
        elementToPopup6.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover7 = document.getElementById('streak-three');
    const elementToPopup7 = document.getElementById('streak-three-popup');
    elementToHover7.addEventListener('mouseenter',
        () => {
        elementToPopup7.classList.add('showFlex');
        });
        
    elementToHover7.addEventListener('mouseleave',
        () => {
        elementToPopup7.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover8 = document.getElementById('streak-seven');
    const elementToPopup8 = document.getElementById('streak-seven-popup');
    elementToHover8.addEventListener('mouseenter',
        () => {
        elementToPopup8.classList.add('showFlex');
        });
        
    elementToHover8.addEventListener('mouseleave',
        () => {
        elementToPopup8.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover9 = document.getElementById('streak-fourteen');
    const elementToPopup9 = document.getElementById('streak-fourteen-popup');
    elementToHover9.addEventListener('mouseenter',
        () => {
        elementToPopup9.classList.add('showFlex');
        });
        
    elementToHover9.addEventListener('mouseleave',
        () => {
        elementToPopup9.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover10 = document.getElementById('streak-twentyOne');
    const elementToPopup10 = document.getElementById('streak-twentyOne-popup');
    elementToHover10.addEventListener('mouseenter',
        () => {
        elementToPopup10.classList.add('showFlex');
        });
        
    elementToHover10.addEventListener('mouseleave',
        () => {
        elementToPopup10.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover11 = document.getElementById('every-streak');
    const elementToPopup11 = document.getElementById('every-streak-popup');
    elementToHover11.addEventListener('mouseenter',
        () => {
        elementToPopup11.classList.add('showFlex');
        });
        
    elementToHover11.addEventListener('mouseleave',
        () => {
        elementToPopup11.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover12 = document.getElementById('on-track');
    const elementToPopup12 = document.getElementById('on-track-popup');
    elementToHover12.addEventListener('mouseenter',
        () => {
        elementToPopup12.classList.add('showFlex');
        });
        
    elementToHover12.addEventListener('mouseleave',
        () => {
        elementToPopup12.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover13 = document.getElementById('outline');
    const elementToPopup13 = document.getElementById('outline-popup');
    elementToHover13.addEventListener('mouseenter',
        () => {
        elementToPopup13.classList.add('showFlex');
        });
        
    elementToHover13.addEventListener('mouseleave',
        () => {
        elementToPopup13.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover14 = document.getElementById('journey');
    const elementToPopup14 = document.getElementById('journey-popup');
    elementToHover14.addEventListener('mouseenter',
        () => {
        elementToPopup14.classList.add('showFlex');
        });
        
    elementToHover14.addEventListener('mouseleave',
        () => {
        elementToPopup14.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover15 = document.getElementById('dual-wielder');
    const elementToPopup15 = document.getElementById('dual-wielder-popup');
    elementToHover15.addEventListener('mouseenter',
        () => {
        elementToPopup15.classList.add('showFlex');
        });
        
    elementToHover15.addEventListener('mouseleave',
        () => {
        elementToPopup15.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover16 = document.getElementById('starting-fresh');
    const elementToPopup16 = document.getElementById('starting-fresh-popup');
    elementToHover16.addEventListener('mouseenter',
        () => {
        elementToPopup16.classList.add('showFlex');
        });
        
    elementToHover16.addEventListener('mouseleave',
        () => {
        elementToPopup16.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover17 = document.getElementById('ever-persist');
    const elementToPopup17 = document.getElementById('ever-persist-popup');
    elementToHover17.addEventListener('mouseenter',
        () => {
        elementToPopup17.classList.add('showFlex');
        });
        
    elementToHover17.addEventListener('mouseleave',
        () => {
        elementToPopup17.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover18 = document.getElementById('back-it-up');
    const elementToPopup18 = document.getElementById('back-it-up-popup');
    elementToHover18.addEventListener('mouseenter',
        () => {
        elementToPopup18.classList.add('showFlex');
        });
        
    elementToHover18.addEventListener('mouseleave',
        () => {
        elementToPopup18.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover19 = document.getElementById('gathering');
    const elementToPopup19 = document.getElementById('gathering-popup');
    elementToHover19.addEventListener('mouseenter',
        () => {
        elementToPopup19.classList.add('showFlex');
        });
        
    elementToHover19.addEventListener('mouseleave',
        () => {
        elementToPopup19.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover20 = document.getElementById('hear-ye');
    const elementToPopup20 = document.getElementById('hear-ye-popup');
    elementToHover20.addEventListener('mouseenter',
        () => {
        elementToPopup20.classList.add('showFlex');
        });
        
    elementToHover20.addEventListener('mouseleave',
        () => {
        elementToPopup20.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover21 = document.getElementById('breakthrough');
    const elementToPopup21 = document.getElementById('breakthrough-popup');
    elementToHover21.addEventListener('mouseenter',
        () => {
        elementToPopup21.classList.add('showFlex');
        });
        
    elementToHover21.addEventListener('mouseleave',
        () => {
        elementToPopup21.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover22 = document.getElementById('touch-grass');
    const elementToPopup22 = document.getElementById('touch-grass-popup');
    elementToHover22.addEventListener('mouseenter',
        () => {
        elementToPopup22.classList.add('showFlex');
        });
        
    elementToHover22.addEventListener('mouseleave',
        () => {
        elementToPopup22.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover23 = document.getElementById('business');
    const elementToPopup23 = document.getElementById('business-popup');
    elementToHover23.addEventListener('mouseenter',
        () => {
        elementToPopup23.classList.add('showFlex');
        });
        
    elementToHover23.addEventListener('mouseleave',
        () => {
        elementToPopup23.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover24 = document.getElementById('tears-wept');
    const elementToPopup24 = document.getElementById('tears-wept-popup');
    elementToHover24.addEventListener('mouseenter',
        () => {
        elementToPopup24.classList.add('showFlex');
        });
        
    elementToHover24.addEventListener('mouseleave',
        () => {
        elementToPopup24.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    const elementToHover25 = document.getElementById('finish-him');
    const elementToPopup25 = document.getElementById('finish-him-popup');
    elementToHover25.addEventListener('mouseenter',
        () => {
        elementToPopup25.classList.add('showFlex');
        });
        
    elementToHover25.addEventListener('mouseleave',
        () => {
        elementToPopup25.classList.remove('showFlex');
        });
    //`~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    </script>
</body>
</html>