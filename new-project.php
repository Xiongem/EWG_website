<?php
ob_start();

session_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();
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
    <title>EWG New Project</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/new_project_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
    <script src="javascript/dropDown.js"></script>
</head>
<body>
    <header>
        <?php makeNav() ?>
        <?php makeDropDown() ?>
    </header>
    <div class="container">
        <div class="contents">
            <h1>Create a New Project!</h1>
                <div class="stuff">
                    <div class="info-contain">
                        <div class="title-content">
            <form method="post" action="php-processes/process-new-project" name="createNewProject">
                            <label for="title">Title:</label>
                            <input type="text" id="new-project-title" placeholder="Name of Your Project" name="newProjectTitle">
                        </div>
                            <div class="genre-content">
                                <label for="genre">Genre:</label>
                                <select id="new-project-genre" name="switch" onchange="switchImage();">
                                    <option name="adventure" id="adventure" value="1">Adventure</option>
                                    <option name="erotica" id="erotica" value="2">Erotica</option>
                                    <option name="fanfiction" id="fanfiction" value="3">Fanfiction</option>
                                    <option name="fantasy" id="fantasy" value="4">Fantasy</option>
                                    <option name="historical" id="historical" value="5">Historical</option>
                                    <option name="horror" id="horror" value="6">Horror</option>
                                    <option name="humor" id="humor" value="7">Humor</option>
                                    <option name="lgbt" id="lgbt" value="8">LGBTQ+</option>
                                    <option name="literary" id="literary" value="9">Literary</option>
                                    <option name="musical" id="musical" value="10">Musical</option>
                                    <option name="mystery" id="mystery" value="11">Mystery</option>
                                    <option name="personal" id="personal" value="12">Personal</option>
                                    <option name="religious" id="religious" value="13">Religious/Spiritual</option>
                                    <option name="romance" id="romance" value="14">Romance</option>
                                    <option name="scifi" id="scifi" value="15">Sci-Fi</option>
                                    <option name="thriller" id="thriller" value="16">Thriller</option>
                                    <option name="ya" id="ya" value="17">Young Adult</option>
                                    <option name="childrens" id="childrens" value="18">Young Readers</option>
                                </select>
                            </div>
                        <div class="goal_num">
                            <label>Goal number:</label>
                            <input name="goal" id="goal" type="number" placeholder="50000 (words)">
                        </div>
                        <div class="goal_end">
                            <label>End Date:</label>
                            <input name="goal_date" id="goal_date" type="date">
                        </div>
                        <label for="no-goal_date" class="container no-goal_date">Check the box if you don't want to set a goal date
                            <input type="checkbox" id="no-goal_date" name="no-goal_date" onclick="noDate()">
                            <span class="checkmark"></span>
                        </label>
                        <div class="daily_goal">
                            <div class="daily-contain">
                                <label for="daily_goal">Daily Goal:</label><br>
                                <input type="number" name="daily_goal" id="daily_goal" placeholder="250">
                            </div>
                            <!-- <p id="recommend">Recommended number:</p> -->
                        </div>
                    </div>
                    <div class="img-contain">
                        <div class="drop-shadow">
                            <img src="images/genre-covers/genre-covers1.jpg" name="genrePreview">
                        </div>
                    </div>
                </div>
                    <div class="about-content">
                        <label for="about-info">About Your Project:</label>
                        <textarea id="about-info" placeholder="What's your project about? Max Length: 750 characters" type="textarea" name="info" maxlength="750"></textarea>
                    </div>
                    <button id="np-submit">Save</button>
            </form>
        </div>
    </div>
    <?php makeFooter() ?>
<script>
    function noDate() {
        var checkBox = document.getElementById("no-goal_date");
        var test = document.getElementById("test");

        if (checkBox.checked == true) {
            document.getElementById("goal_date").disabled = true;
            document.getElementById("goal_date").value = "";
        } else if (checkBox.checked == false) {
            document.getElementById("goal_date").disabled = false;
        }
        var dailyGoal = parseInt(document.getElementById("daily_goal").value);
        var goal = parseInt(document.getElementById("goal").value);
        var recommendation = Math.floor(goal / dailyGoal);
        document.getElementById("recommend").innerHTML = "Recommended number: " + recommendation;
    }
</script>
</body>
</html>