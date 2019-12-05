@extends('layouts.app')
@section('title')
    <title>Register | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('content')
    @if(isset(Auth::user()->email))
        <script>window.location='/dHome';</script>

    @else
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="card-wrapper ">
                    <div  style="width: 350px;" id="image" class="brand text-center">
                        <img class="col-7 offset-0" src="/components/img/diaryLogo.png" alt="logo">
                    </div>
                    <div class="card fat shadow-main rounded-lg border-light   w-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">Register</h4>

                            @if($message=Session::get('error'))
                                <div id="errorAlert" class="alert-size notification alert alert-danger alert-block col-3 rounded-pill btn-sm">
                                    <button id="errorHide" class="close"  type="button">
                                        x
                                    </button>
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
                            <form id="form" action="{{route('registerPost')}}" method="post" >
                                @csrf
                                <div class="form-group btn-group-sm mt-4 ">
                                    <label id="name-label" class="btn-sm scroll-label" for="name">{{ __('Full Name:') }}</label>
                                    <input id="name" type="text" class=" form-control btn-sm  border-light shadow-main rounded-pill @error('name') is-invalid @enderror"  value="{{ old('name') }}" autocomplete="off"  placeholder="Full Name" name="name"  >
                                    @error('name')
                                    <span class="invalid-feedback alert-size" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-4 ">
                                    <label id="email-label" class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror"  value="{{ old('email') }}"  autocomplete="off"  placeholder="E Mail"  name="email"  >
                                    @error('email')
                                    <span class="invalid-feedback alert-size" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-4 ">
                                    <label id="country-label" class="btn-sm scroll-label" for="country_selector" >{{__('Country:')}}</label>
                                    <div class=" ">
                                        <input name="country" style="width: 100%" class=" form-control btn-sm  border-light rounded-pill shadow-main" id="country_selector" type="text" value="{{ old('country') }}">

                                    </div>
                                </div>

                                <div class="form-group btn-group-sm  mt-4 " id="show_hide_password" >
                                    <label id="password-label" class="btn-sm scroll-label" for="password">{{ __('Password:') }}
                                    </label>
                                    <div class="input-group">
                                    <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill shadow-main @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" >
                                        <div class="input-group-append  ">
                                            <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @error('password')
                                        <span class="invalid-feedback alert-size" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="form-group btn-group-sm mt-4"  id="show_hide_password2">
                                    <label id="password-confirmation-label" class="btn-sm scroll-label" for="password_confirmation">{{ __('Confirm Password:') }}
                                    </label>
                                    <div class="input-group">
                                        <input id="password_confirmation" type="password" class="form-control btn-sm  border-light rounded-pill  shadow-main @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password" placeholder="Confirm Password">
                                        <div class="input-group-append  ">
                                            <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback alert-size" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <span id="password_equal" style="display: none" class=" alert-success btn-sm rounded-pill" >Password is the same and greater than 6</span>
                                </div>



                                <div class="row mt-5">

                                    <div class="form-group m-0 col-6">
                                        <button onclick="window.location.href = '/dLogin';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
                                            Login
                                        </button>
                                    </div>
                                    <div class="form-group m-0 col-6">
                                        <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                            Register
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
            <!-- Ülke secimi için gerekli css
                       Start -->
                <link rel="stylesheet" href="/components/countryselect/build/css/countrySelect.css">

                <!-- End -->
                <link rel="stylesheet" href="/components/diaryRegister/css/main.css">
        @endsection
        @section('script')
            <!-- Ülke seçimi için gerekli js
                    Start -->
                <script src="/components/countryselect/build/js/countrySelect.js"></script>
                <!-- Ülke seçimi için gerekli js
                        End  -->
                <script src="/components/diaryRegister/js/main.js"></script>

@endsection
