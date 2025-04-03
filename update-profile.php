<?php
//DB connection
require($_SERVER['DOCUMENT_ROOT'] . '/php-processes/utilities.php');
forceLogin();
dbConnect();
//assigns the user's id for all the sql
$userID = htmlspecialchars($_SESSION["user_id"]);
$username = $_SESSION["username"];
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
        <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.svg"> 
        <meta property="og:url" content="http://www.elsewherewriters.com/index">
        <title>Choose pfp</title>
        <link rel="stylesheet" href="css/EWG_theme.css">
        <link rel="stylesheet" href="css/choose-pfp_theme.css">
        <link rel="website icon" type="svg" href="images\comp-cat-beta.svg">
        <script src="javascript/script.js"></script>
        <!-- <script src="javascript/pfpChange.js"></script>
        <script src="javascript/ajax.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->
    </head>
<body>
    <div class="chooses-pfp-container">
        <div class="chooses-pfp-contents">
            <h1>1. Choose an Image</h1>
            <div class="badge-rows-pfp" id="row1">
            </div>
            <h1>2. Choose a Color</h1>
            <div class="badge-rows-pfp" id="row2">
            </div>
            <h1>3. Submit to Confirm</h1>
            <div class="badge-rows-pfp" id="row3" style="justify-content: center;">
            </div>
            <div>
                <form action="php-processes/choose-pfp" method="post">
                    <div class="hidden-form">
                        <input type="text" name="choose-pfp" id="choose-pfp">
                    </div>
                    <button type="submit" class="submit" name="pfp" id="choose-pfp">Submit</button>
                </form>
            </div> 
        </div>
    </div>
    <script>
        const domainAndImagePath = "images/";
        const reference_bit = "reference/";
        const svgExtension = ".svg";
        const colorPrefix = "color-";

        const sources = [
            "book-n-quill",
            "daggers",
            "dragon",
            "drama",
            "fire",
            "hammer",
            "knife",
            "mace",
            "raven",
            "shield",
            "sword",
            "tools",
            "typewriter",
            "wand"
        ];

        for (var i = 0; i < sources.length; i++) {
            var element = document.createElement("img");
            element.setAttribute("id", sources[i]);
            element.setAttribute("class", "badge-pfp");
            element.setAttribute("src", domainAndImagePath + reference_bit + sources[i] + svgExtension);
            element.addEventListener("click", function (event) {
                while (row2.firstChild) {
                    row2.removeChild(row2.firstChild);
                }
                var id = event.target.id;
                for (var i = 0; i < 35; i++) {//TODO remove magic number
                    var element1 = document.createElement("img");
                    element1.setAttribute("id", colorPrefix + i);
                    element1.setAttribute("class", "badge-pfp");
                    element1.setAttribute("src", domainAndImagePath + id + "/" + id +  i + ".svg");
                    element1.addEventListener("click", function (event) {
                        while (row3.firstChild) {
                            row3.removeChild(row3.firstChild);
                        }
                        var index = event.target.id.slice(6, 100);//assumes that you don't have a LOT of color indices
                        var element2 = document.createElement("img");
                        element2.setAttribute("id", id + "-" + index);
                        element2.setAttribute("class", "badge-pfp");
                        element2.setAttribute("src", domainAndImagePath + id + "/" + id + index + ".svg");
                        console.log(element2.src);
                        document.getElementById("choose-pfp").value = element2.src;
                        // element2.addEventListener("click", function (event) {
                        //     //TODO save to database and push to a different page
                        //     console.log("image is " + id + " and color is " + index);
                        //     console.log(element2.src)
                        //     document.getElementById("choose-pfp").value = element2.src;
                        // });
                        row3.appendChild(element2);
                    });
                    row2.appendChild(element1);
                }
            });
            row1.appendChild(element);
        }
    </script>


</body>

</html>