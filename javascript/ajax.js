function findDailyGoal(){
    var goal=document.getElementById( "goal" ).value;
    var goalDate=document.getElementById( "goal_date" ).value;
    
    if(dailyGoal){
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