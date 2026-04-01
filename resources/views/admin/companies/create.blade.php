@extends('layouts.admin')

@section('content')

<a href="{{ route('admin.companies.index') }}" 
       class="btn btn-outline-secondary btn-sm mb-4">
        ← Kembali
</a>

<h3 class="mb-4">Tambah Perusahaan PKL</h3> 

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-body">

        <form action="{{ route('admin.companies.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama Perusahaan</label>
                <div class="col-sm-9">
                    <input type="text" 
                           name="nama" 
                           class="form-control"
                           value="{{ old('nama') }}"
                           required>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                    <textarea name="alamat" 
                              class="form-control"
                              rows="3"
                              required>{{ old('alamat') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Jurusan</label>
                <div class="col-sm-9">
                    <select name="jurusan_id" 
                            class="form-select" 
                            required>
                        <option value="">-- Pilih Jurusan --</option>
                        @foreach($jurusans as $jurusan)
                            <option value="{{ $jurusan->id }}"
                                {{ old('jurusan_id') == $jurusan->id ? 'selected' : '' }}>
                                {{ $jurusan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Status Kuota</label>
                <div class="col-sm-9">
                    <select name="status_kuota" class="form-select">
                        <option value="open">Open</option>
                        <option value="hampir_penuh">Hampir Penuh</option>
                        <option value="penuh">Penuh</option>
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Deskripsi</label>
                <div class="col-sm-9">
                    <textarea name="deskripsi"
                            class="form-control"
                            rows="4">{{ old('deskripsi') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Benefit</label>
                <div class="col-sm-9">
                    <textarea name="benefit"
                            class="form-control"
                            rows="3">{{ old('benefit') }}</textarea>
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Kontak</label>
                <div class="col-sm-9">
                    <input type="text"
                        name="kontak"
                        class="form-control"
                        value="{{ old('kontak') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nomor Telepon (Flex)</label>
                <div class="col-sm-9">
                    <input type="text"
                        name="telepon"
                        class="form-control"
                        value="{{ old('telepon', $company->telepon ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email Perusahaan</label>
                <div class="col-sm-9">
                    <input type="email"
                        name="email"
                        class="form-control"
                        value="{{ old('email', $company->email ?? '') }}">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Website</label>
                <div class="col-sm-9">
                    <input type="text"
                        name="website"
                        class="form-control"
                        value="{{ old('website') }}">
                </div>
            </div>

            <hr>

            <div class="text-end">
                <a href="{{ route('admin.companies.index') }}" 
                   class="btn btn-secondary">
                    Batal
                </a>

                <button type="submit" 
                        class="btn btn-success">
                    Simpan Data
                </button>
            </div>

        </form>

    </div>
</div>

@endsection
