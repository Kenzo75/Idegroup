<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    @yield('style')
    <link rel="stylesheet" href="{{ asset('css/bar.css')}}">
    <link rel="shortcut icon" href="{{ asset('img/logo,jempol,group.png') }}" type="image/x-icon">


    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
        <div class="garis">
            <div class="side">
                <div class="side-bar">
                    <div class="side-container">
                        <div class="logo">
                            <img src="{{ asset('img/jempol.group') }}" alt="" width="70%" class="logo-jempol">
                        </div>
                        <hr width="100%" class="hitam">
                        <div class="route">
                            <a href="@if (auth()->user()->role === 'admin') {{ route('admin.dashboard') }} @else {{ route('user.dashboard') }} @endif" class="@if(Request::is('user-dashboard', 'admin-dashboard') || Request::is('admin-dashboard') || Request::is('user-dashboard')) btn-side-bar-on @else btn-side-bar @endif"><div class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-layout-wtf" viewBox="0 0 16 16" id="IconChangeColor"> <path d="M5 1v8H1V1h4zM1 0a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h4a1 1 0 0 0 1-1V1a1 1 0 0 0-1-1H1zm13 2v5H9V2h5zM9 1a1 1 0 0 0-1 1v5a1 1 0 0 0 1 1h5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H9zM5 13v2H3v-2h2zm-2-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1H3zm12-1v2H9v-2h6zm-6-1a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1v-2a1 1 0 0 0-1-1H9z" id="mainIconPathAttribute"></path> </svg></div>Dashboard</a>
                            <a href="@if (auth()->user()->role === 'admin') {{ route('admin.tasklist') }} @else {{ route('user.tasklist') }} @endif" class="@if(Request::is('user-tasklist', 'admin-tasklist') || Request::is('admin-tasklist') || Request::is('user-tasklist')) btn-side-bar-on @else btn-side-bar @endif"><div class="icon"><i class="fa-solid fa-clipboard-list"></i></div>Daftar Tugas</a>
                            <a href="@if (auth()->user()->role === 'admin') {{ route('admin.leaderboard') }} @else {{ route('user.leaderboard') }} @endif" class="@if(Request::is('user-leaderboard', 'admin-leaderboard') || Request::is('admin-leaderboard') || Request::is('user-leaderboard')) btn-side-bar-on @else btn-side-bar @endif"><div class="icon"><i class="fa-solid fa-chart-line"></i></div>Leaderboard</a>
                            <a href="{{ route('jadwal') }}" class="@if(Request::is('jadwal')) btn-side-bar-on @else btn-side-bar @endif"><div class="icon"><i class="fa-regular fa-calendar-days"></i></div>Jadwal Piket</a>
                            @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.history') }}" class="@if(Request::is('admin-history')) btn-side-bar-on @else btn-side-bar @endif"><div class="icon"><i class="fa-regular fa-folder" style="color: #000000;"></i></div>History Tugas</a>
                            @else
                            @endif
                        </div>
                        <div class="profil-bar">
                            <div class="foto-1">
                            <a href="{{ route('profil') }}" class="btn-profil"><img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="" width="100px" height="100px" class="foto-bar" id="profil-picture">
                            </div>
                            <div class="user-name">
                            <h3>{{ Auth::user()->name }}</h3>
                            </div>
                            <div class="role">
                            <p class="namauser">
                                @if (auth()->user()->role === 'admin')
                                    (Yang Mulia Mentor)
                                @else
                                    (Anak Magang)
                                @endif
                            </p>
                            <p>{{ Auth::user()->email }}</p>
                            </div>
                        </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dashboard">
                <div class="navi">
                    <div class="navi-content">
                        <div class="container-navi">
                            <div class="left">
                                <button class="btn-toggle-sidebar"><i class="fas fa-bars"></i></button>
                                <div class="date"><i class="fa-regular fa-calendar"></i>{{ now()->format('l, j F Y') }}</div>
                            </div>
                            <div class="dropdown">@guest
                                @if (Route::has('login'))
                                    <a class="" href="{{ route('login') }}">{{ __('Login') }}</a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="" href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif

                            @else
                            <a class="logout" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                            Log out<i class="fa-solid fa-arrow-right-from-bracket"></i>
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endguest
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')

            </div>
        </div>

    <script src="https://kit.fontawesome.com/14a5aff050.js" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const toggleBtn = document.querySelector('.btn-toggle-sidebar');
            const sidebar = document.querySelector('.side');

            toggleBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
            });
        });
    </script>
</body>
</html>
