$(document).ready(function () {
//Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
// Form Odaklanma Start

            $('input,#password-show').focus(function(){

                $("nav").css("-webkit-filter", "blur(5px)");
                $("#image").css("-webkit-filter", "blur(4px)");

                $("form").css("-webkit-filter", "blur(0px)");




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

            emailFB.focus(function() {

                emailLabel.show('fast').animate({top: '-25px'});
            }).blur(function () {
                emailLabel.animate({top: '0px'}).hide('fast');
            });
/* Password Reset Confirm Sayfası için gerkli*/
            var password =  $('#password');
            var passwordLabel = $('#password-label');
            password.focus(function() {

                passwordLabel.show('fast').animate({top: '0px'});
            }).blur(function () {
                passwordLabel.animate({top: '27px'}).hide('fast');
            });

            var passwordConfirmation =  $('#password_confirmation');
            var passwordConfirmationLabel = $('#password-confirmation-label');
            passwordConfirmation.focus(function() {

                passwordConfirmationLabel.show('fast').animate({top: '60px'});
            }).blur(function () {
                passwordConfirmationLabel.animate({top: '80px'}).hide('fast');
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
                errorAlert.animate({left:'1500px'}).hide('slow');
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


// Password için güvenlik doğrulaması
// Password Güvenlik Start

            $('#password , #password_confirmation').on('keyup',function () {
                var passwordLength=$(this).val().length;
                var password=$('#password').val();
                var password_confirmation=$('#password_confirmation').val();
                if(passwordLength>6)
                {

                    $(this).addClass('is-valid');
                    $(this).removeClass('is-invalid');
                    if(password==password_confirmation)
                    {
                        $('#password_equal').show('slow');
                        resetButton.removeAttr('disabled');
                    }
                    else
                    {
                        $('#password_equal').hide('slow');
                        resetButton.attr('disabled','disabled');
                    }
                }
                else
                {
                    $(this).addClass('is-invalid').removeClass('is-valid');
                }



            }) ;

// Password Güvenlik End


// Notification Start

            var notificationHide=$('#notificationHide');
            var notificationAlert=$('#notificationAlert');
            var loginAskAlert=$('#loginAskAlert');
            notificationHide.on('click',function () {
                notificationAlert.animate({left:'1500px'}).hide('slow');
                loginAskAlert.animate({top:'90%'});
            });

// Notification End


// Login Ask Start

            var loginAskHide=$('#loginAskHide');

            loginAskHide.on('click',function () {
                loginAskAlert.animate({left:'1500px'}).hide('slow');
            });

// Login Ask End


// Password'ün gösterilmesi ve gizlenmesi işlemi
// Password Show Hide Start

             var show_hide_password = $("#show_hide_password") ;
            var showHidePasswordInput = show_hide_password.find('input');
            var showHidePasswordI = show_hide_password.find('i');
            show_hide_password.find('a').on('click', function(event) {
                event.preventDefault();

                if(showHidePasswordInput.attr("type") === "text"){
                    showHidePasswordInput.attr('type', 'password');
                    showHidePasswordI.addClass( "fa-eye-slash" ).removeClass( "fa-eye" );
                }
                else if(showHidePasswordInput.attr("type") === "password"){
                    showHidePasswordInput.attr('type', 'text');
                    showHidePasswordI.removeClass( "fa-eye-slash" );
                    showHidePasswordI.addClass( "fa-eye" );
                }
            });
            var show_hide_password2 = $("#show_hide_password2") ;
            var showHidePasswordInput2 = show_hide_password2.find('input');
            var showHidePasswordI2 = show_hide_password2.find('i');
            show_hide_password2.find('a').on('click', function(event) {
                event.preventDefault();

                if(showHidePasswordInput2.attr("type") === "text"){
                    showHidePasswordInput2.attr('type', 'password');
                    showHidePasswordI2.addClass( "fa-eye-slash" ).removeClass( "fa-eye" );
                }
                else if(showHidePasswordInput2.attr("type") === "password"){
                    showHidePasswordInput2.attr('type', 'text');
                    showHidePasswordI2.removeClass( "fa-eye-slash" );
                    showHidePasswordI2.addClass( "fa-eye" );
                }
            });
//  Password Show Hide End

});// Ready End

