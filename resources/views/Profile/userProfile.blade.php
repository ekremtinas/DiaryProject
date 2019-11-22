@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100 ">
            <div class="card-wrapper col-6">
                <div class="brand">
                    <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div class="card fat shadow-lg rounded-lg border-light   w-100 ">
                    <div class="card-body">
                        <h4 class="card-title text-center">User Profile</h4>

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
                        <form id="form" action="{{route('userProfilePost')}}" method="post" >
                            @csrf
                            <div class="form-group btn-group-sm  ">
                                <label class="btn-sm" for="name">{{ __('Full Name:') }}</label>
                                <input id="name" type="text" class="form-control btn-sm  border-light shadow rounded-pill @error('name') is-invalid @enderror"  value="@if (!isset(Auth::user()->name))  {{  old('name') }} @else {{Auth::user()->name}}  @endif" required autocomplete="name" autofocus placeholder="Full Name" required="required" name="name"  >
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group btn-group-sm  ">
                                <label class="btn-sm" for="email">{{ __('E Mail:') }}</label>
                                <input id="email" type="text" class="form-control btn-sm  border-light shadow rounded-pill @error('email') is-invalid @enderror"  value="@if (!isset(Auth::user()->email))  {{  old('email') }} @else {{Auth::user()->email}}  @endif" required autocomplete="email" autofocus placeholder="E Mail" required="required" name="email"  >
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group btn-group-sm has-feedback has-success  " id="show_hide_password" >
                                <label class="btn-sm" for="password">{{ __('Password:') }}
                                </label>

                                <input id="password" type="password" class="form-control btn-sm  border-light rounded-pill  shadow @error('password') is-invalid @enderror" name="password" value="@if (isset(Auth::user()->password)) {{Auth::user()->password}} @endif" required autocomplete="current-password" placeholder="Password" aria-describedby="button-addon2">



                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group btn-group-sm has-feedback has-success"  id="show_hide_password">
                                <label class="btn-sm" for="password_confirmation">{{ __('Confirm Password:') }}
                                </label>
                                <div class="input-group">
                                    <input id="password_confirmation" type="password" class="form-control btn-sm  border-light rounded-pill  shadow @error('password_confirmation') is-invalid @enderror"  value="@if (isset(Auth::user()->password)) {{Auth::user()->password}} @endif" name="password_confirmation" required autocomplete="current-password" placeholder="Confirm Password">

                                </div>
                                @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                            <div class="form-group m-0">
                                <button type="submit" class="btn  btn-block btn-outline-danger  border-light rounded-pill">
                                    Save
                                </button>

                            </div>


                        </form>
                    </div>
                </div>
            </div>

        </div>
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
