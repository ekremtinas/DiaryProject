@extends('layouts.app')
@section('title')
    <title>Diary Home</title>
@endsection
@section('content')
    @if(!isset(Auth::user()->email))
        <script>window.location='/dLogin';</script>

    @else
        <div class="container w-75 h-50" id='top'>
            <div class="mb-3">  Locales: <select class="custom-select-sm col-1 custom-select" id="locale-selector"></select>
            </div>
            <div class='left' hidden>

                <div id='theme-system-selector' class='selector'>
                    Theme System:

                    <select hidden>
                        <option value='bootstrap' selected>Bootstrap 4</option>
                        <option value='standard'>unthemed</option>
                    </select>
                </div>

                <div data-theme-system="bootstrap" class='selector' style='display:none'>
                    Theme Name:

                    <select hidden>
                        <option value='' selected>Default</option>
                        <option value='cerulean'>Cerulean</option>
                        <option value='cosmo'>Cosmo</option>
                        <option value='cyborg'>Cyborg</option>
                        <option value='darkly'>Darkly</option>
                        <option value='flatly'>Flatly</option>
                        <option selected  value='journal'>Journal</option>
                        <option value='litera'>Litera</option>
                        <option value='lumen'>Lumen</option>
                        <option value='lux'>Lux</option>
                        <option value='materia'>Materia</option>
                        <option value='minty'>Minty</option>
                        <option value='pulse'>Pulse</option>
                        <option value='sandstone'>Sandstone</option>
                        <option value='simplex'>Simplex</option>
                        <option value='sketchy'>Sketchy</option>
                        <option value='slate'>Slate</option>
                        <option value='solar'>Solar</option>
                        <option value='spacelab'>Spacelab</option>
                        <option value='superhero'>Superhero</option>
                        <option value='united'>United</option>
                        <option value='yeti'>Yeti</option>
                    </select>
                </div>

                <span id='loading' style='display:none'>loading theme...</span>

            </div>



            <div class='clear'></div>


        <div  id='calendar'></div>
        </div>

        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Event title</h5>
                        <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  ">
                        <div class="form-group">
                            <label for="title" class="col-sm-4 control-label  btn-sm ">Title</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control btn-sm h-50" id="title" placeholder="Title">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="color" class="col-sm-4 control-label btn-sm">Color</label>
                            <div class="col-sm-10">
                                <select name="color" class="form-control btn-sm h-50" id="color">
                                    <option value="">Choose</option>
                                    <option style="color:#0071c5;" value="#0071c5">&#9724; Dark blue</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">&#9724; Turquoise</option>
                                    <option style="color:#008000;" value="#008000">&#9724; Green</option>
                                    <option style="color:#FFD700;" value="#FFD700">&#9724; Yellow</option>
                                    <option style="color:#FF8C00;" value="#FF8C00">&#9724; Orange</option>
                                    <option style="color:#FF0000;" value="#FF0000">&#9724; Red</option>
                                    <option style="color:#000;" value="#000">&#9724; Black</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="start" class="col-sm-4 control-label btn-sm">Start date</label>
                            <div class="col-sm-10">
                                <input type="text" name="start" class="form-control btn-sm h-50" id="start" readonly>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="end" class="col-sm-4 control-label btn-sm">End date</label>
                            <div class="col-sm-10">
                                <input type="text" name="end" class="form-control btn-sm h-50" id="end" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn-outline-secondary btn-sm" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-outline-primary btn-sm">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        @endif
@endsection
@section('css')
    <link href='https://use.fontawesome.com/releases/v5.0.6/css/all.css' rel='stylesheet'>
    <link href='/components/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/list/main.css' rel='stylesheet' />
    <style>



    </style>
    @endsection
@section('script')

    <script src='/components/fullcalendar/packages/core/main.js'></script>
    <script src='/components/fullcalendar/packages/interaction/main.js'></script>
    <script src='/components/fullcalendar/packages/bootstrap/main.js'></script>
    <script src='/components/fullcalendar/packages/daygrid/main.js'></script>
    <script src='/components/fullcalendar/packages/timegrid/main.js'></script>
    <script src='/components/fullcalendar/packages/list/main.js'></script>
    <script src='/components/fullcalendar/js/theme-chooser.js'></script>
    <script src='/components/fullcalendar/js/moment.min.js'></script>
    <script src='/components/fullcalendar/packages/core/locales-all.js'></script>
    <script>


        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar;
            var initialLocaleCode = 'en';
            var localeSelectorEl = document.getElementById('locale-selector');

            initThemeChooser({

                init: function(themeSystem) {
                    calendar = new FullCalendar.Calendar(calendarEl, {
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
                        selectable: true,
                        selectMirror: true,
                        select: function(arg) {
                            $('#ModalAdd #start').val(moment(start).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalAdd #end').val(moment(end).format('YYYY-MM-DD HH:mm:ss'));
                            $('#ModalAdd').modal('show');
                        },
                        events: [
                            {
                                title: 'All Day Event',
                                start: '2019-11-01'
                            },
                            {
                                title: 'Long Event',
                                start: '2019-11-07',
                                end: '2019-11-10'
                            },
                            {
                                groupId: 999,
                                title: 'Repeating Event',
                                start: '2019-11-09T16:00:00'
                            },
                            {
                                groupId: 999,
                                title: 'Repeating Event',
                                start: '2019-1-16T16:00:00'
                            },
                            {
                                title: 'Conference',
                                start: '2019-11-11',
                                end: '2019-11-13'
                            },
                            {
                                title: 'Meeting',
                                start: '2019-11-12T10:30:00',
                                end: '2019-11-12T12:30:00'
                            },
                            {
                                title: 'Lunch',
                                start: '2019-11-12T12:00:00'
                            },
                            {
                                title: 'Meeting',
                                start: '2019-11-12T14:30:00'
                            },
                            {
                                title: 'Happy Hour',
                                start: '2019-11-12T17:30:00'
                            },
                            {
                                title: 'Dinner',
                                start: '2019-11-12T20:00:00'
                            },
                            {
                                title: 'Birthday Party',
                                start: '2019-11-13T07:00:00'
                            },
                            {
                                title: 'Click for Google',
                                url: 'http://google.com/',
                                start: '2019-11-28'
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
