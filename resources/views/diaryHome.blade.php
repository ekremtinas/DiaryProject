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

            <div id="notificationAlert" hidden class="alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
                <button id="notificationHide" class="close alert-size"  type="button">
                    x
                </button>
                <strong>Event deleted</strong>
            </div>

        <div class="modal fade" id="ModalAdd" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="addEventForm" class="form-horizontal" method="POST" action="{{route('addEventPost')}}">

                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Event title</h5>
                        <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  ">
                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="saveTitle-label"  class="btn-sm scroll-home-label" for="saveTitle">{{ __('Event Title:') }}</label>
                                <input id="saveTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Event Title"  name="saveTitle"  >
                                @error('saveTitle')
                                <span  id="saveTitle-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>


                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="saveColor-label"  class="btn-sm scroll-home-label" for="saveColor">{{ __('Color:') }}</label>
                             <select value=""   autocomplete="off" data-bvalidator="required"  placeholder="Color"   name="saveColor" class="form-control btn-sm h-50  form-control btn-sm  border-light shadow-main rounded-pill @error('saveColor') is-invalid @enderror " id="saveColor">
                                <option value="">Choose</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Vize</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Büyük İş</option>
                                <option style="color:#008000;" value="#008000">&#9724; Küçük İş</option>


                            </select>

                            @error('saveColor')
                            <span  id="saveColor-alert" class="saveColor-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>


                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="saveStart-label"  class="btn-sm scroll-home-label" for="saveStart">{{ __('Start date:') }}</label>
                                <input readonly id="saveStart" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveStart') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Start date"  name="saveStart"  >
                                @error('saveStart')
                                <span  id="saveStart-alert" class="saveStart-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="saveEnd-label"  class="btn-sm scroll-home-label" for="saveEnd">{{ __('End date:') }}</label>
                                <input readonly id="saveEnd" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('saveEnd') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="End date"  name="saveEnd"  >
                                @error('saveEnd')
                                <span  id="saveEnd-alert" class="saveEnd-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn  btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button type="submit" id="addEventSubmit" class="btn btn-success btn-sm">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" >
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="editEventForm" class="form-horizontal" method="POST" action="{{route('editEventPost')}}">

                        <input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="editId" name="editId" value="">
                        <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Diary Edit</h5>
                        <button type="button" class="close btn-sm" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  ">
                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="editTitle-label"  class="btn-sm scroll-home-label" for="editTitle">{{ __('Edit Title:') }}</label>
                                <input id="editTitle" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editTitle') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Edit Title"  name="editTitle"  >
                                @error('editTitle')
                                <span  id="editTitle-alert" class="editTitle-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>


                        <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                            <label id="editColor-label"  class="btn-sm scroll-home-label" for="editColor">{{ __('Color:') }}</label>
                            <select value=""   autocomplete="off" data-bvalidator="required"  placeholder="Edit Color"   name="editColor" class="form-control btn-sm h-50  form-control btn-sm  border-light shadow-main rounded-pill @error('color') is-invalid @enderror " id="editColor">
                                <option value="">Choose</option>
                                <option style="color:#0071c5;" value="#0071c5">&#9724; Vize</option>
                                <option style="color:#40E0D0;" value="#40E0D0">&#9724; Büyük İş</option>
                                <option style="color:#008000;" value="#008000">&#9724; Küçük İş</option>

                            </select>

                            @error('editColor')
                            <span  id="editColor-alert" class="color-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                            @enderror

                        </div>


                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="editStart-label"  class="btn-sm scroll-home-label" for="editStart">{{ __('Start date:') }}</label>
                                <input readonly id="editStart" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editStart') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Start date"  name="editStart"  >
                                @error('editStart')
                                <span  id="editStart-alert" class="editStart-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group btn-group-sm mt-5 col-lg-10 offset-lg-1 ">
                                <label id="editEnd-label"  class="btn-sm scroll-home-label" for="editEnd">{{ __('End date:') }}</label>
                                <input readonly id="editEnd" data-bvalidator="required" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('editEnd') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="End date"  name="editEnd"  >
                                @error('editEnd')
                                <span  id="editEnd-alert" class="editEnd-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                        <button id="editEventSubmit" type="submit" class="btn btn-success  btn-sm">Save changes</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

    @endif
@endsection
@section('css')

    <link href='/components/diaryHome/css/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/core/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />
    <link href='/components/fullcalendar/packages/list/main.css' rel='stylesheet' />
    <noscript id="deferred-styles">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.7.1/jquery.contextMenu.min.css">
    <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
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



        var initialLocaleCode = '{{Auth::user()->lang}}'; // Local olarak default dil seçimi
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
