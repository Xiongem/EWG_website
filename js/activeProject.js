function projectSelect(id, display) {
  //assign values
  var project = id;
  console.log("sent post");
  var i = document.getElementById(project);
  i.classList.remove("inactive");
  console.log("removed class");
  //begin post method
  $.post("php-processes/update-activeProject", {
      //DATA
      project: project
  });
  
  // var notActive = document.querySelectorAll("[id='inactive']");
  // for (let i = 0; i < notActive.length; i++) {
  //   if (!notActive[i].classList.contains("hide")) {
  //     notActive[i].setAttribute("id", "inactive");
  //     notActive[i].classList.add("inactive");
  //   }
  // }
  // console.log(display);
  // var active = display;
  // console.log(active);
  //   if (active.classList.contains("inactive")) {
  //     active.classList.remove("inactive");
  //   }
  // console.log("it's done");
}