@extends('layouts.admin')

@section('content')
    <h3 class="mb-4">Data Perusahaan PKL</h3>


    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="d-flex justify-content-between mb-3">
                <span class="fw-semibold">Daftar Perusahaan</span>
                <a href="{{ route('admin.companies.create') }}" class="btn btn-primary btn-sm">
                    + Tambah
                </a>
            </div>

            <form method="GET" class="row g-2 mb-3">

                {{-- SEARCH --}}
                <div class="col-md-3">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control"
                        placeholder="Cari nama perusahaan...">
                </div>

                {{-- FILTER JURUSAN --}}
                <div class="col-md-3">
                    <select name="jurusan" class="form-select">
                        <option value="">Semua Jurusan</option>
                        @foreach ($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}" {{ request('jurusan') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- FILTER APPROVAL --}}
                <div class="col-md-3">
                    <select name="approval_status" class="form-select">
                        <option value="">Semua Approval</option>
                        <option value="approved" {{ request('approval_status') == 'approved' ? 'selected' : '' }}>
                            Approved
                        </option>
                        <option value="pending" {{ request('approval_status') == 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>
                        <option value="rejected" {{ request('approval_status') == 'rejected' ? 'selected' : '' }}>
                            Rejected
                        </option>
                    </select>
                </div>

                {{-- FILTER STATUS KUOTA --}}
                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="">Semua Status Kuota</option>
                        <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                        <option value="hampir_penuh" {{ request('status') == 'hampir_penuh' ? 'selected' : '' }}>Hampir
                            Penuh</option>
                        <option value="penuh" {{ request('status') == 'penuh' ? 'selected' : '' }}>Penuh</option>
                    </select>
                </div>

                <div class="col-md-2 mt-2">
                    <button type="submit" class="btn btn-dark w-100">
                        Filter
                    </button>
                </div>

            </form>

            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle text-center">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Status Kuota</th>
                            <th>Approval</th>
                            <th width="230">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="">
                        @forelse($companies as $index => $company)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td class="text-center">{{ $company->nama }}
                                    @if ($company->is_edited)
                                        <span class="badge bg-warning text-dark">
                                            Edited
                                        </span>
                                    @endif
                                </td>
                                <td>{{ $company->jurusan->nama ?? '-' }}</td>

                                {{-- BADGE STATUS KUOTA --}}
                                <td>
                                    @if ($company->status_kuota == 'open')
                                        <span class="badge bg-success">Open</span>
                                    @elseif($company->status_kuota == 'hampir_penuh')
                                        <span class="badge bg-warning text-dark">Hampir Penuh</span>
                                    @else
                                        <span class="badge bg-danger">Penuh</span>
                                    @endif
                                </td>

                                {{-- BADGE APPROVAL --}}
                                <td>
                                    @if ($company->approval_status === 'approved')
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($company->approval_status === 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                </td>

                                {{-- TOMBOL AKSI --}}
                                <td>
                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.companies.show', $company->id) }}"
                                        class="btn btn-info btn-sm">
                                        Lihat
                                    </a>
                                    {{-- HAPUS --}}
                                    <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST"
                                        class="d-inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Yakin hapus?')">
                                            Hapus
                                        </button>
                                    </form>

                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6">Belum ada data</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $companies->onEachSide(1)->links('pagination::simple-tailwind') }}
            </div>

        </div>
    </div>
@endsection
