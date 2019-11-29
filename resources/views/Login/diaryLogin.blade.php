@extends('layouts.app')
@section('title')
    <title>Diary Login</title>
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
                    <img width="250db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div id="form" class="card fat  rounded-lg border-light shadow-main  w-100 ">
                    <div class="card-body ">
                        <h4 class="card-title text-center ">Login</h4>

                        @if($message=Session::get('error'))
                            <div class="alert alert-danger alert-block">
                                <button class="close" data-dismiss="alert" type="button">
                                    x
                                </button>
                                 <strong>{{$message}}</strong>
                            </div>
                        @endif
                        <form action="{{route('loginPost')}}" method="post" >
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

                            <div class="form-group btn-group-sm mt-4 " id="show_hide_password" >
                                <label id="password-label"  class="btn-sm scroll-label" for="password">{{ __('Password:') }}
                                </label>
                                <div class="input-group ">
                                <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill  shadow-main @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" aria-describedby="button-addon2">
                                    <div class="input-group-append  ">
                                     <a id="password-show" class=" btn btn-sm btn-danger border-light rounded-pill h-100  shadow-main " href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group h-25 ml-3 btn-sm ">
                                <div class="custom-switch custom-control ">
                                    <input class="custom-control-input    " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="custom-control-label   ">Remember Me</label>
                                </div>

                            </div>
                            <div class="row">
                            <div class="form-group m-0 col-6">
                                <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                    Login
                                </button>

                            </div>
                            <div class="form-group m-0 col-6">
                                <button onclick="window.location.href = '/dRegister';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
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
    <style>

       input:focus {

           box-shadow :0 1px 3px rgba(0, 0, 0, 0.16), 0 1px 1px rgba(0, 0, 0, 0.23) !important;
        }


    </style>
            @endsection
@section('script')
    <script>

        $(document).ready(function () {
            //Form'u odaklamak için tıklanan inputlara göre diğer tarafların flu olmasını sağlar.
            // Form Odaklanma Start
            $(':input,#password-show').focus(function(){

                $("nav:not('#dropdown-main')").css("-webkit-filter", "blur(5px)");
                    $("#image").css("-webkit-filter", "blur(4px)");

                    $("form").css("-webkit-filter", "blur(0px)");




            });
                $(':input,#password-show').blur(function () {

                    $("nav:not('#dropdown-main')").css("-webkit-filter", "blur(0px)");
                    $("#image").css("-webkit-filter", "blur(0px)");
                    $("form").css("-webkit-filter", "blur(0px)");
                });
            // Form Odaklanma End
            /// Label Kayan Animasyonu
            // Label Start
            $('#email').focus(function() {

            $('#email-label').show('fast').animate({top: '-25px'});
            });
            $('#email').blur(function () {
                $('#email-label').animate({top: '0px'}).hide('fast');
            });
            $('#password').focus(function() {

                $('#password-label').show('fast').animate({top: '35px'});
            });
            $('#password').blur(function () {
                $('#password-label').animate({top: '55px'}).hide('fast');
            });
            // Label End


        });

        //Password input'u için eye ve eye-slash iconlarını ekleyen password show content'i
        // Password End
            $(document).ready(function() {

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


            });
            // Password End

            // Email için canlı doğrulama işlemi için
            // Email Start
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
            // Email End
    </script>
    @endsection
