@extends('layouts.app')
@section('title')

    @if(!isset(Auth::user()->email))
        <script>window.location='/dLogin';</script>

    @else
    <title>Home | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('locale')
    <select style="margin-right: 50%;" class="custom-select-sm col-1 custom-select rounded-pill shadow-main" id="locale-selector"></select>
@endsection
@section('content')

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
    <div tabindex="-1" class="container w-100 h-50 shadow-main p-3 rounded-lg mt-lg-4" id='top' style="z-index: -1 !important;">

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

        <div class="ml-lg-3 ml-3">
            <div style="font-size: 12px !important;" class="row list-group list-group-horizontal-xl pr-lg-2">
                <div class="col-lg-4 list-group-item ">
                     <select class="custom-select-sm col-6 ml-lg-2 mr-lg-2 custom-select rounded-pill shadow-main" id="bridges-selector">
                        <option value="Bridge Choose" class="optionStyle">Bridge Choose</option>
                    </select>

                    <button id="bridgeAdd" type="button" style="padding: 6px !important;" class=" btn btn-success  fa fa-plus " data-toggle="popover"  data-content="
                            Double-click if you want to add bridge" data-placement="bottom" data-trigger="focus" title="Bridge Add"  ></button>
                    <button id="bridgeEdit" type="button" style="padding: 6px !important;" class=" btn btn-info  fa fa-pencil " data-toggle="popover"  data-content="
                            Double-click if you want to edit bridge" data-placement="bottom" data-trigger="focus" title="Bridge Edit"  ></button>
                    <button id="bridgeDelete" type="button" style="padding: 6px !important;" class=" btn btn-danger  fa fa-trash " data-toggle="popover"  data-content="
                            Double-click if you want to delete bridge" data-placement="bottom" data-trigger="focus" title="Bridge Delete"  ></button>

                    <div id="dialogAdd"  title="Bridge Add">
                        <div class="form-group">
                            <form id="bridgeAddForm"  method="post">
                                @csrf
                            <div class="form-group btn-group-sm mt-lg-4 col-lg-10 offset-lg-1 ">
                                <label id="bridgeName-label"  class="btn-sm scroll-home-label" for="bridgeName">{{ __('Bridge Name:') }}</label>
                                <input id="bridgeName" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('bridgeName') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Bridge Name"  name="bridgeName"  >
                                @error('bridgeName')
                                <span  id="bridgeName-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                            <button type="submit" id="bridgeAddSubmit" class="offset-lg-3 col-lg-6 btn btn-success btn-sm text-lg-center">Save changes</button>
                            </form>

                        </div>
                    </div>

                    <div id="dialogDelete"  title="Bridge Delete">
                        <div class="form-group">
                            <form id="bridgeDeleteForm"  method="post">
                                @csrf
                                <div class="form-group btn-group-sm mt-lg-3 col-lg-10 offset-lg-1 ">
                                    <input id="bridgeId" hidden>
                                    <p>Delete <strong id="bridgeDeleteSelect"></strong> ?</p>

                                </div>
                                <button type="submit" id="bridgeDeleteSubmit" class="offset-lg-3 col-lg-6 btn btn-danger btn-sm text-lg-center">Delete</button>
                            </form>

                        </div>
                    </div>

                    <div id="dialogEdit"  title="Bridge Edit">
                        <div class="form-group">
                            <form id="bridgeEditForm"  method="post">
                                @csrf
                                <div class="form-group btn-group-sm mt-lg-3 col-lg-10 offset-lg-1 ">
                                    <input type="hidden" id="bridgeIdEdit" name="bridgeIdEdit">
                                    <div class="form-group btn-group-sm mt-lg-4 col-lg-10 offset-lg-1 ">
                                        <label id="bridgeNameEdit-label"  class="btn-sm scroll-home-label" for="bridgeNameEdit">{{ __('Bridge Name:') }}</label>
                                        <input id="bridgeNameEdit" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('bridgeNameEdit') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Bridge Name"  name="bridgeNameEdit"  >
                                        @error('bridgeNameEdit')
                                        <span  id="bridgeNameEdit-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                        @enderror

                                    </div>

                                </div>
                                <button type="submit" id="bridgeEditSubmit" class="offset-lg-3 col-lg-6 btn btn-info btn-sm text-lg-center">Edit</button>
                            </form>

                        </div>
                    </div>

                </div>
                <div class="col-lg-2 list-group-item "><b>Before this day: <div style="background-color:#C3C3C3;width: 20px;height: 20px;"></div></b></div>
                <div class="col-lg-2 list-group-item "><b>Today: <div style="background-color:#D6E0EB;width: 20px;height: 20px;"></div></b></div>
                <div class="col-lg-2 list-group-item "><b>Available space: <div style="background-color:#FFB3B3;width: 20px;height: 20px;"></div></b></div>
                <div class="col-lg-2 list-group-item "><button id="newAppointment" class="btn btn-outline-success rounded-pill btn-sm p-lg-2"  data-toggle="popover"  data-content="
                            Double-click if you want to add appointment" data-placement="bottom" data-trigger="focus" title="Appointment Add" ><i class="fa fa-plus-circle"></i> Appointment</button></div>
            </div>
        </div>

            <div class="mt-lg-3 " id='calendar'></div>
        </div>

            <div id="notificationAlert" style="display: none;" class=" alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
                <button id="notificationHide" class="close alert-size"  type="button">
                    x
                </button>
                <strong class="notification-text">Event deleted</strong>
            </div>
            <div id="dialogBridgeDatetimeDelete"  title="Bridge Datetime Delete">
                <div class="form-group">
                    <form id="bridgeDatetimeDeleteForm"  method="post">
                        @csrf
                        <div class="form-group btn-group-sm mt-lg-3 col-lg-10 offset-lg-1 ">
                            <input id="bridgeDatetimeId" style="display:none;">
                            <p>Delete <strong id="bridgeDeleteSelect"></strong> <br> <strong id="bridgeDatetimeDelete"></strong> ?</p>

                        </div>
                        <button type="submit" id="bridgeDatetimeDeleteSubmit" class="offset-lg-3 col-lg-6 btn btn-danger btn-sm text-lg-center">Delete</button>
                    </form>

                </div>
            </div>
         <div style="display: none;" id="mousepopup"></div>
            @include('Home.Modals.addEventModal')
            @include('Home.Modals.clickBridgeModal')
            @include('Home.Modals.editEventModal')
            @include('Home.Modals.workplaceSettingsModal')

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
    <script src="/components/diaryHome/js/lodash.min.js"></script>
    <style>

.event-dark{
    background-color: black !important;
    border-color: black !important;
    z-index:2 !important;
}
#mousepopup{
    background-color:#9E1C20;
    color: white;
    width:auto;
    height:auto;
    padding: 30px;
    text-align:center;
    font:1.2em Arial;
    line-height:50px;
    display:none;
    position:absolute;
    z-index:9999;
    box-shadow: 0 3px 6px rgba(0, 0, 0, 0.16), 0 3px 6px rgba(0, 0, 0, 0.23);
}
.fc-today{
    background: #F0F5FF !important;
    border: none !important;
    border-top: 1px solid #ddd !important;
    font-weight: bold;
}
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
        var timeDiffMoment;//Seçilen iki time arasındaki süre
        var globalRawData;//Event get ile getirilen data
        var globalMaintenance;//Bakım Türünü maintenanceData
        var initialLocaleCode = '<?php if(isset(Auth::user()->lang)){ if( Auth::user()->lang==null) {echo 'en';} else{  echo Auth::user()->lang; } } ?>'; // Local olarak default dil seçimi


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
                    $(".notification-text").html("Event changed");
                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                    $('#notificationAlert').show();
                }
            });
        }
        function editBridge(event,renderedConstraint){ // Bridgeler'de Drop ve Resize Olayları için tarih güncelleme

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
            for(var i=0;i<renderedConstraint.length;i++)
            {
                if(renderedConstraint[i]['id']==id)
                {
                    renderedConstraint[i]['start']=start;
                    renderedConstraint[i]['end']=end;
                }
            }
            $.ajax({
                url: '/dHome/bridgeEditTime',
                type: "POST",
                data: {
                    Event:Event,
                    _token: '{!! csrf_token() !!}',
                },
                dataType:'json',
                success: function(data) {
                    $(".notification-text").html("Bridge changed");
                    $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                    $('#notificationAlert').show();
                }
            });
        }


    </script>
@endsection
