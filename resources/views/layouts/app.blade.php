<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm" style="position: fixed; width: 100%; z-index: 1000;">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <!-- Your left side of the navbar here -->
                        <!-- Note: We are not using this section for the sidebar anymore -->
                    </ul>

                    <!-- Right Side Of Navbar -->
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

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row ">
                <!-- Sidebar -->
                <div class="bg-dark col-md-3 sidebar mt-4" style="position: fixed; height: 100%; overflow-y: auto; padding-top: 80px; padding-left: 15px;">
                    <ul class="nav flex-column gap-1">
                        <li class="nav-item">
                            <li class="nav-item">
                                <a class="nav-link text-light rounded {{ Route::currentRouteName() === 'home' ? 'bg-primary' : '' }}" href="{{ route('home') }}">
                                    <i class="fas fa-home me-2"></i>
                                    Dashboard
                                </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light rounded {{ Route::currentRouteName() === 'transaction.index' ? 'bg-primary' : '' }}" href="{{ route('transaction.index', ['sort' => '-created_at']) }}"><i class="fas fa-list me-2"></i>Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light rounded {{ Route::currentRouteName() === 'transaction.create' ? 'bg-primary' : '' }}" href="{{ route('transaction.create') }}"><i class="fas fa-plus me-2"></i>Tambah Transaksi Baru</a>
                        </li>
                        <li class="nav-item bg-dark rounded" id="stok-menu">
                            <a class="nav-link text-light d-flex justify-content-between rounded {{ Route::currentRouteName() === 'stock.index' ? 'bg-primary' : '' }}" href="#" onclick="toggleSubMenu('stok-submenu')">
                                <div><i class="fas fa-cubes-stacked me-2"></i>Stok</div>
                                <div><i class="fas fa-chevron-down me-2"></i></div>
                            </a>
                            <ul class="nav flex-column gap-1 pl-3" id="stok-submenu" style="display: none;">
                                <li class="nav-item">
                                    <a class="nav-link text-light rounded {{ request()->input('filter.type') === '>' ? 'bg-secondary' : '' }}"
                                        href="{{ route('stock.index', ['filter[type]' => '>', 'sort' => '-created_at']) }}">
                                        Stok Masuk
                                     </a>

                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-light rounded {{ request()->input('filter.type') === '<' ? 'bg-secondary' : '' }}"
                                        href="{{ route('stock.index', ['filter[type]' => '<', 'sort' => '-created_at']) }}">
                                        Stok Keluar
                                     </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light rounded {{ Route::currentRouteName() === 'item.index' ? 'bg-primary' : '' }}" href="{{ route('item.index') }}"><i class="fas fa-boxes-stacked me-2"></i>Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-light rounded {{ Route::currentRouteName() === 'report.index' ? 'bg-primary' : '' }}" href="{{ route('report.index') }}"><i class="fas fa-file me-2"></i>Laporan</a>
                        </li>
                    </ul>
                </div>


                <script>
                    function toggleSubMenu(submenuId) {
                        const submenu = document.getElementById(submenuId);
                        submenu.style.display = submenu.style.display === 'none' ? 'block' : 'none';
                    }
                </script>


                <!-- Main Content -->
                <div class="col-md-9 offset-md-3" style="padding-top: 80px; padding-left: 15px;">
                    <main class="py-4">
                        @yield('content')
                    </main>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
