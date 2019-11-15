<nav class="navbar navbar-expand-md navbar-light bg-white shadow-lg ">
    <div class="container">
        <a class="navbar-brand" href="{{ url('dHome') }}">
            <img width="100db" src="/components/img/diaryLogo.png" alt="logo">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">

            </ul>

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest

                    @if (!isset(Auth::user()->email))
                        @yield('register-link')
                        @yield('login-link')
                    @endif
                @else
                    <li id="dropdown" class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <div id="logout-div"  class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('homeLogout') }}">Logout</a>


                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
@section('script')
    <script>
        $('#dropdown').click(function () {
            $('#logout-div').show('slow');
        });

    </script>
    @endsection

