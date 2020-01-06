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
                    <div  id='app' class="card-body ">
                        <h4 class="card-title text-center ">User Home</h4>
                        <form v-if="userFirstForm" id="userFirstForm" method="post">
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



                    <div style="display: none;" v-if="userSecondForm" v-show="userSecondForm" id="userSecondForm">


                        <div tabindex="-1" class="container w-75 h-50" id='top'>

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
                            <div  id='calendarSecond'></div>
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
            <link href='/components/fullcalendar/packages/list/main.css' rel='stylesheet' />
            <style>



            </style>
        @endsection
        @section('script')
            <script src="/components/userHome/js/main.js" ></script>
            <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
            <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
            <script src="/components/bvalidator/themes/red/red.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
            <script src='/components/fullcalendar/packages/core/main.js'></script>
            <script src='/components/fullcalendar/packages/interaction/main.js'></script>
            <script src='/components/fullcalendar/packages/bootstrap/main.js'></script>
            <script src='/components/fullcalendar/packages/daygrid/main.js'></script>
            <script src='/components/fullcalendar/packages/timegrid/main.js'></script>
            <script src='/components/fullcalendar/packages/list/main.js'></script>
            <script src='/components/fullcalendar/js/theme-chooser.js'></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js'></script>
            <script src='/components/fullcalendar/packages/core/locales-all.js'></script>
            <script>
                $(document).ready(function () {

                    var userForm=new Vue({
                        el:'#app',
                        data:{
                            userFirstForm:true,
                            userSecondForm:false,
                            maintenanceMinuteSum:0

                        }
                    });





                    $('#userFirstForm').bValidator();

                    var userFirstForm=$('#userFirstForm');
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
                                    userForm.userFirstForm=false;
                                    userForm.userSecondForm=true;
                                    console.log(data)
                                }

                            }
                        });

                    });



                    var calendarSecond;
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarSecondEl = document.getElementById('calendarSecond');
                        var initialLocaleCode = 'en';
                        var localeSelectorEl = document.getElementById('locale-selector');
                        initThemeChooser({
                            init: function(themeSystem) {
                                calendarSecond = new FullCalendar.Calendar(calendarSecondEl, {
                                    plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list' ],
                                    themeSystem: themeSystem,
                                    header: {
                                        left: 'prevYear,prev,next,nextYear today custom',
                                        center: 'title',
                                        right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                                    },
                                    defaultDate: '2019-11-12',
                                    weekNumbers: true,
                                    navLinks: true, // can click day/week names to navigate views
                                    editable: true,
                                    eventLimit: true, // allow "more" link when too many events
                                    eventClassName:'context-menu-one',
                                    selectable: true,
                                    selectMirror: true,
                                    selectHelper:true,
                                    select: function(event) {
                                        $('#ModalAdd #saveStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                        $('#ModalAdd #saveEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
                                        $('#ModalAdd').modal('show');
                                    },

                                });
                                calendarSecond.render();
                                // build the locale selector's options
                                calendarSecond.getAvailableLocaleCodes().forEach(function(localeCode) {
                                    var optionEl = document.createElement('option');
                                    optionEl.value = localeCode;
                                    optionEl.selected = localeCode == initialLocaleCode;
                                    optionEl.innerText = localeCode;
                                    localeSelectorEl.appendChild(optionEl);
                                });
                                // when the selected option changes, dynamically change the calendar option
                                localeSelectorEl.addEventListener('change', function() {
                                    if (this.value) {
                                        calendarSecond.setOption('locale', this.value);
                                    }
                                });
                            },
                            change: function(themeSystem) {
                                calendarSecond.setOption('themeSystem', themeSystem);
                            }
                        });
                    });




                });


            </script>




@endsection
