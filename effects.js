$(document).ready(function(){
    // scroll effect
    var speed = "fast"
    $("#add h4").click(function(){
        $("#add form").slideToggle(speed);
    });

    $("#rename h4").click(function(){
        $("#rename form").slideToggle(speed);
    });

    $("#change  h4").click(function(){
        $("#change form").slideToggle(speed);
    });

    $("#transfer  h4").click(function(){
        $("#transfer form").slideToggle(speed);
    });

    $("#remove  h4").click(function(){
        $("#remove form").slideToggle(speed);
    });


});