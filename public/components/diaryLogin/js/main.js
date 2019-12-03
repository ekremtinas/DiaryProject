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
    var passwordFB = $('#password');
    var passwordLabel = $('#password-label');
    emailFB.focus(function() {

        emailLabel.show('fast').animate({top: '-25px'});
    }).blur(function () {
        emailLabel.animate({top: '0px'}).hide('fast');
    });
    passwordFB.focus(function() {

        passwordLabel.show('fast').animate({top: '35px'});
    }).blur(function () {
        passwordLabel.animate({top: '55px'}).hide('fast');
    });
    // Label End




    //Password input'u için eye ve eye-slash iconlarını ekleyen password show content'i
    // Password End


    var show_hide_password = $("#show_hide_password") ;
    show_hide_password.find('a').on('click', function(event) {
        event.preventDefault();
        if(show_hide_password.find('input').attr("type") === "text"){
            show_hide_password.find('input').attr('type', 'password');
            show_hide_password.find('i').addClass( "fa-eye-slash" );
            show_hide_password.find('i').removeClass( "fa-eye" );
        }
        else if(show_hide_password.find('input').attr("type") === "password"){
            show_hide_password.find('input').attr('type', 'text');
            show_hide_password.find('i').removeClass( "fa-eye-slash" );
            show_hide_password.find('i').addClass( "fa-eye" );
        }
    });



    // Password End

    // Email için canlı doğrulama işlemi için
    // Email Start

    var email = $('#email');
    email.on('keyup',function () {
        var emailValue = $(this).val();
        var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if(filter.test(emailValue))
        {
            email.addClass( "is-valid" ).removeClass( "is-invalid" );
        }
        else{
            email.addClass( "is-invalid" ).removeClass( "is-valid" );
        }

    }) ;

// Email End
// Şifre yenileme alertinin gizlenmesi ve diğer hata mesajının gizlenmesi
// Şifre Yenileme Start
var forgotPasswordHide=$('#forgotPasswordHide');
var forgotPasswordAlert=$('#forgotPasswordAlert');
forgotPasswordHide.on('click',function () {
    forgotPasswordAlert.hide('slow').animate({right:'250px'});
});
// Şifre Yenileme End
// Hata Mesajı Start
var errorHide=$('#errorHide');
var errorAlert=$('#errorAlert');
errorHide.on('click',function () {
    errorAlert.hide('slow').animate({right:'250px'});
});
// Hata Mesajı End
});
