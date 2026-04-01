@extends('layouts.app')

@section('title', 'Panduan PKL')

@section('content')

<!-- HERO -->
<div class="relative text-white py-24 overflow-hidden">

    <img src="{{ asset('images/bg-header.png') }}"
         class="absolute inset-0 w-full h-full object-cover">

    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>

    <div class="relative max-w-5xl mx-auto px-6 text-center animate-fadeUp">

        <h1 class="text-4xl font-bold mb-4">
            Panduan PKL
        </h1>

        <p class="text-gray-300 max-w-2xl mx-auto">
            Panduan lengkap untuk membantu siswa SMK dalam mempersiapkan,
            mencari, dan menjalani Praktik Kerja Lapangan dengan lebih baik.
        </p>

    </div>

</div>


<!-- STEP SECTION -->
<div class="bg-white py-20">

    <div class="max-w-6xl mx-auto px-6 space-y-16">

        <!-- STEP 1 -->
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="animate-fadeUp">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">
                    1. Persiapan Sebelum PKL
                </h2>

                <p class="text-gray-600 mb-4">
                    Sebelum mencari tempat PKL, pastikan kamu sudah menentukan
                    bidang yang sesuai dengan jurusan serta menyiapkan dokumen penting.
                </p>

                <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm">
                    <li>Menentukan bidang sesuai jurusan</li>
                    <li>Menyiapkan CV dan surat pengantar</li>
                    <li>Mencari informasi perusahaan</li>
                </ul>
            </div>

            <div class="bg-slate-100 p-8 rounded-xl shadow text-center animate-fadeUp">
                <div class="text-5xl">📄</div>
            </div>

        </div>


        <!-- STEP 2 -->
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="bg-slate-100 p-8 rounded-xl shadow text-center animate-fadeUp">
                <div class="text-5xl">🔎</div>
            </div>

            <div class="animate-fadeUp">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">
                    2. Mencari Tempat PKL
                </h2>

                <p class="text-gray-600 mb-4">
                    Gunakan PKLHub untuk mencari perusahaan yang membuka
                    kesempatan PKL sesuai dengan kebutuhanmu.
                </p>

                <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm">
                    <li>Jelajahi daftar perusahaan</li>
                    <li>Lihat detail informasi perusahaan</li>
                    <li>Periksa status kuota PKL</li>
                    <li>Baca review dari siswa lain</li>
                </ul>
            </div>

        </div>


        <!-- STEP 3 -->
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="animate-fadeUp">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">
                    3. Ajukan Perusahaan
                </h2>

                <p class="text-gray-600 mb-4">
                    Jika perusahaan belum tersedia di PKLHub, kamu bisa
                    mengajukannya melalui fitur yang tersedia.
                </p>

                <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm">
                    <li>Isi data perusahaan</li>
                    <li>Tambahkan informasi lengkap</li>
                    <li>Kirim untuk verifikasi admin</li>
                </ul>
            </div>

            <div class="bg-slate-100 p-8 rounded-xl shadow text-center animate-fadeUp">
                <div class="text-5xl">➕</div>
            </div>

        </div>


        <!-- STEP 4 -->
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="bg-slate-100 p-8 rounded-xl shadow text-center animate-fadeUp">
                <div class="text-5xl">⭐</div>
            </div>

            <div class="animate-fadeUp">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">
                    4. Tips Agar Diterima PKL
                </h2>

                <p class="text-gray-600 mb-4">
                    Persiapkan diri dengan baik agar peluang diterima PKL semakin besar.
                </p>

                <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm">
                    <li>Buat CV yang rapi</li>
                    <li>Bersikap sopan saat menghubungi perusahaan</li>
                    <li>Kirim pengajuan lebih awal</li>
                    <li>Pelajari profil perusahaan</li>
                </ul>
            </div>

        </div>


        <!-- STEP 5 -->
        <div class="grid md:grid-cols-2 gap-10 items-center">

            <div class="animate-fadeUp">
                <h2 class="text-2xl font-bold text-slate-800 mb-4">
                    5. Etika Saat PKL
                </h2>

                <p class="text-gray-600 mb-4">
                    Saat menjalani PKL, jaga sikap dan profesionalitas
                    agar mendapatkan pengalaman terbaik.
                </p>

                <ul class="list-disc pl-5 text-gray-600 space-y-2 text-sm">
                    <li>Datang tepat waktu</li>
                    <li>Menghormati aturan perusahaan</li>
                    <li>Bersikap aktif dan mau belajar</li>
                    <li>Menjaga komunikasi yang baik</li>
                </ul>
            </div>

            <div class="bg-slate-100 p-8 rounded-xl shadow text-center animate-fadeUp">
                <div class="text-5xl">🏢</div>
            </div>

        </div>

    </div>

</div>


<!-- CTA -->
<div class="bg-slate-900 text-white py-20 text-center">

    <div class="max-w-3xl mx-auto px-6 animate-fadeUp">

        <h2 class="text-3xl font-bold mb-4">
            Siap Mencari Tempat PKL?
        </h2>

        <p class="text-gray-300 mb-6">
            Temukan perusahaan terbaik dan mulai perjalanan PKL kamu sekarang.
        </p>

        <a href="{{ route('public.companies.index') }}"
           class="bg-orange-500 hover:bg-orange-600 px-6 py-3 rounded-lg font-semibold transition">
            Cari Tempat PKL →
        </a>

    </div>

</div>

@endsection