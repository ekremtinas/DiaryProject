@extends('layouts.app')
@section('title')

        <title class="pageTitle">User Home | Diary</title>
@endsection
@section('shadow')
    shadow-main
@endsection
@section('localeUser')
    <select style="display: none;" class="custom-select-sm col-1 custom-select rounded-pill shadow-main" id="locale-selector"></select>
@endsection
@section('layoutDiv')
    hidden
    @endsection
@section('pageTitle')
<div class="pageTitle navbar-brand">User Home</div>
@endsection
@section('content')


    <div id="firstContainer" class="container w-100 h-100">
        <div class="row justify-content-center h-100">
            <div class="card-wrapper col-lg-12 pt-lg-3">

                <div   class="card fat   rounded-lg border-light shadow-main  w-100 mb-lg-5 ml-2 mt-2 ">
                    <div  id='vueApp' class="card-body ">
                        <form id="userFirstForm"  method="post">
                            @csrf
                            <div class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2">
                                <label id="licensePlate-label"  class="col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="licensePlate">{{ __('License Plate:') }}</label>
                                <input id="licensePlate" data-bvalidator="required" type="text" class="licensePlateInput col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('licensePlate') is-invalid @enderror "  value="{{ old('licensePlate') }}"   autocomplete="off"   placeholder="License Plate"  name="licensePlate"  >
                                @error('licensePlate')
                                <span  id="licensePlate-alert" class="licensePlate-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                @enderror

                            </div>
                            <img class="col-lg-2 offset-lg-5" hidden id="miniLoading" src="/components/img/gif/miniLoading.gif">
                            <div id="carImage" hidden class="form-group btn-group-sm mt-5 col-lg-8 offset-lg-2 row">

                                <img  class="col-lg-6 carImageZoom rounded-lg  offset-lg-3 border-light shadow-main col-10 offset-1" src=""  \>
                                <div class="form-group btn-sm mt-2 col-lg-6  offset-lg-3">
                                    <div class="custom-switch custom-control ">
                                        <input class="custom-control-input    "  type="checkbox" name="carConfirmSwitch" id="carConfirmSwitch" >
                                        <label for="carConfirmSwitch" class="custom-control-label   ">Yes. This is from my car</label>
                                    </div>

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="form-group btn-group-sm mt-4 col-lg-8 offset-lg-2 ">
                                    <label id="fullName-label"  class=" col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="fullName">{{ __('Full Name:') }}</label>
                                    <input id="fullName" data-bvalidator="required" type="text" class="col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('fullName') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="Full Name"  name="fullName"  >
                                    @error('fullName')
                                    <span  id="fullName-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group btn-group-sm mt-4 col-lg-8 offset-lg-2">
                                    <label id="email-label"  class=" col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="email">{{ __('E Mail:') }}</label>
                                    <input id="email" data-bvalidator="required,email" type="text" class="col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('email') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="E Mail"  name="email"  >
                                    @error('email')
                                    <span  id="email-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-group btn-group-sm mt-4 col-lg-8 offset-lg-2 ">
                                    <label id="gsm-label"  class="col-lg-6 offset-lg-3 btn-sm scroll-home-label" for="gsm">{{ __('GSM:') }}</label>
                                    <input id="gsm" data-bvalidator="required,number,alphanum" type="text" class="col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('gsm') is-invalid @enderror "  value=""   autocomplete="off"   placeholder="GSM"  name="gsm"  >
                                    @error('gsm')
                                    <span  id="gsm-alert" class="title-alert invalid-feedback alert-size pl-3 ml-2 rounded-pill alert-danger col-10 " role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>

                                    @enderror

                                </div>
                            </div>
                            <div class="form-group">
                            <div class="form-group btn-group-sm mt-4 col-lg-8 offset-lg-2  ">
                                <label id="country-label" class=" col-lg-6 offset-lg-3 btn-sm scroll-label" for="country" >{{__('Country:')}}</label>
                                <div class=" ">
                                    <select id="country" name="country" data-bvalidator="required" type="text" class="col-lg-6 offset-lg-3 form-control btn-sm  border-light shadow-main rounded-pill @error('gsm') is-invalid @enderror "  value=""   autocomplete="off">
                                        <option value="Choose Country">Choose Country</option>
                                        <option value="Afghanistan">Afghanistan</option>
                                        <option value="Åland Islands">Åland Islands</option>
                                        <option value="Albania">Albania</option>
                                        <option value="Algeria">Algeria</option>
                                        <option value="American Samoa">American Samoa</option>
                                        <option value="Andorra">Andorra</option>
                                        <option value="Angola">Angola</option>
                                        <option value="Anguilla">Anguilla</option>
                                        <option value="Antarctica">Antarctica</option>
                                        <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                        <option value="Argentina">Argentina</option>
                                        <option value="Armenia">Armenia</option>
                                        <option value="Aruba">Aruba</option>
                                        <option value="Australia">Australia</option>
                                        <option value="Austria">Austria</option>
                                        <option value="Azerbaijan">Azerbaijan</option>
                                        <option value="Bahamas">Bahamas</option>
                                        <option value="Bahrain">Bahrain</option>
                                        <option value="Bangladesh">Bangladesh</option>
                                        <option value="Barbados">Barbados</option>
                                        <option value="Belarus">Belarus</option>
                                        <option value="Belgium">Belgium</option>
                                        <option value="Belize">Belize</option>
                                        <option value="Benin">Benin</option>
                                        <option value="Bermuda">Bermuda</option>
                                        <option value="Bhutan">Bhutan</option>
                                        <option value="Bolivia">Bolivia</option>
                                        <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                        <option value="Botswana">Botswana</option>
                                        <option value="Bouvet Island">Bouvet Island</option>
                                        <option value="Brazil">Brazil</option>
                                        <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                        <option value="Brunei Darussalam">Brunei Darussalam</option>
                                        <option value="Bulgaria">Bulgaria</option>
                                        <option value="Burkina Faso">Burkina Faso</option>
                                        <option value="Burundi">Burundi</option>
                                        <option value="Cambodia">Cambodia</option>
                                        <option value="Cameroon">Cameroon</option>
                                        <option value="Canada">Canada</option>
                                        <option value="Cape Verde">Cape Verde</option>
                                        <option value="Cayman Islands">Cayman Islands</option>
                                        <option value="Central African Republic">Central African Republic</option>
                                        <option value="Chad">Chad</option>
                                        <option value="Chile">Chile</option>
                                        <option value="China">China</option>
                                        <option value="Christmas Island">Christmas Island</option>
                                        <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                        <option value="Colombia">Colombia</option>
                                        <option value="Comoros">Comoros</option>
                                        <option value="Congo">Congo</option>
                                        <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                        <option value="Cook Islands">Cook Islands</option>
                                        <option value="Costa Rica">Costa Rica</option>
                                        <option value="Cote D'ivoire">Cote D'ivoire</option>
                                        <option value="Croatia">Croatia</option>
                                        <option value="Cuba">Cuba</option>
                                        <option value="Cyprus">Cyprus</option>
                                        <option value="Czech Republic">Czech Republic</option>
                                        <option value="Denmark">Denmark</option>
                                        <option value="Djibouti">Djibouti</option>
                                        <option value="Dominica">Dominica</option>
                                        <option value="Dominican Republic">Dominican Republic</option>
                                        <option value="Ecuador">Ecuador</option>
                                        <option value="Egypt">Egypt</option>
                                        <option value="El Salvador">El Salvador</option>
                                        <option value="Equatorial Guinea">Equatorial Guinea</option>
                                        <option value="Eritrea">Eritrea</option>
                                        <option value="Estonia">Estonia</option>
                                        <option value="Ethiopia">Ethiopia</option>
                                        <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                        <option value="Faroe Islands">Faroe Islands</option>
                                        <option value="Fiji">Fiji</option>
                                        <option value="Finland">Finland</option>
                                        <option value="France">France</option>
                                        <option value="French Guiana">French Guiana</option>
                                        <option value="French Polynesia">French Polynesia</option>
                                        <option value="French Southern Territories">French Southern Territories</option>
                                        <option value="Gabon">Gabon</option>
                                        <option value="Gambia">Gambia</option>
                                        <option value="Georgia">Georgia</option>
                                        <option value="Germany">Germany</option>
                                        <option value="Ghana">Ghana</option>
                                        <option value="Gibraltar">Gibraltar</option>
                                        <option value="Greece">Greece</option>
                                        <option value="Greenland">Greenland</option>
                                        <option value="Grenada">Grenada</option>
                                        <option value="Guadeloupe">Guadeloupe</option>
                                        <option value="Guam">Guam</option>
                                        <option value="Guatemala">Guatemala</option>
                                        <option value="Guernsey">Guernsey</option>
                                        <option value="Guinea">Guinea</option>
                                        <option value="Guinea-bissau">Guinea-bissau</option>
                                        <option value="Guyana">Guyana</option>
                                        <option value="Haiti">Haiti</option>
                                        <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                        <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                        <option value="Honduras">Honduras</option>
                                        <option value="Hong Kong">Hong Kong</option>
                                        <option value="Hungary">Hungary</option>
                                        <option value="Iceland">Iceland</option>
                                        <option value="India">India</option>
                                        <option value="Indonesia">Indonesia</option>
                                        <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                        <option value="Iraq">Iraq</option>
                                        <option value="Ireland">Ireland</option>
                                        <option value="Isle of Man">Isle of Man</option>
                                        <option value="Israel">Israel</option>
                                        <option value="Italy">Italy</option>
                                        <option value="Jamaica">Jamaica</option>
                                        <option value="Japan">Japan</option>
                                        <option value="Jersey">Jersey</option>
                                        <option value="Jordan">Jordan</option>
                                        <option value="Kazakhstan">Kazakhstan</option>
                                        <option value="Kenya">Kenya</option>
                                        <option value="Kiribati">Kiribati</option>
                                        <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                        <option value="Korea, Republic of">Korea, Republic of</option>
                                        <option value="Kuwait">Kuwait</option>
                                        <option value="Kyrgyzstan">Kyrgyzstan</option>
                                        <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                        <option value="Latvia">Latvia</option>
                                        <option value="Lebanon">Lebanon</option>
                                        <option value="Lesotho">Lesotho</option>
                                        <option value="Liberia">Liberia</option>
                                        <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                        <option value="Liechtenstein">Liechtenstein</option>
                                        <option value="Lithuania">Lithuania</option>
                                        <option value="Luxembourg">Luxembourg</option>
                                        <option value="Macao">Macao</option>
                                        <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                        <option value="Madagascar">Madagascar</option>
                                        <option value="Malawi">Malawi</option>
                                        <option value="Malaysia">Malaysia</option>
                                        <option value="Maldives">Maldives</option>
                                        <option value="Mali">Mali</option>
                                        <option value="Malta">Malta</option>
                                        <option value="Marshall Islands">Marshall Islands</option>
                                        <option value="Martinique">Martinique</option>
                                        <option value="Mauritania">Mauritania</option>
                                        <option value="Mauritius">Mauritius</option>
                                        <option value="Mayotte">Mayotte</option>
                                        <option value="Mexico">Mexico</option>
                                        <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                        <option value="Moldova, Republic of">Moldova, Republic of</option>
                                        <option value="Monaco">Monaco</option>
                                        <option value="Mongolia">Mongolia</option>
                                        <option value="Montenegro">Montenegro</option>
                                        <option value="Montserrat">Montserrat</option>
                                        <option value="Morocco">Morocco</option>
                                        <option value="Mozambique">Mozambique</option>
                                        <option value="Myanmar">Myanmar</option>
                                        <option value="Namibia">Namibia</option>
                                        <option value="Nauru">Nauru</option>
                                        <option value="Nepal">Nepal</option>
                                        <option value="Netherlands">Netherlands</option>
                                        <option value="Netherlands Antilles">Netherlands Antilles</option>
                                        <option value="New Caledonia">New Caledonia</option>
                                        <option value="New Zealand">New Zealand</option>
                                        <option value="Nicaragua">Nicaragua</option>
                                        <option value="Niger">Niger</option>
                                        <option value="Nigeria">Nigeria</option>
                                        <option value="Niue">Niue</option>
                                        <option value="Norfolk Island">Norfolk Island</option>
                                        <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                        <option value="Norway">Norway</option>
                                        <option value="Oman">Oman</option>
                                        <option value="Pakistan">Pakistan</option>
                                        <option value="Palau">Palau</option>
                                        <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                        <option value="Panama">Panama</option>
                                        <option value="Papua New Guinea">Papua New Guinea</option>
                                        <option value="Paraguay">Paraguay</option>
                                        <option value="Peru">Peru</option>
                                        <option value="Philippines">Philippines</option>
                                        <option value="Pitcairn">Pitcairn</option>
                                        <option value="Poland">Poland</option>
                                        <option value="Portugal">Portugal</option>
                                        <option value="Puerto Rico">Puerto Rico</option>
                                        <option value="Qatar">Qatar</option>
                                        <option value="Reunion">Reunion</option>
                                        <option value="Romania">Romania</option>
                                        <option value="Russian Federation">Russian Federation</option>
                                        <option value="Rwanda">Rwanda</option>
                                        <option value="Saint Helena">Saint Helena</option>
                                        <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                        <option value="Saint Lucia">Saint Lucia</option>
                                        <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                        <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                        <option value="Samoa">Samoa</option>
                                        <option value="San Marino">San Marino</option>
                                        <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                        <option value="Saudi Arabia">Saudi Arabia</option>
                                        <option value="Senegal">Senegal</option>
                                        <option value="Serbia">Serbia</option>
                                        <option value="Seychelles">Seychelles</option>
                                        <option value="Sierra Leone">Sierra Leone</option>
                                        <option value="Singapore">Singapore</option>
                                        <option value="Slovakia">Slovakia</option>
                                        <option value="Slovenia">Slovenia</option>
                                        <option value="Solomon Islands">Solomon Islands</option>
                                        <option value="Somalia">Somalia</option>
                                        <option value="South Africa">South Africa</option>
                                        <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                        <option value="Spain">Spain</option>
                                        <option value="Sri Lanka">Sri Lanka</option>
                                        <option value="Sudan">Sudan</option>
                                        <option value="Suriname">Suriname</option>
                                        <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                        <option value="Swaziland">Swaziland</option>
                                        <option value="Sweden">Sweden</option>
                                        <option value="Switzerland">Switzerland</option>
                                        <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                        <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                        <option value="Tajikistan">Tajikistan</option>
                                        <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                        <option value="Thailand">Thailand</option>
                                        <option value="Timor-leste">Timor-leste</option>
                                        <option value="Togo">Togo</option>
                                        <option value="Tokelau">Tokelau</option>
                                        <option value="Tonga">Tonga</option>
                                        <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                        <option value="Tunisia">Tunisia</option>
                                        <option value="Turkey">Turkey</option>
                                        <option value="Turkmenistan">Turkmenistan</option>
                                        <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                        <option value="Tuvalu">Tuvalu</option>
                                        <option value="Uganda">Uganda</option>
                                        <option value="Ukraine">Ukraine</option>
                                        <option value="United Arab Emirates">United Arab Emirates</option>
                                        <option value="United Kingdom">United Kingdom</option>
                                        <option value="United States">United States</option>
                                        <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                        <option value="Uruguay">Uruguay</option>
                                        <option value="Uzbekistan">Uzbekistan</option>
                                        <option value="Vanuatu">Vanuatu</option>
                                        <option value="Venezuela">Venezuela</option>
                                        <option value="Viet Nam">Viet Nam</option>
                                        <option value="Virgin Islands, British">Virgin Islands, British</option>
                                        <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                        <option value="Wallis and Futuna">Wallis and Futuna</option>
                                        <option value="Western Sahara">Western Sahara</option>
                                        <option value="Yemen">Yemen</option>
                                        <option value="Zambia">Zambia</option>
                                        <option value="Zimbabwe">Zimbabwe</option>
                                    </select>
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                            <div class="form-group btn-group-sm mt-4 col-lg-8 offset-lg-2  ">
                                <label id="lang-label" class="col-lg-6 offset-lg-3 btn-sm scroll-label" for="lang" >{{__('Language:')}}</label>
                                <div class=" ">

                                    <select  name="lang" data-bvalidator="required" style="width: 100%" class="col-lg-6 offset-lg-3  form-control btn-sm  border-light rounded-pill shadow-main" id="lang" type="text" placeholder="Language" >
                                        <option selected value="Choose Language">Choose Language</option>
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
                                        <option value="tr">Turkish</option>
                                        <option value="uk">Ukranian</option>
                                        <option value="ur">Urdu</option>
                                        <option value="uz">Uzbek</option>
                                        <option value="vi">Vietnamese</option>
                                        <option value="cy">Welsh</option>
                                        <option value="xh">Xhosa</option>
                                    </select>
                                </div>
                            </div></div>




                            <div class="form-group btn-group-sm mt-5 col-lg-6 offset-lg-3">

                            <table id="maintenanceTable" style="border-radius: 1rem; !important;" class="table table-responsive-lg table-borderless  btn-sm shadow-main">
                                <tr>
                                    <td ><b>Maintenance type</b></td>

                                    <td><b>Choose</b></td>
                                </tr>

                                @foreach($maintenance ?? '' as $row)
                                <tr style="line-height: 1px !important;padding-top:0px !important;padding-bottom:0px !important; " >
                                    <td  >({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}</td>


                                  <td> <div class="custom-switch custom-control ">
                                          <input class="custom-control-input    "  type="checkbox" value="({{$row->maintenanceMinute}}) {{$row->maintenanceTitle}}" name="maintenance[]" id="maintenance{{$row->id}}" >
                                          <label for="maintenance{{$row->id}}" class="custom-control-label   "></label>
                                      </div></td>

                                </tr>
                                     @endforeach

                            </table>
                            </div>
                            <div class="offset-lg-4 col-lg-4 mt-lg-3 text-center">

                                <div class="form-group m-0 ">
                                    <button disabled  id="goOnButton" type="submit" style="padding:15px 40px !important;" class="btn btn-sm   btn-outline-danger border-light rounded-pill shadow-main">
                                     Go on
                                    </button>

                                </div>
                            </div>

                        </form>

                        <div  style='display:none' id="secondContainer">

                            <div style="" class="loading" id="loading"><div class="sk-cube-grid">
                                    <div class="sk-cube sk-cube1"></div>
                                    <div class="sk-cube sk-cube2"></div>
                                    <div class="sk-cube sk-cube3"></div>
                                    <div class="sk-cube sk-cube4"></div>
                                    <div class="sk-cube sk-cube5"></div>
                                    <div class="sk-cube sk-cube6"></div>
                                    <div class="sk-cube sk-cube7"></div>
                                    <div class="sk-cube sk-cube8"></div>
                                    <div class="sk-cube sk-cube9"></div>
                                </div></div>

                            <div tabindex="-1" class="container w-75 h-100" id='top'>

                                <div class='left' hidden>

                                    <div id='theme-system-selector' class='selector'>
                                        Theme System:

                                        <select hidden>
                                            <option value='bootstrap' selected></option>
                                        </select>
                                    </div>

                                    <div data-theme-system="bootstrap" class='selector' style='display:none'>
                                        Theme Name:

                                        <select hidden>

                                            <option selected  value='journal'>Journal</option>

                                        </select>
                                    </div>

                                    <span id='loading' style='display:none'>loading theme...</span>

                                </div>



                                <div class='clear'></div>
                            </div>
                           <div class="ml-lg-3 ml-3">
                               <div style="font-size: 12px !important;" class="row list-group list-group-horizontal-xl">
                                   <div class="col-lg-3 list-group-item "><b>License Plate: </b> <b class="ml-lg-1" id="plateHtml"></b></div>
                                   <div class="col-lg-3 list-group-item"><b>Total Maintenance: </b> <b class="ml-lg-1" id="minuteHtml">00:00:00</b></div>
                                   <div class="col-lg-2 list-group-item"><b>Before this day: </b><div style="background-color:#C3C3C3;width: 20px;height: 20px;"></div></div>
                                   <div class="col-lg-1 list-group-item"><b>Today: </b><div style="background-color:#D6E0EB;width: 20px;height: 20px;"></div></div>
                                   <div class="col-lg-1 list-group-item"><b>Reserved: </b><div style="background-color:rgb(122, 122, 122);width: 20px;height: 20px;"></div></div>

                               </div>
                           </div>
                               <div class="h-100 mt-lg-3 mt-5" id='calendar'>  </div>



                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
    <div style="display: none;" id="mousepopup"></div>
    @include('UserHome.Modals.editUserModal')

    <div id="notificationAlert" style="display: none;" class=" alert-size notification alert alert-success alert-block col-3 rounded-pill btn-sm">
        <button id="notificationHide" class="close alert-size"  type="button">
            x
        </button>
        <strong class="notification-text"></strong>
    </div>


        @endsection
        @section('css')
            <link rel="stylesheet" href="/components/userHome/css/main.css" >
            <link href="/components/bvalidator/themes/red/red.css" rel="stylesheet" />
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-contextmenu/2.9.0/jquery.contextMenu.css">

            <link href='/components/fullcalendar/packages/core/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/bootstrap/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/timegrid/main.css' rel='stylesheet' />
            <link href='/components/fullcalendar/packages/daygrid/main.css' rel='stylesheet' />

            <style>


            </style>
        @endsection
        @section('script')
            <script src="/components/userHome/js/main.js" ></script>

            <script src="/components/bvalidator/dist/jquery.bvalidator.min.js"></script>
            <script src="/components/bvalidator/themes/presenters/bValidator.DefaultPresenter.js"></script>
            <script src="/components/bvalidator/themes/red/red.js"></script>
            <script src="/components/userHome/js/jquery.contextMenu.min.js" defer></script>
            <script src="/components/userHome/js/bootbox.js" defer></script>

            <script src='/components/fullcalendar/packages/core/main.js'></script>
            <script src='/components/fullcalendar/packages/interaction/main.js'></script>
            <script src='/components/fullcalendar/packages/bootstrap/main.js'></script>
            <script src='/components/fullcalendar/packages/daygrid/main.js'></script>
            <script src='/components/fullcalendar/packages/timegrid/main.js'></script>
            <script src='/components/fullcalendar/js/theme-chooser.js'></script>
            <script src='/components/userHome/js/moment.js'></script>
            <script src='/components/fullcalendar/packages/core/locales-all.js'></script>
            <script src="/components/userHome/js/lodash.min.js"></script>
            <script src="/components/userHome/js/calendar.js" ></script>
            <script>
                    var timeDiffMoment;
                    var addEventData;
                    var calendar; // Calendar değişkeni Global olarak tanımlandı
                    var calendarEl = document.getElementById('calendar'); // Calendar idli div'in değişkene atanması
                    var appointmentData;
            $(document).ready(function () {


                        var userFirstForm=$('#userFirstForm');
                        var secondContainer=$('#secondContainer');
                        userFirstForm.bValidator();


                        var plateHtml=$('#plateHtml');
                        var minuteHtml=$('#minuteHtml');

                        var globalTotalTime;
                        var workplaceName, defaultDate, minTime,maxTime,weekends,defaultView;
                        defaultDate= moment().day().today;
                        minTime="08:00:00";
                        maxTime="18:00:00";
                        weekends=false;
                        defaultView=false;

                    var userFirstForm = $('#userFirstForm');
                    userFirstForm.submit(function(e){
                        e.preventDefault();
                        var maintenanceArray= [];
                        addEventData=[];
                        addEventData.push(userFirstForm.find('#licensePlate').val());
                        addEventData.push(userFirstForm.find('#fullName').val());
                        addEventData.push(userFirstForm.find('#email').val());
                        addEventData.push(userFirstForm.find('#gsm').val());
                        addEventData.push(userFirstForm.find('#country').val());
                        addEventData.push(userFirstForm.find('#lang').val());



                        //Bakım Türü Dakikalarının Toplanması Start
                        globalTotalTime=maintenanceTimeSum(maintenanceArray);
                        //Bakım Türünün Dakikasının Toplanması End


                        addEventData.push({maintenance:maintenanceArray});//Dataya Bakım Türünün Eklenmesi
                        console.log(globalTotalTime)
                        console.log(addEventData)
                        userFirstForm.hide();
                        secondContainer.show();
                        //Mouse with popup
                        $(document).mousemove(function(e){
                            $("#mousepopup").css({left:(e.pageX+20) + "px", top:(e.pageY+20) + "px"});
                            $('#mousepopup').html(addEventData[0]+'  '+addEventData[1]+' '+addEventData[4]);

                        });
                        $('#mousepopup').show();

                        calendar.setOption('slotDuration',globalTotalTime);//Time Grid Aralığının Belirlenmesi
                        calendar.setOption('weekends',weekends);
                        calendar.render();//İlk Render Edilmesi

                       $.ajax({
                            url:'/getUserWorkplace',
                            type:'get',
                            data:{
                                _token:'0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT'
                            },
                            dataType:'json',
                            success:function (data) {

                                workplaceName=data[0]["workplaceName"];
                                defaultDate=data[0]["defaultDate"];
                                minTime=data[0]["minTime"];
                                maxTime=data[0]["maxTime"];
                                weekends=data[0]["weekends"];
                                defaultView=data[0]["defaultView"];
                                calendar.setOption('defaultDate',defaultDate);
                                calendar.setOption('defaultView',defaultView);
                                calendar.setOption('minTime',minTime);
                                calendar.setOption('maxTime',maxTime);
                                calendar.setOption('weekends',weekends);
                                $('.pageTitle').html(workplaceName+' | Diary');
                                calendar.render();
                                   },
                            error:function () {
                                defaultDate= moment().day().today;
                                minTime="08:00:00";
                                maxTime="18:00:00";
                                weekends=false;
                                defaultView=false;
                            },
                            complete : function( qXHR, textStatus ) {
                                // attach error case

                                if (textStatus === 'success') {


                                }
                            }
                        });

                    });




                });
                     function calendarBuild(defaultView,defaultDate,minTime,maxTime,weekends,plateHtml,minuteHtml){
                 var gloabalEvents;
                 var calendarUser;
                 var calendarEl = document.getElementById('calendar');
                 var initialLocaleCode = 'en';
                 var localeSelectorEl = document.getElementById('locale-selector');

                 initThemeChooser({
                     init: function (themeSystem) {
                         calendarUser = new FullCalendar.Calendar(calendarEl, {
                             plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid'],
                             themeSystem: themeSystem,
                             header: {
                                 left: 'prev,next today custom',
                                 center: 'title',
                                 right: 'dayGridMonth,timeGridWeek,timeGridDay'
                             },
                             defaultView: defaultView,//Varsayılan Grid
                             height: 900,//Yüksekliğinin default olarak belirlenmesi silinmesi ve değiştirilmesi sonucunda calendarın tamamı görünmeyebilir
                             defaultDate: defaultDate,//Varsayılan Tarih
                             minTime: minTime,//Mesai saatinin başlama saaati DİNAMİK OLACAK
                             maxTime: maxTime,//Mesai saatinin bitiş saaati DİNAMİK OLACAK
                             weekends: weekends,//Hafta sonunun belirlenmesi Dinamik olacak
                             weekNumbers: true,//Hafta Numaraları Gösterilmesi
                             navLinks: true, // can click day/week names to navigate views
                             editable: false,//Eventler değiştirilemez
                             eventLimit: true, // allow "more" link when too many events
                             selectable: true,//Event seçilip eklenebilir
                             selectMirror: true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                             selectHelper: true,// Kullanıcı sürüklerken bir “yer tutucu” etkinliği çizilip çizilmeyeceği. Eğer True dersek biraz uzaktan sürüklenerek gider.
                             allDaySlot: false,//Tüm Gün Eklenmesi İptal Edilmesi
                             slotEventOverlap: false,// Günlerin Kesişmesini Engeller
                             resourceEventOverlap:false,
                             eventOverlap:false,
                             selectOverlap:false,//Seçilen alan kesişmesini engeller
                             resizable: false,//Boyutunun değiştirilmesini engelleme

                             loading: function(bool) {
                                 if (bool) {
                                     $('#loading').show();
                                 }else{
                                     $('#loading').hide();
                                 }
                             },
                             select: function (event) {
                                 var saveStartTime;//Seçilen time'ın başlangıcı
                                 var saveEndTime;//Seçilen time'ın başlangıcı
                                 saveStartTime = moment(event.start).format('HH:mm');
                                 saveEndTime = moment(event.end).format('HH:mm');
                                 var ms = moment(saveEndTime, "HH:mm").diff(moment(saveStartTime, "HH:mm"));
                                 var d = moment.duration(ms);
                                 var s = Math.floor(d.asHours()) + moment.utc(ms).format(":mm");
                                 var timeDiff = '0' + s;//Seçilen time aralığı

                                 var today=moment().day().today;
                                 var saveStartDate = moment(event.start);
                                 var todayFormat=moment(today);
                                 if(todayFormat>=saveStartDate)//Şuandan itibaren event eklenmesi sağlanıyor öncesi bu bildirim ile belirtiliyor
                                 {
                                     $(".notification-text").html("You can't make an appointment before now");
                                     $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                     $('#notificationAlert').show();

                                 }
                                 else {
                                                var globalStart;
                                     _.forEach(gloabalEvents,function (value) {


                                       if(moment(event.end)<=moment(value.start))
                                         {

                                             console.log('End:::'+event.end+'<'+value.start)
                                             globalStart=value.start;
                                         }


                                     });
                                     var globalStartDate;//Seçilen time'ın başlangıcı
                                     globalStartDate = moment(globalStart).format('HH:mm');
                                     console.log(globalStart)
                                     if(moment(globalStart)>moment(event.start))
                                     {
                                         var msGlobal = moment(globalStart).diff(moment(event.start));

                                     }
                                     /*else{
                                         var msGlobal = moment(event.start, "HH:mm").diff(moment(globalEndDate, "HH:mm"));

                                     }*/
                                    var dGlobal  = moment.duration(msGlobal );
                                     var minuteHtmlGlobal  = moment.duration(minuteHtml.html() );
                                     console.log(dGlobal)
                                     console.log(minuteHtmlGlobal)
                                     if(dGlobal>=minuteHtmlGlobal){
                                          bootbox.confirm({
                                          message: "Do you want to add an appointment",
                                          size: 'small',
                                          buttons: {
                                              confirm: {
                                                  label: 'Yes',
                                                  className: 'btn-success'
                                              },
                                              cancel: {
                                                  label: 'No',
                                                  className: 'btn-danger'
                                              }
                                          },
                                          callback: function (result) {
                                              if (result === true) {

                                                          $.ajaxSetup({
                                                              headers: {
                                                                  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                                                              }
                                                          });

                                                          $.ajax({
                                                              url: '/addUserEvent',
                                                              type: 'post',
                                                              data: {
                                                                  saveTitle: plateHtml.html(),
                                                                  saveStart: moment(event.start).format('YYYY-MM-DD HH:mm:ss'),
                                                                  maintenanceMinute: minuteHtml.html(),
                                                                  _token: '{!! csrf_token() !!}',
                                                                 saveEnd: moment(event.end).format('YYYY-MM-DD HH:mm:ss'),
                                                                 maintenance: globalMaintenance['maintenance']
                                                             },
                                                             dataType: 'json',
                                                             success: function (data) {
                                                                 calendarUser.addEvent(
                                                                     {
                                                                         id: data['id'],
                                                                         title: data['title'] + ' | ' + globalMaintenance['maintenance'],
                                                                         start: data['start'],
                                                                         end: data['newTime'],//Sonradan eklenen dakikanın event'e end olarak eklenmesi
                                                                         backgroundColor: 'green !important',
                                                                         borderColor: 'green !important',
                                                                         editable: true,//Eklenen eventin değiştirilebilir olması
                                                                         durationEditable: false,//Eklenen eventin boyutunun değiştirilemez olması
                                                                         className: 'context-menu-one',


                                                                     });
                                                                 $(".notification-text").html("Appointment added");
                                                                 $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                                 $('#notificationAlert').show();

                                                             }
                                                             ,
                                                             error: function () {
                                                                 $(".notification-text").html("Appointment not added because this plate is registered");
                                                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                                 $('#notificationAlert').show();
                                                             }
                                                         });

                                                         $(".notification-text").html("Election not Exceeded.");
                                                         $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                         $('#notificationAlert').show();
                                                     }


                                             else {
                                                 $(".notification-text").html("Appointment not added");
                                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                 $('#notificationAlert').show();
                                             }

                                         }

                                     });
                                    }
                                     else {

                                         $(".notification-text").html("Election Exceeded.");
                                         $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                         $('#notificationAlert').show();

                                     }

                                 }
                             },
                             eventDataTransform:function (eventInput) {
                                 eventInput.title='Reserved'
                             },
                             events: {
                                 url: '/getUserEvent?_token=0GTwvcp5NWn7zBVtu6lSH4R5GhTRLaCYDoJvnqNT',
                                 type: 'GET', // Send Get data
                                color: '#7A7A7A !important',
                                 textColor: 'white',

                                 success: function (rawData) {

                                    gloabalEvents=rawData;
                                 },
                                 error: function () {
                                     alert('There was an error while fetching events.');
                                 }
                             },
                             eventDrop: function (info) {

                                 edit(info);

                             },
                             eventRender: function (info) {

                                 $(info.el).attr("id", info.event.id).addClass('context-class');

                                     //$(info.el).find('.fc-title').html('Reserved');
                                     //$(info.el).find('.fc-title').parent().parent().attr('style', 'background-color:#7A7A7A !important;border-color:#7A7A7A !important;cursor:no-drop;')

                             },
                             dayRender: function( dayRenderInfo ) {
                                 var today=moment().day().today;//Bugünden önceki timeların rengini değiştirme
                                 var todayFormat=moment(today);
                                 if(todayFormat-86400000>moment(dayRenderInfo.date))
                                 {
                                     dayRenderInfo.el.style.backgroundColor='#C3C3C3';
                                 }
                                 else{


                                 }


                             }

                         });
                         calendarUser.render();
            // build the locale selector's options
                         var i=0;
                         calendarUser.getAvailableLocaleCodes().forEach(function (localeCode) {
                             if(i==0) {
                                 $('#locale-selector').attr('style', 'display:inherit');
                             i++;
                             }var optionEl = document.createElement('option');
                             optionEl.value = localeCode;
                             optionEl.selected = localeCode == initialLocaleCode;
                             optionEl.innerText = localeCode;
                             localeSelectorEl.appendChild(optionEl);
                         });
            // when the selected option changes, dynamically change the calendar option
                         localeSelectorEl.addEventListener('change', function () {
                             if (this.value) {
                                 calendarUser.setOption('locale', this.value);
                             }
                         });
                     },
                     change: function (themeSystem) {
                         calendarUser.setOption('themeSystem', themeSystem);
                     }
                 });
                 function edit(info){ // Drop ve Resize Olayları için tarih güncelleme


                     var today=moment().day().today;
                     var saveStartDate = moment(info.event.start);
                     var todayFormat=moment(today);
                     if(todayFormat>saveStartDate)
                     {
                         $(".notification-text").html("You can't make an appointment before now");
                         $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                         $('#notificationAlert').show();
                         info.revert();
                     }
                     else
                     {


                             var  start = moment(info.event.start).format('YYYY-MM-DD HH:mm:ss');//Drop için
                             var endMoment = moment(info.event.end).format('HH:mm:ss');//Drop Kontrolü için
                             var startMoment =moment(info.event.start).format('HH:mm:ss');//Drop Kontrolü için

                             if(moment(startMoment,"HH:mm")<moment(minTime,"HH:mm"))//Drop edildiğinde start iş başlama tarihinden önce olmaması için
                             {
                                 $(".notification-text").html("No appointment is made before the shift begins");
                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                 $('#notificationAlert').show();
                                 info.revert();
                             }
                             else if(moment(endMoment,"HH:mm")>moment(maxTime,"HH:mm"))//Drop edildiğinde end'in iş bitiş saatinden sonra olmaması için
                             {
                                 $(".notification-text").html("Appointment ends when overtime ends");
                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                 $('#notificationAlert').show();
                                 info.revert();
                             }
                             else {


                             if (info.event.end) {
                                 var end = moment(info.event.end).format('YYYY-MM-DD HH:mm:ss');
                             } else {
                                 var end = start;
                             }

                             var id = info.event.id;

                             Event = [];
                             Event[0] = id;
                             Event[1] = start;
                             Event[2] = end;

                             $.ajax({
                                 url: '/dropUserEvent',
                                 type: "POST",
                                 data: {
                                     Event: Event,
                                     _token: '{!! csrf_token() !!}',
                                 },
                                 dataType: 'json',
                                 success: function (data) {
                                     $(".notification-text").html("Appointment changed");
                                     $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                     $('#notificationAlert').show();
                                 }
                             });
                         }
                     }
                 }

                 $.contextMenu({
                     selector: '.context-menu-one',
                     delegate: ".hasmenu",
                     preventContextMenuForPopup: true,
                     preventSelect: true,
                     callback: function(key, options) {
                         var locale = $('#locale-selector').val();

                         var eventId=$(this).attr('id');
                         var event = calendarUser.getEventById(eventId);
                         switch (key) {
                             case 'edit':

                                 var title = event.title.split("| ");
                                 $('#UserModalEdit #editId').val(event.id);
                                 $('#UserModalEdit #editTitle').val(title[0]);
                                 $('#UserModalEdit #editStart').val(moment(event.start).format('YYYY-MM-DD HH:mm:ss'));
                                 $('#UserModalEdit #editEnd').val(moment(event.end).format('YYYY-MM-DD HH:mm:ss'));
            //Edit Formunda Bakım Türlerinin Seçilmesi
                                 var maintenance=title[1].split(",");
                                 var i=0;
                                 $.each($(".maintenanceEditRow .checkboxMaintenanceInput"),function () {

                                     var maintenanceInput=$(this).val().substr(8);
                                     if(maintenance[i]!=null) {
                                         var globalMaintenanceInput = maintenance[i].substr(11);
                                         console.log(globalMaintenanceInput)
                                     }
                                     if(maintenanceInput===globalMaintenanceInput)
                                     {
                                         $(this).prop("checked", true);

                                     }
                                     i++;
                                 });
                                 $.ajax({
                                     url:'/getUserEventsJoinMaintenance',
                                     type:'get',
                                     data:{
                                         id: event.id
                                     },
                                     success:function (data) {


                                     }
                                 });
                                 $('#UserModalEdit').modal('show');
                                 $('#editEventSubmit').prop( "disabled", false );
                                 break;
                             case 'delete':

                                 bootbox.confirm({
                                         message: "Is appointment delete?",
                                         size: 'small',
                                         locale:  locale,
                                         buttons: {
                                             confirm: {
                                                 label: 'Yes',
                                                 className: 'btn-success'
                                             },
                                             cancel: {
                                                 label: 'No',
                                                 className: 'btn-danger'
                                             }
                                         },
                                         callback: function (result) {
                                             if(result===true)
                                             {

                                                 $.ajaxSetup({
                                                     headers: {
                                                         'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                                                     }
                                                 });

                                                 $.ajax({
                                                     type: 'GET',
                                                     url: '/destroyUserEvent/'+eventId,
                                                     dataType:'json',
                                                     success:function(data){
                                                         $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                                                         $(".notification-text").html("Event deleted");
                                                         $('#notificationAlert').show();
                                                         event.remove();


                                                     }
                                                 });

                                             }
                                             else{
                                                 $(".notification-text").html("Event not deleted");
                                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                                                 $('#notificationAlert').show();
                                             }
                                         }
                                     }

                                 );


                                 break;

                         }
                     },
                     items: {
                         "edit": {name: "Edit", icon: "edit"},
                         "delete": {name: "Delete", icon: "delete"},
                     }
                 });


                 $('.context-menu-one').on('click', function(e){
                     console.log('clicked', this);
                 });





                 var editEventForm = $('#editUserEventForm');
                 editEventForm.submit(function(e){

            //  $('#editEventSubmit').prop( "disabled", true );
                     e.preventDefault();
                     $.ajaxSetup({
                         headers: {
                             'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')

                         }
                     });



                     $.ajax({
                         type: 'POST',
                         url: '/editUserEvent',
                         dataType:"json",
                         data: editEventForm.serialize() ,
                         success:function (data) {

                             if(data.errorEdit)
                             {

                                 $(".notification-text").html("Event not edited ");
                                 $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');

                             }

                             else {

                                 var event = calendarUser.getEventById(data.id);
                                 event.remove();

                                 $('#UserModalEdit').modal('hide');
                                   var maintenanceTitleString="";
                                   var maintenanceTitleJson=data.maintenanceTitle;//Bakım türü İstemciden alınıp stringe atılıyor
                                    _.forEach(maintenanceTitleJson, function(value) {
                                        if(maintenanceTitleJson.length>1){
                                            maintenanceTitleString=maintenanceTitleString+value['maintenanceTitle']+',';
                                        }
                                        else{
                                            maintenanceTitleString=maintenanceTitleString+value['maintenanceTitle'];

                                        }

                                    });
                                 calendarUser.addEvent(
                                     {
                                         id: data.id,
                                         title: data.title + ' | ' +maintenanceTitleString,
                                         start: data.start,
                                         end: data.newTime,
                                         backgroundColor: 'green !important',
                                         borderColor: 'green !important',
                                         editable: true,//Eklenen eventin değiştirilebilir olması
                                         durationEditable: false,//Eklenen eventin boyutunun değiştirilemez olması
                                         className: 'context-menu-one',
                                     });
                                 $(".notification-text").html("Event edited");
                                 $('#notificationAlert').addClass('alert-success').removeClass('alert-danger');
                             }


                             $('#notificationAlert').show();
                         },

                         error:function () {
                             $(".notification-text").html("Event not edited");
                             $('#notificationAlert').addClass('alert-danger').removeClass('alert-success');
                             $('#notificationAlert').show();
                         }
                     });

                 });

             }

                    //Maintenance (Bakım) Türünün Toplanması [Start]
                    function maintenanceTimeSum(maintenanceArray) {


                        var totalHour='00';
                        var totalMinute='00';
                        var totalTime;
                        totalHour=parseInt(totalHour);
                        totalMinute=parseInt(totalMinute);
                        console.log($(userFirstForm))
                        $.each($(userFirstForm).find("input[name='maintenance[]']:checked"), function(){
                            maintenanceArray.push($(this).val()); // Seçili Bakım Türünün Array'e Eklenmesi
                            var item=$(this).val();
                            var maintenanceHour = item.substr(1, 2);
                            var maintenanceMinute = item.substr(4, 2);

                            maintenanceMinute=parseInt(maintenanceMinute);
                            maintenanceHour=parseInt(maintenanceHour);
                            totalHour=totalHour+maintenanceHour;
                            totalMinute=totalMinute+maintenanceMinute;
                            if(totalMinute>=60)
                            {
                                totalHour++;
                                totalMinute=0;
                            }
                        });


                        if(totalMinute==0)
                        {
                            totalTime='0'+totalHour+':'+'0'+totalMinute;
                        }
                        else
                        {
                            totalTime='0'+totalHour+':'+totalMinute;
                        }

                        return moment(totalTime,"HH:mm:ss").format('HH:mm:ss');
                    }
                    //Maintenance (Bakım) Türünün Toplanması [End]
            </script>




@endsection
