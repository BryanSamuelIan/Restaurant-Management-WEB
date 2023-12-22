<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $pagetitle }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Diphylleia&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <div id="app" style="padding-top: 6rem;">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm fixed-top">
            <div class="container">
                <a class="navbar-brand"style="font-family: 'Diphylleia', sans-serif" href="{{ url('/') }}">
                    {{ __('Onoe\'Iki') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @Auth





                            @if (Auth::user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Master') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('menus') }}">{{ __('Data Menu') }}</a>
                                        <a class="nav-link" href="{{ route('suppliers') }}">{{ __('Data Supplier') }}</a>
                                        <a class="nav-link" href="{{ route('events') }}">{{ __('Data Event') }}</a>
                                        <a class="nav-link" href="{{ route('foods') }}">{{ __('Data Makanan') }}</a>
                                        <a class="nav-link" href="{{ route('beverages') }}">{{ __('Data Minuman') }}</a>
                                        <a class="nav-link" href="{{ route('alcohols') }}">{{ __('Data Alkohol') }}</a>
                                    </div>
                                </li>
                            @endif

                            @if (Auth::user()->isOwner())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Master') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('users') }}">{{ __('Data User') }}</a>
                                        <a class="nav-link" href="{{ route('employees') }}">{{ __('Data Karyawan') }}</a>
                                        <a class="nav-link" href="{{ route('menus') }}">{{ __('Data Menu') }}</a>
                                        <a class="nav-link" href="{{ route('suppliers') }}">{{ __('Data Supplier') }}</a>
                                        <a class="nav-link" href="{{ route('events') }}">{{ __('Data Event') }}</a>
                                        <a class="nav-link" href="{{ route('foods') }}">{{ __('Data Makanan') }}</a>
                                        <a class="nav-link" href="{{ route('beverages') }}">{{ __('Data Minuman') }}</a>
                                        <a class="nav-link" href="{{ route('alcohols') }}">{{ __('Data Alkohol') }}</a>
                                    </div>
                                </li>
                            @endif




                        @endauth



                        @auth
                            @if (Auth::user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Action') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link" href="{{ route('menu.create') }}">{{ __('Tambah Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('supplier.create') }}">{{ __('Tambah Supplier') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('event.create') }}">{{ __('Tambah Event') }}</a>

                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->isOwner())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ __('Action') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                                        <a class="nav-link"
                                            href="{{ route('user.create') }}">{{ __('Tambah User') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('employee.create') }}">{{ __('Tambah Karyawan') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('menu.create') }}">{{ __('Tambah Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('supplier.create') }}">{{ __('Tambah Supplier') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('event.create') }}">{{ __('Tambah Event') }}</a>
                                    </div>
                                </li>
                            @endif
                        @endauth


                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('transaction.create') ? 'active' : '' }}"
                                    href="{{ route('transaction.create') }}">{{ __('Buat Order') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('transactions') ? 'active' : '' }}"
                                    href="{{ route('transactions') }}">{{ __('Lihat Transaksi') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('transaction') ? 'active' : '' }}"
                                    href="{{ route('transaction') }}">{{ __('Transaksi Hari Ini') }}</a>
                            </li>

                            @if (Auth::user()->isAdmin())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Pengeluaran') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link"
                                            href="{{ route('purchases') }}">{{ __('List Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('expense.create') }}">{{ __('Tambah Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('purchase.create') }}">{{ __('Tambah Alkohol') }}</a>
                                    </div>
                                </li>
                            @endif
                            @if (Auth::user()->isOwner())
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown"
                                        role="button" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        {{ __('Pengeluaran') }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="nav-link"
                                            href="{{ route('purchases') }}">{{ __('List Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('expense.create') }}">{{ __('Tambah Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('purchase.create') }}">{{ __('Tambah Alkohol') }}</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('analytics') ? 'active' : '' }}"
                                        href="{{ route('analytics') }} ">{{ __('Analytics') }}</a>
                                </li>
                            @endif

                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>


                                {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                               @endif --}}
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>

                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-12">
            @yield('content')
        </main>
    </div>

</html>
