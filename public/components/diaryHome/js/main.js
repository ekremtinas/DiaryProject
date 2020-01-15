$(document).ready(function () {
//Home Main


                //Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
// Form Odaklanma Start

                var passwordAlert = $('#password-alert');
                var emailAlert = $('#email-alert');
                $('input,#password-show').focus(function () {

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

// Label Kayan Animasyonu
// Label Start

                var saveTitleFB = $('#saveTitle');
                var saveTitleLabel = $('#saveTitle-label');
                saveTitleFB.focus(function()
                {
                    saveTitleLabel.show().animate({top: '-30px'});
                  }).blur(function () {
                    saveTitleLabel.animate({top: '0px'}).hide();
                 });

                var maintenanceAddSelectFB = $('#maintenanceAddSelect');
                var maintenanceAddSelectLabel = $('#maintenanceAddSelect-label');
    maintenanceAddSelectFB.focus(function()
                {
                    maintenanceAddSelectLabel.show().animate({top: '-30px'});
                }).blur(function () {
        maintenanceAddSelectLabel.animate({top: '0px'}).hide();
                });

                var saveStartFB = $('#saveStart');
                var saveStartLabel = $('#saveStart-label');
                saveStartFB.focus(function()
                {
                    saveStartLabel.show().animate({top: '-30px'});
                }).blur(function () {
                    saveStartLabel.animate({top: '0px'}).hide();
                });

                var saveEndFB = $('#saveEnd');
                var saveEndLabel = $('#saveEnd-label');
                saveEndFB.focus(function()
                {
                    saveEndLabel.show().animate({top: '-30px'});
                }).blur(function () {
                    saveEndLabel.animate({top: '0px'}).hide();
                });


                var editTitleFB = $('#editTitle');
                var editTitleLabel = $('#editTitle-label');
                editTitleFB.focus(function()
                {
                    editTitleLabel.show().animate({top: '-30px'});
                }).blur(function () {
                    editTitleLabel.animate({top: '0px'}).hide();
                });

                var maintenanceEditSelectFB = $('#maintenanceEditSelect');
                var maintenanceEditSelectLabel = $('#maintenanceEditSelect-label');
                maintenanceEditSelectFB.focus(function()
                {
                    maintenanceEditSelectLabel.show().animate({top: '-30px'});
                }).blur(function () {
                    maintenanceEditSelectLabel.animate({top: '0px'}).hide();
                });

                var editStartFB = $('#editStart');
                var editStartLabel = $('#editStart-label');
                 editStartFB.focus(function()
                {
                    editStartLabel.show().animate({top: '-30px'});
                }).blur(function () {
                     editStartLabel.animate({top: '0px'}).hide();
                });

                var editEndFB = $('#editEnd');
                var editEndLabel = $('#editEnd-label');
                editEndFB.focus(function()
                {
                    editEndLabel.show().animate({top: '-30px'});
                }).blur(function () {
                    editEndLabel.animate({top: '0px'}).hide();
                });


// Label End


// Notification Start

                var notificationHide=$('#notificationHide');
                var notificationAlert=$('#notificationAlert');
                notificationHide.on('click',function () {
                    notificationAlert.animate({left:'1500px'}).hide('slow').animate({left:'1000px'});

                });

// Notification End


// BVALIDATOR JS START

                var locale=initialLocaleCode;

                var options = {
                    lang: locale,
                    messages: {
                        tr: {
                            'default' : 'Lütfen bu değeri düzeltin.',
                            minlen    : 'Uzunluğu en az {0} karakter olmalıdır.',
                            maxlen    : 'Uzunluğu en fazla {0} karakter olmalıdır.',
                            rangelen  : 'Uzunluğu {0} ve {1} arasında olmalıdır.',
                            min       : 'Lütfen daha büyük veya {0} eşit bir sayı girin.',
                            max       : 'Lütfen daha az ya da {0} eşit bir sayı girin.',
                            between   : 'Lütfen {0} ile {1} arasında bir sayı girin.',
                            required  : 'Alan boş geçilemez.',
                            alpha     : 'Sadece alfabetik karakterler giriniz.',
                            alphanum  : 'Sadece alfasayısal karakterler giriniz.',
                            digit     : 'Ondalıklı sayı girilebilir.',
                            number    : 'Lütfen rakam giriniz.',
                            email     : 'Mail adresi giriniz.',
                            url       : 'Lütfen geçerli bir URL girin.',
                            ip4       : 'Lütfen geçerli bir IPv4 adresi girin.',
                            ip6       : 'Lütfen geçerli bir IPv6 adresi girin.',
                            date      : '{0} Bu formatta bir tarih girin.',
                            equal     : 'Aynı değeri girin.',
                            differ    : 'Lütfen farklı bir değer girin.'

                        },
                        ee:{
                            'default' : 'Palun paranda see sisestus.',
                            minlen    : 'Pikkus peab olema vähemalt {0} märki.',
                            maxlen    : 'Pikkus voib olla maksimum {0} märki.',
                            rangelen  : 'Pikkus voib olla vahemikus {0} kuni {1}.',
                            min       : 'Palun sisesta number mis on suurem voi vordne {0} ga.',
                            max       : 'Palun sisesta number mis on väiksem voi vordne {0} ga.',
                            between   : 'Palun sisesta number vahemikus {0} kuni {1}.',
                            required  : 'Noutud väli.',
                            alpha     : 'Lubatud on ainult tähed.',
                            alphanum  : 'Lunatud on ainult tähed ju numbrid.',
                            digit     : 'Lubatud on ainult numbrid.',
                            number    : 'Palun sisesta korrektne number.',
                            email     : 'Palun sisesta korrektne email.',
                            url       : 'Palun sisesta korrektne URL.',
                            ip4       : 'Palun sisesta korrektne IPv4 aadress.',
                            ip6       : 'Palun sisesta korrektne IPv6 aadress.',
                            date      : 'Palun sisesta kuupäev formaadis {0}',
                            equal     : 'Palun sisesta sama väärtus uuesti.',
                            differ    : 'Palun sisesta erinev väärtus.'
                        },
                        es:{
                            'default' : 'Por favor, corrija este valor.',
                            minlen    : 'La longitud debe ser de al menos {0} caracteres.',
                            maxlen    : 'La longitud debe ser como mucho de {0} caracteres.',
                            rangelen  : 'La longitud debe ser de entre {0} y {1} caracteres.',
                            min       : 'Por favor, introduzca un numero mayor o igual que {0}.',
                            max       : 'Por favor, introduzca un numero menor o igual que {0}.',
                            between   : 'Por favor, introducza un numero entre {0} y {1}.',
                            required  : 'Este campo es obligatorio.',
                            alpha     : 'Por favor, introduzca sólo caracteres alfabéticos.',
                            alphanum  : 'Por favor, introduzca sólo caracteres alfanuméricos.',
                            digit     : 'Por favor, introduzca sólo dígitos.',
                            number    : 'Por favor, introduzca un número válido.',
                            email     : 'Por favor, introduzca un e-mail válido.',
                            url       : 'Por favor, introduza una URL válida.',
                            ip4       : 'Por favor, introduzca una dirección IPv4 válida.',
                            ip6       : 'Por favor, introduzca una dirección IPv6 válida.',
                            date      : 'Por favor, introduzca una fecha válida con el formato {0}',
                            equal     : 'Por favor, introduzca el mismo valor de nuevo.',
                            differ    : 'Por favor, introduzca un valor diferente.'
                        },
                        fr:{
                            'default' : 'Por favor, corrija o valor deste campo.',
                            minlen    : 'Ce champ doit contenir au moins {0} caractères.',
                            maxlen    : 'Ce champ doit contenir au maximum {0} caractères.',
                            rangelen  : 'Ce champ doit contenir entre {0} et {1} caractères.',
                            min       : 'Cette valeur doit être supériure ou égale à {0}.',
                            max       : 'Cette valeur doit être inférieure ou égale à {0}.',
                            between   : 'Entrer un nombre entre {0} et {1}.',
                            required  : 'Veuillez renseigner ce champ.',
                            alpha     : 'Seules les lettres sont acceptées.',
                            alphanum  : 'Utilisez des caractères alphanumériques seulement.',
                            digit     : 'Seuls les chiffres sont acceptés.',
                            number    : 'Veuillez saisir un nombre.',
                            email     : 'Veuillez entrer une adresse email valide.',
                            url       : 'Veuillez entrer une URL valide.',
                            ip4       : 'Veuillez fournir une adresse IPv4 valide.',
                            ip6       : 'Veuillez fournir une adresse IPv6 valide.',
                            date      : 'Vous devez entrer une date valide au format {0}',
                            equal     : 'Veuillez saisir la même valeur à nouveau.',
                            differ    : 'Veuillez saisir une autre valeur.'
                        },
                        hr:{
                            'default' : 'Ispravite ovu vrijednost.',
                            minlen    : 'Duljina mora biti najmanje {0} znakova.',
                            maxlen    : 'Duljina mora biti najviše {0} znakova.',
                            rangelen  : 'Duljina mora biti između {0} i {1} znakova.',
                            min       : 'Unesite broj veći ili jednak {0}.',
                            max       : 'Unesite broj manji ili jednak {0}.',
                            between   : 'Unesite broj između {0} i {1}.',
                            required  : 'Ovo polje je obavezno.',
                            alpha     : 'Unesite samo slova.',
                            alphanum  : 'Unesite samo slova i brojeve.',
                            digit     : 'Unesite samo brojeve.',
                            number    : 'Unesite ispravan broj.',
                            email     : 'Unesite ispravnu Email adresu.',
                            url       : 'Unesite ispravan URL.',
                            ip4       : 'Unesite ispravnu IPv4 adresu.',
                            ip6       : 'Unesite ispravnu IPv6 adresu.',
                            date      : 'Unesite ispravan datum u formatu {0}',
                            equal     : 'Unesite ponovno istu vrijednost.',
                            differ    : 'Unesite razlièitu vrijednost.'
                        },
                        ptbr:{
                            'default' : 'Por favor, corrija o valor deste campo.',
                            minlen    : 'O tamanho mínimo é de {0} caracteres.',
                            maxlen    : 'O tamanho máximo é de {0} caracteres.',
                            rangelen  : 'O tamanho deve ser entre  {0} e {1} caracteres.',
                            min       : 'Por favor, insira um número maior ou igual a {0}.',
                            max       : 'Por favor, insira um número menor ou igual a {0}.',
                            between   : 'Por favor, insira um número entre {0} e {1}.',
                            required  : 'Este campo tem preenchimento obrigatório.',
                            alpha     : 'Por favor, insira apenas caracteres alfabéticos.',
                            alphanum  : 'Por favor, insira apenas caracteres alfanuméricos.',
                            digit     : 'Por favor, insira apenas dígitos.',
                            number    : 'Por favor, insira um número válido.',
                            email     : 'Por favor, insira um e-mail válido.',
                            url       : 'Por favor, insira uma URL válida.',
                            ip4       : 'Por favor, insira um endereço IPv4 válido.',
                            ip6       : 'Por favor, insira um endereço IPv6 válida.',
                            date      : 'Por favor, insira uma data válida no formato {0}',
                            equal     : 'Por favor, insira o mesmo valor novamente.',
                            differ    : 'Por favor, insira um valor diferente.'
                        },
                        pt:{
                            'default' : 'Lütfen bu değeri düzeltin.',
                            minlen    : 'Uzunluğu en az {0} karakter olmalıdır.',
                            maxlen    : 'Uzunluğu en fazla {0} karakter olmalıdır.',
                            rangelen  : 'Uzunluğu {0} ve {1} arasında olmalıdır.',
                            min       : 'Lütfen daha büyük veya {0} eşit bir sayı girin.',
                            max       : 'Lütfen daha az ya da {0} eşit bir sayı girin.',
                            between   : 'Lütfen {0} ile {1} arasında bir sayı girin.',
                            required  : 'Alan boş geçilemez.',
                            alpha     : 'Sadece alfabetik karakterler giriniz.',
                            alphanum  : 'Sadece alfasayısal karakterler giriniz.',
                            digit     : 'Ondalıklı sayı girilebilir.',
                            number    : 'Lütfen rakam giriniz.',
                            email     : 'Mail adresi giriniz.',
                            url       : 'Lütfen geçerli bir URL girin.',
                            ip4       : 'Lütfen geçerli bir IPv4 adresi girin.',
                            ip6       : 'Lütfen geçerli bir IPv6 adresi girin.',
                            date      : '{0} Bu formatta bir tarih girin.',
                            equal     : 'Aynı değeri girin.',
                            differ    : 'Lütfen farklı bir değer girin.'
                        }
                    }
                };
                $('#addEventForm').bValidator(options);
                $('#editEventForm').bValidator(options);
    //  console.log($('#addEventForm').data('bValidator').validate());
    /* if() {
         $('#addEventSubmit').prop("disabled", false);
     }*/

// BVALIDATOR JS END
// Add Modal için Maintenance'nin DB'den Getirilmesi
                var maintenanceAdd = document.getElementById('maintenanceAddSelect');
                var maintenanceEdit =document.getElementById('maintenanceEditSelect');
                var optionEl;
                var optionEdit;
                $.ajax({
                   url:'/dHome/getMaintenance',
                   type:'get',
                    data:{
                        _token:'0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT'
                    },
                   dataType:'json',
                   success:function (maintenanceData) {


                       for(j=0;j<maintenanceData.length;j++)
                       {

                        var maintenance ='('+moment(maintenanceData[j]["maintenanceMinute"], "HH:mm").format("HH:mm")+') '+maintenanceData[j]["maintenanceTitle"];
                       $('#maintenanceTable').append( '<tr style="line-height: 1px !important;" class="maintenanceRow" ><td  class="checkboxMaintenance">'+maintenance+'</td> <td ><input class="checkboxMaintenanceInput custom-checkbox form-check" type="checkbox" value="'+maintenance+'"  name="maintenance[]" ></td></tr>');


                       }

                   }
                });


// Add Modal için Maintenance Add Ajax
                 var maintenanceAddSubmit=$('#maintenanceAddSubmit');
                $('#maintenanceAdd').on('dblclick',function () {
                    $('#ModalAdd').modal('hide');
                    $('#MaintenanceAddModal').toggle('show');
                    maintenanceAddSubmit.prop( "disabled", false );

                });


//MODAL CLOSE
// Add Modal için Maintenance Add Ajax
                $('#maintenanceAddCloseX,#maintenanceAddClose').click(function () {
                    $('#ModalAdd').modal('show');
                    $('#MaintenanceAddModal').toggle('hide');
                });
//Add Modal için Maintenance Edit Ajax
                $('#maintenanceEditCloseX,#maintenanceEditClose').click(function () {
                    $('#ModalAdd').modal('show');
                    $('#MaintenanceEditModal').toggle('hide');
                });
//Add Modal için Maintenance Delete Ajax
                $('#maintenanceDeleteCloseX,#maintenanceDeleteClose').click(function () {
                    $('#ModalAdd').modal('show');
                    $('#MaintenanceDeleteModal').toggle('hide');
                });
//MODAL INPUT LABEL ANIMATION

                var maintenanceTitleFB = $('#maintenanceTitle');
                var maintenanceTitleLabel = $('#maintenanceTitle-label');
                maintenanceTitleFB.focus(function()
                {
                    maintenanceTitleLabel.show().animate({top: '-25px'});
                }).blur(function () {
                    maintenanceTitleLabel.animate({top: '0px'}).hide();
                });

                var maintenanceMinuteFB = $('#maintenanceMinute');
                var maintenanceMinuteLabel = $('#maintenanceMinute-label');
                maintenanceMinuteFB.focus(function()
                {
                    maintenanceMinuteLabel.show().animate({top: '-25px'});
                }).blur(function () {
                    maintenanceMinuteLabel.animate({top: '0px'}).hide();
                });
// MODAL ADD,EDİT,DELETE AJAX TECHNOLOGY


    // Add Ajax
                var maintenanceAddForm=$('#maintenanceAddForm');

                maintenanceAddForm.submit(function (e) {

                    maintenanceAddSubmit.prop( "disabled", true );
                    e.preventDefault();
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                        }
                    });
                    $.ajax({
                       url:'/dHome/addMaintenance',
                       type:'post',
                       data:maintenanceAddForm.serialize(),
                       dataType:'json',
                       success:function (data) {

                           var maintenance  = '('+moment(data["maintenanceMinute"], "HH:mm").format("HH:mm")+') '+data["maintenanceTitle"];
                           $('#maintenanceTable').append('<tr style="line-height: 1px !important;" class="maintenanceRow" ><td  class="checkboxMaintenance">'+maintenance+'</td> <td ><input class="checkboxMaintenanceInput custom-checkbox form-check" type="checkbox" value="'+maintenance+'"  name="maintenance[]" ></td></tr>');


                           $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');//Bakım eklenmesi notification start
                           $(".notification-text").html("Maintenance Added");
                           $('#notificationAlert').show();//Bakım eklenmesi notification end
                           $('#MaintenanceAddModal').toggle('hide');//Bakım eklenmesi modal gizlenmesi start
                           $('#ModalAdd').modal('show');//Event eklenmesi modalı gösterilmesi

                        }
                    });


                     });

        // Edit Ajax


                  var maintenanceEditSubmit=$('#maintenanceEditSubmit');
                  var maintenanceChekbox=null;
                  var maintenanceEditTitle =null;
                  var maintenanceEditMinute =null;
                  $('#maintenanceEdit').on('dblclick',function () {//Bakım türü modalında ki edit butonuna çift tıklama
                      $('#ModalAdd').modal('hide');
                      $('#MaintenanceEditModal').toggle('show');
                      $.each($("input[name='maintenance[]']:checked"), function(){//Checkbox'ın seçilmesi

                          maintenanceChekbox=$(this).val();
                      });
                      maintenanceEditTitle = maintenanceChekbox.substr(8);
                      maintenanceEditMinute = maintenanceChekbox.substr(1,5);
                     $('#MaintenanceEditModal #maintenanceEditTitle').val(maintenanceEditTitle);
                      $('#MaintenanceEditModal #maintenanceEditMinute').val(maintenanceEditMinute);
                     maintenanceEditSubmit.prop( "disabled", false );//Bakım türü modalında ki submit enable edilmesi
                  });


                    var maintenanceEditForm=$('#maintenanceEditForm');//Bakım türü modalında ki form'un değişkene atılması

                         maintenanceEditForm.submit(function (e) {

                        maintenanceEditSubmit.prop( "disabled", true );//Bakım türü modalında ki submit disable edilmesi
                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                            }
                        });

                        $.ajax({
                            url:'/dHome/editMaintenance',
                            type:'post',
                            data: maintenanceEditForm.serialize()+ "&maintenanceEditTitleOld=" + maintenanceEditTitle,//Tüm form elemanları ile birlikte eski Bakım title'i gönderilmesi
                            dataType:'json',
                            success:function (data) {
                                $.each($("input[name='maintenance[]']:checked"), function(){//Seçilen checkbox'ın 2 üst elemanının gizlenmesi
                                    $(this).parent().parent().hide();
                                    });
                               var maintenance  = '('+moment(data["maintenanceMinute"], "HH:mm").format("HH:mm")+') '+data["maintenanceTitle"];
                                $('#maintenanceTable').append('<tr style="line-height: 1px !important;" class="maintenanceRow" ><td  class="checkboxMaintenance">'+maintenance+'</td> <td ><input class="checkboxMaintenanceInput custom-checkbox form-check" type="checkbox" value="'+maintenance+'"  name="maintenance[]" ></td></tr>');

                                $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');//Bakım eklenmesi notification start
                                $(".notification-text").html("Maintenance Edited");
                                $('#notificationAlert').show();//Bakım eklenmesi notification end
                                $('#MaintenanceEditModal').toggle('hide');//Bakım eklenmesi modal gizlenmesi start
                                $('#ModalAdd').modal('show');//Event eklenmesi modalı gösterilmesi



                            }
                        });


                        });
            // Delete Ajax

            // Add Modal için Maintenance Delete
                        var maintenanceDeleteSubmit = $('#maintenanceDeleteSubmit');
                        var maintenanceDeleteTitle;
                        var maintenanceChekbox;
                        $('#maintenanceDelete').on('dblclick',function () {

                            $('#ModalAdd').modal('hide');
                            $('#MaintenanceDeleteModal').toggle('show');
                            $.each($("input[name='maintenance[]']:checked"), function(){
                                maintenanceChekbox=$(this).val();
                            });
                            maintenanceDeleteTitle = maintenanceChekbox.substr(8);
                             $('#MaintenanceDeleteModal #maintenanceDeleteSelect').html(maintenanceDeleteTitle);


                            maintenanceDeleteSubmit.prop( "disabled", false );
                        });

                         maintenanceDeleteSubmit.click(function (e) {

                            maintenanceDeleteSubmit.prop( "disabled", true );
                            e.preventDefault();


                            $.ajax({
                                url:'/dHome/deleteMaintenance',
                                type:'get',
                                data:
                                    {
                                        maintenanceDeleteTitle:maintenanceDeleteTitle
                                    },//Tüm form elemanları ile birlikte eski Bakım title'i gönderilmesi
                                dataType:'json',
                                success:function (data) {

                                    $.each($("input[name='maintenance[]']:checked"), function(){
                                        $(this).parent().parent().hide();
                                    });

                                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');//Bakım eklenmesi notification start
                                    $(".notification-text").html("Maintenance deleted");
                                    $('#notificationAlert').show();//Bakım eklenmesi notification end
                                    $('#MaintenanceDeleteModal').toggle('hide');//Bakım eklenmesi modal gizlenmesi start
                                    $('#ModalAdd').modal('show');//Event eklenmesi modalı gösterilmesi
                                }
                            });


                        });


});
