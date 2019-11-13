@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div class="card fat shadow-lg  rounded ">
                    <div class="card-body">
                        <h4 class="card-title text-center">Login</h4>

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
                            <div class="form-group ">
                                <div class="custom-checkbox custom-control">
                                    <input class="custom-control-input  " type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label for="remember" class="custom-control-label">Remember Me</label>
                                </div>
                            </div>


                            <div class="form-group m-0">
                                <button type="submit" class="btn  btn-block btn-outline-danger">
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
@endsection
