<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 'On');
ini_set('error_log', '/path/to/php_errors.log');


ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
// xamppConnect();

forceLogin();

$userID = htmlspecialchars($_SESSION["user_id"]);

    $sql = "SELECT * FROM users WHERE id=$userID";
        $result = $_SESSION["conn"]->query($sql);
        $user = $result->fetch_assoc();
            $joined = $user["joined"];
            $league = $user["league"];
            $points = $user["points"];
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
    <title>Leagues</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/competition.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body id="body">
    <?php if (isset($_SESSION["user_id"]) && $joined == 0) { ?>
        <div class="join-wrapper" id="join-wrapper">
            <div class="join-popup">
                <h2>Join a League to Start Competing!</h2>
                <form method="post">
                    <div class="option-wrapper">
                        <!-- <div class="radio-wrapper-9 radio">
                            <input id="joinCasual" type="radio" name="chooseLeague" value="casual" onclick="checkJoin();">
                            <label for="joinCasual">Casual League</label>
                        </div>
                        <div class="radio-wrapper-9 radio">
                            <input id="joinSpeedster" type="radio" name="chooseLeague" value="speedster">
                            <label for="joinSpeedster">Speedster League</label>
                        </div>   -->
                        <select class="selection" name="chooseLeague" id="chooseLeague">
                            <option name="placeholder" id="placeholder" value="">Choose your league</option>
                            <option name="casual" id="casual" value="casual">Casual</option>
                            <option></option>
                            <option name="speedster" id="speedster" value="speedster">Speedster</option>
                        </select>
                        <input type="hidden" name="test" id="test">
                    </div>
                    <div class="button-wrapper">
                        <button type="submit" id="league-submit" class="league-btn">Save</button>
                    </div>
                </form>
                <?php echo $_POST['test']; ?>
            </div>
        </div>
    <?php } ?>
    <div class="changeLeague-wrapper" id="changeLeague-wrapper">
        <div class="changeLeague-popup">
            <div class="close-wrapper">
                <i class="fa fa-close" onclick="hideLeaguePopup()"></i>
            </div>
            <h3>Change Your League?</h3>
            <h5>Please note: you must be in a league for at least 30 days before you can change leagues.</h5>
            <form method="post" action="php-processes/update-leagues.php">
                <div class="option-wrapper">
                    <div class="radio-wrapper-9 radio">
                        <input id="changeCasual" type="radio" name="chooseLeague" value="casual">
                        <label for="changeCasual">Casual League</label>
                    </div>
                    <div class="radio-wrapper-9 radio">
                        <input id="changeSpeedster" type="radio" name="chooseLeague" value="speedster">
                        <label for="changeSpeedster">Speedster League</label>
                    </div>  
                </div>
                <div class="button-wrapper">
                    <button type="submit" id="change-submit" class="league-btn">Save</button>
                </div>
            </form>
        </div>
    </div>
    <header>
        <?php makeNav() ?>
    </header>
    <div class="global-wrapper">
        <div class="global-content" onclick="toggleGlobal();">
            <?php 
            // $sql = "SELECT * FROM users WHERE joined=1 ORDER BY points DESC";
            $sql = "SELECT id, username, points, 
                FIND_IN_SET(points, 
                (SELECT GROUP_CONCAT(points ORDER BY points DESC) 
                FROM users)) AS rank FROM users WHERE id=$userID";
                $result = $_SESSION["conn"]->query($sql);
                $user = $result->fetch_assoc();
                    $rank = $user["rank"];
            ?>
            <h3><i class="fa fa-caret-down" id="title-caret"></i> Global Ranking:</h3>
            <h2><?= $rank?></h2>
        </div>
    </div>
    <div class="desktop-wrapper">
        <div class="content-wrapper center">
            <div class="league-wrapper">
                <div class="title-wrapper">
                    <h2><?= $league?> League</h2>
                </div>
                <div class="league-content">
                    <div class="labels">
                        <h4>Rank</h4>
                        <h4>Name</h4>
                        <h4>Points</h4>
                    </div>
                    <div class="league-rows">
                        <?php
                        $total_pages = $_SESSION["conn"]->query("SELECT * FROM users WHERE league='$league'")->num_rows;

                        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                        $num_results_on_page = 15;

                        if ($stmt = $_SESSION["conn"]->prepare("SELECT * FROM users WHERE league='$league' ORDER BY points DESC LIMIT ?,?")) {
                            // Calculate the page to get the results we need from our table.
                            $calc_page = ($page - 1) * $num_results_on_page;
                            $stmt->bind_param('ii', $calc_page, $num_results_on_page);
                            $stmt->execute(); 
                            // Get the results...
                            $result = $stmt->get_result();
                            $stmt->close();
                        }

                        $rank = 0;
                        while ($row = $result->fetch_assoc()) {
                            $username = $row["username"];
                            $points = $row["points"];
                            $rank++;                                    
                        ?>
                        <div class="row-item">
                            <h5><?= $rank ?></h5>
                            <h5><?= $username ?></h5>
                            <h5><?= $points ?></h5>
                        </div>
                        <?php 
                        } ?> 
                    </div>
                </div>
                <?php if (ceil($total_pages / $num_results_on_page) > 1) { ?>
                <div class="pages-wrapper">
                    <?php if ($page > 1) { ?>
                        <a class="prev" href="competition.php?page=<?php echo $page-1 ?>">Prev</a>
                    <?php } ?>
                    
                    <?php if ($page > 3) { ?>
                        <a class="start" href="competition.php?page=1">1</a>
                        <span class="dots">...</span>
                    <?php } ?>

                    <?php if ($page-2 > 0) {?>
                        <a class="page" href="competition.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a>
                    <?php } ?>
                    <?php if ($page-1 > 0) {?>
                        <a class="page" href="competition.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a>
                    <?php } ?>

                    <a class="currentpage" href="competition.php?page=<?php echo $page ?>"><?php echo $page ?></a>

                    <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1) {?>
                        <a class="page" href="competition.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a>
                    <?php } ?>
                    <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1) {?>
                        <a class="page" href="competition.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)-2) {?>
                        <span class="dots">...</span>
                        <a class="end" href="competition.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)) {?>
                        <a class="next" href="competition.php?page=<?php echo $page+1 ?>">Next</a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
            <div class="link-wrapper">
                <i class="fa fa-repeat" onclick="showLeaguePopup();"></i>
                <a class="link" onclick="showLeaguePopup();">Change League</a>
            </div>
        </div>
        <div class="content-wrapper" id="content-wrapper">
            <div class="globalTable-wrapper league-wrapper hide" id="globalTable-wrapper">
                <div class="title-wrapper">
                    <h2>Global Rank</h2>
                </div>
                <div class="league-content">
                    <div class="labels">
                        <h4>Rank</h4>
                        <h4>Name</h4>
                        <h4>Points</h4>
                    </div>
                    <div class="league-rows">
                        <?php
                        $total_pages = $_SESSION["conn"]->query("SELECT * FROM users WHERE joined=1")->num_rows;

                        $page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

                        $num_results_on_page = 15;

                        if ($stmt = $_SESSION["conn"]->prepare("SELECT * FROM users WHERE joined=1 ORDER BY points DESC LIMIT ?,?")) {
                            // Calculate the page to get the results we need from our table.
                            $calc_page = ($page - 1) * $num_results_on_page;
                            $stmt->bind_param('ii', $calc_page, $num_results_on_page);
                            $stmt->execute(); 
                            // Get the results...
                            $result = $stmt->get_result();
                            $stmt->close();
                        }

                        $rank = 0;
                        while ($row = $result->fetch_assoc()) {
                            $username = $row["username"];
                            $points = $row["points"];
                            $rank++;                                    
                        ?>
                        <div class="row-item">
                            <h5><?= $rank ?></h5>
                            <h5><?= $username ?></h5>
                            <h5><?= $points ?></h5>
                        </div>
                    <?php 
                    } ?> 
                    </div>
                </div>
                <?php if (ceil($total_pages / $num_results_on_page) > 1) { ?>
                <div class="pages-wrapper">
                    <?php if ($page > 1) { ?>
                        <a class="prev" href="competition.php?page=<?php echo $page-1 ?>">Prev</a>
                    <?php } ?>
                    
                    <?php if ($page > 3) { ?>
                        <a class="start" href="competition.php?page=1">1</a>
                        <span class="dots">...</span>
                    <?php } ?>

                    <?php if ($page-2 > 0) {?>
                        <a class="page" href="competition.php?page=<?php echo $page-2 ?>"><?php echo $page-2 ?></a>
                    <?php } ?>
                    <?php if ($page-1 > 0) {?>
                        <a class="page" href="competition.php?page=<?php echo $page-1 ?>"><?php echo $page-1 ?></a>
                    <?php } ?>

                    <a class="currentpage" href="competition.php?page=<?php echo $page ?>"><?php echo $page ?></a>

                    <?php if ($page+1 < ceil($total_pages / $num_results_on_page)+1) {?>
                        <a class="page" href="competition.php?page=<?php echo $page+1 ?>"><?php echo $page+1 ?></a>
                    <?php } ?>
                    <?php if ($page+2 < ceil($total_pages / $num_results_on_page)+1) {?>
                        <a class="page" href="competition.php?page=<?php echo $page+2 ?>"><?php echo $page+2 ?></a>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)-2) {?>
                        <span class="dots">...</span>
                        <a class="end" href="competition.php?page=<?php echo ceil($total_pages / $num_results_on_page) ?>"><?php echo ceil($total_pages / $num_results_on_page) ?></a>
                    <?php } ?>

                    <?php if ($page < ceil($total_pages / $num_results_on_page)) {?>
                        <a class="next" href="competition.php?page=<?php echo $page+1 ?>">Next</a>
                    <?php } ?>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
    <script>
        function toggleGlobal() {            
            var globalTable = document.getElementById("globalTable-wrapper");
            globalTable.classList.toggle('show');

            var caret = document.getElementById("title-caret");
            
            if (caret.classList.contains('fa-caret-down')) {
                caret.classList.remove('fa-caret-down');
                caret.classList.add('fa-caret-up');
            }else if (caret.classList.contains('fa-caret-up')) {
                caret.classList.remove('fa-caret-up');
                caret.classList.add('fa-caret-down');
            }

            var center = document.getElementById("content-wrapper");
            if (center.classList.contains('center')) {
                center.classList.remove('center');
            }else if (!center.classList.contains('center')) {
                center.classList.add('center');
            }
        }
    </script>
</body>