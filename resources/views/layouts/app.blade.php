<!DOCTYPE html class="h-100">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

</head>
<body class="h-100">
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>

    <div id="app" class="h-100">
        <b-navbar toggleable="sm" type="dark" variant="primary">
            <b-navbar-toggle target="nav-text-collapse"></b-navbar-toggle>

            <b-navbar-brand href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </b-navbar-brand>

            <b-collapse id="nav-text-collapse" is-nav>
                <b-navbar-nav class="ml-auto">
                    @guest
                        <b-nav-item href="{{ route('login') }}">{{ __('Login') }}</b-nav-item>
                        <b-nav-item href="{{ route('register') }}">{{ __('Register') }}</b-nav-item>
                    @else
                        <!-- Navbar dropdowns -->
                        <b-nav-item-dropdown text="{{ Auth::user()->name }}" right>
                            <b-dropdown-item href="#" @click="logout">
                                {{ __('Logout') }}
                            </b-dropdown-item>
                        </b-nav-item-dropdown>
                    @endguest
                </b-navbar-nav>
            </b-collapse>
        </b-navbar>
        <main class="py-0">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
