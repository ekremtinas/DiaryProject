var calendar; // Calendar değişkeni Global olarak tanımlandı
var calendarEl = document.getElementById('calendar'); // Calendar idli div'in değişkene atanması
var localeSelectorEl = document.getElementById('locale-selector'); // Dil için seçilen dilin aktarılması için
var today = moment().day().today; // Bugünü moment ile formatlayıp alma
var initialLocaleCode = 'tr'; // Local olarak default dil seçimi
var appointmentData;
        const promiseBridges = new Promise(function(resolve, reject){
            if (resolve) {
                $.ajax({
                    url: '/dHome/getBridgeDateTime',
                    type:'get',
                    success:function (rawData) {
                        renderedBridgesData=rawData;
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
                promiseBridges.then(function(cevap){
                    cevap.forEach(function(items){
                        items['rendering']='background';
                        items['className']='fc-nonbusiness';
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
            renderedBridges=cevap;
            console.log(renderedBridges)
            calendar.addEventSource(cevap);
        });


initThemeChooser({

    init: function(themeSystem) {
        calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ], // Calendar'ın kullanacağı pluginleri import edilmesi
            themeSystem: themeSystem, // Tema sisteminin belirtilmesi
            header: { // Üst taraftaki alan
                left: 'prev,next today ', // prevYear:önceki yıl,prev:önceki ay,next:sonraki ay,nextYear:sonraki yıl,today: bugün, custom:eğer kendimiz bir buton koymamız gerekirse kullanıcak buton
                center: 'title', // Ortadaki başlık
                right: 'timeGridWeek,timeGridDay,listMonth' // dayGridMonth: Günlerin olduğu ay,timeGridWeek:haftanın liste halinde gösterilmesi,timeGridDay:Günün saatlerinin liste(grid) halinde gösterilmesi,listMonth:Belitrilen aydaki tüm eventlerin listelenmesi
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
            unselectAuto:true,//Seçilen alan başka bir yere tıklandığında kaybolması
            selectOverlap:true,//Seçilen alan kesişmesini engeller
            views: {
                timeGrid: {
                    eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            }, // Context-Menu için eventlara class atanması
            selectable: true, //Kullanıcının tıklayıp sürükleyerek birden fazla gün veya zaman dilimini vurgulamasına izin verir.
            selectMirror: true, // Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
            allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
            eventOverlap:true,// Günlerin Kesişmesini Engeller
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


                selectDiff(event);
                selectAddAppointment(event,addEventData);

            },
            eventClick: function(info) {
               /* var selectedBridge = bridgesSelector.children("option:selected").val();//Köprülerin tarih-saat aralığını seçmek için global olan selector'ün alınması
                if(selectedBridge==null || selectedBridge=='Bridge Choose') {
                    clickEventJoinMaintenance(info);
                }
                else
                {
                    clickBridge(info);
                }*/
            },
            events:function(fetchInfo, successCallback, failureCallback) {
                $.ajax({
                    url: '/dHome/getEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                    type:'get',
                    success:function (rawData ) {
                         rawData.forEach(function(items){
                             items['rendering']='background';

                         });
                        appointmentData=rawData;
                        successCallback(rawData);

                    },
                    error: function() {
                        alert('There was an error while fetching events.');
                    }
                });
            },
            selectAllow:function(selectInfo){
                    var bool=[];
                    return  selectAllowBridge(selectInfo,bool);

            },
            eventRender: function(info) {


                if(info.el.className=='fc-nonbusiness fc-bgevent')
                {

                    $(info.el).attr("id", info.event.id);/*.popover({
                                animation:true,
                                delay: 300,
                                content: 'Double click for bridge detail in '+info.event.title,
                                trigger: 'hover'
                            }).attr('title','');*/
                }
                else {
                    $(info.el).attr("id", info.event.id).addClass('context-menu-one context-class event-dark');/*.popover({
                                animation:true,
                                delay: 300,
                                content: 'Click for appointment detail in '+info.event.title,
                                trigger: 'hover'
                            });*/
                }
                $(info.el).attr("title",info.event.title);

            },
            eventDrop: function(info) {
               /* eventDrop(info);*/
            },
            eventResize: function(info) {
               /* eventResize(info);*/
            },
            dayRender: function( dayRenderInfo ) {
                var today=moment().day().today;//Bugünden önceki timeların rengini değiştirme
                var todayFormat=moment(today);
                if(todayFormat-86400000>moment(dayRenderInfo.date))//Burdaki sayı bir günün milisaniye cinsinden karşılığıdır.
                {
                    dayRenderInfo.el.style.backgroundColor='#C3C3C3';
                }

            },

        });
        calendar.render();//İlk Render Edilmesi
        //Calendar Multi Language [Start]
        calendar.setOption('locale', initialLocaleCode);
        calendar.getAvailableLocaleCodes().forEach(function(localeCode) {
            var optionEl = document.createElement('option');
            optionEl.value = localeCode;
            optionEl.selected = localeCode == initialLocaleCode;
            optionEl.innerText = localeCode;
            localeSelectorEl.appendChild(optionEl);
        });
        localeSelectorEl.addEventListener('change', function() {
            if (this.value) {
                calendar.setOption('locale', this.value);
            }
        });
        //Calendar Multi Language [End]

    },
    change: function(themeSystem) {
        calendar.setOption('themeSystem', themeSystem);
    }

});

//Seçilen Alanın Farkının Alınması Fonksiyonu [Start]
function selectDiff(event){

    var saveStartTime;//Seçilen time'ın başlangıcı
    var saveEndTime;//Seçilen time'ın başlangıcı
    saveStartTime = moment(event.start).format('HH:mm');
    saveEndTime = moment(event.end).format('HH:mm');
    var ms = moment(saveEndTime, "HH:mm").diff(moment(saveStartTime, "HH:mm"));
    var d = moment.duration(ms);
    var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
    var timeDiff = '0' + s;
    timeDiffMoment = moment(timeDiff, 'HH:mm');//Seçilen aradaki dakika farkının alınması

}
//Seçilen Alanın Farkının Alınması Fonksiyonu [End]

//Randevu Ekleme Fonksiyonu(Ajax) [Start]
function selectAddAppointment(event,addEventData) {
    var start=moment(event.start).format('YYYY-MM-DD HH:mm:ss');
    var end =moment(event.end).format('YYYY-MM-DD HH:mm:ss');
    var licensePlate=addEventData[0];
    var fullName=addEventData[1];
    var email=addEventData[2];
    var gsm=addEventData[3];
    var country=addEventData[4];
    var lang=addEventData[5];
    var maintenance=addEventData[6]['maintenance'];
    console.log(maintenance)

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

        }
    });

    $.ajax({
        url: '/addSelectAppoinment',
        type: 'post',
        data: {
            start:start,
            end:end,
            licensePlate:licensePlate,
            fullName:fullName,
            email:email,
            gsm:gsm,
            country:country,
            lang:lang,
            maintenance:maintenance,

        },
        dataType: 'json',
        success: function (data) {
            if(data['errorBridge'])
            {
                $(".notification-text").html("There is no bridge in this area. Please select another area");
                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                $('#notificationAlert').show();
            }
            else if(data['errorUser'])
            {
                $(".notification-text").html("There is this user. Please,you add dataset repeat");
                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                $('#notificationAlert').show();
            }
            else {

                appointmentData.push(data);

                calendar.addEvent(
                    {
                        id: data['id'],
                        title: data['title'],
                        start: data['start'],
                        end: data['newTime'],
                        /*   backgroundColor: 'blue !important',
                           borderColor: 'blue !important',*/
                        className: 'context-menu-one context-class event-dark',
                        /*  rendering: 'background'*/

                    });

                calendar.setOption('selectable',false);
                calendar.setOption('slotDuration','00:30');
                calendar.render();


                $('#mousepopup').effect("shake", function(){$(this).hide()});
                $(".notification-text").html("Bridge History Added");
                $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                $('#notificationAlert').show();
            }
        }
        ,
        error: function () {
            $(".notification-text").html("Bridge History not Added");
            $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
            $('#notificationAlert').show();
        }
    });


}
//Randevu Ekleme Fonksiyonu(Ajax) [End]

//Bridge'ler Üzerine Tıklandığında Select İşleminin Yapılması Fonksiyonu [Start]
function selectAllowBridge(selectInfo,bool) {
    for(var i=0;i<renderedBridges.length;i++) {
        if (moment(selectInfo.start) >= moment(renderedBridges[i]['start']) && moment(selectInfo.end) <= moment(renderedBridges[i]['end'])) {
            console.log('Seçilen Start: ' + selectInfo.start + ' | Event Start: ' + renderedBridges[i]['start'])
            console.log('Seçilen End: ' + selectInfo.end + ' | Event End: ' + renderedBridges[i]['end'])
            bool.push(true);

        } else {
            bool.push(false);

        }


    }
    var findBool= _.find(bool,function (o) {
        return o===true;
    });
    if(undefined !==findBool){
        return true;
    }
    else {
        //alert('Müsait Değil');
        return false;
    }



}
//Bridge'ler Üzerine Tıklandığında Select İşleminin Yapılması Fonksiyonu [End]
