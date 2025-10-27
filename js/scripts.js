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
function showBackground() {
  var body = document.getElementById("body");
  body.style.height = "unset";
  body.style.overflow = "unset";
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
function showFinishPopup() {
  var finishPopup = document.getElementById("finish-popup-wrapper");
  finishPopup.style.display = "flex";
  finishPopup.scrollIntoView();
  setTimeout(hideBackground, 500);
}
function hideFinishPopup() {
  var body = document.getElementById("body");
  document.getElementById("finish-popup-wrapper").style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
}

function showDeletePopup() {
  var deletePopup = document.getElementById("delete-popup-wrapper");
  deletePopup.style.display = "flex";
  deletePopup.scrollIntoView();
  setTimeout(hideBackground, 500);
}
function hideDeletePopup() {
  var body = document.getElementById("body");
  document.getElementById("delete-popup-wrapper").style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
}

function goBack() {
  history.go(-1);
}