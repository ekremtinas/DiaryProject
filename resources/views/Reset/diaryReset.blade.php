@extends('layouts.app')
@section('title')
    <title>Reset Password | Diary</title>
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
                        <h4 class="card-title text-center ">Reset Password</h4>
                    <div style="width:350px " id="image" class="brand text-lg-center text-center">
                        <img class="col-lg-4  col-4" src="/components/img/lock.jpg" alt="logo">
                    </div>
                        <div style="font-size: small;" class="col-8 offset-2  text-center">
                           <dt> Having trouble logging in?</dt>
                            Enter your user email address and we'll send you a link so that you can re-enter your account.</div>
                        @if($message=Session::get('error'))
                            <div id="errorAlert"  class=" notification alert-size alert alert-danger alert-block  btn-sm rounded-pill shadow-main col-3">
                                <a id="errorHide" class="close"  >x</a>
                                <strong>{{$message}}</strong>
                            </div>
                        @endif
                        <form id="resetForm" action="{{route('passwordResetPost')}}" method="post" >
                            @csrf
                            <div class="form-group btn-group-sm mt-3 col-lg-10 offset-1 ">
                                <label id="email-label"  class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                <input id="email" data-bvalidator="required,email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror "  value="{{ old('email') }}"   autocomplete="off"   placeholder="E Mail"  name="email"  >
                                @error('email')
                                <span class="email-alert invalid-feedback alert-size col-lg-11 alert-danger alert-block  btn-sm rounded-pill" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>



                            <div class="row ">

                                <div class="form-group mt-4 col-6 offset-3">
                                    <button id="resetButton" type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                        Send Login Link
                                    </button>

                                </div>


                            </div>
                            <div class="row mb-2">
                                <h6 class="text-center col-6 offset-3">Or</h6>
                                <div class="form-group m-0 col-5 ml-4">
                                    <button onclick="window.location.href = '/dRegister';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
                                        Register
                                    </button>
                                </div>
                                <div class="form-group m-0 col-5">
                                    <button onclick="window.location.href = '/dLogin';" type="button" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                      Back to Login
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @if(isset($notificationEmail))
            <div id="notification-email-send" class=" notification alert alert-info alert-block  btn-sm rounded-pill shadow-main col-6">
                <a id="notification-email-send-close" class="close"  >x</a>
                <strong>Thank you! For a password renewal link, please check the email at  {{$notificationEmail}}  </strong>
            </div>
        @endif
    @if(isset($please))
        <div id="notification-email-send" class=" notification alert alert-info alert-block  btn-sm rounded-pill shadow-main col-6">
            <a id="notification-email-send-close" class="close"  >x</a>
            <strong>{{$please}}  </strong>
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
