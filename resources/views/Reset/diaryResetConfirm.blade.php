@extends('layouts.app')
@section('title')
    <title>Confirm Reset Password | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('content')

    <div id="container" class="container h-100 col-6">
        <div class="row justify-content-center h-100  col-6 offset-3 ">
            <div class="card-wrapper">
                <div style="width:350px " id="image" class="brand text-lg-center text-center">
                    <img class="col-lg-7  col-7" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div id="form" class="card fat  rounded-lg border-light shadow-main">
                    <p class="card-body ">
                    <h4 class="card-title text-center ">New Password</h4>
                    <div style="width:350px " id="image" class="brand text-lg-center text-center">
                        <img class="col-lg-4  col-4" src="/components/img/lock.jpg" alt="logo">
                    </div>

                    @if($message=Session::get('error'))
                        <div id="errorAlert"  class=" notification alert-size alert alert-danger alert-block  btn-sm rounded-pill shadow-main col-3">
                            <a id="errorHide" class="close"  >x</a>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    @if($message=Session::get('success'))
                        <div id="notificationAlert" class="alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
                            <button id="notificationHide" class="close"  type="button">
                                x
                            </button>
                            <strong>{{$message}}</strong>
                        </div>
                    @endif
                    @if($message=Session::get('loginAsk'))
                        <div style="top:80%;" id="loginAskAlert" class="alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm ">
                            <button id="loginAskHide" class="close"  type="button">
                                x
                            </button>
                            <strong>{{$message}}</strong>
                            <a href="/dPasswordResetConfirmLogin?resetuid={{md5($resetuid['resetuid'])}}" id="loginAsk" class="col-2 btn btn-block btn-outline-info border-light rounded-pill shadow-main fa fa-check" href="{{route('loginGet')}}"></a>

                        </div>
                    @endif
                    <form id="resetForm" action="{{route('passwordResetConfirmPost')}}" method="post" >
                        @csrf
                        <div class="form-group btn-group-sm  mt-4 " id="show_hide_password" >
                            <label id="password-label" class="btn-sm scroll-label offset-1 " for="password">{{ __('Password:') }}
                            </label>
                            <div class="input-group">
                                <input id="password" data-bvalidator="required,minlen[6],maxlen[30]" type="password" class="form-control btn-sm  border-light rounded-pill col-9 offset-1 shadow-main @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" >
                                <div class="input-group-append  ">
                                    <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>

                            </div>


                        </div>
                        <div class="form-group btn-group-sm mt-4"  id="show_hide_password2">
                            <label id="password-confirmation-label" class="btn-sm scroll-label  offset-1 " for="password_confirmation">{{ __('Confirm Password:') }}
                            </label>
                            <div class="input-group">
                                <input id="password_confirmation" data-bvalidator="required,minlen[6],maxlen[30]" type="password" class="form-control btn-sm  border-light rounded-pill col-9 offset-1  shadow-main @error('password') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password" placeholder="Confirm Password">
                                <div class="input-group-append  ">
                                    <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                </div>
                                @error('password')
                                <span id="password-alert" class="password-alert invalid-feedback alert-size pl-3 ml-4 rounded-pill alert-danger col-10  " role="alert">
                                       <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <span id="password_equal" style="display: none" class=" alert-success btn-sm rounded-pill offset-1 alert-size" >Password is the same and greater than 6 </span>
                        </div>

                        <input hidden name="resetuid" value="{{$resetuid['resetuid']}}">


                        <div class="row ">

                            <div class="form-group mt-4 col-6 offset-3">
                                <button disabled id="resetButton" type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                    Reset Password
                                </button>

                            </div>


                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>

    @if(isset($notificationEmail))
        <div id="notification-email-send" class=" notification alert-size alert alert-info alert-block  btn-sm rounded-pill shadow-main col-6">
            <a id="notification-email-send-close" class="close"  >x</a>
            <strong>Thank you! For a password renewal link, please check the email at  {{$notificationEmail}}  </strong>
        </div>
    @endif

@endsection
@section('css')
    <link rel="stylesheet" href="/components/diaryReset/css/main.css" >
    <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
@endsection
@section('script')
    <script src="/components/diaryReset/js/main.js" ></script>
    <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
    <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
    <script src="/components/bvalidator/themes/red/red.js"></script>
    <script>
        $(document).ready(function () {
            $('#resetForm').bValidator();


        });

    </script>
@endsection

