function projectSelect(id) {
  //assign values
  var project = id;
  //begin post method
  $.post("php-processes/update-activeProject", {
      //DATA
      project: project
  });
  
  console.log(project);
  var body = document.getElementById("body");
  document.getElementById("project-popup").style.display = "none";
  body.style.height = "unset";
  body.style.overflow = "unset";
    // location.href = "index.php"
}