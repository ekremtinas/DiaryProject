@extends('layouts.app')
@section('title')
    <title>Diary Login</title>
    @endsection
@section('shadow')
    shadow-lg
    @endsection
@section('register-link')
    <li class="nav-item">
        <a class="nav-link" href="{{ route('registerGet') }}">{{ __('Register') }}</a>
    </li>
    @endsection
@section('content')
    @if(isset(Auth::user()->email))
        <script>window.location='/dHome';</script>

    @else
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div class="card fat shadow-lg rounded-lg border-light   w-100 ">
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
                            <div class="form-group btn-group-sm  ">
                                <label class="btn-sm" for="email">{{ __('E Mail:') }}</label>
                                <input id="email" type="text" class="form-control btn-sm  border-light shadow rounded-pill @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E Mail" required="required" name="email"  >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group btn-group-sm has-feedback has-success  " id="show_hide_password" >
                                <label class="btn-sm" for="password">{{ __('Password:') }}
                                </label>
                                <div class="input-group">
                                <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill  shadow @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password" aria-describedby="button-addon2">
                                    <div class="input-group-append  ">
                                     <a class=" btn btn-sm btn-danger border-light rounded-pill h-100" href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                    </div>
                                </div>

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>


                            <div class="form-group h-25 ml-3 btn-sm ">
                                <div class="custom-switch custom-control">
                                    <input class="custom-control-input    " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="custom-control-label   ">Remember Me</label>
                                </div>

                            </div>



                            <div class="form-group m-0">
                                <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill">
                                    Login
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
            @endsection
@section('script')
    <script>
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
    </script>
    @endsection
