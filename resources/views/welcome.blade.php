@extends('layouts.app')

@section('title','PKLHub')

@section('content')

<section class="relative min-h-screen flex items-center pt-24">

    <!-- Background -->
    <img src="{{ asset('images/background-hero.png') }}"
         class="absolute inset-0 w-full h-full object-cover">

         <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>

    <div class="relative w-full max-w-7xl mx-auto px-8">

        <div class="max-w-2xl text-white">

            {{-- <div class="flex items-center gap-3 mb-4">
                <img src="{{ asset('images/logo.png') }}" class="h-10">
                <span class="text-3xl font-bold">
                    <span class="brand-blue">PKL</span><span class="brand-orange">Hub</span>
                </span>
            </div> --}}


            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight mb-6 hero-title animate-fadeUp">
                Temukan Tempat Magang
                Impianmu di Surabaya!
            </h1>


            <p class="text-lg text-white mb-8 drop-shadow-[2px_2px_4px_rgba(0,0,0,0.7)] [-webkit-text-stroke:0.4px_rgba(0,0,0,0.5)] animate-fadeUp">
                Platform terpercaya untuk ribuan peluang PKL/Magang
                di Kota Surabaya. Gabung PKLHub sekarang!
            </p>


            <div class="flex gap-4 animate-fadeUp">

                <a href="{{ route('public.companies.index') }}"
                   class="bg-orange-500 hover:bg-orange-600 px-7 py-3 rounded-lg font-semibold shadow-lg">
                    Cari Tempat Magang →
                </a>

            </div>

        </div>

    </div>

</section>

@endsection