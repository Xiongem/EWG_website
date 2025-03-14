// var update = document.getElementsByClassName("badge1");
// var updateBadge = function(event) {
//     var id = event.target.id;
//     var badge = event.target.src;
//         console.log(id);
//         console.log(badge);
//          // Using XMLHttpRequest 
//     const xhr = new XMLHttpRequest(); 
//     xhr.open('POST', 'update-badges.php', true); 
         
//     xhr.onload = function() { 
//         if (xhr.status === 200) { 
//             alert('Badge updated successfully!'); 
//         } else { 
//             alert('Error updating badge.'); 
//         } 
//     }; 
         
//     xhr.send();
// };
// for (var i = 0; i < update.length; i++) {
//     update[i].addEventListener('click', updateBadge, false); 
// }; 
//~~~~~~~~~~~~~~~~~
var update = document.getElementsByClassName("badge1");
for (var i = 0; i < update.length; i++) {
    update.addEventListener("click", function (event) {
        var id = event.target.id;
        var badge = event.target.src;
            console.log(id);
            console.log(badge);
            
         // Using XMLHttpRequest 
    // const xhr = new XMLHttpRequest(); 
    // xhr.open('POST', 'update-badges.php', true); 
         
    // xhr.onload = function() { 
    //     if (xhr.status === 200) { 
    //         alert('Badge updated successfully!'); 
    //     } else { 
    //         alert('Error updating badge.'); 
    //     } 
    // }; 
         
    // xhr.send();
    });
}
    //~~~~~~~~~~~~~~~~~
function updateBadge() {

}
    //~~~~~~~~~~~~~~~~~
// var elements = document.getElementsByClassName("classname");

// var myFunction = function() {
//     var attribute = this.getAttribute("data-myattribute");
//     alert(attribute);
// };

// for (var i = 0; i < elements.length; i++) {
//     elements[i].addEventListener('click', myFunction, false);
// }
//~~~~~~~~~~~~~~~~~
    // const id = document.getElementsByClassName("badge1").id
    // const badge = document.getElementsByClassName("badge1").src; 
// document.getElementById('uploadButton').addEventListener('click', function() { 
//     const fileInput = document.getElementById('fileInput'); 
//     const file = fileInput.files[0]; // Get the selected file 
 
//     if (!file) { 
//         alert('Please select a file to upload.'); 
//         return; 
//     } 
 
//     const formData = new FormData(); 
//     formData.append('file', file); // Append the file to the FormData object 
 
//     // Using XMLHttpRequest 
//     const xhr = new XMLHttpRequest(); 
//     xhr.open('POST', 'upload.php', true); 
 
//     xhr.onload = function() { 
//         if (xhr.status === 200) { 
//             alert('File uploaded successfully!'); 
//         } else { 
//             alert('Error uploading file.'); 
//         } 
//     }; 
 
//     xhr.send(formData); // Send the FormData object 
// }); 

$(document).ready(function() {
    $("input").keyup(function(){
        var name = $("input").val(); //assigns value to variable
        $.post("suggestion.php", { //POST METHOD AND WHERE SENDING THE DATA
            suggestion: name //DATA
        }, function(data, status) {
            $("#test").html(data); //INSERT DATA INTO P WITH ID TEST
            alert(status); //gives status message in browser
        });
    })
})

function toggleImage1() {
    imgsrc= document.getElementById("start-1st-project").src;
    if (imgsrc.indexOf("images/badges/1st-project-mono.png")!=-1){
        document.getElementById("start-1st-project").src = "images/badges/1st-project-color.png";
        //assign values
        var id = imgsrc.id;
        var badge = imgsrc;
        //begin post method
        $.post("php-processes/update-badges.php", {
            //DATA
            id: id,
            badge: badge
        }, function(status) {
            alert(status);
        });
    } 
    else {
        document.getElementById("start-1st-project").src = "images/badges/1st-project-mono.png";
    }
  }

  function toggleImage1() {
    imgsrc= document.getElementById("start-1st-project").src;
    if (imgsrc.indexOf("images/badges/1st-project-mono.png")!=-1){
        document.getElementById("start-1st-project").src = "images/badges/1st-project-color.png";
        // var values = {
            var id = document.getElementById("start-1st-project").id;
            var badge =  document.getElementById("start-1st-project").src;
        // };  
            console.log(id, badge);
            $.ajax({
                url: php-processes/update-badges.php,
                type: 'POST',
                data: { value: id, badge },
            });
            // .done(function(data) {
            //     alert("success" + data);
            // })
            // .fail(function(data) {
            //     alert("failure" + data);
            // });
    } 
    else {
        document.getElementById("start-1st-project").src = "images/badges/1st-project-mono.png";
    }
  }