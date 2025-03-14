//PROJECTS
function myFunction2() {
    document.getElementById("myDropdown2").classList.toggle("show2");
  }
    
  // Close the dropdown menu if the user clicks outside of it
  window.onclick = function(event2) {
    if (!event2.target.matches('.dropbtn2')) {
      var dropdowns2 = document.getElementsByClassName("dropdown-content2");
      var ii;
       for (ii = 0; ii < dropdowns2.length; ii++) {
        var openDropdown2 = dropdowns2[ii];
        if (openDropdown2.classList.contains('show2')) {
          openDropdown2.classList.remove('show2');
        }
      }
    }
  } 
  