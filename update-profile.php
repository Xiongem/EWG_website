<?php
//DB connection
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();
//assigns the user's id for all the sql
$userID = htmlspecialchars($_SESSION["user_id"]);
//echos the user's profile data
$sql = "SELECT * FROM users WHERE id=$userID";
$result = $_SESSION["conn"]->query($sql);
$user = $result->fetch_assoc();
    $username = $user["username"];
    $bio = $user["bio"];
    $fav1 = $user["fav-1"];
    $fav2 = $user["fav-2"];
    $fav3 = $user["fav-3"];
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://elsewherewriters.com/images/comp-cat-beta.png"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/index">
    <title>Update Profile</title>
    <link rel="stylesheet" href="css/EWG_theme.css">
    <link rel="stylesheet" href="css/profile-create_theme.css">
    <link rel="website icon" type="png" href="images\comp-cat.png">
    <script src="javascript/script.js"></script>
</head>
<body>
    <div class="create-container">
        <div class="create-content">
            <h1>Update Your Profile</h1>
            <form action="php-processes/process-updateProfile" method="post" id="profileCreation">
                <label for="bio">Bio: Tell everyone a little about yourself</label><br>
                <textarea name="bio" id="bio" minlength="1" maxlength="300" placeholder="Max Length: 300"><?=$bio?></textarea><br>
                <label for="favs">Favorites: What are your favorite books or authors?</label><br>
                <div class="fav-container">
                    <div class="fav-content">
                        <label for="fav-1">1</label>
                        <textarea class="favs" name="fav-1" id="fav-1" minlength="1" maxlength="100"><?=$fav1?></textarea><br>
                    </div>
                    <div class="fav-content">
                        <label for="fav-2">2</label>
                        <textarea class="favs" name="fav-2" id="fav-2" minlength="1" maxlength="100"><?=$fav2?></textarea><br>
                    </div>
                    <div class="fav-content">
                        <label for="fav-3">3</label>
                        <textarea class="favs" name="fav-3" id="fav-3" minlength="1" maxlength="100"><?=$fav3?></textarea><br>
                    </div>
                </div>
                <div class="buttons">
                    <a href="profile.php" class="cancel-button">
                        <div class="cancel">
                            Cancel
                        </div>
                    </a>
                    <button type="submit" value="Submit" id="profile-create-button">Update</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>