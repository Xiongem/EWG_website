//adds a show password option
function showPassword() {
  var showPass = document.getElementById("pwd");
  var confirmPass = document.getElementById("confirm_pwd");
  if (showPass.type === "password") {
    showPass.type = "text";
    confirmPass.type = "text";
  } else {
    showPass.type = "password";
    confirmPass.type = "password";
  }
} 

//Switching Genre Covers on Dropdown Selection
var imageList = Array();
for (var i = 1; i <= 19; i++) {
    imageList[i] = new Image(70, 70);
    imageList[i].src = "images/genre-covers/genre-covers" + i + ".webp";
}
function switchImage() {
var selectedImage = document.createNewProject.genre.options[document.createNewProject.genre.selectedIndex].value;
document.genrePreview.src = imageList[selectedImage].src;
}

function findDailyGoal(){
    var goal=document.getElementById( "goal" ).value;
    var goalDate=document.getElementById( "goal_date" ).value;
    
    if(goalDate){
        $.ajax({
        type: 'post',
        url: 'php-processes/math',
        data: {
            goal: goal,
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
//sets the user color scheme
function setTheme(theme) {
  document.documentElement.className = theme;
  localStorage.setItem('theme', theme);
}
window.onload = function getTheme() {
  const theme = localStorage.getItem('theme');
  theme && setTheme(theme);
}
function showWarning() {
  document.getElementById("warning").style.display = "flex";
}
function hideWarning() {
  document.getElementById("warning").style.display = "none";
}
function hideBackground() {
  var body = document.getElementById("body");
  body.style.height = "100%";
  body.style.overflow = "hidden";
}

function showProjectPopup() {
  var projectPopup = document.getElementById("project-popup");
  projectPopup.style.display = "flex";
  projectPopup.scrollIntoView();
  setTimeout(hideBackground, 500);
}
function hideProjectPopup() {
  var body = document.getElementById("body");
  document.getElementById("project-popup").style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
}

function showUpdateWords() {
  var elmntToView = document.getElementById("count-update-popup");
  elmntToView.style.display = "flex";
  elmntToView.scrollIntoView();
  setTimeout(hideBackground, 500);
}

function hideUpdateWords() {
  var elmntToView = document.getElementById("count-update-popup");
  elmntToView.style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
}

