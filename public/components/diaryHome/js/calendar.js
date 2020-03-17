var calendar; // Calendar değişkeni Global olarak tanımlandı
var calendarEl = document.getElementById('calendar'); // Calendar idli div'in değişkene atanması
var renderedData;

$(document).ready(function () {


    var localeSelectorEl = document.getElementById('locale-selector'); // Dil için seçilen dilin aktarılması için
    var today = moment().day().today; // Bugünü moment ile formatlayıp alma
    var j=0;


    var renderedBridgeData;
    const promiseBridges = new Promise(function(resolve, reject){
        if (resolve) {
            $.ajax({

                url: '/dHome/getBridgeDateTime',
                type:'get',
                success:function (rawData) {
                    globalRawData=rawData;

                    resolve(rawData);
                    console.log(1)
                },
                error: function() {
                    alert('There was an error while fetching events.');
                }
            });
        } else {
          reject('Error');
        }
      });

    const promiseBusiness = new Promise(function(resolve, reject){
        if (resolve) {
         //   var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması

            promiseBridges.then(function(cevap){
              //  var filteredData=_.filter(renderedBridgeData, function(o) { return o.title==selectedBridge; }); //Lodash kütüphanesi ile filtreliyoruz.




                    cevap.forEach(function(items){
                       // console.log(items['title']+" = "+items['start']+" - "+items['end'] );
                        items['title']='Available time';
                        items['groupId']='1';
                       items['daysOfWeek']= [0];
                       items['startTime']= moment(items['start']).format('HH:mm');
                       items['endTime']= moment(items['end']).format('HH:mm');
                       delete items['start'];
                       delete items['end'];
                       delete items['id'];
                       delete items['title'];
                       delete items['groupId'];
                    });
                    console.log(2)
                   resolve(cevap);




            });

        }

        else {
            reject('Error');
        }
    });

      promiseBusiness.then(function(cevap){
   console.log(3);
    console.log(cevap[0])

    //calendar.addEventSource(cevap);

    });

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
                slotDuration: '00:30', // Default olarak time aralığı
                defaultDate: today, //Varsayılan tarih
                weekNumbers: true, // Hafta Numaralarının gösterilmesi
                navLinks: true, // Günlerin ayrıntısı için gerekli link
                editable: true, //Değiştirilebilrliğinin aktif edilmesi
                resizable: true, // Boyutun uzatılmasının aktifleştirilmesi
                eventLimit: true, // Bir günde görüntülenen etkinlik sayısını sınırlar.Dokümantasyondan view parametresi alınarak sınırlandırılabilir.
                droppable:false,
                selectOverlap:false,//Seçilen alan kesişmesini engeller
                views: {
                    timeGrid: {
                        eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                    }
                },
              businessHours:


                  promiseBusiness.then(function(cevap){
                      console.log(3);
                      console.log(cevap[0])

                      //calendar.addEventSource(cevap);

                  })



               /* [ {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                    daysOfWeek: [ 0 ], // Monday - Thursday

                    startTime: '00:00', // a start time (10am in this example)
                    endTime: '00:00', // an end time (6pm in this example)
                 }]*/
               ,
                eventClassName:'context-menu-one', // Context-Menu için eventlara class atanması
                selectable: true, //Kullanıcının tıklayıp sürükleyerek birden fazla gün veya zaman dilimini vurgulamasına izin verir.
                selectMirror: true, // Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
                eventOverlap:false,// Günlerin Kesişmesini Engeller
                firstDay:moment().day(),
                nowIndicator:true,

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


                    var selectedBridge = bridgesSelector.children("option:selected"). val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ünün seçili olanının değerinin alınması
                    var bridgeId = bridgesSelector.children("option:selected"). data('id');//Köprülerin tarih-saat aralığını seçmek için global olan selector'ünün seçili olanın data-id'sinin alınması


                    if(selectedBridge=="Bridge Choose" || selectedBridge==null)
                    {
                        $('#ModalAdd #saveStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd #saveEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                        $('#ModalAdd').modal('show');
                        $('#editEventSubmit').prop( "disabled", true );
                    }
                    else
                    {
                        bridgeDateTime(selectedBridge,event,selectedBridge,bridgeId);


                    }



                },
                eventClick: function(info) {

                    var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                    if(selectedBridge==null || selectedBridge=='Bridge Choose') {
                        $.ajax({
                            url: '/dHome/getEventsJoinMaintenance',
                            type: 'get',
                            data: {
                                id: info.event.id
                            },
                            dataType: 'json',
                            success: function (data) {
                                var title = info.event.title;
                                var message = 'Maintenance Title: ' + data.maintenanceTitle + '<br>Maintenance Minute: ' + data.maintenanceMinute;
                                if (data.joinError) {
                                    title = 'Maintenance not found';
                                    message = 'No maintenance type assigned';
                                } else {
                                    title = info.event.title;
                                    message = 'Maintenance Title: ' + data.maintenanceTitle + '<br>Maintenance Minute: ' + data.maintenanceMinute;

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
                    }
                    else
                    {

                    }

                },

                events:function(fetchInfo, successCallback, failureCallback) {
                    $.ajax({

                        url: '/dHome/getEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                        type:'get',
                        success:function (rawData ) {
                            globalRawData=rawData;
                            renderedData=rawData;
                            successCallback(rawData);
                        },
                        error: function() {
                            alert('There was an error while fetching events.');
                        }
                    });


                  },
                selectConstraint: "businessHours",
                eventRender: function(info) {
                    var busLength= $('.fc-content-skeleton').find('table').find('.fc-nonbusiness').length;
                    var bus =$('.fc-content-skeleton').find('table').find('.fc-nonbusiness');
                    for(var i=0;i<busLength;i++)
                    {
                        $(bus[i]).on('click',function () {
                            alert('Müsait Değil');
                        });
                    }

                     //   $('.fc-nonbusiness').attr('style','cursor:none !important;');
                    if(info.event.groupId === "1"){
                        // Just add some text or html to the event element.
                       //  $(info.el).attr('style','background-color:blue !important;border-color:blue !important;opacity:0.5 !important');
                      //   $(info.el).parent().parent().children(':last-child').attr('style','opacity:0.5 !important');
                        /*   var gridTr=$('.fc-slats').find('table').find('tr');
                           console.log(gridTr)
                           $.each(gridTr,function (items) {
                               $(gridTr[items]).attr('style','background-color:red !important');
                               console.log($(gridTr[items]).data('time'))
                           });*/

                    }
                    $(info.el).attr("id",info.event.id).addClass('context-class');
                    $(info.el).attr("title",info.event.title);
                    var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                    if(selectedBridge=="Bridge Choose" || selectedBridge==null)
                    {

                    }
                    else
                    {

                        $(info.el).attr("style","background-color:#17225e !important;border-color:#17225e !important");

                    }

                },
                eventDrop: function(info) {
                    var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                    if(selectedBridge==null || selectedBridge=='Bridge Choose')
                    {
                        edit(info.event);
                    }
                   else
                    {
                        editBridge(info.event);
                      //  info.revert();
                    }

                },

                eventResize: function(info) {

                    var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                    if(selectedBridge==null || selectedBridge=='Bridge Choose')
                    {
                        edit(info.event);
                    }
                    else
                    {
                        editBridge(info.event);
                        //info.revert();
                    }

                },
                dayRender: function( dayRenderInfo ) {
                    var today=moment().day().today;//Bugünden önceki timeların rengini değiştirme
                    var todayFormat=moment(today);
                    if(todayFormat-86400000>moment(dayRenderInfo.date))//Burdaki sayı bir günün milisaniye cinsinden karşılığıdır.
                    {
                        dayRenderInfo.el.style.backgroundColor='#C3C3C3';
                    }

                    var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması




                    if(selectedBridge==null || selectedBridge=='Bridge Choose')
                    {
                     //   dayRenderInfo.el.style.backgroundColor='#ecb6b6';




                    }
                    else
                    {
                     //     dayRenderInfo.el.style.backgroundColor='#64bfdd';
                    }



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

            //Bridge Select and Render

            bridgesSelector.on('change',function(){
                var selectedBridge = $(this).children("option:selected"). val();
                var selectedBridgeId = $(this).children("option:selected").data('id');
                if(selectedBridge==null || selectedBridge=="Bridge Choose")
                {

                    $.ajax({

                        url: '/dHome/getEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                        type:'get',
                        success:function (rawData) {
                            globalRawData=rawData;
                            renderedData=rawData;
                            calendar.removeAllEvents();
                            calendar.addEventSource(rawData);
                            calendar.render();

                        },
                        error: function() {
                            alert('There was an error while fetching events.');
                        }
                    });

                }
                else
                {

                    $.ajax({

                        url: '/dHome/getBridgeDateTime',
                        type:'get',
                        success:function (rawData) {
                            globalRawData=rawData;
                            renderedData=rawData;
                            var filteredData=_.filter(renderedData, function(o) { return o.title==selectedBridge; }); //Lodash kütüphanesi ile filtreliyoruz.
                            calendar.removeAllEvents();

                            calendar.addEventSource(filteredData);
                            calendar.render();
                        },
                        error: function() {
                            alert('There was an error while fetching events.');
                        }
                    });
                }


            });




            $('.fc-next-button').on('click',function () {//İleri Butonu ile render etme işlemi

                calendar.removeAllEvents();
                calendar.addEventSource(renderedData);
            });
            $('.fc-prev-button').on('click',function () {//Geri Butonu ile render etme işlemi

            calendar.removeAllEvents();
            calendar.addEventSource(renderedData);
            });

            $( "#dialogBridgeDatetimeDelete" ).dialog({//Bridge Event'inin Silinmesi Konusunda Dialog Kurulması
                position: {
                    my: "center",
                    at: "center",
                    of: window
                },
                autoOpen: false,
                title: "Bridge Delete",
                height: 200,
                closeText: "",

            }).prev(".ui-dialog-titlebar").attr("style","background-color:#e22620 !important;border-color:#e22620 !important;");

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
                            var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                            if(selectedBridge==null || selectedBridge=='Bridge Choose') {
                                $('#addEventForm').find("input[name='maintenance[]']:checked").prop('checked', false);
                                $('#addEventForm')[0].reset();
                                chooseMessage.html('');


                                $('#ModalEdit #editId').val(event.id);
                                $('#ModalEdit #editTitle').val(event.title);
                                $('#ModalEdit #editStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                $('#ModalEdit #editEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));

                                $.ajax({
                                    url: '/dHome/getEventsJoinMaintenance',
                                    type: 'get',
                                    data: {
                                        id: event.id
                                    },
                                    success: function (data) {

                                        var maintenanceMinute = moment(data.maintenanceMinute, "HH:mm");//Seçilen time'ın bakım time'larından büyük olması durumumda disable edilmesi

                                        var ms = moment(event.end, "HH:mm").diff(moment(event.start, "HH:mm"));
                                        var d = moment.duration(ms);
                                        var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                                        var timeDiff = '0' + s;
                                        timeDiffMoment = moment(timeDiff, 'HH:mm');

                                        var optionName = data.maintenanceTitle.split(',');


                                        $.each($('#maintenanceTableEdit').find("input[name='maintenance[]']"), function () {//Checkbox'ın seçilmesi//Editlenmek istenen bakım türü seçiliyor.
                                            $(this).prop('checked', false);

                                            for (var j = 0; j < optionName.length; j++) {
                                                if ($(this).val().substr(8) == optionName[j]) {
                                                    $(this).prop('checked', true);
                                                    // console.log($(this))


                                                }
                                            }


                                        });


                                    }
                                });


                                $('#ModalEdit').modal('show');
                                $('#editEventSubmit').prop("disabled", false);


                            }
                            else
                            {
                                $("#dialogEdit").dialog("open");
                                $( "#dialogAdd" ).dialog( "close" );
                                $( "#dialogDelete" ).dialog( "close" );
                            }


                            break;
                        case 'delete':
                            var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                            if(selectedBridge==null || selectedBridge=='Bridge Choose') {
                                bootbox.confirm({
                                        message: "Is event delete?",
                                        size: 'small',
                                        locale: locale,
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
                                            if (result === true) {

                                                $.ajaxSetup({
                                                    headers: {
                                                        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                    }
                                                });

                                                $.ajax({
                                                    type: 'GET',
                                                    url: '/dHome/destroyEvent/' + eventId,
                                                    dataType: 'json',
                                                    success: function (data) {
                                                        $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                        $(".notification-text").html("Event deleted");
                                                        $('#notificationAlert').show();
                                                        event.remove();


                                                    }
                                                });

                                            } else {
                                                $(".notification-text").html("Event not deleted");
                                                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                $('#notificationAlert').show();
                                            }
                                        }
                                    }
                                );
                            }
                            else
                            {
                                $('#bridgeDatetimeDeleteForm').find('#bridgeDatetimeId').attr('value',eventId);
                                $('#bridgeDatetimeDelete').html(moment(event.start).format('YYYY.MM.DD HH:mm:ss') +" - "+moment(event.end).format('YYYY.MM.DD HH:mm:ss') );
                                 $("#dialogBridgeDatetimeDelete").dialog("open");
                                $( "#dialogAdd" ).dialog( "close" );
                                $( "#dialogEdit" ).dialog( "close" );
                            }


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



    //Bridge DateTime Function

    function bridgeDateTime(selectedBridge,event,bridgeName,bridgeId) {

        bootbox.confirm({
            message: "Do you want to add an bridge datetime",
            size: 'small',
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
                if (result === true) {
                    console.log(bridgeId)


                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                        }
                    });

                    $.ajax({
                        url: '/addBridgeDateTime',
                        type: 'post',
                        data: {
                            bridge_name:bridgeName,
                            bridge_id:bridgeId,
                            start: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                            end: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                        },
                        dataType: 'json',
                        success: function (data) {
                            calendar.addEvent(
                                {
                                   // id: data['id'],
                                    title: data['bridge_name'] ,
                                    start: data['start'],
                                    end: data['end'],
                                    backgroundColor: 'blue !important',
                                    borderColor: 'blue !important',



                                });
                            $(".notification-text").html("Bridge History Added");
                            $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                            $('#notificationAlert').show();

                        }
                        ,
                        error: function () {
                            $(".notification-text").html("Bridge History not Added");
                            $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                            $('#notificationAlert').show();
                        }
                    });


                }


                else {
                    $(".notification-text").html("Bridge History not added");
                    $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                    $('#notificationAlert').show();
                }

            }

        });


    }


});

