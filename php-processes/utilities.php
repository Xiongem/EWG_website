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


//* NAV MENU-BAR
function makeNav() {
//* User is logged in and has the hydra slayer badge
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["overlay"] == "unlocked") {
        $pfp_set = $_SESSION["pfp"];
        $username = $_SESSION["username"];
            $htmlContent = <<<HTML
            <div class="logo">
                <img src="images/comp-cat-beta.webp" alt="cat using computer logo">
        </div>
        <nav>
        <!-- //* DESKTOP NAVIGATION--> 
            <div class="nav-bar">
                <div class="desktop-navContent">
                    <a href="index.php">Home</a>
                    <div class="projects-container">
                        <a>Projects</a>
                        <!-- //* Projects dropdown-->
                        <div class="projects-dropdown"> 
                            <a href="newProject.php">Create New Project</a>
                            <a href="archives.php">Current/Past Projects</a>
                        </div>
                    </div>
                    <a href="announcements.php">News</a>
                    <a href="about.php">About</a>
                    <div class="desktop-user" id="user-logged-in">
                        <div class="pfp-wrapper">
                            <img id="pfp-overlay" src="images/hydra-slayer-overlay.webp">
                            <img id="pfp" src="$pfp_set" alt="user profile picture">
                        </div>
                        <!-- //* User Dropdown-->
                        <div class="user-content"> 
                            <a href="profile.php?name=$username">Profile <i class="fa fa-user" id="profile-icon" alt="profile icon"></i></a>
                            <a href="settings.php">Settings <i class="fa fa-gear" id="setting-icon" alt="setting icon"></i></a>
                            <a href="php-processes/logout.php">Logout <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
            <!-- //* MOBILE NAVIGATION-->
                <div class="mobileNav" id="mobileNav">
                    <div class="menu-icon-wrapper">
                        <div id="menu-bar-1" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                    </div>
                    <!-- //* Dropdown-->
                    <div class="navMenu slide-right close" id="navMenu"> 
                        <div class="navContent">
                            <a href="index.php">Home 
                                <i class="fa fa-home" id="home-icon" alt="home icon"></i></a>
                            <div class="projects">
                                <a href="newProject.php">New Project 
                                    <i class="fa fa-plus" id="new-project-icon" alt="plus symbol icon"></i></a>
                                <a href="archives.php">Archive 
                                    <i class="fa fa-bookmark" id="bookmark-icon" alt="bookmark icon"></i></a>
                            </div>
                            <a href="announcements.php">News
                                <i class="fa fa-bullhorn" id="announcements-icon" alt="megaphone icon"></i></a>
                            <a href="about.php">About 
                                <i class="fa fa-question" id="about-icon" alt="question mark icon"></i></a>
                            <a href="settings.php">Settings 
                                <i class="fa fa-gear" id="setting-icon" alt="gear icon"></i></a>
                            <a href="php-processes/logout.php" id="login-link">Logout 
                                <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
                <div class="user" id="user">
                    <a href="profile.php?name=$username">
                        <div class="pfp-wrapper">
                            <img id="pfp-overlay" class="pfp-overlay" src="images/hydra-slayer-overlay.webp">
                            <img id="pfp" src="$pfp_set" alt="user profile picture">
                        </div>
                    </a>
                </div>
            </div>
        </nav>
        HTML;
            echo $htmlContent;
//* User is logged in but hydra slayer badge is locked
} elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && $_SESSION["overlay"] == "locked"){
    $pfp_set = $_SESSION["pfp"];
    $username = $_SESSION["username"];
        $htmlContent = <<<HTML
        <div class="logo">
                <img src="images/comp-cat-beta.webp" alt="cat using computer logo">
        </div>
        <nav>
        <!-- //* DESKTOP NAVIGATION--> 
            <div class="nav-bar">
                <div class="desktop-navContent">
                    <a href="index.php">Home</a>
                    <div class="projects-container">
                        <a>Projects</a>
                        <!-- //* Projects dropdown-->
                        <div class="projects-dropdown"> 
                            <a href="newProject.php">Create New Project</a>
                            <a href="archives.php">Current/Past Projects</a>
                        </div>
                    </div>
                    <a href="announcements.php">News</a>
                    <a href="about.php">About</a>
                    <div class="desktop-user" id="user-logged-in">
                        <img src="$pfp_set" alt="user profile picture">
                        <!-- //* User Dropdown-->
                        <div class="user-content"> 
                            <a href="profile.php?name=$username">Profile <i class="fa fa-user" id="profile-icon" alt="profile icon"></i></a>
                            <a href="settings.php">Settings <i class="fa fa-gear" id="setting-icon" alt="setting icon"></i></a>
                            <a href="php-processes/logout.php">Logout <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
            <!-- //* MOBILE NAVIGATION-->
                <div class="mobileNav" id="mobileNav">
                    <div class="menu-icon-wrapper">
                        <div id="menu-bar-1" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                    </div>
                    <!-- //* Dropdown-->
                    <div class="navMenu slide-right close" id="navMenu"> 
                        <div class="navContent">
                            <a href="index.php">Home 
                                <i class="fa fa-home" id="home-icon" alt="home icon"></i></a>
                            <div class="projects">
                                <a href="newProject.php">New Project 
                                    <i class="fa fa-plus" id="new-project-icon" alt="plus symbol icon"></i></a>
                                <a href="archives.php">Archive 
                                    <i class="fa fa-bookmark" id="bookmark-icon" alt="bookmark icon"></i></a>
                            </div>
                            <a href="announcements.php">News
                                <i class="fa fa-bullhorn" id="announcements-icon" alt="megaphone icon"></i></a>
                            <a href="about.php">About 
                                <i class="fa fa-question" id="about-icon" alt="question mark icon"></i></a>
                            <a href="settings.php">Settings 
                                <i class="fa fa-gear" id="setting-icon" alt="gear icon"></i></a>
                            <a href="php-processes/logout.php" id="login-link">Logout 
                                <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
                <div class="user" id="user">
                    <a href="profile.php?name=$username"><img src="$pfp_set" alt="user profile picture"></a>
                </div>
            </div>
        </nav>
    HTML;
        echo $htmlContent;
//* User is logged in but nothing is in the database about the hydra slayer badge
} elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $pfp_set = $_SESSION["pfp"];
    $username = $_SESSION["username"];
        $htmlContent = <<<HTML
        <div class="logo">
                <img src="images/comp-cat-beta.webp" alt="cat using computer logo">
        </div>
        <nav>
        <!-- //* DESKTOP NAVIGATION--> 
            <div class="nav-bar">
                <div class="desktop-navContent">
                    <a href="index.php">Home</a>
                    <div class="projects-container">
                        <a>Projects</a>
                        <!-- //* Projects dropdown-->
                        <div class="projects-dropdown"> 
                            <a href="newProject.php">Create New Project</a>
                            <a href="archives.php">Current/Past Projects</a>
                        </div>
                    </div>
                    <a href="announcements.php">News</a>
                    <a href="about.php">About</a>
                    <div class="desktop-user" id="user-logged-in">
                        <img src="$pfp_set" alt="user profile picture">
                        <!-- //* User Dropdown-->
                        <div class="user-content"> 
                            <a href="profile.php?name=$username">Profile <i class="fa fa-user" id="profile-icon" alt="profile icon"></i></a>
                            <a href="settings.php">Settings <i class="fa fa-gear" id="setting-icon" alt="setting icon"></i></a>
                            <a href="php-processes/logout.php">Logout <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
            <!-- //* MOBILE NAVIGATION-->
                <div class="mobileNav" id="mobileNav">
                    <div class="menu-icon-wrapper">
                        <div id="menu-bar-1" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                    </div>
                    <!-- //* Dropdown-->
                    <div class="navMenu slide-right close" id="navMenu"> 
                        <div class="navContent">
                            <a href="index.php">Home 
                                <i class="fa fa-home" id="home-icon" alt="home icon"></i></a>
                            <div class="projects">
                                <a href="newProject.php">New Project 
                                    <i class="fa fa-plus" id="new-project-icon" alt="plus symbol icon"></i></a>
                                <a href="archives.php">Archive 
                                    <i class="fa fa-bookmark" id="bookmark-icon" alt="bookmark icon"></i></a>
                            </div>
                            <a href="announcements.php">News
                                <i class="fa fa-bullhorn" id="announcements-icon" alt="megaphone icon"></i></a>
                            <a href="about.php">About 
                                <i class="fa fa-question" id="about-icon" alt="question mark icon"></i></a>
                            <a href="settings.php">Settings 
                                <i class="fa fa-gear" id="setting-icon" alt="gear icon"></i></a>
                            <a href="php-processes/logout.php" id="login-link">Logout 
                                <i class="fa fa-sign-out" id="logout-icon" alt="logout icon"></i></a>
                        </div>
                    </div>
                </div>
                <div class="user" id="user">
                    <a href="profile.php?name=$username"><img src="$pfp_set" alt="user profile picture"></a>
                </div>
            </div>
        </nav>
    HTML;
        echo $htmlContent;
//* User is not logged in
} else {
    $htmlContent = <<<HTML
        <div class="logo">
                <img src="../images/comp-cat-beta.webp" alt="cat using computer logo">
        </div>
        <nav>
        <!-- //* DESKTOP NAVIGATION--> 
            <div class="nav-bar"> 
                <div class="desktop-navContent">
                    <a href="index.php">Home</a>
                    <a href="announcements.php">News</a>
                    <a href="about.php">About</a>
                    <div class="desktop-user" id="user-not-logged-in">
                        <a href="login.php" id="login">Login</a>
                    </div>
                </div>
            <!-- //* MOBILE NAVIGATION-->
                <div class="mobileNav" id="mobileNav">
                    <div class="menu-icon-wrapper">
                        <div id="menu-bar-1" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                        <div id="menu-bar-3" class="menu-bar"></div>
                    </div>
                    <!-- //* Dropdown-->
                    <div class="navMenu slide-right close" id="navMenu"> 
                        <div class="navContent">
                            <a href="index.php">Home 
                                <i class="fa fa-home" id="home-icon" alt="home icon"></i></a>
                            <a href="announcements.php">News
                                <i class="fa fa-bullhorn" id="announcements-icon" alt="megaphone icon"></i></a>
                            <a href="about.php">About 
                                <i class="fa fa-question" id="about-icon" alt="question mark icon"></i></a>
                        </div>
                    </div>
                </div>
                <div class="user" id="user">
                    <a href="login.php"><h2>Login</h2></a>
                </div>
            </div>
        </nav>
    HTML;
        echo $htmlContent;
    }
}


//* FOOTER
//Make sure to keep the credit to Kohaku for the use of the cat computer logo
function makeFooter() {
    $todayDate = date("Y");
        $htmlContent = <<<HTML
            <footer id="footer">
                <p id="copyright">&copy;$todayDate. All rights reserved.</p>
                <p id="logo-link">Logo by <a href="https://kohacu.com/20181205post-22321/">Kohaku!</a></p>
                <p id="contact"><a href="contact.php">Contact Us</a></p>
            </footer>
        HTML;
            echo $htmlContent;
}