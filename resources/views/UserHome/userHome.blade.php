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


    <div id="container" class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper ">
                <div style="width:550px " id="image" class="brand text-center">
                    <img class="col-5 offset-0" src="/components/img/diaryLogo.png" alt="logo">
                </div>
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



                    <div  style="display: none;height: 70% !important;"  id="userSecondForm">


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


                            <div class="h-100" id='calendar'></div>
                        </div>
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







                    $('#userFirstForm').bValidator();

                    var userFirstForm=$('#userFirstForm');
                    var userSecondForm=$('#userSecondForm');

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
                                if(data!=null)
                                {
                                    userSecondForm.show();
                                    userFirstForm.hide();
                                   
                                }

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
                                    defaultView: ['dayGridMonth'],
                                    defaultDate: today,
                                    weekNumbers: true,
                                    navLinks: true, // can click day/week names to navigate views
                                    editable: true,
                                    eventLimit: true, // allow "more" link when too many events
                                    eventClassName:'context-menu-one',
                                    selectable: true,
                                    selectMirror: true,
                                    selectHelper:true,
                                    allDaySlot:false,//Tüm Gün Eklenmesi İptal Edilmesi
                                    select: function(event) {
                                       alert('clicked');
                                    },
                                    events: [
                                        {
                                            title: 'All Day Event',
                                            start: '2020-01-01'
                                        },
                                        {
                                            title: 'Long Event',
                                            start: '2019-01-07',
                                            end: '2019-01-10'
                                        },
                                        {
                                            groupId: 999,
                                            title: 'Repeating Event',
                                            start: '2019-08-09T16:00:00'
                                        },
                                        {
                                            groupId: 999,
                                            title: 'Repeating Event',
                                            start: '2019-08-16T16:00:00'
                                        },
                                        {
                                            title: 'Conference',
                                            start: '2019-08-11',
                                            end: '2019-08-13'
                                        },
                                        {
                                            title: 'Meeting',
                                            start: '2019-08-12T10:30:00',
                                            end: '2019-08-12T12:30:00'
                                        },
                                        {
                                            title: 'Lunch',
                                            start: '2019-08-12T12:00:00'
                                        },
                                        {
                                            title: 'Meeting',
                                            start: '2019-08-12T14:30:00'
                                        },
                                        {
                                            title: 'Happy Hour',
                                            start: '2019-08-12T17:30:00'
                                        },
                                        {
                                            title: 'Dinner',
                                            start: '2019-08-12T20:00:00'
                                        },
                                        {
                                            title: 'Birthday Party',
                                            start: '2019-08-13T07:00:00'
                                        },
                                        {
                                            title: 'Click for Google',
                                            url: 'http://google.com/',
                                            start: '2019-08-28'
                                        }
                                    ]
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
