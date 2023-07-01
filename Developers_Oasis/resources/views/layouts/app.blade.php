<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Developers Oasis</title>
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js','resources/css/app.css'])
</head>

<body>
    <div id="app">
        <div class="header m-5">
            <nav class="navbar navbar-expand-md w-100 mynav">
                <div class="container-fluid d-flex align-items-baseline ">
                    @unless(request()->is('login', 'register', 'password/*'))
                    <router-link to="/">
                        <img class="logo" style="width:100px;height: 100px" src="{{ asset('images/logo_site.png') }}" class="img-fluid navbar-brand">
                    </router-link>
                    @endunless
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">

                        @auth()
                        <!-- Left Side Of Navbar -->
                        <menubar-component class="mx-auto"></menubar-component>
                        @endauth
                        <!-- Right Side Of Navbar -->
                        @unless(request()->is('login', 'register', 'password/*'))
                        <ul class="navbar-nav ms-auto">
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
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                                <image src="D:\Final_Project\Developers_Oasis\public\images\users\default.jpg" />
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                 </a>
                                 <router-link to="/user/profile/auth::user()->id" class="dropdown-item">
                                   {{__('Profile')}}  </router-link>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                    </div>
                    </li>
                    @endguest
                    </ul>
                    @endunless
                </div>
        </div>
        </nav>
    </div>
    <main class="mt-5">
        @yield('content')
    </main>
    </div>
</body>

</html>
