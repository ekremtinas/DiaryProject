$(document).ready(function () {
//Login Main
//Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
// Form Odaklanma Start
    
            var passwordAlert = $('#password-alert');
            var emailAlert = $('#email-alert');
            $('input,#password-show').focus(function(){

                $("nav").css("-webkit-filter", "blur(5px)");
                $("#image").css("-webkit-filter", "blur(4px)");

                $("form").css("-webkit-filter", "blur(0px)");
                passwordAlert.hide();
                emailAlert.hide();

            }).blur(function () {

                $("nav").css("-webkit-filter", "blur(0px)");
                $("#image").css("-webkit-filter", "blur(0px)");
                $("form").css("-webkit-filter", "blur(0px)");
            });

// Form Odaklanma End


// Label Kayan Animasyonu
// Label Start

            var emailFB = $('#email');
            var emailLabel = $('#email-label');
            var passwordFB = $('#password');
            var passwordLabel = $('#password-label');

            emailFB.focus(function() {

                emailLabel.show('fast').animate({top: '-25px'});
                $(this).css("background-color","#fff");
            }).blur(function () {
                emailLabel.animate({top: '0px'}).hide('fast');
            });
            passwordFB.focus(function() {

                passwordLabel.show('fast').animate({top: '60px'});


            }).blur(function () {
                passwordLabel.animate({top: '80px'}).hide('fast');
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
                errorAlert.animate({left:'1500px'}).hide('slow');
            });

// Hata Mesajı End


// Password için güvenlik doğrulaması
// Password Güvenlik Start

             $('#password').on('keyup',function () {
                    var passwordLength=$(this).val().length;
                    var loginButton = $('#button');
                    if(passwordLength>6)
                    {
                        $(this).addClass('is-valid').removeClass('is-invalid');
                        loginButton.removeAttr('disabled');
                     }
                    else
                    {
                        $(this).addClass('is-invalid').removeClass('is-valid');
                        loginButton.attr('disabled','disabled');
                    }
                }) ;

//Password Güvenlik End


});// Ready End
