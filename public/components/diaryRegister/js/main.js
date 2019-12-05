
$(document).ready(function () {
    // Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
    // Start
    $(':input,#password-show').focus(function(){

        $("nav").css("-webkit-filter", "blur(3px)");
        $("#image").css("-webkit-filter", "blur(3px)");
        $("form").css("-webkit-filter", "blur(0px)");
    }).blur(function () {

        $("nav").css("-webkit-filter", "blur(0px)");
        $("#image").css("-webkit-filter", "blur(0px)");
        $("form").css("-webkit-filter", "blur(0px)");
    });
    // End
    /// LABEL SHOW-HİDE ANİMASYONU
    // START
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

        emailLabel.show('fast').animate({top: '35px'});
    }).blur(function () {
        emailLabel.animate({top: '60px'}).hide('fast');
    });

    var countrySelector= $('#country_selector');
    var countryLabel=$('#country-label');
    countrySelector.focus(function() {

        countryLabel.show('fast').animate({top: '95px'});
    }).blur(function () {
        countryLabel.animate({top: '120px'}).hide('fast');
    });

    var password =  $('#password');
    var passwordLabel = $('#password-label');
    password.focus(function() {

        passwordLabel.show('fast').animate({top: '155px'});
    }).blur(function () {
        passwordLabel.animate({top: '175px'}).hide('fast');
    });

    var passwordConfirmation =  $('#password_confirmation');
    var passwordConfirmationLabel = $('#password-confirmation-label');
    passwordConfirmation.focus(function() {

        passwordConfirmationLabel.show('fast').animate({top: '210px'});
    }).blur(function () {
        passwordConfirmationLabel.animate({top: '235px'}).hide('fast');
    });
    // END





    // Password'ün gösterilmesi ve gizlenmesi işlemi
    // Start
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
    // End

    // Email için canlı doğrulama işlemi için
    // Start
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

// End
// Password için güvenlik doğrulaması
// Start


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

            }
            else
            {
                $('#password_equal').hide('slow');

            }
        }
        else
        {
            $(this).addClass('is-invalid');
            $(this).removeClass('is-valid');
        }



    }) ;
    // End


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

});


// Ülke seçimi selector default
// Ülke seçimi Start
$("#country_selector").countrySelect({
    preferredCountries: ['ca', 'gb', 'us']
});
// Ülke seçimi End

