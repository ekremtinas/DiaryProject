@extends('layouts.app')
@section('title')
    <title>Diary Register</title>
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
                <div class="card-wrapper">
                    <div class="brand">
                        <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                    </div>
                    <div class="card fat shadow-lg  rounded ">
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
                                <div class="form-group btn-group-sm has-success has-feedback ">
                                    <label for="name">{{ __('Full Name') }}</label>
                                    <input id="name" type="text" class="form-control btn-sm border-dark shadow @error('name') is-invalid @enderror"  value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="Full Name" required="required" name="name"  >
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm has-success has-feedback ">
                                    <label for="email">{{ __('E Mail') }}</label>
                                    <input id="email" type="text" class="form-control btn-sm border-dark shadow @error('email') is-invalid @enderror"  value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="E Mail" required="required" name="email"  >
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="form-group btn-group-sm has-feedback has-success">
                                    <label for="password">{{ __('Password') }}
                                    </label>
                                    <input id="password" type="password" class="form-control btn-sm border-dark shadow @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm has-feedback has-success">
                                    <label for="password_confirmation">{{ __('Confirm Password') }}
                                    </label>
                                    <input id="password_confirmation" type="password" class="form-control btn-sm border-dark shadow @error('password_confirmation') is-invalid @enderror" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">
                                    @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>



                                <div class="form-group m-0">
                                    <button type="submit" class="btn  btn-block btn-outline-danger">
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
@section('script')

    @endsection
