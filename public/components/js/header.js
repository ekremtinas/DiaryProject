$(document).ready(function () {
    $('#dropdown').on('click',function() {
        $('#logout-div').slideToggle( "slow");
    });

});
$(document).ready(function () {

    $('#calendar').on('click', function () {

        $('#logout-div').hide("fast");
    });
    $('#top').on('click', function () {

        $('#logout-div').hide("fast");
    });
});

