<?php
session_start();
function dbConnect() {
    $servername = "localhost";
    $database = "u792691800_ewg_data";
    $username = "u792691800_Xiongem97";
    $password = "Hi5gem97*";
    $_SESSION["conn"] = mysqli_connect($servername, $username, $password, $database);
    if (!$_SESSION["conn"]) {die("Connection failed: " . mysqli_connect_error()); }
}

function forceLogin() {
//    echo("forceLogin start"."<br>");
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
//    echo "Welcome to the member's area, " . htmlspecialchars($_SESSION["user_id"]) . "!";
    } else {
        echo ("redirecting");
        header("Location: /login.php");
        exit();
    }
}

function makeDropDown() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["overlay"] == "images/badges/hydra-slayer-color.png") {
        $pfp_set = $_SESSION["pfp"];
        $htmlContent = <<<HTML
        <div class="dropdown drop">
            <div class="fuck-you drop" onclick="myFunction()">
                <img id="pfp-overlay" class="pfp-overlay pfp drop"src="images/hydra-slayer-overlay.png">
                <img id="pfp" src="$pfp_set" alt="profile-picture-icon"  class="dropbtn dropbutn drop">
                        <div id="myDropdown" class="dropdown-content dropdown-contents">
                        <a href="profile.php">Profile <img class="drpdwn-icon" id="profile-icon" src="images\user.png"></a>
                        <a href="settings.php">Settings <img class="drpdwn-icon" id="setting-icon" src="images\settings.png"></a>
                        <a href="php-processes/logout.php">Logout <img class="drpdwn-icon" id="logout-icon" src="images\logout.png"></a>
                    </div>
            </div>
        </div>
        <!-- <script>
            window.addEventListener('load', function() {
          // wait until the page loads before working with HTML elements
          document.addEventListener('click', function(event) {
            //click listener on the document
            document.querySelectorAll('.dropdown-contents').forEach(function(el) {
              if (el !== event.target) el.classList.remove('show')
              // close any showing dropdown that isn't the one just clicked
            });
            if (event.target.matches('.dropbtn')) {
              event.target.closest('.dropdown').querySelector('.dropdown-contents').classList.toggle('show')
            }
            // if this is a dropdown button being clicked, toggle the show class
          })
        })
        </script> -->
    HTML;
        echo $htmlContent;
} elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["overlay"] == "images/badges/hydra-slayer-mono.png"){
    $pfp_set = $_SESSION["pfp"];
        $htmlContent = <<<HTML
        <div class="dropdown drop">
            <div class="fuck-you" onclick="myFunction()">
                <img id="pfp" src="$pfp_set" alt="profile-picture-icon"  class="dropbtn dropbutn">
                        <div id="myDropdown" class="dropdown-content dropdown-contents">
                        <a href="profile.php">Profile <img class="drpdwn-icon" id="profile-icon" src="images\user.png"></a>
                        <a href="settings.php">Settings <img class="drpdwn-icon" id="setting-icon" src="images\settings.png"></a>
                        <a href="php-processes/logout.php">Logout <img class="drpdwn-icon" id="logout-icon" src="images\logout.png"></a>
                    </div>
            </div>
        </div>
        <!-- <script>
            window.addEventListener('load', function() {
          // wait until the page loads before working with HTML elements
          document.addEventListener('click', function(event) {
            //click listener on the document
            document.querySelectorAll('.dropdown-contents').forEach(function(el) {
              if (el !== event.target) el.classList.remove('show')
              // close any showing dropdown that isn't the one just clicked
            });
            if (event.target.matches('.dropbutn')) {
              event.target.closest('.drop').querySelector('.dropdown-contents').classList.toggle('show')
            }
            // if this is a dropdown button being clicked, toggle the show class
          })
        })
        </script> -->
    HTML;
        echo $htmlContent;
        
} elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $pfp_set = $_SESSION["pfp"];
        $htmlContent = <<<HTML
        <div class="dropdown drop">
            <div class="fuck-you" onclick="myFunction()">
                <img id="pfp" src="$pfp_set" alt="profile-picture-icon"  class="dropbtn dropbutn">
                        <div id="myDropdown" class="dropdown-content dropdown-contents">
                        <a href="profile.php">Profile <img class="drpdwn-icon" id="profile-icon" src="images\user.png"></a>
                        <a href="settings.php">Settings <img class="drpdwn-icon" id="setting-icon" src="images\settings.png"></a>
                        <a href="php-processes/logout.php">Logout <img class="drpdwn-icon" id="logout-icon" src="images\logout.png"></a>
                    </div>
            </div>
        </div>
        <!-- <script>
            window.addEventListener('load', function() {
          // wait until the page loads before working with HTML elements
          document.addEventListener('click', function(event) {
            //click listener on the document
            document.querySelectorAll('.dropdown-contents').forEach(function(el) {
              if (el !== event.target) el.classList.remove('show')
              // close any showing dropdown that isn't the one just clicked
            });
            if (event.target.matches('.drop')) {
              event.target.closest('.drop').querySelector('.dropdown-contents').classList.toggle('show')
            }
            // if this is a dropdown button being clicked, toggle the show class
          })
        })
        </script> -->
    HTML;
        echo $htmlContent;
    } else {
    echo "";
    }
}

function makeNav() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $htmlContent = <<<HTML
        <div class="logo">
            <img src="images/comp-cat-beta.png" alt="cat-using-computer">
        </div>
        <nav class="nav-menu">
            <a href="index.php">Home</a>
            <div class="dropdown2 drop">
                <a href="#" onclick="myFunction2()" class="dropbtn2 dropbutn drop">Projects</a>
                    <div id="myDropdown2" class="dropdown-content2 dropdown-contents">
                        <a href="new-project.php">Create New<br>Project <img class="drpdwn-icon2" id="new-icon" src="images\add.png"></a>
                        <a href="projects.php">Current/Past<br>Projects <img class="drpdwn-icon2" id="project-icon" src="images\writing.png"></a>
                    </div>
            </div> 
            <a href="announcements.php">Announcements</a>
            <a href="about.php">About</a>
        </nav>
        <!-- <script>
            window.addEventListener('load', function() {
          // wait until the page loads before working with HTML elements
          document.addEventListener('click', function(event) {
            //click listener on the document
            document.querySelectorAll('.dropdown-contents').forEach(function(el) {
              if (el !== event.target) el.classList.remove('show')
              // close any showing dropdown that isn't the one just clicked
            });
            if (event.target.matches('.drop')) {
              event.target.closest('.drop').querySelector('.dropdown-contents').classList.toggle('show')
            }
            // if this is a dropdown button being clicked, toggle the show class
          })
        })
        </script> -->
    HTML;
        echo $htmlContent;
    } else {
        $htmlContent = <<<HTML
        <div class="logo">
            <img src="images/comp-cat-beta.png" alt="cat-using-computer">
        </div>
        <nav class="nav-menu">
            <a href="index.php">Home</a> 
            <a href="announcements.php">Announcements</a>
            <a href="about.php">About</a>
            <a href="login.php" class="active">Login</a>
        </nav>
    HTML;
        echo $htmlContent;
    }
}

function makePopup() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        echo'';
    } else {
        $htmlContent = <<<HTML
            <div class="container">
            <div class="not-logged-in" id="not-logged-in">
                <p>Psst, hey you. 
                <br>
                If you already have an account just click the Login link above. 
                <br>    
                If you're new click <a href="account-create.html">here</a> to sign up and 
                    start earning badges!</p>
            </div>
        HTML;
            echo $htmlContent;
    }
}

function makeProgressBar(){
    $percentage = $_SESSION["percentage"];
    $progress = $_SESSION["progress"];
    $current_count = $_SESSION["current_count"];
    $goal = $_SESSION["goal"];
    $days = $_SESSION["days"];
    $daily = $_SESSION["daily"];
    //The user is logged in and has a genre set (a project exists)
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION["genre"])) {
        $htmlContent = <<<HTML
            <div class="pb-container">
                <div class="progress-bar" style="display: flex; justify-content: center;">
                    <h1>Project Progress</h1>
                    <div class="fuck-you">
                        <div class="percentage-bar">
                            <div id="project-pb" class="clickable" style="width: $progress%;" onclick="showProgressPopup()"></div>
                            <div class="percentage-text" id="percentage-text">
                                <p id='progress-percentage'>$percentage%</p>
                            </div>
                        </div> 
                    </div>
                        <div class="progress-container">
                            <div class="progress-container-left">
                                <h2>Current: $current_count</h2>
                            </div>
                            <div id="daysLeft" class="progress-container-middle">
                                <h2>Days Left: $days</h2>
                            </div>
                            <div class="progress-container-middle">
                                <h2>Daily Goal: $daily</h2>
                            </div>
                            <div class="progress-container-right">
                                <h2>Goal: $goal</h3>
                            </div>
                        </div>
                </div>
            </div>
        HTML;
            echo $htmlContent;
    //The user is logged in but has no genre set (no project exists)
    }elseif (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && empty($_SESSION["genre"])) {
        $htmlContent = <<<HTML
            <div class="pb-container">
            <div class="progress-bar" style="display: flex; justify-content: center;">
                <h1>Project Progress</h1>
                <div class="fuck-you">
                    <div class="percentage-bar">
                        <div id="project-pb" style="width: $progress%;"></div>
                        <div class="percentage-text" id="percentage-text">
                            <p id='progress-percentage'>$percentage%</p>
                        </div>
                    </div> 
                </div>
                    <div class="progress-container">
                        <div class="progress-container-left">
                            <h2>Current: $current_count</h2>"
                        </div>
                        <div id="daysLeft" class="progress-container-middle">
                            <h2>Days Left: $days</h2>
                        </div>
                        <div class="progress-container-middle">
                            <h2>Daily Goal: $daily</h2>
                        </div>
                        <div class="progress-container-right">
                            <h2>Goal: $goal</h3>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
            echo $htmlContent;
    //The user is not logged in
    }else {
        $htmlContent = <<<HTML
            <div class="pb-container">
            <div class="progress-bar" style="display: flex; justify-content: center;">
                <h1>Project Progress</h1>
                <div class="fuck-you">
                    <div class="percentage-bar">
                        <div id="project-pb" style="width: $progress%;"></div>
                        <div class="percentage-text" id="percentage-text">
                            <p id='progress-percentage'>$percentage%</p>
                        </div>
                    </div> 
                </div>
                    <div class="progress-container">
                        <div class="progress-container-left">
                            <h2>Current: $current_count</h2>"
                        </div>
                        <div id="daysLeft" class="progress-container-middle">
                            <h2>Days Left: $days</h2>
                        </div>
                        <div class="progress-container-middle">
                            <h2>Daily Goal: $daily</h2>
                        </div>
                        <div class="progress-container-right">
                            <h2>Goal: $goal</h3>
                        </div>
                    </div>
                </div>
            </div>
        HTML;
            echo $htmlContent;
    }
}

//Make sure to keep the credit to Kohaku for the use of the cat computer logo
function makeFooter() {
    $todayDate = date("Y");
        $htmlContent = <<<HTML
            <footer id="footer">
                <p id="copyright">&copy;$todayDate. All rights reserved.</p> <p>Logo by <a href="https://kohacu.com/20181205post-22321/">Kohaku!</a></p>
                    <p><a href="contact.php">Contact Us</a></p>
            </footer>
        HTML;
            echo $htmlContent;
}

function hidden() {
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
        $htmlContent = <<<HTML
            <div>
                <p id="updateBadges">Click <a href="profile.php">here</a> to update your badges!<br>There are many more where these came from.</p>
            </div>
        HTML;
            echo $htmlContent;
    } else {
        echo ('');
    }
}

function makeArchivedProjects() {
    $archived_genre_picture = $_SESSION["archived_genre_picture"];
    $archived_title = $_SESSION["archived_title"];
    $archived_info = $_SESSION["archived_info"];
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && isset($_SESSION["genre"])) {
        $htmlContent = <<<HTML
            <div class="fuck-you">
                <div class="prev-container">
                    <h1 class="projTitle">Previous Projects</h1>
                    <div class="prev-content">
                    <img src= $archived_genre_picture>
                        <h2>$archived_title</h2>
                        <p id='info'>$archived_info</p>
                    </div>
                </div>
            </div>
        HTML;
            echo $htmlContent;
    } else {
        $htmlContent = <<<HTML
            <div class="fuck-you">
                <div class="prev-container">
                    <h1 class="projTitle">Previous Projects</h1>
                    <div class="prev-content">
                    <img src= "images/genre-covers/placeholder.jpg">
                        <h2>Title</h2>
                        <p id='info'>Once you archived a current project, it will show up here!</p>
                    </div>
                </div>
            </div>
        HTML;
            echo $htmlContent;
    }
}
?>