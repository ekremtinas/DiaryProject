@extends('layouts.app')
@section('title')
    @if(isset(Auth::user()->email))
        <script>window.location='/dHome';</script>

    @else
    <title>Register | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('content')

        <div class="container h-100">
            <div class="row justify-content-center h-100">
                <div class="card-wrapper ">
                    <div  style="width: 350px;" id="image" class="brand text-center">
                        <img class="col-7 offset-0" src="/components/img/diaryLogo.png" alt="logo">
                    </div>
                    <div class="card fat shadow-main rounded-lg border-light   w-100">
                        <div id="resetButton" style="position: absolute;top:0; right: 0;" class="btn-block btn-sm btn-outline-danger fa fa-trash col-1 rounded-circle pr-1"></div>

                        <div class="card-body">
                            <h4 class="card-title text-center">Register</h4>
                             @if($message=Session::get('error'))
                                <div id="errorAlert" class="alert-size notification alert alert-danger alert-block col-3 rounded-pill btn-sm">
                                    <button id="errorHide" class="close alert-size"  type="button">
                                        x
                                    </button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            @if($message=Session::get('success'))
                                <div id="notificationAlert" class="alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
                                    <button id="notificationHide" class="close alert-size"  type="button">
                                        x
                                    </button>
                                    <strong>{{$message}}</strong>
                                </div>
                            @endif
                            <form id="registerForm" action="{{route('registerPost')}}" method="post" >
                                @csrf

                                <div class="form-group btn-group-sm mt-5 ">
                                    <label id="name-label" class="btn-sm scroll-label" for="name">{{ __('Full Name:') }}</label>
                                    <input id="name" data-bvalidator="required,minlen[3],maxlen[50]" type="text" class=" form-control btn-sm  border-light shadow-main rounded-pill @error('name') is-invalid @enderror"  value="{{ old('name') }}" autocomplete="off"  placeholder="Full Name" name="name"  >
                                    @error('name')
                                    <span id="name-alert" class="name-alert invalid-feedback alert-size  rounded-pill alert-danger  col-10 pl-3 ml-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-5 ">
                                    <label id="email-label" class="btn-sm scroll-label" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" data-bvalidator="required,email" type="text" class="form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror"  value="{{ old('email') }}"  autocomplete="off"  placeholder="E Mail"  name="email"  >
                                    @error('email')
                                    <span id="email-alert" class="email-alert invalid-feedback alert-size  rounded-pill alert-danger  col-10 pl-3 ml-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group btn-group-sm mt-5 ">
                                    <label id="country-label" class="btn-sm scroll-label" for="country_selector" >{{__('Country:')}}</label>
                                    <div class=" ">
                                        <input name="country" data-bvalidator="required" style="width: 100%" class=" form-control btn-sm  border-light rounded-pill shadow-main" id="country_selector" type="text" value="{{ old('country') }}">

                                    </div>
                                </div>
                                <div class="form-group btn-group-sm mt-5 ">
                                    <label id="lang-label" class="btn-sm scroll-label" for="lang" >{{__('Language:')}}</label>
                                    <div class=" ">

                                        <select  name="lang" data-bvalidator="required" style="width: 100%" class=" form-control btn-sm  border-light rounded-pill shadow-main" id="lang" type="text" placeholder="Language" value="{{ old('lang') }}">
                                            <option value="af">Afrikanns</option>
                                            <option value="sq">Albanian</option>
                                            <option value="ar">Arabic</option>
                                            <option value="hy">Armenian</option>
                                            <option value="eu">Basque</option>
                                            <option value="bn">Bengali</option>
                                            <option value="bg">Bulgarian</option>
                                            <option value="ca">Catalan</option>
                                            <option value="km">Cambodian</option>
                                            <option value="zh">Chinese (Mandarin)</option>
                                            <option value="hr">Croation</option>
                                            <option value="cs">Czech</option>
                                            <option value="da">Danish</option>
                                            <option value="nl">Dutch</option>
                                            <option value="en">English</option>
                                            <option value="et">Estonian</option>
                                            <option value="fj">Fiji</option>
                                            <option value="fi">Finnish</option>
                                            <option value="fr">French</option>
                                            <option value="ka">Georgian</option>
                                            <option value="de">German</option>
                                            <option value="el">Greek</option>
                                            <option value="gu">Gujarati</option>
                                            <option value="he">Hebrew</option>
                                            <option value="hi">Hindi</option>
                                            <option value="hu">Hungarian</option>
                                            <option value="is">Icelandic</option>
                                            <option value="id">Indonesian</option>
                                            <option value="ga">Irish</option>
                                            <option value="it">Italian</option>
                                            <option value="ja">Japanese</option>
                                            <option value="jw">Javanese</option>
                                            <option value="ko">Korean</option>
                                            <option value="la">Latin</option>
                                            <option value="lv">Latvian</option>
                                            <option value="lt">Lithuanian</option>
                                            <option value="mk">Macedonian</option>
                                            <option value="ms">Malay</option>
                                            <option value="ml">Malayalam</option>
                                            <option value="mt">Maltese</option>
                                            <option value="mi">Maori</option>
                                            <option value="mr">Marathi</option>
                                            <option value="mn">Mongolian</option>
                                            <option value="ne">Nepali</option>
                                            <option value="no">Norwegian</option>
                                            <option value="fa">Persian</option>
                                            <option value="pl">Polish</option>
                                            <option value="pt">Portuguese</option>
                                            <option value="pa">Punjabi</option>
                                            <option value="qu">Quechua</option>
                                            <option value="ro">Romanian</option>
                                            <option value="ru">Russian</option>
                                            <option value="sm">Samoan</option>
                                            <option value="sr">Serbian</option>
                                            <option value="sk">Slovak</option>
                                            <option value="sl">Slovenian</option>
                                            <option value="es">Spanish</option>
                                            <option value="sw">Swahili</option>
                                            <option value="sv">Swedish </option>
                                            <option value="ta">Tamil</option>
                                            <option value="tt">Tatar</option>
                                            <option value="te">Telugu</option>
                                            <option value="th">Thai</option>
                                            <option value="bo">Tibetan</option>
                                            <option value="to">Tonga</option>
                                            <option selected value="tr">Turkish</option>
                                            <option value="uk">Ukranian</option>
                                            <option value="ur">Urdu</option>
                                            <option value="uz">Uzbek</option>
                                            <option value="vi">Vietnamese</option>
                                            <option value="cy">Welsh</option>
                                            <option value="xh">Xhosa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group btn-group-sm  mt-5 " id="show_hide_password" >
                                    <label id="password-label" class="btn-sm scroll-label" for="password">{{ __('Password:') }}
                                    </label>
                                    <div class="input-group">
                                    <input id="password" data-bvalidator="required,minlen[6],maxlen[30]" type="password" class="form-control btn-sm  border-light rounded-pill shadow-main @error('password') is-invalid @enderror" name="password"  autocomplete="current-password" placeholder="Password" >
                                        <div class="input-group-append  ">
                                            <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @error('password')
                                        <span id="password-alert" class="password-alert invalid-feedback alert-size  rounded-pill alert-danger col-10 pl-3 ml-2" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>


                                </div>
                                <div class="form-group btn-group-sm mt-5"  id="show_hide_password2">
                                    <label id="password-confirmation-label" class="btn-sm scroll-label" for="password_confirmation">{{ __('Confirm Password:') }}
                                    </label>
                                    <div class="input-group">
                                        <input  id="password_confirmation" data-bvalidator="required,minlen[6],maxlen[16]" type="password" class=" form-control btn-sm  border-light rounded-pill  shadow-main @error('password_confirmation') is-invalid @enderror" name="password_confirmation"  autocomplete="current-password" placeholder="Confirm Password">
                                        <div class="input-group-append  ">
                                            <a style="z-index: 0" id="password-show" class=" btn btn-sm btn-outline-danger border-light rounded-pill h-100 shadow-main" href="#"><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                        @error('password_confirmation')
                                        <span class="invalid-feedback alert-size  rounded-pill alert-danger  col-10 pl-3 ml-2 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <span id="password_equal" style="display: none" class=" invalid-feedback alert-size  rounded-pill alert-success col-8 offeset-2" >Password is the same and greater than 6</span>
                                </div>



                                <div class="row mt-5">

                                    <div class="form-group m-0 col-6">
                                        <button  onclick="window.location.href = '/dLogin';" type="button" class="btn btn-block   btn-outline-danger border-light rounded-pill shadow-main">
                                            Login
                                        </button>
                                    </div>
                                    <div class="form-group m-0 col-6">
                                        <button type="submit" class="btn  btn-block btn-outline-danger border-light rounded-pill shadow-main">
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
            <!-- Ülke secimi için gerekli css
                       Start -->
                <link rel="stylesheet" href="/components/countryselect/build/css/countrySelect.css">

                <!-- End -->
                <link rel="stylesheet" href="/components/diaryRegister/css/main.css">
                <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
        @endsection
        @section('script')
            <!-- Ülke seçimi için gerekli js
                    Start -->
                <script src="/components/countryselect/build/js/countrySelect.js"></script>
                <!-- Ülke seçimi için gerekli js
                        End  -->
                <script src="/components/diaryRegister/js/main.js"></script>
                <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
                <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
                <script src="/components/bvalidator/themes/red/red.js"></script>
                <script>
                    $(document).ready(function () {
                        $('#registerForm').bValidator();

                        $('#resetButton').click(function(){
                            $('#registerForm')[0].reset();
                        });
                    });

                </script>


@endsection
