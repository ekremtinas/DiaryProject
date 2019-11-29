@extends('layouts.app')
@section('title')
    <title>Diary Register</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('login-link')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('loginGet') }}">{{ __('Login') }}</a>
    </li>
    @endsection
@section('content')
    @if(isset(Auth::user()->email))
        <script>window.location='/dHome';</script>

    @else
        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="card-wrapper ">
                    <div  style="width: 350px;" id="image" class="brand text-center">
                        <img width="250db" src="/components/img/diaryLogo.png" alt="logo">
                    </div>
                    <div class="card fat shadow-main rounded-lg border-light   w-100">
                        <div class="card-body">
                            <h4 class="card-title text-center">Register</h4>

                            @if($message=Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button class="close" data-dismiss="alert" type="button">
                                        x
                                    </button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            @if($message=Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button class="close" data-dismiss="alert" type="button">
                                        x
                                    </button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            <form id="form" action="{{route('registerPost')}}" method="post" >
                                @csrf
                                <div class="form-group btn-group-sm  ">
                                    <label class="btn-sm " for="name">{{ __('Full Name:') }}</label>
                                    <input id="name" type="text" class=" form-control btn-sm  border-light shadow-main rounded-pill @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autocomplete="off"  placeholder="Full Name" required="required" name="name"  >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm  ">
                                    <label class="btn-sm" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="off"  placeholder="E Mail" required="required" name="email"  >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm ">
                                    <label class="btn-sm" for="country_selector" >{{__('Country:')}}</label>
                                    <div class=" ">
                                        <input name="country" style="width: 100%" class=" form-control btn-sm  border-light rounded-pill shadow-main" id="country_selector" type="text" value="{{ old('country') }}">

                                    </div>
                                </div>

                                <div class="form-group btn-group-sm   " id="show_hide_password" >
                                    <label class="btn-sm" for="password">{{ __('Password:') }}
                                    </label>

                                        <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill shadow-main @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" >



                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm "  id="show_hide_password">
                                    <label class="btn-sm" for="password_confirmation">{{ __('Confirm Password:') }}
                                    </label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control btn-sm  border-light rounded-pill  shadow-main @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">
                                    <div class="input-group-append  ">
                                        <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-danger border-light rounded-pill h-100 shadow-main" href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <span id="password_equal" style="display: none" class=" alert-success btn-sm rounded-pill" >Password is the same and greater than 6</span>
                                </div>



                                <div class="form-group m-0">
                                    <button type="submit" class="btn  btn-block btn-outline-danger shadow-main border-light rounded-pill">
                                       Register
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" hidden href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
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
                <style>
                    input:focus {

                        box-shadow: none !important;
                    }


                </style>
                @endsection
            @section('script')
              <!-- Ülke seçimi için gerekli js
                    Start -->
                <script src="/components/countryselect/build/js/countrySelect.js"></script>
                <script>
                    $("#country_selector").countrySelect({
                        preferredCountries: ['ca', 'gb', 'us']
                    });
                </script>
               <!-- End -->
                <script>

                    $(document).ready(function () {
                        // Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
                        // Start
                        $(':input,#password-show').focus(function(){

                            $("nav:not('#dropdown-main')").css("-webkit-filter", "blur(3px)");
                            $("#image").css("-webkit-filter", "blur(3px)");
                            $("form").css("-webkit-filter", "blur(0px)");
                        });
                        $(':input,#password-show').blur(function () {

                            $("nav:not('#dropdown-main')").css("-webkit-filter", "blur(0px)");
                            $("#image").css("-webkit-filter", "blur(0px)");
                            $("form").css("-webkit-filter", "blur(0px)");
                        });
                        // End
                    });
                    $(document).ready(function() {
                        // Password'ün gösterilmesi ve gizlenmesi işlemi
                        // Start
                        $("#show_hide_password a").on('click', function(event) {
                            event.preventDefault();
                            if($('#show_hide_password input').attr("type") == "text"){
                                $('#show_hide_password input').attr('type', 'password');
                                $('#show_hide_password i').addClass( "fa-eye-slash" );
                                $('#show_hide_password i').removeClass( "fa-eye" );
                            }
                            else if($('#show_hide_password input').attr("type") == "password"){
                                $('#show_hide_password input').attr('type', 'text');
                                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                                $('#show_hide_password i').addClass( "fa-eye" );
                            }
                        });
                        // End
                    });
                    // Email için canlı doğrulama işlemi için
                    // Start
                    $(document).ready(function () {
                        $('#email').on('keyup',function () {
                            var email = $(this).val();
                            var filter = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                            if(filter.test(email))
                            {
                                $('#email').addClass( "is-valid" );
                                $('#email').removeClass( "is-invalid" );
                            }
                            else{
                                $('#email').addClass( "is-invalid" );
                                $('#email').removeClass( "is-valid" );
                            }

                        }) ;
                    });
                    // End
                    // Password için güvenlik doğrulaması
                    // Start
                    $(document).ready(function () {

                        $('#password , #password_confirmation').on('keyup',function () {
                           var passwordLength=$(this).val().length;
                            var password=$('#password').val();
                            var password_confirmation=$('#password_confirmation').val();
                           if(passwordLength>6)
                           {

                               $(this).addClass('is-valid');
                               $(this).removeClass('is-invalid');
                               if(password==password_confirmation)
                               {
                                   $('#password_equal').show('slow');

                               }
                               else
                               {
                                   $('#password_equal').hide('slow');

                               }
                           }
                           else
                           {
                               $(this).addClass('is-invalid');
                               $(this).removeClass('is-valid');
                           }



                        }) ;
                    });
                    // End
                </script>
@endsection
