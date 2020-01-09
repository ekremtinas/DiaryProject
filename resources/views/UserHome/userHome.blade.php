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
                                <label id="licensePlate-label"  class="btn-sm scroll-label" for="licensePlate">{{ __('License Plate:') }}</label>
                                <input id="licensePlate" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('licensePlate') is-invalid @enderror "  value="{{ old('licensePlate') }}"   autocomplete="off"   placeholder="License Plate"  name="licensePlate"  >
                                @error('licensePlate')
                                <span  id="licensePlate-alert" class="licensePlate-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>


                            <div class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2">
                            <table id="maintenanceTable" style="border-radius: 1rem; !important;" class="table table-responsive-lg table-borderless  btn-sm shadow-main">
                                <tr>
                                    <td >Maintenance type</td>

                                    <td>Choose</td>
                                </tr>
                                @foreach($maintenance as $row)
                                <tr style="line-height: 3px">
                                    <td  >({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}</td>

                                    <td ><input class="custom-checkbox form-check" type="checkbox" value="({{$row->maintenanceMinute}}) ({{$row->id}})" name="maintenance[]" ></td>
                                </tr>
                                @endforeach
                            </table>
                            </div>
                            <div class="offset-lg-3 col-lg-6 mt-lg-5">

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





        @endsection
        @section('css')
            <link rel="stylesheet" href="/components/userHome/css/main.css" >
            <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />

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


                            }
                        });

                    });



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
                                    defaultView: 'dayGridMonth',
                                    height: 900,
                                    defaultDate: today,
                                    weekNumbers: true,
                                    navLinks: true, // can click day/week names to navigate views
                                    editable: false,
                                    eventLimit: true, // allow "more" link when too many events
                                    eventClassName:'context-menu-one',
                                    selectable: true,
                                    selectMirror: true,
                                    selectHelper:true,
                                    allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
                                    eventOverlap:false,// Günlerin Kesişmesini Engeller
                                    resizable: false,
                                    select: function(event) {

                                        $.ajaxSetup({
                                            headers: {
                                                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                                            }
                                        });
                                        $.ajax({
                                            url:'{{route("eventUserAdd")}}',
                                            type:'post',
                                            data:{
                                                saveTitle: plateHtml.html(),
                                                saveStart: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                                                maintenanceMinute: minuteHtml.html(),
                                                _token: '{!! csrf_token() !!}',
                                                saveEnd: moment(event.end).format('YYYY-MM-DD HH:mm:ss')
                                            },
                                            dataType:'json',
                                            success:function (data) {
                                                calendar.addEvent(
                                                    {
                                                        id: data['id'],
                                                        title: data['title'],
                                                        start: data['start'],
                                                        end: data['newTime']
                                                    });

                                            }
                                        });
                                    },
                                    events: {
                                        url: '/getUserEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                                        type: 'GET', // Send Get data
                                        color: 'yellow',
                                        textColor: 'white',
                                        success:function (rawData) {


                                        },
                                        error: function() {
                                            alert('There was an error while fetching events.');
                                        }
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




                });


            </script>




@endsection
