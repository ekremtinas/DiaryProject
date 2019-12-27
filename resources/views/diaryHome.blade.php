@extends('layouts.app')
@section('title')
    @if(!isset(Auth::user()->email))
        <script>window.location='/dLogin';</script>

    @else
    <title>Home | Diary</title>
@endsection
@section('locale')
    <select class="custom-select-sm col-1 custom-select rounded-pill shadow-main" id="locale-selector"></select>
@endsection
@section('content')

        <div class="loading" id="loading"><img width="100px" height="100px" src="/components/img/gif/loading.gif"></div>
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


            <div  id='calendar'></div>
        </div>

            <div id="notificationAlert" style="display: none;" class=" alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
                <button id="notificationHide" class="close alert-size"  type="button">
                    x
                </button>
                <strong class="notification-text">Event deleted</strong>
            </div>

            @include('Home.Modals.addEventModal')
            @include('Home.Modals.editEventModal')


    @endif
@endsection
@section('css')

    <link href='/components/diaryHome/css/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/core/main.css' rel='stylesheet' />

    <link href='/components/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/list/main.css' rel='stylesheet' />
    <noscript id="deferred-styles">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
    <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
     <link href = "https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"
              rel = "stylesheet">
    </noscript>

    <style>


    </style>
@endsection
@section('script')
    <script src='/components/diaryHome/js/main.js' ></script>
    <script src='/components/diaryHome/js/calendar.js' ></script>
    <script src='/components/fullcalendar/packages/core/main.js' ></script>
    <script src='/components/fullcalendar/packages/interaction/main.js' ></script>
    <script src='/components/fullcalendar/packages/bootstrap/main.js' ></script>
    <script src='/components/fullcalendar/packages/daygrid/main.js' defer></script>
    <script src='/components/fullcalendar/packages/timegrid/main.js' defer></script>
    <script src='/components/fullcalendar/packages/list/main.js' ></script>
    <script src='/components/fullcalendar/js/theme-chooser.js' ></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.js' ></script>
    <script src='/components/fullcalendar/packages/core/locales-all.js' ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/5.3.2/bootbox.js" defer></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"  integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
    <script src="/components/bvalidator/dist/jquery.bvalidator.min.js" defer></script>
    <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js" defer></script>
    <script src="/components/bvalidator/themes/red/red.js" defer></script>

    <script>


        var loadDeferredStyles = function() {
            var addStylesNode = document.getElementById("deferred-styles");
            var replacement = document.createElement("div");
            replacement.innerHTML = addStylesNode.textContent;
            document.body.appendChild(replacement)
            addStylesNode.parentElement.removeChild(addStylesNode);
        };
        var raf = requestAnimationFrame || mozRequestAnimationFrame ||
            webkitRequestAnimationFrame || msRequestAnimationFrame;
        if (raf) raf(function() {
            window.setTimeout(loadDeferredStyles, 0);
        });
        else window.addEventListener('load', loadDeferredStyles);
    </script>
    <script>
        var timeDiffMoment;//Seçilen iki time arasındaki süre
        $(function () {
            $('[data-toggle="popover"]').popover()
        })
        $('.popover-dismiss').popover({
            trigger: 'focus'
        })

        var initialLocaleCode = '<?php if(isset(Auth::user()->lang)){ echo Auth::user()->lang; } ?>'; // Local olarak default dil seçimi
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
                url: '/dHome/dropEvent',
                type: "POST",
                data: {
                    Event:Event,
                    _token: '{!! csrf_token() !!}',
                },
                dataType:'json',
                success: function(data) {

                }
            });
        }

    </script>
@endsection
