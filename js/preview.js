function projectSelect(i) {
    $("#title").keyup(function(){
        // Getting the current value of textarea
        var currentText = $(this).val();		
         // Setting the Div content
        $("#preview-title").text(currentText);
    });
}