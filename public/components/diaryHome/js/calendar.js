$(document).ready(function () {

var calendar; // Calendar değişkeni Global olarak tanımlandı
var editData; // Editleme için events parametresinden alacağımız array
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
            defaultView:['timeGrid'],
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
            selectHelper: true, // Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
            allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
            selectMirror:true,
            eventOverlap:false,// Günlerin Kesişmesini Engeller

            loading: function(bool) {
                if (bool) {
                    $('#loading').show();
                }else{
                    $('#loading').hide();
                }
            },

            select: function(event) { //Tarih / saat seçimi yapıldığında tetiklenir.






                    var eventForm = $('#addEventForm ,#editEventForm');
                    var saveStartTime = moment(event.start).format('HH:mm');
                    var saveEndTime = moment(event.end).format('HH:mm');

                    var ms = moment(saveEndTime, "HH:mm").diff(moment(saveStartTime, "HH:mm"));
                    var d = moment.duration(ms);
                    var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                    var timeDiff = '0' + s;
                    eventForm.find("#maintenanceAddSelect option,#maintenanceEditSelect option").each(function () {
                        var maintenanceSelect = $(this).val();
                        var maintenanceEditMinute = maintenanceSelect.substr(1, 5);
                        if (maintenanceEditMinute != 'hoose') {

                            timeDiffMoment = moment(timeDiff, 'HH:mm');
                            var maintenanceEditMinuteMoment = moment(maintenanceEditMinute, 'HH:mm');

                            if (timeDiffMoment < maintenanceEditMinuteMoment) {

                                $(this).attr('disabled', 'disabled');
                            } else {

                                $(this).attr('disabled', false);
                            }

                        }
                        else
                        {
                            $(this).attr('selected',true);
                        }

                    });

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
                        bootbox.alert({
                            title: info.event.title,
                            message: 'Maintenance Title: '+data.maintenanceTitle +'<br>Maintenance Minute: '+data.maintenanceMinute ,
                            size: 'small',
                            callback: function (result) {
                                console.log('This was logged in the callback: ' + result);
                            }
                        });
                        console.log(data.maintenanceTitle);
                    }
                });


            },


            events: {
                url: '/dHome/getEvent',
                type: 'GET', // Send Get data
                success:function (rawData) {

                    editData=rawData;
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







        $.contextMenu({
            selector: '.context-menu-one',
            delegate: ".hasmenu",
            preventContextMenuForPopup: true,
            preventSelect: true,
            callback: function(key, options) {
                var locale = $('#locale-selector').val();
                var event=$(this);
                var eventId=$(this).attr('id');

                switch (key) {
                    case 'edit':


                                for(i=0;i<editData.length;i++)
                                {

                                    if(editData[i].id==eventId)
                                    {

                                        $('#ModalEdit #editId').val(eventId);
                                        $('#ModalEdit #editTitle').val(editData[i].title);
                                        $('#ModalEdit #editStart').val(editData[i].start);
                                        $('#ModalEdit #editEnd').val(editData[i].end);
                                        $.ajax({
                                            url:'/dHome/getEventsJoinMaintenance',
                                            type:'get',
                                            data:{
                                                id: editData[i].id
                                            },
                                           success:function (data) {
                                               var maintenanceEdit =document.getElementById('maintenanceEditSelect');
                                               var optionEdit;
                                               optionEdit = document.createElement('option');
                                               optionEdit.value = '('+moment(data.maintenanceMinute, "HH:mm").format("HH:mm")+') '+data.maintenanceTitle;
                                               optionEdit.innerText = '('+moment(data.maintenanceMinute, "HH:mm").format("HH:mm")+') '+data.maintenanceTitle;
                                               optionEdit.selected=true;
                                               maintenanceEdit.appendChild(optionEdit);

                                           }
                                        });


                                    }
                                }
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
        var maintenanceSelect = addEventForm.find('#maintenanceAddSelect').val();
        var maintenanceTitle = maintenanceSelect.substr(7);

        $.ajax({
            type: 'POST',
            url: '/dHome/addEvent',
            dataType:"json",
            data: {
                saveTitle: addEventForm.find('#saveTitle').val(),
                saveStart: addEventForm.find('#saveStart').val(),
                maintenanceTitle: maintenanceTitle,
                _token: addEventForm.find('#_token').val(),
                saveEnd: addEventForm.find('#saveEnd').val()
            },
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

        $('#editEventSubmit').prop( "disabled", true );
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

            }
        });

        var maintenanceSelect = editEventForm.find('#maintenanceEditSelect').val();
        var maintenanceTitle = maintenanceSelect.substr(7);
        console.log(maintenanceTitle);
        $.ajax({
            type: 'POST',
            url: '/dHome/editEvent',
            dataType:"json",
            data: {
                editId:editEventForm.find('#editId').val(),
                editTitle: editEventForm.find('#editTitle').val(),
                editStart: editEventForm.find('#editStart').val(),
                _token: editEventForm.find('#_token').val(),
                editEnd: editEventForm.find('#editEnd').val(),
                maintenanceTitle: maintenanceTitle,
            },
            success:function (editData) {
                if(editData.allDay)
                {

                    $(".notification-text").html("Event not edited because AllDay");
                    $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');

                }

                else {

                    var event = calendar.getEventById(editData.id);
                    event.remove();

                    $('#ModalEdit').modal('hide');

                    calendar.addEvent(
                        {
                            id: editData.id,
                            title: editData.title,
                            start: editData.start,
                            end: data.newTime
                        });
                }
                $(".notification-text").html("Event edited");
                $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');

                $('#notificationAlert').show();
            }
        });

    });




});
