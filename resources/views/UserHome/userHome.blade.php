@extends('layouts.app')
@section('title')

        <title>User Home | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('locale')
    <select class="custom-select-sm col-1 custom-select rounded-pill shadow-main" id="locale-selector"></select>
@endsection
@section('content')


    <div id="firstContainer" class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper col-lg-12 pt-lg-3">

                <div   class="card fat   rounded-lg border-light shadow-main  w-100 mb-lg-5 ">
                    <div  id='vueApp' class="card-body ">
                        <h4 class="card-title text-center ">User Home</h4>
                        <form id="userFirstForm"  method="post">
                            @csrf
                            <div class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2">
                                <label id="licensePlate-label"  class="col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="licensePlate">{{ __('License Plate:') }}</label>
                                <input id="licensePlate" data-bvalidator="required" type="text" class="col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('licensePlate') is-invalid @enderror "  value="{{ old('licensePlate') }}"   autocomplete="off"   placeholder="License Plate"  name="licensePlate"  >
                                @error('licensePlate')
                                <span  id="licensePlate-alert" class="licensePlate-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>


                            <div class="form-group btn-group-sm mt-5 col-lg-6 offset-lg-3">
                            <table id="maintenanceTable" style="border-radius: 1rem; !important;" class="table table-responsive-lg table-borderless  btn-sm shadow-main">
                                <tr>
                                    <td ><b>Maintenance type</b></td>

                                    <td><b>Choose</b></td>
                                </tr>

                                @foreach($maintenance ?? '' as $row)
                                <tr style="line-height: 1px !important;" >
                                    <td  >({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}</td>

                                    <td ><input  class="custom-checkbox form-check" type="checkbox" value="({{$row->maintenanceMinute}}) ({{$row->id}})" name="maintenance[]" ></td>
                                </tr>
                                     @endforeach

                            </table>
                            </div>
                            <div class="offset-lg-4 col-lg-4 mt-lg-5">

                                <div class="form-group m-0 ">
                                    <button  id="goOnButton" type="submit" class="btn btn-sm  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                     Go on
                                    </button>

                                </div>
                            </div>

                        </form>

                        <div  style='display:none' id="secondContainer">


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
                           <div class="ml-lg-3">
                            <div class="row"><h6>License Plate: </h6> <h6 class="ml-lg-1" id="plateHtml"></h6></div>
                            <div class="row"><h6>Total maintenance time: </h6> <h6 class="ml-lg-1" id="minuteHtml"></h6></div>
                           </div>
                               <div class="h-100 mt-lg-5" id='calendar'></div>

                            <div class="offset-lg-3 col-lg-6 mt-lg-5">
                                <div class="form-group m-0 ">
                                    <button  id="appointmentButton" type="submit" class="btn btn-sm  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                        Make an Appointment
                                    </button>

                                </div>
                            </div>

                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>


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
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">

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
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js" defer></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js" defer></script>

            <script src='/components/fullcalendar/packages/core/main.js'></script>
            <script src='/components/fullcalendar/packages/interaction/main.js'></script>
            <script src='/components/fullcalendar/packages/bootstrap/main.js'></script>
            <script src='/components/fullcalendar/packages/daygrid/main.js'></script>
            <script src='/components/fullcalendar/packages/timegrid/main.js'></script>
            <script src='/components/fullcalendar/js/theme-chooser.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js'></script>
            <script src='/components/fullcalendar/packages/core/locales-all.js'></script>
            <script>

                $(document).ready(function () {


                    if (window.history && window.history.pushState) {

                        window.history.pushState('forward', null, './#forward');

                        $(window).on('popstate', function() {
                            bootbox.confirm({
                                    message: "The transactions were not completed.Are you sure you want to quit?",
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

                                    }
                                }

                            );
                        });

                    }

                    var firstFormData;


                    $('#userFirstForm').bValidator();

                    var userFirstForm=$('#userFirstForm');
                    var secondContainer=$('#secondContainer');
                    var plateHtml=$('#plateHtml');
                    var minuteHtml=$('#minuteHtml');
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

                                    secondContainer.show();
                                    userFirstForm.hide();
                                    plateHtml.html(data.licensePlate);
                                    minuteHtml.html(data.totalMinute);


                            },
                            error:function (error) {
                                $(".notification-text").html("Please select the type of care");
                                $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                $('#notificationAlert').show();
                            }
                        });

                    });


                         var i=1;
                        var calendar;
                        var calendarEl = document.getElementById('calendar');
                        var initialLocaleCode = 'en';
                        var localeSelectorEl = document.getElementById('locale-selector');
                        var today = moment().day().today; // Bugünü moment ile formatlayıp alma
                        initThemeChooser({
                            init: function(themeSystem) {
                                calendar = new FullCalendar.Calendar(calendarEl, {
                                    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
                                    themeSystem: themeSystem,
                                    header: {
                                        left: 'prevYear,prev,next,nextYear today custom',
                                        center: 'title',
                                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                                    },
                                    defaultView: 'dayGridMonth',//Varsayılan Grid
                                    height: 900,//Yüksekliğinin default olarak belirlenmesi silinmesi ve değiştirilmesi sonucunda calendarın tamamı görünmeyebilir
                                    defaultDate: today,
                                    weekNumbers: true,//Hafta Numaraları Gösterilmesi
                                    navLinks: true, // can click day/week names to navigate views
                                    editable: false,//Eventler değiştirilemez
                                    eventLimit: true, // allow "more" link when too many events

                                    selectable: true,//Event seçilip eklenebilir
                                    selectMirror: true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                                    selectHelper:true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                                    allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
                                    eventOverlap:false,// Günlerin Kesişmesini Engeller
                                    resizable: false,//Boyutunun değiştirilmesini engelleme
                                    businessHours: { //Sınırlama işlemlerinin yapılması
                                        // days of week. an array of zero-based day of week integers (0=Sunday)
                                        daysOfWeek: [ 1, 2, 3, 4,5], // Monday - Thursday

                                        startTime: '10:00', // a start time (10am in this example)
                                        endTime: '18:00', // an end time (6pm in this example)
                                    },
                                    select: function(event) {


                                        if(i==1) {
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
                                                    saveEnd: moment(event.end).format('YYYY-MM-DD HH:mm:ss')
                                                },
                                                dataType: 'json',
                                                success: function (data) {
                                                    calendar.addEvent(
                                                        {
                                                            id: data['id'],
                                                            title: data['title'],
                                                            start: data['start'],
                                                            end: data['newTime'],//Sonradan eklenen dakikanın event'e end olarak eklenmesi
                                                            backgroundColor:'green !important',
                                                            borderColor:'green !important',
                                                            editable:true,//Eklenen eventin değiştirilebilir olması
                                                            durationEditable:false,//Eklenen eventin boyutunun değiştirilemez olması
                                                            className:'context-menu-one',

                                                        });
                                                    $(".notification-text").html("Appointment added");
                                                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                    $('#notificationAlert').show();

                                                }
                                            });
                                        i++;
                                        }
                                        else
                                        {
                                            $(".notification-text").html("Already added appointment cannot be added any more");
                                            $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                            $('#notificationAlert').show();
                                        }

                                    },
                                    events: {
                                        url: '/getUserEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                                        type: 'GET', // Send Get data
                                       // color: 'grey !important',
                                        textColor: 'white',
                                        success:function (rawData) {


                                        },
                                        error: function() {
                                            alert('There was an error while fetching events.');
                                        }
                                    },
                                    eventDrop: function(info) {

                                        edit(info.event);

                                    },
                                    eventRender: function(info) {

                                        $(info.el).attr("id",info.event.id).addClass('context-class');



                                    }
                                });
                                calendar.render();
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
                            },
                            change: function(themeSystem) {
                                calendar.setOption('themeSystem', themeSystem);
                            }
                        });



                    function edit(event){ // Drop ve Resize Olayları için tarih güncelleme

                        var  start = moment(event.start).format('YYYY-MM-DD HH:mm:ss');
                        if(event.end){
                            var   end = moment(event.end).format('YYYY-MM-DD HH:mm:ss');
                        }else{
                            var   end = start;
                        }

                        var   id =  event.id;

                        Event = [];
                        Event[0] = id;
                        Event[1] = start;
                        Event[2] = end;

                        $.ajax({
                            url: '/dropUserEvent',
                            type: "POST",
                            data: {
                                Event:Event,
                                _token: '{!! csrf_token() !!}',
                            },
                            dataType:'json',
                            success: function(data) {
                                $(".notification-text").html("Appointment changed");
                                $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                $('#notificationAlert').show();
                            }
                        });
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


                                        }
                                    });
                                     $('#ModalEdit').modal('show');
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











                });


            </script>




@endsection
