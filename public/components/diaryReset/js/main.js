$(document).ready(function () {
    //Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
    // Form Odaklanma Start
    $(':input,#password-show').focus(function(){

        $("nav").css("-webkit-filter", "blur(5px)");
        $("#image").css("-webkit-filter", "blur(4px)");

        $("form").css("-webkit-filter", "blur(0px)");




    }).blur(function () {

        $("nav").css("-webkit-filter", "blur(0px)");
        $("#image").css("-webkit-filter", "blur(0px)");
        $("form").css("-webkit-filter", "blur(0px)");
    });
    // Form Odaklanma End
    /// Label Kayan Animasyonu
    // Label Start
    var emailFB = $('#email');
    var emailLabel = $('#email-label');

    emailFB.focus(function() {

        emailLabel.show('fast').animate({top: '-25px'});
    }).blur(function () {
        emailLabel.animate({top: '0px'}).hide('fast');
    });

    // Label End






    // Email için canlı doğrulama işlemi için
    // Email Start

    var email = $('#email');
    var resetButton = $('#resetButton');
    email.on('keyup',function () {
        var emailValue = $(this).val();
        var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(filter.test(emailValue))
        {
            email.addClass( "is-valid" ).removeClass( "is-invalid" );
            resetButton.removeAttr('disabled');
        }
        else{
            email.addClass( "is-invalid" ).removeClass( "is-valid" );
            resetButton.attr('disabled','disabled');

        }

    }) ;
    // Email End
    // Hata Mesajı Start
    var errorHide=$('#errorHide');
    var errorAlert=$('#errorAlert');
    errorHide.on('click',function () {
        errorAlert.hide('slow').animate({right:'250px'});
    });
// Hata Mesajı End
    //Email gönderildiğinde gösterilen bildirim
    // Email send bildirim Start

    var notificationSendClose=$('#notification-email-send-close');
    var notificationSend=$('#notification-email-send');
    notificationSendClose.on('click',function () {
        notificationSend.animate({left:'1500px'}).hide('slow');
    });
    // Email send bildirim End
});

