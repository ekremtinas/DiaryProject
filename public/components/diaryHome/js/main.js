$(document).ready(function () {
//Login Main
    //Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
    // Form Odaklanma Start
    var passwordAlert = $('#password-alert');
    var emailAlert = $('#email-alert');
    $(':input,#password-show').focus(function () {

        $("nav").css("-webkit-filter", "blur(5px)");
        $("#image").css("-webkit-filter", "blur(4px)");
        $("#top").css("-webkit-filter", "blur(5px)");
        $("form").css("-webkit-filter", "blur(0px)");
        passwordAlert.hide();
        emailAlert.hide();

    }).blur(function () {

        $("nav").css("-webkit-filter", "blur(0px)");
        $("#image").css("-webkit-filter", "blur(0px)");
        $("form").css("-webkit-filter", "blur(0px)");
        $("#top").css("-webkit-filter", "blur(0px)");
    });
// Form Odaklanma End

    /// Label Kayan Animasyonu
    // Label Start
    var saveTitleFB = $('#saveTitle');
    var saveTitleLabel = $('#saveTitle-label');
    saveTitleFB.focus(function()
    {
        saveTitleLabel.show().animate({top: '-30px'});
      }).blur(function () {
        saveTitleLabel.animate({top: '0px'}).hide();
     });

    var colorFB = $('#color');
    var colorLabel = $('#color-label');
    colorFB.focus(function()
    {
        colorLabel.show().animate({top: '-30px'});
    }).blur(function () {
        colorLabel.animate({top: '0px'}).hide();
    });

    var startFB = $('#start');
    var startLabel = $('#start-label');
    startFB.focus(function()
    {
        startLabel.show().animate({top: '-30px'});
    }).blur(function () {
        startLabel.animate({top: '0px'}).hide();
    });

    var endFB = $('#end');
    var endLabel = $('#end-label');
    endFB.focus(function()
    {
        endLabel.show().animate({top: '-30px'});
    }).blur(function () {
        endLabel.animate({top: '0px'}).hide();
    });


    var editTitleFB = $('#editTitle');
    var editTitleLabel = $('#editTitle-label');
    editTitleFB.focus(function()
    {
        editTitleLabel.show().animate({top: '-30px'});
    }).blur(function () {
        editTitleLabel.animate({top: '0px'}).hide();
    });

    var editColorFB = $('#editColor');
    var editColorLabel = $('#editColor-label');
    editColorFB.focus(function()
    {
        editColorLabel.show().animate({top: '-30px'});
    }).blur(function () {
        editColorLabel.animate({top: '0px'}).hide();
    });

    // Label End

                //// AJAX ADD EVENT




});
