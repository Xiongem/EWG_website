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