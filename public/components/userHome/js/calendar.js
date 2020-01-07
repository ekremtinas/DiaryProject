var calendarSecond;
document.addEventListener('DOMContentLoaded', function() {
    var calendarSecondEl = document.getElementById('calendarSecond');
    var initialLocaleCode = 'en';
    var localeSelectorEl = document.getElementById('locale-selector');

    console.log(calendarSecondEl);
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
