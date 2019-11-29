$(document).ready(function () {
    $('#dropdown').on('click',function() {
        $('#logout-div').toggle("slide");
    });

});
$(document).ready(function () {

    $('#calendar').on('click', function () {

        $('#logout-div').hide("slow");
    });
    $('#top').on('click', function () {

        $('#logout-div').hide("slow");
    });
});

