@extends('layouts.app')
@section('title')

        <title>User Home | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('content')


    <div id="container" class="container h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper ">
                <div style="width:550px " id="image" class="brand text-center">
                    <img class="col-5 offset-0" src="/components/img/diaryLogo.png" alt="logo">
                </div>
                <div id="form" class="card fat   rounded-lg border-light shadow-main  w-100 ">
                    <div class="card-body ">
                        <h4 class="card-title text-center ">User Home</h4>
                        <form id="userHomeForm" action="{{route('userHomePost')}}" method="post" >
                            @csrf
                            <div class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2">
                                <label id="licensePlate-label"  class="btn-sm scroll-label" for="licensePlate">{{ __('License Plate:') }}</label>
                                <input id="licensePlate" data-bvalidator="required,email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('licensePlate') is-invalid @enderror "  value="{{ old('licensePlate') }}"   autocomplete="off"   placeholder="License Plate"  name="licensePlate"  >
                                @error('licensePlate')
                                <span  id="licensePlate-alert" class="licensePlate-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                            <div class="offset-lg-3 col-lg-6 mt-lg-5">

                                <div class="form-group m-0 ">
                                    <button  id="button" type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
                                        Login
                                    </button>

                                </div>
                            </div>
                        </form>


                    </div>
                </div>
            </div>

        </div>






        @endsection
        @section('css')
            <link rel="stylesheet" href="/components/diaryLogin/css/main.css" >
            <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
            <style>



            </style>
        @endsection
        @section('script')
            <script src="/components/diaryLogin/js/main.js" ></script>
            <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
            <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
            <script src="/components/bvalidator/themes/red/red.js"></script>
            <script>
                $(document).ready(function () {
                    $('#loginForm').bValidator();
                });

            </script>




@endsection
