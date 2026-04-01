@extends('layouts.app')

@section('title','Login')

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
            Login
        </h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <label class="block text-sm font-medium mb-1">
                Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required autofocus
                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500"
            >

            @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
        </div>


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


        <div class="flex items-center gap-2 text-sm">
            <input type="checkbox" name="remember">
            <label>Remember me</label>
        </div>


        <button
            class="w-full bg-slate-900 text-white py-2 rounded-lg hover:bg-slate-800">
            Login
        </button>


        <div class="text-center text-sm text-gray-600 mt-4">

            Belum punya akun?

            <a href="{{ route('register') }}"
               class="text-blue-600 hover:underline">
                Register
            </a>

        </div>

        </form>

    </div>

</div>

@endsection