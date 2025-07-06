// Navigation menu dropdown
function navMenuClick() {
    document.getElementById('navMenu').classList.toggle('show');     
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

function showProjectPopup() {
  var body = document.getElementById("body");
  document.getElementById("project-popup").style.display = "flex";
  body.style.height = "100%";
  body.style.overflow = "hidden";
}
function hideProjectPopup() {
  var body = document.getElementById("body");
  document.getElementById("project-popup").style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
}

function showProjectSettings() {
  document.getElementById("settings-popup").style.display = "flex";
}
function hideProjectSettings() {
  document.getElementById("settings-popup").style.display = "none";
}