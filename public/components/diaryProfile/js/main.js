$(document).ready(function () {
// Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
// Form Blur Start
            var nameAlert=$('#name-alert');
            var emailAlert=$('#email-alert');

            $('input,#password-show').focus(function(){

                $("nav").css("-webkit-filter", "blur(3px)");
                $("#image").css("-webkit-filter", "blur(3px)");
                $("form").css("-webkit-filter", "blur(0px)");
                nameAlert.hide();
                emailAlert.hide();


            }).blur(function () {

                $("nav").css("-webkit-filter", "blur(0px)");
                $("#image").css("-webkit-filter", "blur(0px)");
                $("form").css("-webkit-filter", "blur(0px)");
            });
// Form Blur End

// LABEL SHOW-HİDE ANİMASYONU
// LABEL SHOW-HİDE ANİMASYONU START

            var name=$('#name');
            var nameLabel=$('#name-label');
            name.focus(function() {

                nameLabel.show('fast').animate({top: '-25px'});
            }).blur(function () {
                nameLabel.animate({top: '0px'}).hide('fast');
            });

            var email =$('#email');
            var emailLabel = $('#email-label');
            email.focus(function() {

                emailLabel.show('fast').animate({top: '60px'});
            }).blur(function () {
                emailLabel.animate({top: '80px'}).hide('fast');
            });

            var countrySelector= $('#country_selector');
            var countryLabel=$('#country-label');
            countrySelector.focus(function() {

                countryLabel.show('fast').animate({top: '140px'});
            }).blur(function () {
                countryLabel.animate({top: '170px'}).hide('fast');
            });
            var lang= $('#lang');
            var langLabel=$('#lang-label');
            lang.focus(function() {

                langLabel.show('fast').animate({top: '220px'});
            }).blur(function () {
                langLabel.animate({top: '250px'}).hide('fast');
            });





// LABEL SHOW-HİDE ANİMASYONU END



// Email için canlı doğrulama işlemi için
// Email Doğrulama Start

            var email=$('#email');
            email.on('keyup',function () {
                var emailValue = $(this).val();
                var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if(filter.test(emailValue))
                {
                    email.addClass( "is-valid" );
                    email.removeClass( "is-invalid" );
                }
                else{
                    email.addClass( "is-invalid" );
                    email.removeClass( "is-valid" );
                }

            }) ;

// Email Doğrulama End


// Hata Mesajı Start
            var errorHide=$('#errorHide');
            var errorAlert=$('#errorAlert');
            errorHide.on('click',function () {
                errorAlert.animate({left:'1500px'}).hide('slow');
            });
// Hata Mesajı End

// Notification Start
            var notificationHide=$('#notificationHide');
            var notificationAlert=$('#notificationAlert');
            notificationHide.on('click',function () {
                notificationAlert.animate({left:'1500px'}).hide('slow');
            });
// Notification End


// Ülke seçimi selector default
// Ülke seçimi Start
            $("#country_selector").countrySelect({
                preferredCountries: ['tr', 'nl', 'de']
            });

// Ülke seçimi End

// BValidator için hangi form'a uygulanacağı belirtiliyor.
// BValidator Start

            $('#userProfileForm').bValidator();

// BValidator End
});// Ready End
