$(document).ready(function () {
    $('input').focus(function(){

        $("nav").css("-webkit-filter", "blur(5px)");
        $("#image").css("-webkit-filter", "blur(4px)");

        $("form").css("-webkit-filter", "blur(0px)");


    }).blur(function () {

        $("nav").css("-webkit-filter", "blur(0px)");
        $("#image").css("-webkit-filter", "blur(0px)");
        $("form").css("-webkit-filter", "blur(0px)");
    });
    $('input[type=checkbox]').focus(function () {
        $('#maintenanceTable').attr('style','box-shadow :0 1px 3px rgba(0, 0, 0, 0.16), 0 1px 1px rgba(0, 0, 0, 0.23) !important;');
    }).blur(function () {
        $('#maintenanceTable').attr('style','box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23) !important;');
    });


});
