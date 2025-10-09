<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
forceLogin();

$userID = htmlspecialchars($_SESSION["user_id"]);
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
        <a href="project.php" class="overview-container">
            <img src="<?= $genre_picture ?>">
            <div class="overview-info">
                    <h2 class="overview-title"><?= $title ?> <i class="fa fa-star" id="star-icon" alt="star icon"></i></h2>
                    <p class="overview-summary"><?= $info ?></p>
                    <div class="overview-data">
                        <div class="overview-wordCount">
                            <p><strong>Words:</strong></p>
                            <p><?= $current_count ?>/<?= $goal ?></p>
                        </div>
                        <div class="overview-badges">
                            <p><strong>Badges:</strong></p>
                            <p>5/25</p>
                        </div>
                    </div>
            </div>
        </a>
        <?php }} ?>
        <!-- <a href="project.php" class="overview-container">
            <img src="../images/genre-covers/placeholder(v3).webp">
            <div class="overview-info">
                    <h2 class="overview-title">Title <i class="fa fa-star" id="star-icon" alt="star icon"></i></h2>
                    <p class="overview-summary">Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex 
                            sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis 
                            convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus 
                            fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada 
                            lacinia integer nunc posuere ut hendrerit semper vel class</p>
                    <div class="overview-data">
                        <div class="overview-wordCount">
                            <p><strong>Words:</strong></p>
                            <p>50,000</p>
                        </div>
                        <div class="overview-badges">
                            <p><strong>Badges:</strong></p>
                            <p>5/25</p>
                        </div>
                    </div>
            </div>
        </a>
        <a href="project.php" class="overview-container">
            <img src="../images/genre-covers/placeholder(v3).webp">
            <div class="overview-info">
                    <h2 class="overview-title">Title <i class="fa fa-star" id="star-icon" alt="star icon"></i></h2>
                    <p class="overview-summary">Lorem ipsum dolor sit amet consectetur adipiscing elit quisque faucibus ex 
                            sapien vitae pellentesque sem placerat in id cursus mi pretium tellus duis 
                            convallis tempus leo eu aenean sed diam urna tempor pulvinar vivamus 
                            fringilla lacus nec metus bibendum egestas iaculis massa nisl malesuada 
                            lacinia integer nunc posuere ut hendrerit semper vel class</p>
                    <div class="overview-data">
                        <div class="overview-wordCount">
                            <p><strong>Words:</strong></p>
                            <p>50,000</p>
                        </div>
                        <div class="overview-badges">
                            <p><strong>Badges:</strong></p>
                            <p>5/25</p>
                        </div>
                    </div>
            </div>
        </a>       -->
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
</body>
</html>