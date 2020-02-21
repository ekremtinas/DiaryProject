
$(document).ready(function () {
    $('#dropdown').on('click',function() {
        $('#logout-div').slideToggle( "slow");
    });


    $("[class*=main]").on('dblclick', function () {

        $('#logout-div').hide("fast");
    });


});

