<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
// forceLogin();
dbConnect();

// $userID = htmlspecialchars($_SESSION["user_id"]);
$username = $_GET["userNAME"];
// Fetch profile picture info
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $pfp = $user["pfp"];
    $userID = $user["id"];

    if (empty($pfp)) {
        $pfp_set = "images\pfp-icon.png";
    } else{
        $pfp_set = $pfp;
    }
// Fetch project info
$sql = "SELECT * FROM current_project WHERE username='$username' AND current_state='current'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();

    if (isset($user["genre"])) { //user has an active project
        if ($user["goal_date"] == "0000-00-00") { //user didn't set a goal date
            $genre = $user["genre"];
            $title = $user["title"];
            $goalDate = $user["goal_date"];
            $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.jpg';
            $info = $user["info"];
            $current_count = $user["current_count"];
            $daily = $user["daily_goal"];
            $goal = $user["goal"];
            $days = 0;
        } elseif (isset($user["goal_date"])) { //user set a goal date
            $genre = $user["genre"];
            $title = $user["title"];
            $goalDate = $user["goal_date"];
            $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.jpg';
            $info = $user["info"];
            $current_count = $user["current_count"];
            $daily = $user["daily_goal"];
            $goal = $user["goal"];
            $now = time();
            $your_date = strtotime($goalDate);
            $datediff = $your_date - $now;
            $interval = round($datediff / (60 * 60 * 24));
            $days = $interval;
            if ($days == 0) {
                $days = "Final Day!";
            } elseif ($days < 0) {
                $days = "Project Past Due!";
            }
        }
    } else { //no project active
        $default = 'images/genre-covers/placeholder.jpg';
        $genre_picture = $default;
        $info = "Looks like you haven't started a project yet.<br><br>Click <a href=\"new-project.php\">here</a> to get started.";
        $current_count = 0;
        $goal = 0;
        $days = 0;
        $daily = 0;
        $title = "Title";        
    }

// Progress Bar
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
$default = 'images/genre-covers/placeholder.jpg';
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
    <title>EWG Projects</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/projects_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
    <!-- <script src="javascript/ajax.js"></script> -->
</head>
<body>
        <div id="warning" class="popup2">
            <div class="fuck-you2">
                <div class="popup-content2">
                    <h1><strong>Archive your current project?</strong></h1>
                    <p>This is <strong><em>permanent</em></strong> and cannot be undone.
                    <br><br>
                    Are you <strong>certain</strong> you want to archive this project?</p>
                    <div class="button-row2">
                        <a class="btn archive-btn" href="php-processes/process-archiveProject.php">Archive</a>
                        <a class="btn cancel" onclick="hideWarning()">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
    </header>
        <div class="current-container">
            <div class="current-img">
                <img src= <?=$genre_picture?>>
                <div class="updateProject" id="updateProject">
                    <a href="projects-update.php">Change Project Info</a>
                </div>
            </div>
            <div class="current-contents">
                <div class="top">
                    <h1 class="projTitle">Current Project</h1>
                    <div class="add-new-container" id="add-new-container">
                        <div class="add-new-contents">
                            <button onclick="showPopup()">Update Progress</button>
                            <div id="popup" class="popup">
                                <div class="popup-content">
                                    <h2>Update Your Progress!</h2>
                                    <div class="fuck-you">
                                        <form action="php-processes/process-update-progress" method="post" name="updateProgress" id="updateProgress">
                                            <label>New Total</label>
                                            <input name="newCount" id="newCount" type="number" value="<?=$current_count?>">
                                            <div class="button-row">
                                                <button id="subBut" onclick="hidePopup()">Update</button>
                                        </form>
                                            <div id="archive" class="btn">
                                                <a class="archive-btn" onclick="showWarning()">Archive</a>
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                <?php echo "<h2>$title</h2>"?>
                <div class="info-container">
                    <p class="summary" id="summary"><?= $info?></p>
                </div>
                <div class="container">
                    <div class="pb-container">
                        <div class="progress-bar" style="display: flex; justify-content: center;">
                            <h1>Project Progress</h1>
                            <div class="fuck-you3">
                                <div class="percentage-bar">
                                    <div id="project-pb" style="width: <?=$progress?>%;"></div>
                                    <div class="percentage-text" id="percentage-text">
                                        <p id="progress-percentage"><?=$percentage?>%</p>
                                    </div>
                                </div> 
                            </div>
                                <div class="progress-container">
                                    <div class="progress-content">
                                        <h2 class="headings"><u>Current:</u></h2>
                                        <h2 class="headings"><?=$current_count?></h2>
                                    </div>
                                    <div id="daysLeft" class="progress-content">
                                        <h2 class="headings"><u>Days Left:</u></h2>
                                        <h2 class="headings"><?=$days?></h2>
                                    </div>
                                    <div class="progress-content">
                                        <h2 class="headings"><u>Daily Goal:</u></h2>
                                        <h2 class="headings"><?=$daily?></h2>
                                    </div>
                                    <div class="progress-content">
                                        <h2 class="headings"><u>Goal:</u></h2>
                                        <h2 class="headings"><?=$goal?></h2>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="fuck-you">
                <div class="prev-container">
                    <h1 class="projTitle">Previous Projects</h1>
                    <?php 
                    $sql = "SELECT * FROM current_project WHERE username='$username' AND current_state='archived'";
                    $result = $_SESSION["conn"]->query($sql);
                        if ($result->num_rows > 0) {
                            while ($rows = $result->fetch_assoc()) {
                                $archived_genre = $rows["genre"];
                                $archived_title = $rows["title"];
                                $archived_info = $rows["info"];
                                $archived_current_count = $rows["current_count"];
                                $archived_goal = $rows["goal"];
                                $archived_genre_picture = 'images/genre-covers/genre-covers'.$archived_genre.'.jpg';?>
                                <div class="prev-content">
                                    <img src=<?=$archived_genre_picture ?>>
                                    <div class="archive-content">
                                        <h3 id="title"><?= $archived_title ?></h3>
                                    </div>
                                    <div class="archive-content middle">
                                        <p class='info'><?= $archived_info ?></p>
                                    </div>
                                    <div class="archive-content last" id="total">
                                        <p class='info'>Total Words</p>
                                        <p class='info'><?= $archived_current_count ?> out of <?= $archived_goal ?></p>
                                    </div>
                                </div>
                    <?php }}else { ?>
                        <div class="prev-content">
                            <img src=<?= $default ?>>
                            <h2>Title</h2>
                            <p id='info'>Once you finish and archive a project, it will show up here!</p>
                        </div>
                   <?php } ?>
                </div>
            </div>
    <?php makeFooter() ?>
<script>
    <?php if ($_SESSION["user_id"]) { ?>
        var getUserID = <?= $userID ?>;
        var sessionUserID = <?= $_SESSION["user_id"] ?>;
            if (getUserID != sessionUserID ) {
                document.getElementById('updateProject').style.display = 'none';
                document.getElementById('add-new-container').style.display = 'none';
                console.log("complete");
            }
    <?php } elseif (!isset($_SESSION["user_id"])) {?>
            document.getElementById('updateProject').style.display = 'none';
            document.getElementById('add-new-container').style.display = 'none';
            console.log("complete");
    <?php } ?>
//~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~
    var days = "<?=$days?>";
    if (days == 0) {
        document.getElementById('daysLeft').style.display = 'none';
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
    let hidden = '<?=$genre;?>';
        if (hidden === ""){
            function hideStuff(){
                document.getElementById('add-new-container').style.display = 'none';
                document.getElementById('updateProject').style.display = 'none';
            }
            hideStuff();
        }else {
            function showStuff(){
                document.getElementById('add-new-container').style.display = 'block';
                document.getElementById('updateProject').style.display = 'block';
            }
            showStuff();
        }
//curve progress bar when it reaches 100
    function updateProgressBar() {
        var pbPercentage = <?=$percentage?>;
        const curveProgressBar = document.getElementById('project-pb');
        if (pbPercentage >= 100) {
            curveProgressBar.style = 'border-radius: 14px 14px 14px 14px; width: <?=$progress?>%;';
        }
    }
    updateProgressBar();
    </script>
</body>
</html>