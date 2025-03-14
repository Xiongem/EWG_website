<?php
ob_start();
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();

$userID = htmlspecialchars($_SESSION["user_id"]);

$sql = "SELECT * FROM current_project WHERE users_id=$userID AND current_state='current'";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $genre = $user["genre"];
    $title = $user["title"];
    $info = $user["info"];
    $current_count = $user["current_count"];
    $goal = $user["goal"];
    $date = $user["goal_date"];
    $current_state = "current";
    $daily = $user["daily_goal"];

    if ($date == "0000-00-00"){
        $dateGoal = 0;
    } else {
        $dailyGoal = $user["goal_date"];
    }
switch ($genre) {
    case '1':
        $realGenre = "Adventure";
        break;
    case '2':
        $realGenre = "Erotica";
        break;
    case '3':
        $realGenre = "Fanfiction";
        break;
    case '4':
        $realGenre = "Fantasy";
        break;
    case '5':
        $realGenre = "Historical";
        break;
    case '6':
        $realGenre = "Horror";
        break;
    case '7':
        $realGenre = "Humor";
        break;
    case '8':
        $realGenre = "LGBTQ+";
        break;
    case '9':
        $realGenre = "Literary";
        break;
    case '10':
        $realGenre = "Musical";
        break;
    case '11':
        $realGenre = "Mystery";
        break;
    case '12':
        $realGenre = "Personal";
        break;
    case '13':
        $realGenre = "Religious/Spiritual";
        break;
    case '14':
        $realGenre = "Romance";
        break;
    case '15':
        $realGenre = "Sci-Fi";
        break;
    case '16':
        $realGenre = "Thriller";
        break;
    case '17':
        $realGenre = "Young Adult";
        break;
    case '18':
        $realGenre = "Young Readers";
        break;
    default:
      echo "Something went wrong";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index.html">
    <title>EWG Update Current Project</title>
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
            <h1>Update Your Project</h1>
                <div class="stuff">
                    <div class="info-contain">
                        <div class="title-content">
            <form method="post" action="php-processes/process-updateProject" name="createNewProject">
                            <label for="title">Title:</label>
                            <input type="text" id="new-project-title" value="<?=$title?>" name="newProjectTitle">
                        </div>
                        <p>Make sure to reselect the correct genre</p>
                            <div class="genre-content">
                                <label for="genre">Genre:</label>
                                <select id="new-project-genre" name="switch" onchange="switchImage();">
                                    <script>
                                        var select = document.getElementById('new-project-genre');
                                        var option;
                                        var genre = <?=$genre?>;
                                        for (var i=0; i<select.options.length; i++) {
                                            option = select.options[i];
                                            if (option.value === genre){
                                                // option.setAttribute('selected', true);
                                                option.selected = true;
                                        }}
                                        // document.querySelector('.genre')

                                        console.log(genre)
                                        
                                    </script>
                                    <option class="genre" name="adventure" id="adventure" value="1">Adventure</option>
                                    <option class="genre" name="erotica" id="erotica" value="2">Erotica</option>
                                    <option class="genre" name="fanfiction" id="fanfiction" value="3">Fanfiction</option>
                                    <option class="genre" name="fantasy" id="fantasy" value="4">Fantasy</option>
                                    <option class="genre" name="historical" id="historical" value="5">Historical</option>
                                    <option class="genre" name="horror" id="horror" value="6">Horror</option>
                                    <option class="genre" name="humor" id="humor" value="7">Humor</option>
                                    <option class="genre" name="lgbt" id="lgbt" value="8">LGBTQ+</option>
                                    <option class="genre" name="literary" id="literary" value="9">Literary</option>
                                    <option class="genre" name="musical" id="musical" value="10">Musical</option>
                                    <option class="genre" name="mystery" id="mystery" value="11">Mystery</option>
                                    <option class="genre" name="personal" id="personal" value="12">Personal</option>
                                    <option class="genre" name="religious" id="religious" value="13">Religious/Spiritual</option>
                                    <option class="genre" name="romance" id="romance" value="14">Romance</option>
                                    <option class="genre" name="scifi" id="scifi" value="15">Sci-Fi</option>
                                    <option class="genre" name="thriller" id="thriller" value="16">Thriller</option>
                                    <option class="genre" name="ya" id="ya" value="17">Young Adult</option>
                                    <option class="genre" name="childrens" id="childrens" value="18">Young Readers</option>
                                </select>
                            </div>
                            <div  id="advice">
                                <p>Previous Genre: <?=$realGenre?></p>
                            </div>
                        <div class="goal_num">
                            <label>Goal number:</label>
                            <input name="goal" id="goal" type="number" value="<?=$goal?>">
                        </div>
                        <div class="goal_end">
                            <label>End Date:</label>
                            <input name="goal_date" id="goal_date" type="date" value="<?=$date?>">
                        </div>
                        <label for="no-goal_date" class="container no-goal_date">Check the box if you don't want to set a goal date
                            <input type="checkbox" id="no-goal_date" name="no-goal_date" onclick="noDate()">
                            <span class="checkmark"></span>
                        </label>
                        <div class="daily_goal">
                            <div class="daily-contain">
                                <label for="daily_goal">Daily Goal:</label><br>
                                <input type="number" name="daily_goal" id="daily_goal" value="<?=$daily?>">
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
                        <textarea id="about-info" value="<?=$info?>" type="textarea" name="info" maxlength="750"><?=$info?></textarea>
                    </div>
                    <button id="np-submit">Save</button>
            </form>
        </div>
    </div>
    <?php makeFooter() ?>
    <script>
    var userGenre = <?=$genre?>;
    switch (userGenre) {
        case '1':
            var selectedGenre = document.getElementById('adventure');
            selectedGenre.selected = true;
            break;
        case '2':
            var selectedGenre = document.getElementById('erotica');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '3':
            var selectedGenre = document.getElementById('fanfiction');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '4':
            var selectedGenre = document.getElementById('fantasy');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '5':
            var selectedGenre = document.getElementById('historical');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '6':
            var selectedGenre = document.getElementById('horror');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '7':
            var selectedGenre = document.getElementById('humor');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '8':
            var selectedGenre = document.getElementById('lgbt');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '9':
            var selectedGenre = document.getElementById('literary');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '10':
            var selectedGenre = document.getElementById('musical');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '11':
            var selectedGenre = document.getElementById('mystery');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '12':
            var selectedGenre = document.getElementById('personal');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '13':
            var selectedGenre = document.getElementById('religious');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '14':
            var selectedGenre = document.getElementById('romance');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '15':
            var selectedGenre = document.getElementById('scifi');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '16':
            var selectedGenre = document.getElementById('thriller');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '17':
            var selectedGenre = document.getElementById('ya');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        case '18':
            var selectedGenre = document.getElementById('childrens');
            // selectedGenre.selected = true;
            selectedGenre.setAttribute('selected', true);
            break;
        default:
            console.log("something went wrong")
            break;
    }

    
    var dateGoal = <?=$dateGoal?>;
    if (dateGoal == 0) {
        document.getElementById("no-goal_date").checked = true;
        document.getElementById("goal_date").disabled = true;
        document.getElementById("goal_date").value = 0000-00-00;
    }

    function noDate() {
        var checkBox = document.getElementById("no-goal_date");
        var test = document.getElementById("test");

        if (checkBox.checked == true) {
            document.getElementById("goal_date").disabled = true;
            document.getElementById("goal_date").value = 0000-00-00;
        } else if (checkBox.checked == false) {
            document.getElementById("goal_date").disabled = false;
        }
    }
</script>
</body>
</html>