function projectSelect(id, display) {
  //assign values
  var project = id;
  //begin post method
  $.post("php-processes/update-activeProject", {
      //DATA
      project: project
  });
  var notActive = document.querySelectorAll("[id='inactive']");
  for (let i = 0; i < notActive.length; i++) {
    if (!notActive[i].classList.contains("hide")) {
      notActive.classList.add("hide");
    }
  }
  console.log(display);
  var active = display;
  console.log(active);
    if (active.classList.contains("hide")) {
      active.classList.remove("hide");
    }
  console.log("it's done");
}