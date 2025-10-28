<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="Elsewhere Writers Guild Official Website"> 
    <meta property="og:description" content="The official website for the Elsewhere Writers Guild, an alternative option to NaNoWriMo."> 
    <meta property="og:image" content="http://www.elsewherewriters.com/images/comp-cat-beta.webp"> 
    <meta property="og:url" content="http://www.elsewherewriters.com/choose-pfp">
    <title>Choose Profile Picture</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="website icon" type="webp" href="../images/comp-cat-beta.webp">
    <script src="js/scripts.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <div class="chooses-pfp-container">
        <div class="chooses-pfp-contents">
            <h1>1. Choose an Image</h1>
            <?php if ($_SESSION['pfpCreate'] === false): ?>
                <em class="required">Please select a profile picture</em>
            <?php endif; ?>
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
        const domainAndImagePath = "../images/";
        const reference_bit = "reference/";
        const webpExtension = ".webp";
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
            element.setAttribute("src", domainAndImagePath + reference_bit + sources[i] + webpExtension);
            element.addEventListener("click", function (event) {
                while (row2.firstChild) {
                    row2.removeChild(row2.firstChild);
                }
                var id = event.target.id;
                for (var i = 0; i < 35; i++) {//TODO remove magic number
                    var element1 = document.createElement("img");
                    element1.setAttribute("id", colorPrefix + i);
                    element1.setAttribute("class", "badge-pfp");
                    element1.setAttribute("src", domainAndImagePath + id + "/" + id + "-" + i + ".webp");
                    element1.addEventListener("click", function (event) {
                        while (row3.firstChild) {
                            row3.removeChild(row3.firstChild);
                        }
                        var index = event.target.id.slice(6, 100);//assumes that you don't have a LOT of color indices
                        var element2 = document.createElement("img");
                        element2.setAttribute("id", id + "-" + index);
                        element2.setAttribute("class", "badge-pfp");
                        element2.setAttribute("src", domainAndImagePath + id + "/" + id + "-" + index + ".webp");
                        console.log(element2.src);
                        document.getElementById("choose-pfp").value = element2.src;
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