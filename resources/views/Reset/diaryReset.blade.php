@extends('layouts.app')
@section('title')
    <title>Diary Reset Password</title>
@section('content')
    <div id="container" class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper">
                <div style="width:350px " id="image" class="brand text-center">
                    <img width="250db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div id="form" class="card fat  rounded-lg border-light shadow-main  w-100 ">
                    <div class="card-body ">
                        <h4 class="card-title text-center ">Reset Password</h4>

                        @if($message=Session::get('error'))
                            <div id="errorAlert" class="alert alert-danger alert-block btn-sm  rounded-pill shadow-main">
                                <a id="errorHide" class="close"  >x</a>
                                <strong>{{$message}}</strong>
                            </div>
                        @endif
                        <form action="{{route('passwordResetPost')}}" method="post" >
                            @csrf
                            <div class="form-group btn-group-sm mt-5 ">
                                <label id="email-label"  class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                <input id="email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror "  value="{{ old('email') }}"   autocomplete="off"   placeholder="E Mail"  name="email"  >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>



                            <div class="row">

                                <div class="form-group mt-4 col-6 offset-3">
                                    <button disabled id="resetButton" type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                        Send Login Link
                                    </button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>

        @if(isset($notificationEmail))
            <div id="notification-email-send" class=" notification-email-send alert alert-info alert-block  btn-sm rounded-pill shadow-main col-6">
                <a id="notification-email-send-close" class="close"  >x</a>
                <strong>Thank you! For a password renewal link, please check the email at  {{$notificationEmail}}  </strong>
            </div>
        @endif

@endsection
@section('css')
            <link rel="stylesheet" href="/components/diaryReset/css/main.css" >
    @endsection
@section('script')
            <script src="/components/diaryReset/js/main.js" ></script>
    @endsection
