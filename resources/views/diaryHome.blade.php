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
                            left: 'prevYear,prev,next,nextYear today',
                            center: 'title',
                            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
                        },
                        defaultDate: '2019-08-12',
                        weekNumbers: true,
                        navLinks: true, // can click day/week names to navigate views
                        editable: true,
                        eventLimit: true, // allow "more" link when too many events
                        selectable: true,
                        selectMirror: true,
                        select: function(arg) {
                            var title = prompt('Olay başlığı:');
                            if (title) {
                                calendar.addEvent({
                                    title: title,
                                    start: arg.start,
                                    end: arg.end,
                                    allDay: arg.allDay
                                })
                            }
                            calendar.unselect()
                        },
                        events: [
                            {
                                title: 'All Day Event',
                                start: '2019-08-01'
                            },
                            {
                                title: 'Long Event',
                                start: '2019-08-07',
                                end: '2019-08-10'
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
