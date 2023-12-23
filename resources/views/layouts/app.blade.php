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
    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <!-- DataTables CSS and JS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js">
    </script>


    <!-- Bootstrap CSS and JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Scripts -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Diphylleia&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
</head>

<body>
    <div id="app" style="padding-top: 6rem;">
        <nav class="navbar navbar-expand-md navbar-light shadow-sm fixed-top" style="background-color: #87b874">
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
                                        <a class="nav-link" href="{{ route('admin.menus') }}">{{ __('Data Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.suppliers') }}">{{ __('Data Supplier') }}</a>
                                        <a class="nav-link" href="{{ route('admin.events') }}">{{ __('Data Event') }}</a>
                                        <a class="nav-link" href="{{ route('admin.foods') }}">{{ __('Data Makanan') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.beverages') }}">{{ __('Data Minuman') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.alcohols') }}">{{ __('Data Alkohol') }}</a>
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
                                        <a class="nav-link" href="{{ route('owner.users') }}">{{ __('Data User') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.employees') }}">{{ __('Data Karyawan') }}</a>
                                        <a class="nav-link" href="{{ route('owner.menus') }}">{{ __('Data Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.suppliers') }}">{{ __('Data Supplier') }}</a>
                                        <a class="nav-link" href="{{ route('owner.events') }}">{{ __('Data Event') }}</a>
                                        <a class="nav-link" href="{{ route('owner.foods') }}">{{ __('Data Makanan') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.beverages') }}">{{ __('Data Minuman') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.alcohols') }}">{{ __('Data Alkohol') }}</a>
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
                                        <a class="nav-link"
                                            href="{{ route('admin.menu.create') }}">{{ __('Tambah Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.supplier.create') }}">{{ __('Tambah Supplier') }}</a>
                                        {{-- <a class="nav-link"
                                            href="{{ route('admin.event.create') }}">{{ __('Tambah Event') }}</a> --}}

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
                                            href="{{ route('owner.user.create') }}">{{ __('Tambah User') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.employee.create') }}">{{ __('Tambah Karyawan') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.menu.create') }}">{{ __('Tambah Menu') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.supplier.create') }}">{{ __('Tambah Supplier') }}</a>
                                        {{-- <a class="nav-link"
                                            href="{{ route('owner.event.create') }}">{{ __('Tambah Event') }}</a> --}}
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
                                            href="{{ route('admin.purchases') }}">{{ __('List Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.expense.create') }}">{{ __('Tambah Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('admin.purchase.create') }}">{{ __('Tambah Alkohol') }}</a>
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
                                            href="{{ route('owner.purchases') }}">{{ __('List Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.expense.create') }}">{{ __('Tambah Pengeluaran') }}</a>
                                        <a class="nav-link"
                                            href="{{ route('owner.purchase.create') }}">{{ __('Tambah Alkohol') }}</a>
                                    </div>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link {{ request()->routeIs('analytics') ? 'active' : '' }}"
                                        href="{{ route('owner.analytics') }} ">{{ __('Analytics') }}</a>
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

    <script>
        // Use jQuery instead of $ to avoid conflicts
        jQuery(document).ready(function() {
            jQuery('#myTable').DataTable({
                responsive: true
            });
        });
    </script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <body>

</html>
