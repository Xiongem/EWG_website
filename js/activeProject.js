function projectSelect(id) {
  //assign values
  var project = id;
  //begin post method
  $.post("php-processes/update-activeProject", {
      //DATA
      project: project
  });
}