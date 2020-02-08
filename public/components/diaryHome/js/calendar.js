$(document).ready(function () {

var calendar; // Calendar değişkeni Global olarak tanımlandı
var calendarEl = document.getElementById('calendar'); // Calendar idli div'in değişkene atanması

var localeSelectorEl = document.getElementById('locale-selector'); // Dil için seçilen dilin aktarılması için
var today = moment().day().today; // Bugünü moment ile formatlayıp alma

initThemeChooser({

    init: function(themeSystem) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ], // Calendar'ın kullanacağı pluginleri import edilmesi
            themeSystem: themeSystem, // Tema sisteminin belirtilmesi

            header: { // Üst taraftaki alan
                left: 'prevYear,prev,next,nextYear today custom', // prevYear:önceki yıl,prev:önceki ay,next:sonraki ay,nextYear:sonraki yıl,today: bugün, custom:eğer kendimiz bir buton koymamız gerekirse kullanıcak buton
                center: 'title', // Ortadaki başlık
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth' // dayGridMonth: Günlerin olduğu ay,timeGridWeek:haftanın liste halinde gösterilmesi,timeGridDay:Günün saatlerinin liste(grid) halinde gösterilmesi,listMonth:Belitrilen aydaki tüm eventlerin listelenmesi

            },
            defaultView:['timeGridWeek'],
            defaultDate: today, //Varsayılan tarih
            weekNumbers: true, // Hafta Numaralarının gösterilmesi
            navLinks: true, // Günlerin ayrıntısı için gerekli link
            editable: true, //Değiştirilebilrliğinin aktif edilmesi
            resizable: true, // Boyutun uzatılmasının aktifleştirilmesi
            eventLimit: true, // Bir günde görüntülenen etkinlik sayısını sınırlar.Dokümantasyondan view parametresi alınarak sınırlandırılabilir.
            droppable:false,
            views: {
                timeGrid: {
                    eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            businessHours: { //Sınırlama işlemlerinin yapılması
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 1, 2, 3, 4,5], // Monday - Thursday

                startTime: '10:00', // a start time (10am in this example)
                endTime: '18:00', // an end time (6pm in this example)
            },
            eventClassName:'context-menu-one', // Context-Menu için eventlara class atanması
            selectable: true, //Kullanıcının tıklayıp sürükleyerek birden fazla gün veya zaman dilimini vurgulamasına izin verir.
            selectMirror: true, // Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
            allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
            eventOverlap:false,// Günlerin Kesişmesini Engeller

            loading: function(bool) {
                if (bool) {
                    $('#loading').show();
                }else{
                    $('#loading').hide();
                }
            },

            select: function(event) { //Tarih / saat seçimi yapıldığında tetiklenir.
                    $('#editEventForm')[0].reset();//Diğer Form'da ki verilerin temizlenmesi işlemi bu işlemin yapılmasının nedeni iki form da aynı anda dom üzerinde durduğu için hatalara neden oluyor
                    $('#editEventForm').find("input[name='maintenance[]']:checked").prop('checked', false);

                    var chooseMessage=$('.chooseMessage');//Bakım türü aşımı mesajının kaldırılması
                    chooseMessage.html('');//Bakım türü aşımı mesajının kaldırılması


                    var saveStartTime;//Seçilen time'ın başlangıcı
                    var saveEndTime;//Seçilen time'ın başlangıcı
                    saveStartTime = moment(event.start).format('HH:mm');
                    saveEndTime = moment(event.end).format('HH:mm');
                    var ms = moment(saveEndTime, "HH:mm").diff(moment(saveStartTime, "HH:mm"));
                    var d = moment.duration(ms);
                    var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                    var timeDiff = '0' + s;
                    timeDiffMoment = moment(timeDiff, 'HH:mm');//Seçilen aradaki dakika farkının alınması




                $('#ModalAdd #saveStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd #saveEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                $('#ModalAdd').modal('show');
                $('#editEventSubmit').prop( "disabled", true );



            },
            eventClick: function(info) {


                $.ajax({
                    url:'/dHome/getEventsJoinMaintenance',
                    type:'get',
                    data:{
                      id: info.event.id
                    },
                    dataType:'json',
                    success:function (data) {
                        var title =info.event.title;
                        var message='Maintenance Title: '+data.maintenanceTitle +'<br>Maintenance Minute: '+data.maintenanceMinute ;
                        if(data.joinError)
                        {
                                title='Maintenance not found';
                                message='No maintenance type assigned';
                        }
                        else{
                            title =info.event.title;
                            message='Maintenance Title: '+data.maintenanceTitle +'<br>Maintenance Minute: '+data.maintenanceMinute ;

                        }

                                bootbox.alert({
                                    title: title,
                                    message: message,
                                    size: 'small',
                                    callback: function (result) {

                                    }
                                });

                    }
                });


            },


            events: {
                url: '/dHome/getEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                type: 'GET', // Send Get data
                color: 'yellow',
                textColor: 'white',
                success:function (rawData) {
                    globalRawData=rawData;
                },
                error: function() {
                    alert('There was an error while fetching events.');
                }
            },
            eventRender: function(info) {

                $(info.el).attr("id",info.event.id).addClass('context-class');



            },
            eventDrop: function(info) {

                edit(info.event);

            },
            eventResize: function(info) {

                edit(info.event);

            },






        });
        calendar.render();
        calendar.setOption('locale', initialLocaleCode);
        // build the locale selector's options
        calendar.getAvailableLocaleCodes().forEach(function(localeCode) {

            var optionEl = document.createElement('option');
            optionEl.value = localeCode;
            optionEl.selected = localeCode == initialLocaleCode;
            optionEl.innerText = localeCode;
            localeSelectorEl.appendChild(optionEl);
        });

        // when the selected option changes, dynamically change the calendar option
        localeSelectorEl.addEventListener('change', function() {
            if (this.value) {
                calendar.setOption('locale', this.value);
            }


        });





// CONTEXT MENU
        $.contextMenu({
            selector: '.context-menu-one',
            delegate: ".hasmenu",
            preventContextMenuForPopup: true,
            preventSelect: true,
            callback: function(key, options) {
                var locale = $('#locale-selector').val();
                var chooseMessage=$('.chooseMessage');
                var eventId=$(this).attr('id');
                var event = calendar.getEventById(eventId);
                switch (key) {
                    case 'edit':

                                       $('#addEventForm').find("input[name='maintenance[]']:checked").prop('checked', false);
                                       $('#addEventForm')[0].reset();
                                        chooseMessage.html('');


                                        $('#ModalEdit #editId').val(event.id);
                                        $('#ModalEdit #editTitle').val(event.title);
                                        $('#ModalEdit #editStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                        $('#ModalEdit #editEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));

                                        $.ajax({
                                            url:'/dHome/getEventsJoinMaintenance',
                                            type:'get',
                                            data:{
                                                id: event.id
                                            },
                                           success:function (data) {

                                               var maintenanceMinute=moment(data.maintenanceMinute, "HH:mm");//Seçilen time'ın bakım time'larından büyük olması durumumda disable edilmesi

                                               var ms = moment(event.end, "HH:mm").diff(moment(event.start, "HH:mm"));
                                               var d = moment.duration(ms);
                                               var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                                               var timeDiff = '0' + s;
                                               timeDiffMoment = moment(timeDiff, 'HH:mm');

                                               var optionName= data.maintenanceTitle.split(',');


                                               $.each($('#maintenanceTableEdit').find("input[name='maintenance[]']"), function() {//Checkbox'ın seçilmesi//Editlenmek istenen bakım türü seçiliyor.
                                                   $(this).prop('checked', false);

                                                   for (var j = 0; j < optionName.length; j++)
                                                   {
                                                        if ($(this).val().substr(8) == optionName[j]) {
                                                           $(this).prop('checked', true);
                                                           // console.log($(this))


                                                        }
                                               }


                                               });




                                           }
                                        });




                                $('#ModalEdit').modal('show');
                                $('#editEventSubmit').prop( "disabled", false );





                        break;
                    case 'delete':

                        bootbox.confirm({
                                message: "Is event delete?",
                                size: 'small',
                                locale:  locale,
                                buttons: {
                                    confirm: {
                                        label: 'Yes',
                                        className: 'btn-success'
                                    },
                                    cancel: {
                                        label: 'No',
                                        className: 'btn-danger'
                                    }
                                },
                                callback: function (result) {
                                    if(result===true)
                                    {

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                            }
                                        });

                                        $.ajax({
                                            type: 'GET',
                                            url: '/dHome/destroyEvent/'+eventId,
                                            dataType:'json',
                                            success:function(data){
                                                $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                $(".notification-text").html("Event deleted");
                                                $('#notificationAlert').show();
                                                event.remove();




                                            }
                                        });

                                    }
                                    else{
                                        $(".notification-text").html("Event not deleted");
                                        $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                        $('#notificationAlert').show();
                                    }
                                }
                            }

                        );


                        break;

                }
            },
            items: {
                "edit": {name: "Edit", icon: "edit"},
                "delete": {name: "Delete", icon: "delete"},


            }
        });


        $('.context-menu-one').on('click', function(e){
            console.log('clicked', this);
        });
    },


    change: function(themeSystem) {
        calendar.setOption('themeSystem', themeSystem);
    }

});

    var addEventForm = $('#addEventForm');
    var editEventForm = $('#editEventForm');

    addEventForm.submit(function(e){
        $('#addEventSubmit').prop( "disabled", true );
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

            }
        });


        $.ajax({
            type: 'POST',
            url: '/dHome/addEvent',
            dataType:"json",
            data: addEventForm.serialize() ,
            success:function (data) {
                if(data.allDay)
                {

                    $(".notification-text").html("Event not added because AllDay");
                    $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');

                }
                else if(data.conflict)
                {

                    $(".notification-text").html("Event not added because Conflict Time");
                    $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');

                }
                else {

                    $('#ModalAdd').modal('hide');

                    calendar.addEvent(
                        {
                            id: data['id'],
                            title: data['title'],
                            start: data['start'],
                            end: data['newTime']
                        });
                    $(".notification-text").html("Event added");
                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                   data=null;


                }
                $('#notificationAlert').show();
                $('#addEventSubmit').prop( "disabled", false );


            },
            error:function () {
                $(".notification-text").html("Event not added");
                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                $('#notificationAlert').show();
                $('#addEventSubmit').prop( "disabled", false );
            }
        });
    });
    editEventForm.submit(function(e){

      //  $('#editEventSubmit').prop( "disabled", true );
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

            }
        });



        $.ajax({
            type: 'POST',
            url: '/dHome/editEvent',
            dataType:"json",
            data: editEventForm.serialize() ,
            success:function (data) {

                if(data.errorEdit)
                {

                    $(".notification-text").html("Event not edited ");
                    $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');

                }

                else {

                    var event = calendar.getEventById(data.id);
                    event.remove();

                    $('#ModalEdit').modal('hide');

                    calendar.addEvent(
                        {
                            id: data.id,
                            title:data.title,
                            start: data.start,
                            end: data.newTime
                        });
                    $(".notification-text").html("Event edited");
                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                }


                $('#notificationAlert').show();
            }
        });

    });

//Checkbox Seçimi sonrası uyarı Çakışma engelleme denemesi
    /*$("input[type=checkbox]").click(function() {
        console.log("sad");
        $.each($("input[name='maintenance[]']:checked"), function () {//Checkbox'ın seçilmesi

            var maintenanceCheckbox = $(this).val();
            var maintenanceMinute = maintenanceCheckbox.substr(1, 5);



            var maintenanceMinuteMoment = moment(maintenanceMinute, 'HH:mm');

            if (timeDiffMoment < maintenanceMinuteMoment) {

                $(this).attr('disabled', 'disabled');
            } else {

                $(this).attr('disabled', false);
            }
            $(this).attr('selected', false);


        });
    });*/




});

