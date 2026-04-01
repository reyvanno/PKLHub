@extends('layouts.app')

@section('title', 'Ajukan Perusahaan PKL')

@section('content')

    @php
        $draft = $draft ?? [];

        function val($key, $draft)
        {
            return old($key, $draft[$key] ?? '');
        }
    @endphp



    <!-- HEADER -->
    <div class="relative text-white py-20 overflow-hidden">

        <!-- Background Image -->
        <img src="{{ asset('images/bg-header.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <!-- Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>


        <!-- Content -->
        <div class="relative max-w-5xl mx-auto px-6 animate-fadeUp">

            <a href="{{ route('user.companies.index') }}"
                class="inline-block bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm mb-6 transition">
                ← Kembali
            </a>



            <h1 class="text-3xl font-bold">
                Ajukan Perusahaan PKL
            </h1>

            <p class="text-gray-300 mt-2">
                Tambahkan perusahaan baru untuk direkomendasikan sebagai tempat PKL.
            </p>

        </div>

    </div>



    <!-- CONTENT -->
    <div class="bg-slate-800 py-16">

        <div class="max-w-4xl mx-auto px-6 space-y-6">



            {{-- ERROR --}}
            @if ($errors->any())

                <div class="bg-red-100 text-red-700 p-4 rounded-lg">
                    <ul class="list-disc pl-5">

                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>
                </div>

            @endif



            {{-- WARNING --}}
            @if (isset($warning))
                <div class="bg-yellow-100 text-yellow-800 p-4 rounded-lg">
                    {{ $warning }}
                </div>
            @endif



            {{-- DUPLICATE --}}
            @if (isset($similar) && $similar->isNotEmpty())

                <div class="bg-yellow-100 p-6 rounded-xl">

                    <h4 class="font-semibold mb-4">
                        Perusahaan Serupa yang Sudah Ada
                    </h4>

                    @foreach ($similar as $company)
                        <div class="mb-3 p-3 border rounded bg-white">

                            <strong>{{ $company->nama }}</strong>

                            <p class="text-sm text-gray-500">
                                {{ $company->alamat }}
                            </p>

                            @if ($company->approval_status === 'approved')
                                <a href="{{ route('public.companies.show', [
                                    'slug' => $company->slug,
                                    'from' => 'create',
                                    'origin' => $from,
                                ]) }}"
                                    onclick="event.preventDefault(); saveDraftAndGo(this.href);"
                                    class="inline-block mt-2 text-sm border px-3 py-1 rounded hover:bg-gray-100">

                                    Lihat Detail

                                </a>
                            @else
                                <span class="text-sm text-gray-500">
                                    (Menunggu verifikasi admin)
                                </span>
                            @endif

                        </div>
                    @endforeach



                    <form method="POST" action="{{ route('user.companies.store') }}">
                        @csrf

                        @foreach ($draft as $key => $value)
                            @if (!is_array($value))
                                <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                            @endif
                        @endforeach

                        <input type="hidden" name="confirm_duplicate" value="1">

                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600 mt-3">
                            Tetap Ajukan Perusahaan
                        </button>

                    </form>

                </div>

            @endif



            <!-- FORM CARD -->
            <div class="bg-white rounded-xl shadow-xl p-8">

                <form id="companyForm" action="{{ route('user.companies.store', ['from' => $from]) }}" method="POST"
                    class="space-y-6">

                    @csrf



                    <!-- NAMA -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Nama Perusahaan
                        </label>

                        <input type="text" name="nama" value="{{ val('nama', $draft) }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">

                    </div>



                    <!-- ALAMAT -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Alamat
                        </label>

                        <textarea name="alamat" rows="3" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ val('alamat', $draft) }}</textarea>

                    </div>



                    <!-- JURUSAN -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Jurusan
                        </label>

                        <select name="jurusan_id" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">

                            <option value="">-- Pilih Jurusan --</option>

                            @foreach ($jurusans as $jurusan)
                                <option value="{{ $jurusan->id }}"
                                    {{ val('jurusan_id', $draft) == $jurusan->id ? 'selected' : '' }}>

                                    {{ $jurusan->nama }}

                                </option>
                            @endforeach

                        </select>

                    </div>



                    <!-- STATUS -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Status Kuota
                        </label>

                        <select name="status_kuota"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">

                            @foreach (['open', 'hampir_penuh', 'penuh'] as $status)
                                <option value="{{ $status }}"
                                    {{ val('status_kuota', $draft) == $status ? 'selected' : '' }}>

                                    {{ ucfirst(str_replace('_', ' ', $status)) }}

                                </option>
                            @endforeach

                        </select>

                    </div>



                    <!-- DESKRIPSI -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Deskripsi
                        </label>

                        <textarea name="deskripsi" rows="3"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ val('deskripsi', $draft) }}</textarea>

                    </div>



                    <!-- BENEFIT -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Benefit
                        </label>

                        <textarea name="benefit" rows="3"
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ val('benefit', $draft) }}</textarea>

                    </div>



                    <!-- KONTAK -->
                    @foreach (['kontak', 'telepon', 'email', 'website'] as $field)
                        <div>

                            <label class="block text-sm font-medium mb-1 animate-fadeUp">
                                {{ ucfirst($field) }}
                            </label>

                            <input type="{{ $field == 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                                value="{{ val($field, $draft) }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp ">

                        </div>
                    @endforeach



                    <div class="flex justify-end gap-3">

                        <a href="{{ route('user.clearDraft', ['from' => $from]) }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 animate-fadeUp">

                            Batal

                        </a>

                        <button class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 animate-fadeUp">

                            Ajukan Perusahaan

                        </button>

                    </div>



                </form>

            </div>

        </div>

    </div>

@endsection
