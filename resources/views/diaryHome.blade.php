@extends('layouts.app')
@section('content')
    <div class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper">
                <div class="brand">
                    <img width="300db" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <h1 class="text-center">Home</h1>
                @if(isset(Auth::user()->email))
                    <div class="alert alert-danger succes-block">
                    <strong>Welcome {{ Auth::user()->email }}</strong>
                        <br>
                        <a href="{{ url('diaryLogout')  }}">Logout</a>
                    </div>
                    @else
                <script>window.location='/dLogin';</script>
                    @endif
            </div>

        </div>
@endsection
