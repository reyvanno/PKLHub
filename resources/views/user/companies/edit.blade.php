@extends('layouts.app')

@section('title', 'Edit Perusahaan PKL')

@section('content')

    <!-- HEADER -->

    <div class="relative text-white py-20 overflow-hidden">

        <img src="{{ asset('images/bg-header.png') }}" class="absolute inset-0 w-full h-full object-cover">

        <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>

        <div class="relative max-w-5xl mx-auto px-6 animate-fadeUp">

            <a href="{{ route('user.companies.index') }}"
                class="inline-block bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm mb-6 transition">
                ← Kembali
            </a>

            <h1 class="text-3xl font-bold">
                Edit Perusahaan PKL
            </h1>

            <p class="text-gray-300 mt-2">
                Perubahan yang kamu lakukan akan menunggu verifikasi admin kembali.
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


            <!-- FORM CARD -->
            <div class="bg-white rounded-xl shadow-xl p-8">

                <form action="{{ route('user.companies.update', $company) }}" method="POST" class="space-y-6">

                    @csrf
                    @method('PATCH')


                    <!-- NAMA -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Nama Perusahaan
                        </label>

                        <input type="text" name="nama" value="{{ old('nama', $company->nama) }}" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">

                    </div>


                    <!-- ALAMAT -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Alamat
                        </label>

                        <textarea name="alamat" rows="3" required
                            class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ old('alamat', $company->alamat) }}</textarea>

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
                                    {{ old('jurusan_id', $company->jurusan_id) == $jurusan->id ? 'selected' : '' }}>

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
                                    {{ old('status_kuota', $company->status_kuota) == $status ? 'selected' : '' }}>

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

                        <textarea name="deskripsi" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ old('deskripsi', $company->deskripsi) }}</textarea>

                    </div>


                    <!-- BENEFIT -->
                    <div>

                        <label class="block text-sm font-medium mb-1 animate-fadeUp">
                            Benefit
                        </label>

                        <textarea name="benefit" rows="3" class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">{{ old('benefit', $company->benefit) }}</textarea>

                    </div>


                    <!-- KONTAK -->
                    @foreach (['kontak', 'telepon', 'email', 'website'] as $field)
                        <div>

                            <label class="block text-sm font-medium mb-1 animate-fadeUp">
                                {{ ucfirst($field) }}
                            </label>

                            <input type="{{ $field == 'email' ? 'email' : 'text' }}" name="{{ $field }}"
                                value="{{ old($field, $company->$field) }}"
                                class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-500 animate-fadeUp">

                        </div>
                    @endforeach


                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 p-4 rounded-lg text-sm animate-fadeUp">

                        ⚠ Setelah disimpan, perusahaan akan kembali berstatus
                        <b>menunggu verifikasi admin</b>.

                    </div>


                    <div class="flex justify-end gap-3">

                        <a href="{{ route('user.companies.index') }}"
                            class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 animate-fadeUp">

                            Batal

                        </a>

                        <button class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 animate-fadeUp">

                            Simpan Perubahan

                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection
