@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="min-h-screen relative overflow-hidden pt-24 flex items-center justify-center">

    <!-- Background -->
    <img 
        src="{{ asset('images/background-hero.png') }}"
        class="absolute inset-0 w-full h-full object-cover"
    >

    <!-- Overlay -->
    <div class="absolute inset-0 bg-black/60"></div>


    <!-- Card -->
    <div class="relative w-full max-w-md bg-white rounded-xl shadow-xl p-8 animate-fadeUp">

        <h2 class="text-2xl font-bold text-center mb-6">
            Register
        </h2>


        <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf


        <!-- Nama -->
        <div>

            <label class="block text-sm font-medium mb-1">
                Nama
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name') }}"
                required autofocus
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >

            @error('name')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>



        <!-- Email -->
        <div>

            <label class="block text-sm font-medium mb-1">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >

            @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>



        <!-- Password -->
        <div>

            <label class="block text-sm font-medium mb-1">
                Password
            </label>

            <input
                type="password"
                name="password"
                required
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >

            @error('password')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror

        </div>



        <!-- Konfirmasi Password -->
        <div>

            <label class="block text-sm font-medium mb-1">
                Konfirmasi Password
            </label>

            <input
                type="password"
                name="password_confirmation"
                required
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >

        </div>



        <button
            class="w-full bg-slate-900 text-white py-2 rounded-lg hover:bg-slate-800 transition">

            Register

        </button>



        <div class="text-center text-sm text-gray-600 mt-4">

            Sudah punya akun?

            <a href="{{ route('login') }}"
               class="text-blue-600 hover:underline">
                Login
            </a>

        </div>


        </form>

    </div>

</div>

@endsection