<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('CRM') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand nav-header" href="{{ url('home') }}">
                    {{ __('CRM') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                        @if(auth()->user()->role != 0)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/users/overview') }}">
                                    Users
                                </a>
                            </li>
                        @endif
                        @if(auth()->user()->role == 2)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ url('/companies/overview') }}">
                                    Companies
                                </a>
                            </li>
                        @endif
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div id="menu-item-user-edit">
                                        <a class="dropdown-item"
                                            onclick="event.preventDefault();
                                                            document.getElementById('profile-edit-form').submit();">
                                            {{ __('Edit Profile') }}
                                        </a>

                                        <form id="profile-edit-form" action="{{ url('/user/edit/' . auth()->user()->id) }}" method="GET" class="d-none"></form>
                                    </div>
                                    
                                    @if (auth()->user()->two_factor_secret)
                                        <div id="menu-item-two-factor-auth">
                                            <a class="dropdown-item"
                                                onclick="event.preventDefault();
                                                                document.getElementById('two-factor-auth-form').submit();">
                                                {{ __('Two Factor') }}
                                            </a>

                                            <form id="two-factor-auth-form" action="{{ url('/user/two-factor-auth') }}" method="GET" class="d-none"></form>
                                        </div>
                                    @endif
                                    
                                    <div id="menu-item-logout">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>
</html>