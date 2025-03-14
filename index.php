<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();

if (isset($_SESSION["user_id"])) {
    $userID = htmlspecialchars($_SESSION["user_id"]);
    $sql = "SELECT * FROM current_project WHERE users_id=$userID AND current_state='current'";
    $result = $_SESSION["conn"]->query($sql);
    $user = $result->fetch_assoc();
        $genre = $user["genre"];
        $title = $user["title"];
        $goalDate = $user["goal_date"];
        $infos = $user["info"];
        $current_counts = $user["current_count"];
        $goals = $user["goal"];
        $daily= $user["daily_goal"];

        $now = time(); // or your date as well
        $your_date = strtotime($goalDate);
        $datediff = $your_date - $now;
        $interval = round($datediff / (60 * 60 * 24));
        $days = $interval;
            
        $_SESSION["genre"] = $genre;

    $sql = "SELECT * FROM users WHERE id=$userID";
    $result = $_SESSION["conn"]->query($sql);
    $user = $result->fetch_assoc();
        $pfp = $user["pfp"];

    if (empty($pfp)) {
        $pfp_set = "images/pfp-icon.png";
    } else{
        $pfp_set = $pfp;
    }
        if (empty($genre)) {
            $genre_picture = 'images/genre-covers/placeholder.jpg';
            $info = "Looks like you haven't started a project yet.<br><br>Click <a href=\"new-project.php\">here</a> to get started.";
            $current_count = 0;
            $goal = 0;
            $days = 0;
        } else{
            if ($goalDate == "0000-00-00") {
                $days = 0;
            } elseif (isset($goalDate)) {
                $days = $interval;
            }
            if ($days == 0) {
                $days = "Final Day!";
            } elseif ($days < 0) {
                $days = "Project Past Due!";
            }
            $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.jpg';
            $info = $infos;
            $current_count = $current_counts;
            $goal = $goals;
        }

        if (empty($current_count) || empty($goal)) {
            $progress = 3;
            $percentage = 0;
        } elseif (floor($current_count / $goal * 100)<=3) {
            $progress = 3;
            $percentage = 0;
        } else {
            $progress = floor($current_count / $goal * 100);
            $percentage = $progress;
        }
    $sql = "SELECT `start-1st-project`, `first-daily`, `quarter-quomplete`, `half-way`, `all-downhill`, 
    `cross-finish`, `on-track`, `out-gate`, `streak-two`, `streak-three`, `streak-seven`, 
    `streak-fourteen`, `streak-twentyOne`, `every-streak`,`hydra-slayer`
    FROM current_project, users WHERE users_id=$userID AND current_state='current'";
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
    $sql = "SELECT `hydra-slayer` FROM users WHERE id=$userID";
        $result = $_SESSION["conn"]->query($sql);
        $badge = $result->fetch_assoc();
            $_SESSION["overlay"] = $badge["hydra-slayer"];
    }else {
        $pfp_set = "images\pfp-icon.png";
        $genre_picture = "images/genre-covers/placeholder.jpg";
        $title = "";
        $info = "Looks like you're not logged in. <br><br>Click <a href=\"login.php\">here</a> to login or sign up!";
        $current_count = 0;
        $goal = 0;
        $progress = 3;
        $percentage = 0;
        $days = 0;
        $daily = 0;
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
}
$_SESSION["pfp"] = $pfp_set;
$_SESSION["percentage"] = $percentage;
$_SESSION["progress"] = $progress;
$_SESSION["current_count"] = $current_count;
$_SESSION["goal"] = $goal;
$_SESSION["days"] = $days;
$_SESSION["daily"] = $daily;

echo "Testing Testing";
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
    <title>EWG Home</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/home_theme.css">
    <link rel="website icon" type="png" href="images/comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <div id="background-layer" class="background-layer">
            <div class="update-container">
                <h2>Update Your Progress!</h2>
                <form action="php-processes/process-update-progress" method="post" name="updateProgress" id="updateProgress">
                    <label>New Total</label>
                    <input name="newCount" id="newCount" type="number" value="<?=$current_count?>">
                        <div class="button-row">
                            <button id="subBut">Update</button>
                            <a class="btn cancel" onclick="hideProgressPopup()">Cancel</a>
                        </div>
                </form>
            </div>
    </div>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
    </header>
<!--Area below the nav bar-->
<?php makePopup() ?>
<!--Progress Bar-->
<?php makeProgressBar() ?>

<div id="summaryPopup" class="summaryPopup">
    <div class="sum-container">
        <?= $info ?>
    </div>
</div>
        
<!--Project and Badge areas-->
        <div class="under-PB">
            <div class="project-overview">
                <div class="project"><h1>Your Current Project</h1></div>
                <div class="project-container">
                    <a id="goProjects" href="projects.php"><img src= <?=$genre_picture?>></a> 
                    <div class="project-title">
                        <?php echo "<h2>$title</h2>"?>
                        <p class="summary" id="summary"><?= $info?></p>
                    </div> 
                </div>
            </div>
            <!--Badge area-->
            <div class="badge-area">
                <div class="badge-header">
                    <h1>Badges</h1>
                </div>
                <div class="badges">
                    <div class="badge-rows">
                        <div class="pop-container">
                            <div class="elementToPopup" id="start-1st-project-popup">
                                <h3>Started Your Project</h3>
                                <p>Off you pop!</p>
                            </div>
                            <img class="badge1 pulse" id="start-1st-project" src="<?php if(!empty($badge1)) {
                            echo $badge1;
                        }else{
                            echo $default1;
                        } ?>">
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
                        } ?>">
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
                        } ?>">
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
                        } ?>">
                        </div>
                        <div class="pop-container">
                            <div class="elementToPopup" id="all-downhill-popup">
                                <h3>All Downhill From Here</h3>
                                <p>Reached 75%!<br>You're so close!</p>
                            </div>
                            <img class="badge1 pulse" id="all-downhill" src="<?php if(!empty($badge5)) {
                            echo $badge5;
                        }else{
                            echo $default5;
                        } ?>">
                        </div>
                    </div>
                    <div class="badge-rows">
                        <div class="pop-container">
                            <div class="elementToPopup" id="cross-finish-popup">
                                <h3>Crossed the Finish Line!</h3>
                                <p>Reached 100% on your current project!<br>YOU DID IT, YAY!!!</p>
                            </div>
                            <img class="badge1 pulse" id="cross-finish" src="<?php if(!empty($badge6)) {
                            echo $badge6;
                        }else{
                            echo $default6;
                        } ?>">
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
                        } ?>">
                        </div>
                        <div class="pop-container">
                            <div class="elementToPopup" id="out-gate-popup">
                                <h3>Out the Gate on Day 1</h3>
                                <p>A timely start!</p>
                            </div>
                            <img class="badge1 pulse" id="out-gate" src="<?php if(!empty($badge8)) {
                            echo $badge8;
                        }else{
                            echo $default8;
                        } ?>">
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
                        } ?>">
                        </div>
                    </div>
                    <div class="badge-rows">
                        <div class="pop-container">
                            <div class="elementToPopup" id="streak-three-popup">
                                <h3>3-Day Streak</h3>
                                <p>Third time's the charm</p>
                            </div>
                            <img class="badge1 pulse" id="streak-three" src="<?php if(!empty($badge10)) {
                            echo $badge10;
                        }else{
                            echo $default10;
                        } ?>">
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
                        } ?>">
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
                        } ?>">
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
                        } ?>">
                        </div>
                        <div class="pop-container">
                            <div class="elementToPopup" id="every-streak-popup">
                                <h3>Every Day Streak</h3>
                                <p>Congrats, you've worked on your project every day!</p>
                            </div>
                            <img class="badge1 pulse" id="every-streak" src="<?php if(!empty($badge14)) {
                            echo $badge14;
                        }else{
                            echo $default14;
                        } ?>">
                        </div>
                    </div>
                </div>
                <?php hidden() ?>
            </div>
        </div>
    </div>
    <?php makeFooter() ?>
    <script>
    var days = "<?=$days?>";
    if (days == 0) {
        document.getElementById('daysLeft').style.display = 'none';
    } else {
        document.getElementById('daysLeft').style.display = 'block';
    }
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
// Popup percentage for bar
    const progressBar = document.
        getElementById('project-pb');
    const percentagePop = document.
        getElementById('percentage-text');
    
    progressBar.addEventListener('mouseenter',
        () => {
            percentagePop.style.display = 'block';
        });
    
    progressBar.addEventListener('mouseleave',
        () => {
            percentagePop.style.display = 'none';
        });        
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
</script>
</body>
</html>