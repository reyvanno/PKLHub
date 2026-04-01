@extends('layouts.app')

@section('title', 'Perusahaan Saya')

@section('content')

<!-- HEADER -->
<div class="relative text-white py-20 overflow-hidden">

    <!-- Background Image -->
    <img src="{{ asset('images/bg-header.png') }}" class="absolute inset-0 w-full h-full object-cover">

    <!-- Gradient Overlay -->
    <div class="absolute inset-0 bg-gradient-to-r from-black/80 via-black/60 to-black/40"></div>


    <!-- Content -->
    <div class="relative max-w-5xl mx-auto px-6 animate-fadeUp">

            <a href="{{ route('public.companies.index') }}"
                class="inline-block bg-white/10 backdrop-blur hover:bg-white/20 text-white px-4 py-2 rounded-lg text-sm mb-6 transition">
                ← Kembali
            </a>

        <h1 class="text-3xl font-bold">
            Data Perusahaan
        </h1>

        <p class="text-gray-300 mt-2">
            Kelola perusahaan yang kamu ajukan untuk PKL.
        </p>

    </div>

</div>




<!-- CONTENT -->
<div class="bg-slate-800 py-16">

    <div class="max-w-6xl mx-auto px-6 animate-fadeUp ">


        <div class="grid md:grid-cols-4 gap-6 mb-10">

            <div class="bg-white rounded-xl p-6 shadow text-center">
                <p class="text-gray-500 text-sm">Total Perusahaan</p>
                <h3 class="text-2xl font-bold text-slate-800">
                    {{ $companies->count() }}
                </h3>
            </div>

            <div class="bg-white rounded-xl p-6 shadow text-center">
                <p class="text-gray-500 text-sm">Approved</p>
                <h3 class="text-2xl font-bold text-green-600">
                    {{ $companies->where('approval_status', 'approved')->count() }}
                </h3>
            </div>

            <div class="bg-white rounded-xl p-6 shadow text-center">
                <p class="text-gray-500 text-sm">Pending</p>
                <h3 class="text-2xl font-bold text-yellow-500">
                    {{ $companies->where('approval_status', 'pending')->count() }}
                </h3>
            </div>

            <div class="bg-white rounded-xl p-6 shadow text-center">
                <p class="text-gray-500 text-sm">Rejected</p>
                <h3 class="text-2xl font-bold text-red-500">
                    {{ $companies->where('approval_status', 'rejected')->count() }}
                </h3>
            </div>

        </div>

        <div class="bg-white rounded-xl shadow-xl p-8">



            <div class="flex justify-between items-center mb-6">

                <h3 class="text-lg font-semibold">
                    Daftar Perusahaan Saya
                </h3>

                <a href="{{ route('user.companies.create', ['from' => $from]) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm transition">

                    + Daftar Perusahaan

                </a>

            </div>



            @if (session('success'))
                <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif




            <div class="overflow-x-auto">

                <table class="w-full text-sm text-left">

                    <thead class="bg-slate-900 text-white">

                        <tr class="text-center">

                            <th class="px-4 py-3">Nama</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Diajukan</th>
                            <th class="px-4 py-3">Aksi</th>

                        </tr>

                    </thead>



                    <tbody class="divide-y text-center">

                        @forelse($companies as $company)
                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-4 py-3 font-medium">
                                    {{ $company->nama }}
                                </td>



                                <td class="px-4 py-3">

                                    @if ($company->approval_status == 'approved')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs">
                                            Approved
                                        </span>
                                    @elseif($company->approval_status == 'pending')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs">
                                            Pending
                                        </span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs">
                                            Rejected
                                        </span>
                                    @endif

                                </td>



                                <td class="px-4 py-3 text-gray-500">
                                    {{ $company->created_at->format('d M Y') }}
                                </td>



                                <td class="px-4 py-3 text-center">

                                        <div class="flex justify-center gap-2">

                                            <a href="{{ route('user.companies.edit', $company) }}"
                                               class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                               Edit
                                            </a>

                                            <form action="{{ route('user.companies.destroy', $company) }}" method="POST"
                                                  onsubmit="return confirm('Yakin ingin menghapus perusahaan ini?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                                    Hapus
                                                </button>

                                            </form>

                                        </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="4" class="text-center py-8 text-gray-500">

                                    Belum ada perusahaan diajukan.

                                </td>

                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>



        </div>

    </div>

</div>

@endsection
