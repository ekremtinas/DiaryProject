
$(document).ready(function () {
    $('#dropdown').on('click',function() {
        $('#logout-div').slideToggle( "slow");
    });


    $('#calendar').on('click', function () {

        $('#logout-div').hide("fast");
    });
    $('#top').on('click', function () {

        $('#logout-div').hide("fast");
    });


});

