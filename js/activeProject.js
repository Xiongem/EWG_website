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
}