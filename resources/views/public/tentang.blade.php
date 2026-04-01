@extends('layouts.app')

@section('title', 'Tentang PKLHub')

@section('content')

<!-- HERO -->
<div class="relative text-white py-24 overflow-hidden">

    <img src="{{ asset('images/bg-header.png') }}" 
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>

    <div class="relative max-w-5xl mx-auto px-6 text-center animate-fadeUp">

        <h1 class="text-4xl font-bold mb-4">
            Tentang <span class="text-blue-500">PKL</span><span class="text-orange-500">Hub</span>
        </h1>

        <p class="text-gray-300 max-w-2xl mx-auto">
            Platform direktori tempat PKL untuk siswa SMK yang membantu menemukan
            perusahaan terbaik dan berbagi pengalaman magang secara transparan.
        </p>

    </div>

</div>


<!-- SECTION TENTANG -->
<div class="bg-white py-20">

    <div class="max-w-6xl mx-auto px-6 grid md:grid-cols-2 gap-12 items-center">

        <div class="animate-fadeUp">

            <h2 class="text-3xl font-bold text-slate-800 mb-6">
                Apa itu PKLHub?
            </h2>

            <p class="text-gray-600 leading-relaxed mb-4">
                PKLHub adalah platform berbasis web yang berfungsi sebagai direktori
                tempat Praktik Kerja Lapangan (PKL) bagi siswa SMK, khususnya di wilayah
                Surabaya dan sekitarnya.
            </p>

            <p class="text-gray-600 leading-relaxed mb-4">
                Platform ini dibuat untuk membantu siswa menemukan perusahaan yang
                menyediakan kesempatan magang, mengetahui status kuota PKL,
                serta membaca ulasan dari siswa lain yang pernah menjalani PKL
                di perusahaan tersebut.
            </p>

            <p class="text-gray-600 leading-relaxed">
                Dengan PKLHub, proses pencarian tempat PKL menjadi lebih mudah,
                terorganisir, dan transparan.
            </p>

        </div>

        <div class="animate-fadeUp">
            <img src="{{ asset('images/about.png') }}"
                 class="rounded-xl shadow-xl">
        </div>

    </div>

</div>



<!-- MASALAH -->
<div class="bg-slate-100 py-20">

    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center text-slate-800 mb-12 animate-fadeUp">
            Masalah yang Sering Dialami Siswa
        </h2>

        <div class="grid md:grid-cols-4 gap-6">

            <div class="bg-white p-6 rounded-xl shadow animate-fadeUp">
                <h3 class="font-semibold mb-2">Informasi Terbatas</h3>
                <p class="text-sm text-gray-600">
                    Siswa sering kesulitan mendapatkan informasi tempat PKL yang terpercaya.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow animate-fadeUp">
                <h3 class="font-semibold mb-2">Tidak Tahu Kuota</h3>
                <p class="text-sm text-gray-600">
                    Banyak siswa tidak mengetahui apakah perusahaan masih menerima PKL.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow animate-fadeUp">
                <h3 class="font-semibold mb-2">Tidak Ada Review</h3>
                <p class="text-sm text-gray-600">
                    Sulit mengetahui pengalaman siswa lain di perusahaan tersebut.
                </p>
            </div>

            <div class="bg-white p-6 rounded-xl shadow animate-fadeUp">
                <h3 class="font-semibold mb-2">Pencarian Lama</h3>
                <p class="text-sm text-gray-600">
                    Proses mencari tempat PKL sering memakan waktu yang lama.
                </p>
            </div>

        </div>

    </div>

</div>



<!-- CARA KERJA -->
<div class="bg-white py-20">

    <div class="max-w-6xl mx-auto px-6">

        <h2 class="text-3xl font-bold text-center text-slate-800 mb-12 animate-fadeUp">
            Bagaimana PKLHub Bekerja
        </h2>

        <div class="grid md:grid-cols-3 gap-10 text-center">

            <div class="animate-fadeUp">

                <div class="text-4xl mb-4">🔎</div>

                <h3 class="font-semibold mb-2">
                    Cari Perusahaan
                </h3>

                <p class="text-sm text-gray-600">
                    Jelajahi daftar perusahaan yang membuka kesempatan PKL.
                </p>

            </div>

            <div class="animate-fadeUp">

                <div class="text-4xl mb-4">⭐</div>

                <h3 class="font-semibold mb-2">
                    Lihat Review
                </h3>

                <p class="text-sm text-gray-600">
                    Baca pengalaman siswa lain yang pernah menjalani PKL.
                </p>

            </div>

            <div class="animate-fadeUp">

                <div class="text-4xl mb-4">➕</div>

                <h3 class="font-semibold mb-2">
                    Ajukan Perusahaan
                </h3>

                <p class="text-sm text-gray-600">
                    Tambahkan perusahaan baru yang belum tersedia di sistem.
                </p>

            </div>

        </div>

    </div>

</div>



<!-- VISI -->
<div class="bg-slate-900 text-white py-20">

    <div class="max-w-4xl mx-auto px-6 text-center animate-fadeUp">

        <h2 class="text-3xl font-bold mb-6">
            Visi PKLHub
        </h2>

        <p class="text-gray-300 leading-relaxed">
            Menjadi platform informasi tempat PKL yang terpercaya dan mudah diakses
            oleh siswa SMK untuk membantu mereka menemukan pengalaman magang yang
            lebih baik dan relevan dengan jurusan mereka.
        </p>

    </div>

</div>

@endsection