<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'PKLHub')</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="@yield('body-class') bg-gray-50 flex flex-col min-h-screen page-transition">


    <!-- NAVBAR -->
    <nav id="navbar"
        class="fixed top-0 left-0 w-full z-50 text-white transition-all duration-300
    @if (request()->routeIs('welcome')) backdrop-blur-md bg-black/30 @endif
">

        <div class="max-w-7xl mx-auto px-8 py-4 grid grid-cols-[1fr_auto_1fr] items-center">

            <!-- LOGO -->
            <div class="flex items-center animate-fadeUp">
                <a href="{{ route('welcome') }}" class="flex items-center gap-2 font-bold text-xl">
                    <img src="{{ asset('images/logo.png') }}" class="w-6 h-6">
                    <span>
                        <span class="text-blue-500">PKL</span><span class="text-orange-500">Hub</span>
                    </span>
                </a>
            </div>


            <!-- MENU -->
            @if (!request()->routeIs('login') && !request()->routeIs('register'))
                <div class="hidden md:flex justify-center items-center gap-8 text-sm font-medium animate-fadeUp">

                    <a href="{{ route('public.companies.index') }}" class="hover:text-gray-300 transition">
                        Perusahaan
                    </a>

                    <a href="{{ route('public.panduan') }}" class="hover:text-gray-300 transition">
                        Panduan PKL
                    </a>

                    <a href="{{ route('public.tentang') }}" class="hover:text-gray-300 transition">
                        Tentang
                    </a>

                </div>
            @endif


            <!-- RIGHT MENU -->
            <div class="flex items-center justify-end gap-4 min-w-0 animate-fadeUp">
                @guest
                    @if (!request()->routeIs('login') && !request()->routeIs('register'))
                        <a href="{{ route('login') }}" class="hover:text-gray-300 transition">
                            Login
                        </a>

                        <a href="{{ route('register') }}"
                            class="bg-orange-500 hover:bg-orange-600 px-4 py-2 rounded-lg font-semibold transition">
                            Register
                        </a>
                    @endif
                @endguest


                @auth

                    @if (request()->routeIs('public.companies.index'))
                        @if (auth()->user()->role == 'admin')
                            <a href="/admin" class="bg-yellow-500 text-black px-4 py-2 rounded-lg animate-fadeUp">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('user.companies.index') }}"
                                class="bg-blue-500 px-4 py-2 rounded-lg font-semibold shadow-lg animate-fadeUp">
                                Perusahaan Saya
                            </a>
                        @endif
                    @endif


                    <!-- USER DROPDOWN -->
                    <div class="relative group animate-fadeUp">

                        <button
                            class="bg-orange-500 hover:bg-orange-600 text-white px-4 py-2 rounded-lg flex items-center gap-2 max-w-[180px] truncate">

                            {{ auth()->user()->name }}

                        </button>

                        <div
                            class="absolute right-0 mt-2 hidden group-hover:block bg-white text-black rounded-lg shadow-lg w-40">

                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">
                                Profile
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">
                                    Logout
                                </button>

                            </form>

                        </div>

                    </div>

                @endauth

            </div>

        </div>

    </nav>


    <!-- CONTENT -->
    <main class="flex-grow">
        @yield('content')
    </main>


    <!-- FOOTER -->
    <footer class="bg-slate-950 text-gray-300">

        <div class="max-w-7xl mx-auto px-3 py-5 grid md:grid-cols-5 gap-8 animate-fadeUp">

            <!-- BRAND -->
            <div class="md:col-span-2">

                <div class="flex items-center gap-2 mb-3">

                    <img src="{{ asset('images/logo.png') }}" class="w-6 h-6">

                    <span class="text-lg font-semibold text-white">
                        <span class="text-blue-500">PKL</span><span class="text-orange-500">Hub</span>
                    </span>

                </div>

                <p class="text-sm leading-relaxed text-gray-400">
                    PKLHub adalah platform direktori tempat PKL untuk siswa SMK di Surabaya.
                    Temukan perusahaan terbaik, lihat review dari siswa lain,
                    dan pilih tempat magang yang tepat untuk masa depanmu.
                </p>

            </div>


            <!-- NAVIGASI -->
            <div>

                <h4 class="text-white font-semibold mb-3">
                    Navigasi
                </h4>

                <ul class="space-y-1 text-sm">

                    <li>
                        <a href="{{ route('welcome') }}" class="hover:text-white transition">
                            Home
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('public.companies.index') }}" class="hover:text-white transition">
                            Perusahaan
                        </a>
                    </li>

                </ul>

            </div>


            <!-- UNTUK PERUSAHAAN -->
            <div>

                <h4 class="text-white font-semibold mb-3">
                    Untuk Perusahaan
                </h4>

                <ul class="space-y-1 text-sm">

                    <li>
                        <a href="{{ route('register') }}" class="hover:text-white transition">
                            Daftar Akun
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('login') }}" class="hover:text-white transition">
                            Login
                        </a>
                    </li>

                    <li>
                        <a href="{{ route('user.companies.create') }}" class="hover:text-white transition">
                            Ajukan Perusahaan
                        </a>
                    </li>

                </ul>

            </div>


            <!-- BANTUAN -->
            <div>

                <h4 class="text-white font-semibold mb-3">
                    Bantuan
                </h4>

                <ul class="space-y-1 text-sm">

                    <li>
                        <a href="#" class="hover:text-white transition">
                            Panduan PKL
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white transition">
                            FAQ
                        </a>
                    </li>

                    <li>
                        <a href="#" class="hover:text-white transition">
                            Kebijakan Privasi
                        </a>
                    </li>

                </ul>

            </div>


            <!-- KONTAK -->
            <div>

                <h4 class="text-white font-semibold mb-3">
                    Kontak
                </h4>

                <p class="text-sm text-gray-400">
                    Email: info@pklhub.id
                </p>

                <p class="text-sm text-gray-400 mt-1">
                    Surabaya, Indonesia
                </p>

            </div>

        </div>


        <!-- BOTTOM -->
        <div class="border-t border-slate-800 py-4 text-center text-sm text-gray-500 animate-fadeUp">

            © {{ date('Y') }} PKLHub. All rights reserved.

        </div>

    </footer>
    <script>
        const navbar = document.getElementById("navbar");

        window.addEventListener("scroll", () => {

            if (window.scrollY > 30) {

                navbar.classList.add(
                    "bg-slate-900",
                    "shadow-lg"
                );

            } else {

                navbar.classList.remove(
                    "bg-slate-900",
                    "shadow-lg"
                );

            }

        });
        document.querySelectorAll("a").forEach(link => {

            link.addEventListener("click", function(e) {

                if (link.hostname === window.location.hostname) {

                    document.body.style.transition = "opacity .25s ease";
                    document.body.style.opacity = "0";

                }

            });

        });
    </script>

</body>

</html>
