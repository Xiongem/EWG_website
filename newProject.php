<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
// ini_set('log_errors', 'On');
// ini_set('error_log', '/path/to/php_errors.log');

ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
dbConnect();
forceLogin();

$userID = $_SESSION["user_id"];

// $sql = "SELECT * FROM current_project WHERE users_id=$userID AND current_state='current'";
//     $result = $_SESSION["conn"]->query($sql);
//     $project = $result->fetch_assoc();

//     echo $result;
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
    <title>New Project</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/newProject.css">
    <link rel="website icon" type="webp" href="images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <!-- //* NAVIGATION FOR BOTH MOBILE AND DESKTOP--> 
    <header>
        <?php makeNav() ?>
    </header>
    <div class="archive-warning hide">
        <h3>You already have a maximum of 5 projects in progress. Click 
            <a href="archives.php">here</a> to archive one.</h3>
    </div>
    <div class="new-project-wrapper">
        <h1>Create a New Project</h1>
        <div class="new-project-container">
            <form method="post" action="create-newProject.php" name="createNewProject">
                <div class="input-section">
                    <label for="title">Title</label>
                    <input class="input" type="text" name="title" id="title"
                        placeholder="Awesome Title">
                    <label for="genre">Genre</label>
                    <select class="input" name="genre" id="genre" onchange="switchImage();">
                        <option name="placeholder" id="placeholder" value="0">Choose your genre</option>
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
                        <option name="nonfiction" id="nonfiction" value="12">Nonfiction</option>
                        <option name="personal" id="personal" value="13">Personal</option>
                        <option name="religious" id="religious" value="14">Religious/Spiritual</option>
                        <option name="romance" id="romance" value="15">Romance</option>
                        <option name="scifi" id="scifi" value="16">Sci-Fi</option>
                        <option name="thriller" id="thriller" value="17">Thriller</option>
                        <option name="ya" id="ya" value="18">Young Adult</option>
                        <option name="childrens" id="childrens" value="19">Young Readers</option>
                    </select>
                    <label for="goalNumber">Goal Number</label>
                    <input class="input" type="text" name="goalNumber" id="goalNumber" pattern="^\d+(,\d+)?$"
                        placeholder="50,000">
                    <label for="endDate">End Date</label>
                    <input class="input" type="date" name="endDate" id="endDate" onchange="findDailyGoal()">
                        <div class="checkbox-wrapper">
                            <label class="noEndDate" for="noEndDate">Check this box if you don't want to set an end date</label>
                            <input class="input" type="checkbox" name="noEndDate" id="noEndDate" onclick="noDate()">
                        </div>
                    <span id="recommend"></span>
                    <label for="dailyGoal">Daily Goal</label>
                    <input class="input" type="text" name="dailyGoal" id="dailyGoal" pattern="^\d+(,\d+)?$"
                        placeholder="100 (you can leave me blank)">
                    <label class="summary" for="summary">Summary</label>
                    <textarea class="summary input" name="summary" id="summary" maxlength="500"
                        placeholder="Tell the world about your awesome project (max: 500 characters)"></textarea>
                </div>
                <div class="preview-section">
                    <h1>Preview</h1>
                    <img class="preview-image" id="preview-image" src="images/genre-covers/placeholder(v3).webp" name="genrePreview">
                    <h2 id="preview-title"></h2>
                    <div class="grid-item">
                        <h3>Total:</h3>
                        <div>
                            <span>0 / </span><span id="preview-goal"></span>
                        </div>
                    </div>
                    <div class="grid-item" id="preview-date-wrapper">
                        <h3>Due on:</h3>
                        <span id="preview-date"></span>
                    </div>
                    <div class="grid-item">
                        <h3>Average:</h3>
                        <span id="preview-daily"></span>
                    </div>
                    <div class="grid-item">
                        <h3>Summary:</h3>
                        <span id="preview-summary"></span>
                    </div>
                </div>
                <div class="button">
                    <a id="cancel" onclick="goBack()">Cancel</a>
                    <input type="submit" value="Looks Good" id="submit">
                </div>
            </form>
        </div>
    </div>
    <!-- //* FOOTER-->
    <!-- //! Keep link to logo artist for permission to use-->
    <?php makeFooter() ?>
<script>
    function goBack() {
        history.go(-1);
    }
    //* Disables the date input and hides due date in preview area
    function noDate() {
        var checkBox = document.getElementById("noEndDate");

        if (checkBox.checked == true) {
            document.getElementById("endDate").disabled = true;
            document.getElementById("endDate").value = "";

            var previewDateWrapper = document.getElementById("preview-date-wrapper");
            previewDateWrapper.classList.add("hide");
        } else if (checkBox.checked == false) {
            document.getElementById("endDate").disabled = false;

            var previewDateWrapper = document.getElementById("preview-date-wrapper");
            previewDateWrapper.classList.remove("hide");
        }
        var dailyGoal = parseInt(document.getElementById("dailyGoal").value);
        var goal = parseInt(document.getElementById("goalNumber").value);
        var recommendation = Math.floor(goal / dailyGoal);
        document.getElementById("recommend").innerHTML = "Recommended number: " + recommendation;
    }

    //* sends data to math php file to find average daily word count
    function findDailyGoal(){
        var goal=document.getElementById( "goalNumber" ).value;
        var newGoal = goal.replace(/,/g,"");
        var goalDate=document.getElementById( "endDate" ).value;
        
        if(goalDate){
            $.ajax({
            type: 'post',
            url: 'php-processes/math',
            data: {
                newGoal: newGoal,
                goalDate: goalDate,
            },
            success: function (data) {
                $( '#recommend' ).html(data);
            }
            });
        }
        else{
            $( '#recommend' ).html("");
            console.log("Something went wrong")
            return false;
        }
    }

    //* ajax for preview area updating
    $(document).ready(function(){
        //* Title
        $("#title").keyup(function(){
            // Getting the current value of input
            var currentText = $(this).val();		
            // Setting the Span content
            $("#preview-title").text(currentText);
        });

        //* Goal Number
        $("#goalNumber").keyup(function(){
            // Getting the current value of input
            var currentText = $(this).val();		
            // Setting the Span content
            $("#preview-goal").text(currentText);
        });

        //* Goal Number
        $("#dailyGoal").keyup(function(){
            // Getting the current value of input
            var currentText = $(this).val();		
            // Setting the Span content
            $("#preview-daily").text(currentText);
        });

        //* End Date
        $("#endDate").change(function(){
            // Getting the current value of input	
            var currentText = $(this).val();
            var date = new Date(currentText).toLocaleDateString('en-US');		
            // Setting the Span content
            $("#preview-date").text(date);
        });
        
        //* Summary
        $("#summary").keyup(function(){
            // Getting the current value of input
            var currentText = $(this).val();		
            // Setting the Span content
            $("#preview-summary").text(currentText);
        });
    });
</script>
</body>
</html>