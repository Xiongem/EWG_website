<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

//* If user is logged in
if ($_SESSION["user_id"]) {
    $userID = htmlspecialchars($_SESSION["user_id"]);

    //* Pull User Info
    $sql = "SELECT * FROM users WHERE id=$userID";
        $result = $_SESSION["conn"]->query($sql);
        $user = $result->fetch_assoc();
            $pfp = $user["pfp"];
            $username = $user["username"];

            //* Setting pfp
            if ($pfp) {
                $pfp_set = $pfp;
            } else {
                $pfp_set = "images/pfp-icon.webp";
        }

    //* Pull Project Info
    $sql = "SELECT display FROM current_project WHERE username='$username' AND current_state='current'";
        $result = $_SESSION["conn"]->query($sql);
        $display = $result->fetch_assoc();

    //* if user has selected a project to be active from project selection
    if ($display == "active") { 
        $sql = "SELECT * FROM current_project WHERE username='$username' AND current_state='current' AND display='active'";
        $result = $_SESSION["conn"]->query($sql);
        $project = $result->fetch_assoc();
            $displayTitle = $project["title"];
            $displayGenre = $project["genre"];
            $displayGenrePicture = 'images/genre-covers/genre-covers'.$displayGenre.'.webp';
            $displayInfo = $project["info"];
            $displayCount = $project["current_count"];
            $displayGoal = $project["goal"];
            $displayGoalDate = $project["goal_date"];
            $displayDailyGoal = $project["daily_goal"];
            $displayPercentage = floor($displayCount / $displayGoal * 100);
                //* Days left math
                $now = time();
                $your_date = strtotime($displayGoalDate);
                $divideDate = $your_date - $now;
                $math = round($divideDate / (60 * 60 * 24));
                    if ($displayGoalDate == "0000-00-00" || !$displayGoalDate) {
                        $displayDays = "No Goal Date Set";
                    } elseif (isset($displayGoalDate) && $displayGoalDate !== "0000-00-00") {
                        $displayDays = $math;
                        if ($displayDays == 0) {
                            $displayDays = "Final Day!";
                        } elseif ($displayDays < 0) {
                            $displayDays = "Project Past Due!";
                        }
                    }
    } else {
        $sql = "SELECT * FROM current_project WHERE username='$username' AND current_state='current'";
        $result = $_SESSION["conn"]->query($sql);
        $project = $result->fetch_assoc();
            $displayTitle = $project["title"];
            $displayGenre = $project["genre"];
            $displayGenrePicture = 'images/genre-covers/genre-covers'.$displayGenre.'.webp';
            $displayInfo = $project["info"];
            $displayCount = $project["current_count"];
            $displayGoal = $project["goal"];
            $displayGoalDate = $project["goal_date"];
            $displayDailyGoal = $project["daily_goal"];
            $displayPercentage = floor($displayCount / $displayGoal * 100);
                //* Days left math
                $now = time();
                $your_date = strtotime($displayGoalDate);
                $divideDate = $your_date - $now;
                $math = round($divideDate / (60 * 60 * 24));
                    if ($displayGoalDate == "0000-00-00" || !$displayGoalDate) {
                        $displayDays = "No Goal Date Set";
                    } elseif (isset($displayGoalDate) && $displayGoalDate !== "0000-00-00") {
                        $displayDays = $math;
                        if ($displayDays == 0) {
                            $displayDays = "Final Day!";
                        } elseif ($displayDays < 0) {
                            $displayDays = "Project Past Due!";
                        }
                    }
    }
$_SESSION["pfp"] = $pfp_set;
$_SESSION["username"] = $username;
} 
//* User is not logged in
else {
    $pfp_set = "images/pfp-icon.webp";
    $displayGenrePicture = "images/genre-covers/placeholder.webp";
}
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
    <title>Home</title>
    <link rel="stylesheet" href="mf-css/style.css">
    <link rel="stylesheet" href="mf-css/home.css">
    <link rel="stylesheet" href="mf-css/progressBar.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <script src="js/badges.js"></script>
    <script src="js/activeProject.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">
    <!-- //* POPUP FOR CHOOSING ACTIVE PROJECTS-->
    <div class="project-select-popup-wrapper" id="project-popup">
        <div class="project-select-popup"><div class="close-wrapper">
                <i class="fa fa-close" onclick="hideProjectPopup()"></i>
            </div>
            <?php
            //* Pull active project data
            $sql = "SELECT * FROM current_project WHERE username='$username' AND current_state='current'";
                $result = $_SESSION["conn"]->query($sql);
                    if ($result->num_rows > 0) {
                        while ($rows = $result->fetch_assoc()) {
                            $projectID = $rows["id"];
                            $title = $rows["title"];
                            $genre = $rows["genre"];
                            $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.webp';
                            $current_count = $rows["current_count"];
                            $goal = $rows["goal"];
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
                        ?>
            <div class="project-select-content" onclick="projectSelect('<?= $projectID ?>')">
                <img class="popup-image" src=<?= $genre_picture ?> alt="genre cover image">
                <div class="project-info">
                    <h3 id="popup-project-title"><i class="fa fa-star" id="star-icon" alt="star icon"></i> 
                        <?= $title ?> <?= $projectID ?></h3>
                    <div class="project-stats">
                        <p id="popup-goal">Goal: <?= $current_count ?>/<?= $goal ?></p>
                        <p><?= $progress ?>%</p>
                        <p id="popup-days-left"><?= $days ?></p>
                    </div>
                </div>
            </div>
            <?php }}else { ?>
            <div class="project-select-content" onclick="hideProjectPopup()">
                <img class="popup-image" src="../images/genre-covers/placeholder(v3).webp" alt="genre cover image">
                <div class="project-info">
                    <h3 id="popup-project-title"><i class="fa fa-star hide" id="star-icon" alt="star icon"></i> 
                        Let's Give this One an Obnoxiously Long Title to Test What the Overflow Will do</h3>
                    <div class="project-stats">
                        <p id="popup-goal">Goal: 10,000/50,00</p>
                        <p id="popup-days-left">Days Left: Some</p>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
    <div class="count-update-wrapper" id="count-update-popup">
        <div class="count-update-popup">
            <div class="close-wrapper">
                <i class="fa fa-close" onclick="hideUpdateWords()"></i>
            </div>
            <h2>Update Word Count</h2>
            <form action="" method="">
                <div class="count-type-select-wrapper">
                    <select class="count-type-select">
                        <p>Add/Replace Total <i class="fa fa-caret-down" id="down-icon" alt="down icon"></i></p>
                        <div class="count-type-dropdown">
                            <option class="count-type-list" id="replace">replace total</option>
                            <option class="count-type-list" id="add">Add to total</option>
                        </div>
                    </select>
                    <input type="text" pattern="^\d+(,\d+)?$" id="updateWordCount" name="updateWordCount">
                </div>
                <div class="button-wrapper">
                    <button class="save" onclick="hideUpdateWords()">Save</button>
                </div>
            </form>
        </div>
    </div>
    <!-- //* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <!-- //* BUTTON FOR SELECTING ACTIVE PROJECT TO SEE -->
    <div class="project-select-wrapper">
        <div class="project-select" onclick="showProjectPopup()">Switch Project <i class="fa fa-caret-down" id="down-icon" alt="down icon"></i>
        </div>
    </div>
    <!-- //* PROGRESS BAR-->
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
                    <p><?= $displayCount ?>/<?= $displayGoal ?></p>
                </div>
                <div id="daysLeft" class="progress-info">
                    <h2>Days Left:</h2>
                    <p><?= $displayDays ?></p>
                </div>
                <div id="dailyGoal" class="progress-info">
                    <h2>Daily Goal:</h2>
                    <p><?= $displayDailyGoal ?></p>
                </div>
                <div id="goal" class="progress-info">
                    <h2>Percentage:</h2>
                    <p><?= $displayPercentage ?>%</p>
                </div>
            </div>
            <div class="added">
                <span class="fa fa-plus" id="updateCount" onclick="showUpdateWords()"></span>
            </div>
        </div>
    </div>
    <!-- //* CURRENT PROJECT OVERVIEW AND INFO-->
    <div class="main-wrapper">
        <div class="current-project-wrapper">
            <div class="current-project-container">
                <div id="area-title">
                    <h1>Your Current Project</h1>
                </div>
                <div class="progress-info-container">
                    <div id="project-img">
                        <img src=<?= $displayGenrePicture ?> id="theme-img">
                    </div>
                    <div id="project-title">
                        <h2><?= $displayTitle ?></h2>
                    </div>
                    <div id="project-summary">
                        <!-- <p>Looks like you don't have any active projects.
                            <br><br>
                            Click <a href="newProject.php">here</a> to get started!
                        </p> -->
                        <p id="summary-text"><?= $displayInfo ?></p>
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
                        <img src="../images/badges/quarter-quomplete-mono.webp" id="quarter-quomplete" class="badge pulse">
                        <div class="badgeToPopup" id="quarter-quomplete-popup">
                            <h4>Quarter Quomplete</h4>
                            <p>Reached the 25% mark! That's a quarter of the way there!</p>
                        </div>
                    </div>
                    <!-- //* Half Way-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/half-way-mono.webp" id="half-way" class="badge pulse">
                        <div class="badgeToPopup" id="half-way-popup">
                            <h4>Half-Way There, Woah!<br>Livin' on a-</h4>
                            <p>Reached the 50% mark<br>on your current project.<br>Good job!</p>
                        </div>
                    </div>
                    <!-- //* All Downhill-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/all-downhill-mono.webp" id="all-downhill" class="badge pulse">
                        <div class="badgeToPopup" id="all-downhill-popup">
                            <h4>All Downhill From Here</h4>
                            <p>Reached 75%!<br>You're so close!</p>
                        </div>
                    </div>
                    <!-- //* Cross Finish-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/cross-finish-mono.webp" id="cross-finish" class="badge pulse">
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
                        <img src="../images/badges/streak-two-mono.webp" id="streak-two" class="badge pulse">
                        <div class="badgeToPopup" id="streak-two-popup">
                            <h4>2-Day Streak</h4>
                            <p>The start of a beautiful streak</p>
                        </div>
                    </div>
                    <!-- //* 3 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/streak-three-mono.webp" id="streak-three" class="badge pulse">
                        <div class="badgeToPopup" id="streak-three-popup">
                            <h3>3-Day Streak</h3>
                            <p>Third time's the charm</p>
                        </div>
                    </div>
                    <!-- //* 7 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/streak-seven-mono.webp" id="streak-seven" class="badge pulse">
                        <div class="badgeToPopup" id="streak-seven-popup">
                            <h4>7-Day Streak</h4>
                            <p>One whole week!</p>
                        </div>
                    </div>
                    <!-- //* 14 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/streak-fourteen-mono.webp" id="streak-fourteen" class="badge pulse">
                        <div class="badgeToPopup" id="streak-fourteen-popup">
                            <h4>14-Day Streak</h4>
                            <p>TWO whole weeks!!</p>
                        </div>
                    </div>
                    <!-- //* 21 Day Streak-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/streak-twentyOne-mono.webp" id="streak-twentyOne" class="badge pulse">
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
                        <img src="../images/badges/first-daily-mono.webp" id="first-daily" class="badge pulse">
                        <div class="badgeToPopup" id="first-daily-popup">
                            <h4>First Daily</h4>
                            <p>Reached your daily goal for the first time on this project</p>
                        </div>
                    </div>
                    <!-- //* Full Streak-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/every-streak-mono.webp" id="every-streak" class="badge pulse">
                        <div class="badgeToPopup" id="every-streak-popup">
                            <h4>Every Day Streak</h4>
                            <p>Congrats, you've worked on your project every day!</p>
                        </div>
                    </div>
                    <!-- //* Stayed on Track-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/on-track-mono.webp" id="on-track" class="badge pulse">
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
                        <img src="../images/badges/outline-mono-v2.webp" id="outline" class="badge pulse">
                        <div class="badgeToPopup" id="outline-popup">
                            <h4>Know Where Ya Goin'</h4>
                            <p>Started your project with an outline.</p>
                        </div>
                    </div>
                    <!-- //* Pantser/Journey-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/journey-mono.webp" id="journey" class="badge pulse">
                        <div class="badgeToPopup" id="journey-popup">
                            <h4>It's All About The Journey</h4>
                            <p>The only plan you have is to explore and discover the project along the way</p>
                        </div>
                    </div>
                    <!-- //* Dual Wielding-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/dual-wielder-mono.webp" id="dual-wielder" class="badge pulse">
                        <div class="badgeToPopup" id="dual-wielder-popup">
                            <h4>Dual Wielder</h4>
                            <p>Your special sauce is ??% planning and ??% exploration, you'll never tell how much of each</p>
                        </div>
                    </div>
                    <!-- //* Fresh Project-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/starting-fresh-mono.webp" id="starting-fresh" class="badge pulse">
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
                        <img src="../images/badges/ever-persist-mono.webp" id="ever-persist" class="badge pulse">
                        <div class="badgeToPopup" id="ever-persist-popup">
                            <h4>Ever Persistent</h4>
                            <p>You Returned to a WIP!</p>
                        </div>
                    </div>
                    <!-- //* Backed up Project-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/back-it-up-mono.webp" id="back-it-up" class="badge pulse">
                        <div class="badgeToPopup" id="back-it-up-popup">
                            <h4>Back It Up!</h4>
                            <p>You never know when The Horrors will hit your computer, but you're 
                                ready!<br>Project backed up!</p>
                        </div>
                    </div>
                    <!-- //* Guild Hall Gathering-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/gathering-mono.webp" id="gathering" class="badge pulse">
                        <div class="badgeToPopup" id="gathering-popup">
                            <h4>Guildhall Gathering</h4>
                            <p>You participated in a Write In or Sprint!</p>
                        </div>
                    </div>
                    <!-- //* Hear Ye-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/hear-ye-mono.webp" id="hear-ye" class="badge pulse">
                        <div class="badgeToPopup" id="hear-ye-popup">
                            <h4>Hear Ye! Hear Ye!</h4>
                            <p>You've told someone about your goal, whether a close friend or the whole world!</p>
                        </div>
                    </div>
                    <!-- //* Breakthrough-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/breakthrough-mono.webp" id="breakthrough" class="badge pulse">
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
                        <img src="../images/badges/touch-grass-mono.webp" id="touch-grass" class="badge pulse">
                        <div class="badgeToPopup" id="touch-grass-popup">
                            <h4>Touched Grass</h4>
                            <p>You made sure to go outside and get some of that sweet, sweeet vitamin D.</p>
                        </div>
                    </div>
                    <!-- //* Took Care of Business-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/business-mono.webp" id="business" class="badge pulse">
                        <div class="badgeToPopup" id="business-popup">
                            <h4>Took Care of Business</h4>
                            <p>You took care of your other responsibilities, like dishes or homework. All those boring things no one wants to do.</p>
                        </div>
                    </div>
                    <!-- //* Tears Were Wept-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/tears-wept-mono.webp" id="tears-wept" class="badge pulse">
                        <div class="badgeToPopup" id="tears-wept-popup">
                            <h4>Tears Were Wept</h4>
                            <p>Either the creation or the process itself made you cry.</p>
                        </div>
                    </div>
                    <!-- //* Finished Project-->
                    <div class="badge-wrapper">
                        <img src="../images/badges/finish-him-mono.webp" id="finish-him" class="badge pulse">
                        <div class="badgeToPopup" id="finish-him-popup">
                            <h4><em>Finish Him</em></h4>
                            <p>You fully completed this project during this challenge.<br>WIP no more!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="instruction-wrapper">
                <p class="instruction">
                    To give yourself a badge, simply activate the toggle and click on a badge. 
                    Click again to remove the badge.
                </p>
                <div class="slider-container">
                    <i class="fa fa-lock" alt="lock icon"></i>
                    <label class="switch">
                        <input type="checkbox" id="badgeEdit" onclick="disableBadgePopups()">
                        <span class="slider round"></span>
                    </label>
                    <i class="fa fa-unlock" alt="unlocked icon"></i>
                </div>
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