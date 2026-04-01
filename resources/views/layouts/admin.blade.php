<!DOCTYPE html>
<html>
<head>
    <title>Admin - PKLHub</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('admin.dashboard') }}">
            PKLHub Admin
        </a>

        <div class="ms-auto">

            @guest
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-sm me-2">
                    Login
                </a>
                <a href="{{ route('register') }}" class="btn btn-light btn-sm">
                    Register
                </a>
            @endguest

            @auth
                @if(auth()->user()->role == 'admin')

                @if(request()->is('admin'))
                    <a href="{{ route('public.companies.index') }}" 
                    class="btn btn-success btn-sm me-2">
                        Beranda
                    </a>
                @else
                    <a href="{{ url('/admin') }}" 
                    class="btn btn-warning btn-sm me-2">
                        Dashboard
                    </a>
                @endif

            @endif

                <div class="dropdown d-inline">
                    <button class="btn btn-light btn-sm dropdown-toggle"
                            type="button"
                            data-bs-toggle="dropdown">
                        {{ auth()->user()->name }}
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">
                                    Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
