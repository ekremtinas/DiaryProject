@extends('layouts.app')
@section('content')
    @if(!isset(Auth::user()->email))
        <script>window.location='/dLogin';</script>

    @else
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <h1 class="text-center">Home</h1>

                    <div class="alert alert-danger succes-block">
                        <strong>Welcome {{ Auth::user()->email }}</strong>
                        <br>
                        <a href="{{ route('homeLogout')  }}">Logout</a>
                    </div>

            </div>

        </div>
        @endif
@endsection
