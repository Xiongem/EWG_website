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

$_SESSION["timezone"] = $timezone;
date_default_timezone_set("$timezone");
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
    <title>Archives</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/archives.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php {
        //* Pull active project data
        $sql = "SELECT * FROM current_project WHERE users_id='$userID' AND current_state='current'";
            $result = $_SESSION["conn"]->query($sql);
                if ($result->num_rows > 0) {
                    while ($rows = $result->fetch_assoc()) {
                        $projectID = $rows["id"];
                        $title = $rows["title"];
                        $genre = $rows["genre"];
                        $currentDisplay = $rows["display"];
                        $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.webp';
                        $current_count = $rows["current_count"];
                        $goal = $rows["goal"];
                        $goalDate = $rows["goal_date"];
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
        <?php if ($currentDisplay !== "active") { ?>
            <div class="project-select-popup-wrapper" id="project-popup">
                <div class="project-select-popup">
                    <div class="project-select-content" onclick="projectSelect('<?= $projectID ?>', '<?= $currentDisplay ?>')">
                        <img class="popup-image" src=<?= $genre_picture ?> alt="genre cover image">
                        <div class="project-info">
                            <h3 id="popup-project-title">
                                <i class="fa fa-star <?= $currentDisplay ?>" id="<?= $projectID ?>" alt="star icon"></i> 
                                <?= $title ?></h3>
                            <div class="project-stats">
                                <p id="popup-goal">Goal: <?= $current_count ?>/<?= $goal ?></p>
                                <p><?= $progress ?>%</p>
                                <?php if ($days !== "No Goal Date Set") { 
                                        if ($began) { ?>
                                            <p id="popup-days-left">Days Left: <?= $days ?></p>
                                        <?php } else { ?>
                                            <p id="popup-days-until">Starts in: <?= $started ?> days</p>
                                        <?php } ?>
                                <?php }else { ?>
                                    <p id="popup-days-left"><?= $days ?></p>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
            <?php } ?>
            <script>
                var project = id;
                    const boxes = document.querySelectorAll('.fa-star');
                    for (const box of boxes) {
                        box.classList.add('inactive');
                    }
                function refresh(){
                    location.reload();
                }
                function projectSelect(id, display) {
                    //assign values
                    var project = id;
                    const boxes = document.querySelectorAll('.fa-star');
                    for (const box of boxes) {
                        box.classList.add('inactive');
                    }

                    var i = document.getElementById(project);
                    i.classList.remove("inactive");
                    //begin post method
                    $.post("php-processes/update-activeProject", {
                        //DATA
                        project: project
                    });
                    setTimeout(refresh, 300);
                }
            </script>
        </div>
    </div>
    <?php }}} ?>
    <!--* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="title-wrapper">
        <h1>All Your Projects</h1>
        <div class="instruction-wrapper">
            <p><i class="fa fa-star" id="star-icon" alt="star icon"></i> = Active Project</p>
        </div>
    </div>
    <div class="main-wrapper">
    <?php
    //* Pull active project data
    $sql = "SELECT * FROM current_project WHERE users_id='$userID'";
        $result = $_SESSION["conn"]->query($sql);
            if ($result->num_rows > 0) {
                while ($rows = $result->fetch_assoc()) {
                    $specificValue = "unlocked";
                    $badges = array_reduce($rows, function($carry, $item) use ($specificValue) {
                        return $carry + ($item === $specificValue ? 1 : 0);
                    }, 0);
                    $projectID = $rows["id"];
                    $title = $rows["title"];
                    $genre = $rows["genre"];
                    $info = $rows["info"];
                    $state = $rows["current_state"];
                    $currentDisplay = $rows["display"];
                    $genre_picture = 'images/genre-covers/genre-covers'.$genre.'.webp';
                    $current_count = $rows["current_count"];
                    $goal = $rows["goal"];
                    $goalDate = $rows["goal_date"];
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
        <a href="project.php?projectID=<?=$projectID?>" class="overview-container">
            <?php if ($state == "completed") { ?>
            <div class="complete-img-wrapper">
                <img src="images/completed.webp" id="completedImg" alt="completed trophy image">
            </div>
            <?php } ?>
            <img src="<?= $genre_picture ?>" id="genreImage" alt="genre image">
            <div class="overview-info">
                    <h2 class="overview-title">
                        <?php if ($state == "current") {?>
                        <i class="fa fa-star" id="<?=$projectID?>" alt="star icon"></i>
                        <?php } ?>
                        <?= $title ?>
                    </h2>
                    <p class="overview-summary"><?= $info ?></p>
                    <div class="overview-data">
                        <div class="overview-wordCount">
                            <p><strong>Words:</strong></p>
                            <p><?= $current_count ?>/<?= $goal ?></p>
                        </div>
                        <div class="overview-badges">
                            <p><strong>Badges:</strong></p>
                            <p><?=$badges?>/25</p>
                        </div>
                    </div>
            </div>
        </a>
        <?php }} ?>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
</body>
</html>