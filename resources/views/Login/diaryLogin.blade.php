@extends('layouts.app')
@section('title')
    <title>Login | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('content')
    @if(isset(Auth::user()->email))
        <script>window.location='/dHome';</script>

    @else

        <div id="container" class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="card-wrapper">
                    <div style="width:350px " id="image" class="brand text-center">
                        <img class="col-7 offset-0" src="/components/img/diaryLogo.png" alt="logo">
                    </div>
                    <div id="form" class="card fat  rounded-lg border-light shadow-main  w-100 ">
                        <div class="card-body ">
                            <h4 class="card-title text-center ">Login</h4>

                            @if($message=Session::get('error'))
                                <div id="errorAlert" class="notification alert-size alert alert-danger alert-block  rounded-pill shadow-main col-3">
                                    <a id="errorHide" class="close"  >x</a>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            <form action="{{route('loginPost')}}" method="post" >
                                @csrf
                                <div class="form-group btn-group-sm mt-5 ">
                                    <label id="email-label"  class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror "  value="{{ old('email') }}"   autocomplete="off"   placeholder="E Mail"  name="email"  >
                                    @error('email')
                                    <span  id="email-alert" class="email-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror

                                </div>

                                <div class="form-group btn-group-sm mt-5 " id="show_hide_password" >
                                    <label id="password-label"  class="btn-sm scroll-label" for="password">{{ __('Password:') }}
                                    </label>
                                    <div class="input-group ">
                                        <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill  shadow-main @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" >
                                        <div class="input-group-append  ">
                                            <a id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100  shadow-main " href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @error('password')
                                        <span id="password-alert" class="password-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10  " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>


                                <div class="form-group h-25 ml-3 btn-sm mt-5 ">
                                    <div class="custom-switch custom-control ">
                                        <input class="custom-control-input    " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label for="remember" class="custom-control-label   ">Remember Me</label>
                                    </div>

                                </div>
                                @if($message=Session::get('error'))

                                    <div id="forgotPasswordAlert" class="alert-forgot-password alert-info btn-sm rounded-pill  shadow-main">
                                        <a id="forgotPasswordHide" class="close"  >x</a>
                                     <label class="col-8" for="forgotPassword">Forgot your password?</label>
                                        <a id="forgotPassword" class="col-2 btn btn-block btn-outline-info border-light rounded-pill shadow-main fa fa-unlock-alt" href="{{route('passwordResetGet')}}"></a>

                                    </div>

                                @endif
                                <div class="row">
                                    <div class="form-group m-0 col-6">
                                        <button onclick="window.location.href = '/dRegister';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
                                            Register
                                        </button>
                                    </div>
                                    <div class="form-group m-0 col-6">
                                        <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                            Login
                                        </button>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>



            @endif
            @endsection
            @section('css')
                <link rel="stylesheet" href="/components/diaryLogin/css/main.css" >
            @endsection
            @section('script')
                <script src="/components/diaryLogin/js/main.js" ></script>
@endsection
