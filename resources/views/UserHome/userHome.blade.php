@extends('layouts.app')
@section('title')

        <title class="pageTitle">User Home | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('locale')
    <select style="display: none;" class="custom-select-sm col-1 custom-select rounded-pill shadow-main" id="locale-selector"></select>
@endsection
@section('layoutDiv')
    hidden
    @endsection
@section('pageTitle')
<div class="pageTitle navbar-brand">User Home</div>
@endsection
@section('content')


    <div id="firstContainer" class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper col-lg-12 pt-lg-3">

                <div   class="card fat   rounded-lg border-light shadow-main  w-100 mb-lg-5 ml-2 mt-2 ">
                    <div  id='vueApp' class="card-body ">
                        <form id="userFirstForm"  method="post">
                            @csrf
                            <div class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2">
                                <label id="licensePlate-label"  class="col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="licensePlate">{{ __('License Plate:') }}</label>
                                <input id="licensePlate" data-bvalidator="required" type="text" class="licensePlateInput col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('licensePlate') is-invalid @enderror "  value="{{ old('licensePlate') }}"   autocomplete="off"   placeholder="License Plate"  name="licensePlate"  >
                                @error('licensePlate')
                                <span  id="licensePlate-alert" class="licensePlate-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                            <img class="col-lg-2 offset-lg-5" hidden id="miniLoading" src="/components/img/gif/miniLoading.gif">
                            <div id="carImage" hidden class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2 row">

                                <img  class="col-lg-6 carImageZoom  offset-lg-3 border-light shadow-main col-10 offset-1" src=""  \>
                                <div class="form-group btn-sm mt-2 col-lg-6  offset-lg-3">
                                    <div class="custom-switch custom-control ">
                                        <input class="custom-control-input    "  type="checkbox" name="carConfirmSwitch" id="carConfirmSwitch" >
                                        <label for="carConfirmSwitch" class="custom-control-label   ">Yes. This is from my car</label>
                                    </div>

                                </div>
                            </div>


                            <div class="form-group btn-group-sm mt-5 col-lg-6 offset-lg-3">

                            <table id="maintenanceTable" style="border-radius: 1rem; !important;" class="table table-responsive-lg table-borderless  btn-sm shadow-main">
                                <tr>
                                    <td ><b>Maintenance type</b></td>

                                    <td><b>Choose</b></td>
                                </tr>

                                @foreach($maintenance ?? '' as $row)
                                <tr style="line-height: 1px !important;padding-top:0px !important;padding-bottom:0px !important; " >
                                    <td  >({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}</td>


                                  <td> <div class="custom-switch custom-control ">
                                          <input class="custom-control-input    "  type="checkbox" value="({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}" name="maintenance[]" id="maintenance{{$row->id}}" >
                                          <label for="maintenance{{$row->id}}" class="custom-control-label   "></label>
                                      </div></td>

                                </tr>
                                     @endforeach

                            </table>
                            </div>
                            <div class="offset-lg-4 col-lg-4 mt-lg-3 text-center">

                                <div class="form-group m-0 ">
                                    <button disabled  id="goOnButton" type="submit" style="padding:15px 40px !important;" class="btn btn-sm   btn-outline-danger border-light rounded-pill shadow-main">
                                     Go on
                                    </button>

                                </div>
                            </div>

                        </form>

                        <div  style='display:none' id="secondContainer">

                            <div style="" class="loading" id="loading"><div class="sk-cube-grid">
                                    <div class="sk-cube sk-cube1"></div>
                                    <div class="sk-cube sk-cube2"></div>
                                    <div class="sk-cube sk-cube3"></div>
                                    <div class="sk-cube sk-cube4"></div>
                                    <div class="sk-cube sk-cube5"></div>
                                    <div class="sk-cube sk-cube6"></div>
                                    <div class="sk-cube sk-cube7"></div>
                                    <div class="sk-cube sk-cube8"></div>
                                    <div class="sk-cube sk-cube9"></div>
                                </div></div>

                            <div tabindex="-1" class="container w-75 h-100" id='top'>

                                <div class='left' hidden>

                                    <div id='theme-system-selector' class='selector'>
                                        Theme System:

                                        <select hidden>
                                            <option value='bootstrap' selected></option>
                                        </select>
                                    </div>

                                    <div data-theme-system="bootstrap" class='selector' style='display:none'>
                                        Theme Name:

                                        <select hidden>

                                            <option selected  value='journal'>Journal</option>

                                        </select>
                                    </div>

                                    <span id='loading' style='display:none'>loading theme...</span>

                                </div>



                                <div class='clear'></div>
                            </div>
                           <div class="ml-lg-3 ml-3">
                            <div class="row"><h6>License Plate: </h6> <h6 class="ml-lg-1" id="plateHtml"></h6></div>
                            <div class="row"><h6>Total Maintenance: </h6> <h6 class="ml-lg-1" id="minuteHtml"></h6></div>
                           </div>
                               <div class="h-100 mt-lg-3" id='calendar'>  </div>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('UserHome.Modals.editUserModal')

    <div id="notificationAlert" style="display: none;" class=" alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
        <button id="notificationHide" class="close alert-size"  type="button">
            x
        </button>
        <strong class="notification-text"></strong>
    </div>


        @endsection
        @section('css')
            <link rel="stylesheet" href="/components/userHome/css/main.css" >
            <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.0/jquery.contextMenu.css">

            <link href='/components/fullcalendar/packages/core/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

            <style>


            </style>
        @endsection
        @section('script')
            <script src="/components/userHome/js/main.js" ></script>
            <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
            <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
            <script src="/components/bvalidator/themes/red/red.js"></script>
            <script src="/components/userHome/js/jquery.contextMenu.min.js" defer></script>
            <script src="/components/userHome/js/bootbox.js" defer></script>

            <script src='/components/fullcalendar/packages/core/main.js'></script>
            <script src='/components/fullcalendar/packages/interaction/main.js'></script>
            <script src='/components/fullcalendar/packages/bootstrap/main.js'></script>
            <script src='/components/fullcalendar/packages/daygrid/main.js'></script>
            <script src='/components/fullcalendar/packages/timegrid/main.js'></script>
            <script src='/components/fullcalendar/js/theme-chooser.js'></script>
            <script src='/components/userHome/js/moment.js'></script>
            <script src='/components/fullcalendar/packages/core/locales-all.js'></script>
            <script src="/components/userHome/js/lodash.min.js"></script>
            <script>
                    var timeDiffMoment;
            $(document).ready(function () {


                    var userFirstForm=$('#userFirstForm');
                    userFirstForm.bValidator();
                    var secondContainer=$('#secondContainer');
                    var plateHtml=$('#plateHtml');
                    var minuteHtml=$('#minuteHtml');

                    var workplaceName, defaultDate, minTime,maxTime,weekends,defaultView
                    defaultDate= moment().day().today;
                    minTime="08:00:00";
                    maxTime="18:00:00";
                    weekends=false;
                    defaultView=false;
                      userFirstForm.submit(function (e) {

                        e.preventDefault();
                        $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                            }
                        });
                        $.ajax({
                            url:'{{route("userFirstFormPost")}}',
                            type:'post',
                            data:userFirstForm.serialize(),
                            dataType:'json',
                            success:function (data) {
                                    globalMaintenance=data;//Global olarak veriyi atama
                                    secondContainer.show();
                                    userFirstForm.hide();
                                    plateHtml.html(data.licensePlate);
                                    minuteHtml.html(data.totalMinute);
                                    $("input[type=checkbox]").prop("checked", false);//Bir sonraki edit işleminde seçil bir şekilde kalmamsı için

                            },
                            error:function (error) {
                                $(".notification-text").html("Please select the type of care");
                                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                $('#notificationAlert').show();
                            }
                        });






                        $.ajax({
                            url:'/getUserWorkplace',
                            type:'get',
                            data:{
                                _token:'0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT'
                            },
                            dataType:'json',
                            success:function (data) {

                                workplaceName=data[0]["workplaceName"];
                                defaultDate=data[0]["defaultDate"];
                                minTime=data[0]["minTime"];
                                maxTime=data[0]["maxTime"];
                                weekends=data[0]["weekends"];
                                defaultView=data[0]["defaultView"];
                                $('.pageTitle').html(workplaceName+' | Diary');

                                calendarBuild(defaultView,defaultDate,minTime,maxTime,weekends,plateHtml,minuteHtml);
                            },
                            error:function () {
                                defaultDate= moment().day().today;
                                minTime="08:00:00";
                                maxTime="18:00:00";
                                weekends=false;
                                defaultView=false;
                            },
                            complete : function( qXHR, textStatus ) {
                                // attach error case

                                if (textStatus === 'success') {


                                }
                            }
                        });







                      });




                });
             function calendarBuild(defaultView,defaultDate,minTime,maxTime,weekends,plateHtml,minuteHtml){


                 var i = 1;
                 var calendar;
                 var calendarEl = document.getElementById('calendar');
                 var initialLocaleCode = 'en';
                 var localeSelectorEl = document.getElementById('locale-selector');

                 initThemeChooser({
                     init: function (themeSystem) {
                         calendar = new FullCalendar.Calendar(calendarEl, {
                             plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                             themeSystem: themeSystem,
                             header: {
                                 left: 'prevYear,prev,next,nextYear today custom',
                                 center: 'title',
                                 right: 'dayGridMonth,timeGridWeek,timeGridDay'
                             },
                             defaultView: defaultView,//Varsayılan Grid
                             height: 900,//Yüksekliğinin default olarak belirlenmesi silinmesi ve değiştirilmesi sonucunda calendarın tamamı görünmeyebilir
                             defaultDate: defaultDate,//Varsayılan Tarih
                             minTime: minTime,//Mesai saatinin başlama saaati DİNAMİK OLACAK
                             maxTime: maxTime,//Mesai saatinin bitiş saaati DİNAMİK OLACAK
                             weekends: weekends,//Hafta sonunun belirlenmesi Dinamik olacak
                             weekNumbers: true,//Hafta Numaraları Gösterilmesi
                             navLinks: true, // can click day/week names to navigate views
                             editable: false,//Eventler değiştirilemez
                             eventLimit: true, // allow "more" link when too many events
                             selectable: true,//Event seçilip eklenebilir
                             selectMirror: true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                             selectHelper: true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                             allDaySlot: false,//Tüm Gün Eklenmesi İptal Edilmesi
                             eventOverlap: false,// Günlerin Kesişmesini Engeller
                             resizable: false,//Boyutunun değiştirilmesini engelleme
                             loading: function(bool) {
                                 if (bool) {
                                     $('#loading').show();
                                 }else{
                                     $('#loading').hide();
                                 }
                             },
                             select: function (event) {
                                 var saveStartTime;//Seçilen time'ın başlangıcı
                                 var saveEndTime;//Seçilen time'ın başlangıcı
                                 saveStartTime = moment(event.start).format('HH:mm');
                                 saveEndTime = moment(event.end).format('HH:mm');
                                 var ms = moment(saveEndTime, "HH:mm").diff(moment(saveStartTime, "HH:mm"));
                                 var d = moment.duration(ms);
                                 var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                                 var timeDiff = '0' + s;
                                 var today=moment().day().today;
                                 var saveStartDate = moment(event.start);
                                 var todayFormat=moment(today);
                                 if(todayFormat>=saveStartDate)
                                 {
                                     $(".notification-text").html("You can't make an appointment before now");
                                     $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                     $('#notificationAlert').show();

                                 }
                                 else {
                                     bootbox.confirm({
                                         message: "Do you want to add an appointment",
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


                                                     timeDiffMoment = moment(timeDiff, 'HH:mm');

                                                     if (globalTotalTime <= timeDiffMoment) {


                                                         $.ajaxSetup({
                                                             headers: {
                                                                 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                                                             }
                                                         });

                                                         $.ajax({
                                                             url: '{{route("eventUserAdd")}}',
                                                             type: 'post',
                                                             data: {
                                                                 saveTitle: plateHtml.html(),
                                                                 saveStart: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                                                                 maintenanceMinute: minuteHtml.html(),
                                                                 _token: '{!! csrf_token() !!}',
                                                                 saveEnd: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                                                                 maintenance: globalMaintenance['maintenance']
                                                             },
                                                             dataType: 'json',
                                                             success: function (data) {
                                                                 calendar.addEvent(
                                                                     {
                                                                         id: data['id'],
                                                                         title: data['title'] + ' | ' + globalMaintenance['maintenance'],
                                                                         start: data['start'],
                                                                         end: data['newTime'],//Sonradan eklenen dakikanın event'e end olarak eklenmesi
                                                                         backgroundColor: 'green !important',
                                                                         borderColor: 'green !important',
                                                                         editable: true,//Eklenen eventin değiştirilebilir olması
                                                                         durationEditable: false,//Eklenen eventin boyutunun değiştirilemez olması
                                                                         className: 'context-menu-one',

                                                                     });
                                                                 $(".notification-text").html("Appointment added");
                                                                 $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                                 $('#notificationAlert').show();

                                                             }
                                                             ,
                                                             error: function () {
                                                                 $(".notification-text").html("Appointment not added because this plate is registered");
                                                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                                 $('#notificationAlert').show();
                                                             }
                                                         });

                                                         i++;
                                                         $(".notification-text").html("Election not Exceeded.");
                                                         $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                         $('#notificationAlert').show();
                                                     } else {

                                                         $(".notification-text").html("Election Exceeded.");
                                                         $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                         $('#notificationAlert').show();

                                                     }



                                             }
                                             else {
                                                 $(".notification-text").html("Appointment not added");
                                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                 $('#notificationAlert').show();
                                             }
                                         }

                                     });
                                 }
                             },
                             events: {
                                 url: '/getUserEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                                 type: 'GET', // Send Get data
            // color: 'grey !important',
                                 textColor: 'white',
                                 success: function (rawData) {


                                 },
                                 error: function () {
                                     alert('There was an error while fetching events.');
                                 }
                             },
                             eventDrop: function (info) {

                                 edit(info);

                             },
                             eventRender: function (info) {

                                 $(info.el).attr("id", info.event.id).addClass('context-class');
                                 /* var today=moment().day().today;//Bugünden önceki timeların rengini değiştirme
                                  var startDate = moment(info.event.start);
                                  var todayFormat=moment(today);
                                  if(todayFormat>startDate)
                                  {
                                     // $('.fc-day').attr("style","background-color:red");
                                  }*/


                             }
                         });
                         calendar.render();
            // build the locale selector's options
                         var i=0;
                         calendar.getAvailableLocaleCodes().forEach(function (localeCode) {
                             if(i==0) {
                                 $('#locale-selector').attr('style', 'display:inherit');
                             i++;
                             }var optionEl = document.createElement('option');
                             optionEl.value = localeCode;
                             optionEl.selected = localeCode == initialLocaleCode;
                             optionEl.innerText = localeCode;
                             localeSelectorEl.appendChild(optionEl);
                         });
            // when the selected option changes, dynamically change the calendar option
                         localeSelectorEl.addEventListener('change', function () {
                             if (this.value) {
                                 calendar.setOption('locale', this.value);
                             }
                         });
                     },
                     change: function (themeSystem) {
                         calendar.setOption('themeSystem', themeSystem);
                     }
                 });
                 function edit(info){ // Drop ve Resize Olayları için tarih güncelleme


                     var today=moment().day().today;
                     var saveStartDate = moment(info.event.start);
                     var todayFormat=moment(today);
                     if(todayFormat>saveStartDate)
                     {
                         $(".notification-text").html("You can't make an appointment before now");
                         $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                         $('#notificationAlert').show();
                         info.revert();
                     }
                     else
                     {


                             var  start = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');//Drop için
                             var endMoment = moment(info.event.end).format('HH:mm:ss');//Drop Kontrolü için
                             var startMoment =moment(info.event.start).format('HH:mm:ss');//Drop Kontrolü için

                             if(moment(startMoment,"HH:mm")<moment(minTime,"HH:mm"))//Drop edildiğinde start iş başlama tarihinden önce olmaması için
                             {
                                 $(".notification-text").html("No appointment is made before the shift begins");
                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                 $('#notificationAlert').show();
                                 info.revert();
                             }
                             else if(moment(endMoment,"HH:mm")>moment(maxTime,"HH:mm"))//Drop edildiğinde end'in iş bitiş saatinden sonra olmaması için
                             {
                                 $(".notification-text").html("Appointment ends when overtime ends");
                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                 $('#notificationAlert').show();
                                 info.revert();
                             }
                             else {


                             if (info.event.end) {
                                 var end = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
                             } else {
                                 var end = start;
                             }

                             var id = info.event.id;

                             Event = [];
                             Event[0] = id;
                             Event[1] = start;
                             Event[2] = end;

                             $.ajax({
                                 url: '/dropUserEvent',
                                 type: "POST",
                                 data: {
                                     Event: Event,
                                     _token: '{!! csrf_token() !!}',
                                 },
                                 dataType: 'json',
                                 success: function (data) {
                                     $(".notification-text").html("Appointment changed");
                                     $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                     $('#notificationAlert').show();
                                 }
                             });
                         }
                     }
                 }

                 $.contextMenu({
                     selector: '.context-menu-one',
                     delegate: ".hasmenu",
                     preventContextMenuForPopup: true,
                     preventSelect: true,
                     callback: function(key, options) {
                         var locale = $('#locale-selector').val();

                         var eventId=$(this).attr('id');
                         var event = calendar.getEventById(eventId);
                         switch (key) {
                             case 'edit':

                                 var title = event.title.split("| ");
                                 $('#UserModalEdit #editId').val(event.id);
                                 $('#UserModalEdit #editTitle').val(title[0]);
                                 $('#UserModalEdit #editStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                 $('#UserModalEdit #editEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
            //Edit Formunda Bakım Türlerinin Seçilmesi
                                 var maintenance=title[1].split(",");
                                 var i=0;
                                 $.each($(".maintenanceEditRow .checkboxMaintenanceInput"),function () {

                                     var maintenanceInput=$(this).val().substr(8);
                                     if(maintenance[i]!=null) {
                                         var globalMaintenanceInput = maintenance[i].substr(11);
                                         console.log(globalMaintenanceInput)
                                     }
                                     if(maintenanceInput===globalMaintenanceInput)
                                     {
                                         $(this).prop("checked", true);

                                     }
                                     i++;
                                 });
                                 $.ajax({
                                     url:'/getUserEventsJoinMaintenance',
                                     type:'get',
                                     data:{
                                         id: event.id
                                     },
                                     success:function (data) {


                                     }
                                 });
                                 $('#UserModalEdit').modal('show');
                                 $('#editEventSubmit').prop( "disabled", false );
                                 break;
                             case 'delete':

                                 bootbox.confirm({
                                         message: "Is appointment delete?",
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
                                                     url: '/destroyUserEvent/'+eventId,
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





                 var editEventForm = $('#editUserEventForm');
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
                         url: '/editUserEvent',
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

                                 $('#UserModalEdit').modal('hide');
                                   var maintenanceTitleString="";
                                   var maintenanceTitleJson=data.maintenanceTitle;//Bakım türü İstemciden alınıp stringe atılıyor
                                    _.forEach(maintenanceTitleJson, function(value) {
                                        if(maintenanceTitleJson.length>1){
                                            maintenanceTitleString=maintenanceTitleString+value['maintenanceTitle']+',';
                                        }
                                        else{
                                            maintenanceTitleString=maintenanceTitleString+value['maintenanceTitle'];

                                        }

                                    });
                                 calendar.addEvent(
                                     {
                                         id: data.id,
                                         title: data.title + ' | ' +maintenanceTitleString,
                                         start: data.start,
                                         end: data.newTime,
                                         backgroundColor: 'green !important',
                                         borderColor: 'green !important',
                                         editable: true,//Eklenen eventin değiştirilebilir olması
                                         durationEditable: false,//Eklenen eventin boyutunun değiştirilemez olması
                                         className: 'context-menu-one',
                                     });
                                 $(".notification-text").html("Event edited");
                                 $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                             }


                             $('#notificationAlert').show();
                         },

                         error:function () {
                             $(".notification-text").html("Event not edited");
                             $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                             $('#notificationAlert').show();
                         }
                     });

                 });

             }

            </script>




@endsection
