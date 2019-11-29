@extends('layouts.app')
@section('title')
    <title>Diary Register</title>
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
                                <div class="form-group btn-group-sm mt-4 ">
                                    <label id="name-label" class="btn-sm scroll-label" for="name">{{ __('Full Name:') }}</label>
                                    <input id="name" type="text" class=" form-control btn-sm  border-light shadow-main rounded-pill @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autocomplete="off"  placeholder="Full Name" required="required" name="name"  >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-4 ">
                                    <label id="email-label" class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="off"  placeholder="E Mail" required="required" name="email"  >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
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

                                        <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill shadow-main @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" >



                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-4"  id="show_hide_password">
                                    <label id="password-confirmation-label" class="btn-sm scroll-label" for="password_confirmation">{{ __('Confirm Password:') }}
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



                                <div class="row mt-5">
                                    <div class="form-group m-0 col-6">
                                        <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                            Register
                                        </button>

                                    </div>
                                    <div class="form-group m-0 col-6">
                                        <button onclick="window.location.href = '/dLogin';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
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
              <!-- Ülke secimi için gerekli css
                       Start -->
                <link rel="stylesheet" href="/components/countryselect/build/css/countrySelect.css">

                  <!-- End -->
                <style>
                    input:focus {

                        box-shadow :0 1px 3px rgba(0, 0, 0, 0.16), 0 1px 1px rgba(0, 0, 0, 0.23) !important;
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
                        /// LABEL SHOW-HİDE ANİMASYONU
                        // START
                        $('#name').focus(function() {

                            $('#name-label').show('fast').animate({top: '-25px'});
                        });
                        $('#name').blur(function () {
                            $('#name-label').animate({top: '0px'}).hide('fast');
                        });
                        $('#email').focus(function() {

                            $('#email-label').show('fast').animate({top: '35px'});
                        });
                        $('#email').blur(function () {
                            $('#email-label').animate({top: '60px'}).hide('fast');
                        });
                        $('#country_selector').focus(function() {

                            $('#country-label').show('fast').animate({top: '95px'});
                        });
                        $('#country_selector').blur(function () {
                            $('#country-label').animate({top: '120px'}).hide('fast');
                        });
                        $('#password').focus(function() {

                            $('#password-label').show('fast').animate({top: '155px'});
                        });
                        $('#password').blur(function () {
                            $('#password-label').animate({top: '175px'}).hide('fast');
                        });
                        $('#password_confirmation').focus(function() {

                            $('#password-confirmation-label').show('fast').animate({top: '210px'});
                        });
                        $('#password_confirmation').blur(function () {
                            $('#password-confirmation-label').animate({top: '235px'}).hide('fast');
                        });
                        // END
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
