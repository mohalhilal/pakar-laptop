<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Sistem Pakar Laptop') }}</title>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/datatables.min.css') }}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/datatables.min.js') }}"></script>

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>

    <!-- Navbar untuk layar mobile -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Panel</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMobileMenu" aria-controls="navbarMobileMenu" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarMobileMenu">
                <!-- Info Nama Akun di Navbar (Mobile) -->
                <span class="navbar-text text-warning ms-auto me-3">
                    Hallo, {{ Auth::user()->name }} 👋
                </span>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/admin">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('gejala.index') }}">Kelola Gejala</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kerusakan.index') }}">Kelola Kerusakan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('solusi.index') }}">Kelola Solusi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('aturan') }}">Kelola Aturan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('users.index') }}">Kelola Pengguna</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-warning" href="{{ url('logout') }}">Keluar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Container Utama untuk desktop dan tablet -->
    <div class="admin-container">
        <!-- Sidebar untuk layar besar -->

        <nav class="sidebar d-none d-lg-block">

            <!-- Info Nama Akun di Sidebar (Desktop/Tablet) -->
            <ul class="nav flex-column nav-pills">
                <li class="nav-item"><a class="btn btn-success ms-2" href="#" readonly>Hallo, {{ Auth::user()->name }} 👋</a></li>
                <br>
                <li class="nav-item"><a class="btn btn-warning ms-2" href="#" readonly>Admin Panel</a></li>
                <li class="nav-item">
                    @if(!empty($act_beranda))
                    <a class="nav-link text-white active" href="/admin">Beranda</a>
                    @else
                    <a class="nav-link text-white" href="/admin">Beranda</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(!empty($act_gejala))
                    <a class="nav-link text-white active" href="{{ route('gejala.index') }}">Kelola Gejala</a>
                    @else
                    <a class="nav-link text-white" href="{{ route('gejala.index') }}">Kelola Gejala</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(!empty($act_kerusakan))
                    <a class="nav-link text-white active" href="{{ route('kerusakan.index') }}">Kelola Kerusakan</a>
                    @else
                    <a class="nav-link text-white" href="{{ route('kerusakan.index') }}">Kelola Kerusakan</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(!empty($act_solusi))
                    <a class="nav-link text-white active" href="{{ route('solusi.index') }}">Kelola Solusi</a>
                    @else
                    <a class="nav-link text-white" href="{{ route('solusi.index') }}">Kelola Solusi</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(!empty($act_konsultasi))
                    <a class="nav-link text-white active" href="{{ route('kelola-konsultasi.index') }}">Kelola Konsultasi</a>
                    @else
                    <a class="nav-link text-white" href="{{ route('kelola-konsultasi.index') }}">Kelola Konsultasi</a>
                    @endif
                <li class="nav-item">
                    @if(!empty($act_aturan))
                    <a class="nav-link text-white active" href="{{ route('aturan') }}">Kelola Aturan </a>
                    @else
                    <a class="nav-link text-white" href="{{ route('aturan') }}">Kelola Aturan</a>
                    @endif
                </li>
                <li class="nav-item">
                    @if(!empty($act_users))
                    <a class="nav-link text-white active" href="{{ route('users.index') }}">Kelola Pengguna</a>
                    @else
                    <a class="nav-link text-white" href="{{ route('users.index') }}">Kelola Pengguna</a>
                    @endif
                </li>
                <li class="nav-item mt-3">
                    <a class="nav-link text-warning" href="{{ url('logout') }}" onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                        {{ __('Keluar') }}

                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>

        <div class="container my-5">
            @yield('content')
        </div>