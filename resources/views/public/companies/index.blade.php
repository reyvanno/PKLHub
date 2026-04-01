@extends('layouts.app')

@section('title', 'PKLHub - Temukan Tempat PKL')

@section('content')

    @php use Illuminate\Support\Str; @endphp

    <!-- HERO -->
    <section class="relative py-28 overflow-hidden">

        <!-- Background Image -->
        <img src="{{ asset('images/background-hero.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradient overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/60 via-black/30 to-transparent"></div>

        <div class="relative max-w-6xl mx-auto px-6 text-center text-white">

            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight mb-6 hero-title animate-fadeUp">
                Temukan Tempat PKL Terbaik untuk Masa Depanmu
            </h1>

            <p class="text-lg text-white mb-8 drop-shadow-[2px_2px_4px_rgba(0,0,0,0.7)] [-webkit-text-stroke:0.4px_rgba(0,0,0,0.5)] animate-fadeUp">
                Platform informasi tempat PKL SMK di Surabaya.
            </p>

            <!-- SEARCH -->
            <form method="GET"
                class="flex flex-col md:flex-row items-center justify-center gap-3 max-w-3xl mx-auto animate-fadeUp">

                <!-- SEARCH INPUT -->
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama perusahaan..."
                    class="w-full md:w-72 px-4 py-2.5 rounded-lg border border-gray-300
               text-black shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                <!-- JURUSAN -->
                <select name="jurusan"
                    class="w-full md:w-56 px-4 py-2.5 rounded-lg border border-gray-300
               text-black shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">Semua Jurusan</option>

                    @foreach ($jurusans as $jurusan)
                        <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                            {{ $jurusan->nama }}
                        </option>
                    @endforeach

                </select>

                <!-- RATING -->
                <select name="min_rating"
                    class="w-full md:w-40 px-4 py-2.5 rounded-lg border border-gray-300
               text-black shadow-sm
               focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                    <option value="">Rating</option>

                    <option value="4" {{ request('min_rating') == '4' ? 'selected' : '' }}>
                        4+ Bintang
                    </option>

                    <option value="3" {{ request('min_rating') == '3' ? 'selected' : '' }}>
                        3+ Bintang
                    </option>

                    <option value="2" {{ request('min_rating') == '2' ? 'selected' : '' }}>
                        2+ Bintang
                    </option>

                </select>

                <!-- BUTTON -->
                <button type="submit"
                    class="px-6 py-2.5 bg-black text-white rounded-lg
               shadow-md hover:bg-gray-800 transition">

                    Cari

                </button>

            </form>

        </div>
    </section>

    <!-- TOP RATED -->
    @if ($topRated->isNotEmpty())

        <section class="py-16 bg-slate-900 relative">

            <!-- subtle divider -->
            <div class="max-w-7xl mx-auto px-6">

                <h3
                    class="text-2xl font-bold text-center mb-10 flex justify-center items-center gap-2 text-white animate-fadeUp">
                    <span class="text-yellow-400 text-3xl">★</span> Rekomendasi Terbaik
                </h3>

                <div class="grid md:grid-cols-3 gap-6">

                    @foreach ($topRated as $company)
                        <div
                            class="border border-slate-200 rounded-xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition text-center bg-white">

                            <h5 class="font-bold text-lg mb-2 animate-fadeUp">
                                {{ $company->nama }}
                            </h5>

                            <div class="mb-2 animate-fadeUp">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($company->reviews_avg_rating))
                                        <span class="text-yellow-400">★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor

                                <div class="text-sm text-gray-500">
                                    {{ number_format($company->reviews_avg_rating, 1) }}
                                    ({{ $company->reviews_count }} review)
                                </div>

                            </div>

                            <p class="text-sm text-gray-500  animate-fadeUp">
                                {{ Str::limit($company->alamat, 60) }}
                            </p>

                            <a href="{{ route('public.companies.show', $company->slug) }}"
                                class="inline-block mt-4 bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800 transition animate-fadeUp">
                                Lihat Detail
                            </a>

                        </div>
                    @endforeach

                </div>

            </div>
        </section>
        </div>

    @endif



    <!-- LIST PERUSAHAAN -->
    <section class="py-16 bg-slate-800 relative">

        <!-- subtle gradient -->
        <div class="absolute top-0 left-0 w-full h-12 bg-gradient-to-b from-black/10 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6">

            <h3 class="text-2xl font-bold text-center mb-10 text-white animate-fadeUp">
                <span class="text-yellow-400 text-3xl">💼</span> List Perusahaan
            </h3>

            <div class="grid md:grid-cols-3 gap-6">

                @forelse($companies as $company)

                    <div
                        class="border border-slate-200 rounded-xl p-6 shadow-lg hover:shadow-2xl hover:-translate-y-1 transition text-center bg-white">

                        <h5 class="font-bold text-lg mb-2 animate-fadeUp">
                            {{ $company->nama }}
                        </h5>

                        @if ($company->reviews_count > 0)
                            <div class="mb-2 animate-fadeUp">

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= round($company->reviews_avg_rating))
                                        <span class="text-yellow-400">★</span>
                                    @else
                                        <span class="text-gray-300">★</span>
                                    @endif
                                @endfor

                                <div class="text-sm text-gray-500">
                                    {{ number_format($company->reviews_avg_rating, 1) }}
                                    ({{ $company->reviews_count }} review)
                                </div>

                            </div>
                        @else
                            <p class="text-sm text-gray-400">Belum ada review</p>
                        @endif


                        <p class="text-sm text-gray-500 mb-3 animate-fadeUp">
                            {{ Str::limit($company->alamat, 80) }}
                        </p>


                        <div class="flex justify-center gap-2 mb-4 animate-fadeUp">

                            <span class="text-xs bg-gray-200 px-3 py-1 rounded">
                                {{ $company->jurusan->nama ?? '-' }}
                            </span>

                            @if ($company->status_kuota == 'open')
                                <span class="text-xs bg-green-200 px-3 py-1 rounded">Open</span>
                            @elseif($company->status_kuota == 'hampir_penuh')
                                <span class="text-xs bg-yellow-200 px-3 py-1 rounded">Hampir Penuh</span>
                            @else
                                <span class="text-xs bg-red-200 px-3 py-1 rounded">Penuh</span>
                            @endif

                        </div>

                        <a href="{{ route('public.companies.show', $company->slug) }}"
                            class="inline-block mt-4 bg-slate-900 text-white px-4 py-2 rounded-lg hover:bg-slate-800 transition animate-fadeUp">
                            Lihat Detail
                        </a>

                    </div>

                @empty

                    <div class="col-span-3 text-center text-gray-500 animate-fadeUp">
                        Tidak ada data ditemukan.
                    </div>
                @endforelse

            </div>


            <div class="mt-10 flex justify-center animate-fadeUp">
                {{ $companies->links() }}
            </div>

        </div>
    </section>

@endsection
