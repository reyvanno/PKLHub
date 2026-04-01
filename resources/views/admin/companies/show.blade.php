@extends('layouts.admin')

@section('content')

<h3 class="mb-4">Detail Perusahaan</h3>

<a href="{{ route('admin.companies.index') }}" 
class="btn btn-secondary btn-sm mb-3">
← Kembali </a>

<div class="card shadow-sm">
    <div class="card-body">

    <h4 class="fw-bold">
        {{ $company->nama }}

        @if(in_array('nama', $company->edited_fields ?? []))
            <span class="badge bg-warning text-dark ms-2">Edited</span>
        @endif
    </h4>

    <div class="mb-3">
        <strong>Status Approval:</strong>

        @if($company->approval_status == 'approved')
            <span class="badge bg-success">Approved</span>
        @elseif($company->approval_status == 'pending')
            <span class="badge bg-warning text-dark">Pending</span>
        @else
            <span class="badge bg-danger">Rejected</span>
        @endif
    </div>

    <hr>

    <table class="table table-bordered">

        <tr>
            <th width="200">Alamat</th>
            <td>
                {{ $company->alamat }}

                @if($company->is_edited && in_array('alamat', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Jurusan</th>
            <td>
                {{ $company->jurusan->nama ?? '-' }}

                @if($company->is_edited && in_array('jurusan_id', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Status Kuota</th>
            <td>
                {{ ucfirst($company->status_kuota) }}

                @if($company->is_edited && in_array('status_kuota', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Deskripsi</th>
            <td>
                {{ $company->deskripsi ?? '-' }}

                @if($company->is_edited && in_array('deskripsi', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Benefit</th>
            <td>
                {{ $company->benefit ?? '-' }}

                @if($company->is_edited && in_array('benefit', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Email</th>
            <td>
                @if($company->email)
                    <a href="mailto:{{ $company->email }}">
                        {{ $company->email }}
                    </a>
                @else
                    -
                @endif

                @if($company->is_edited && in_array('email', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Telepon</th>
            <td>
                @if($company->telepon)
                    <a href="tel:{{ $company->telepon }}">
                        {{ $company->telepon }}
                    </a>
                @else
                    -
                @endif

                @if($company->is_edited && in_array('telepon', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Kontak</th>
            <td>
                {{ $company->kontak ?? '-' }}

                @if($company->is_edited && in_array('kontak', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Website</th>
            <td>
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank">
                        {{ $company->website }}
                    </a>
                @else
                    -
                @endif

                @if($company->is_edited && in_array('website', $company->edited_fields ?? []))
                    <span class="badge bg-warning text-dark ms-2">Edited</span>
                @endif
            </td>
        </tr>

        <tr>
            <th>Diajukan Oleh</th>
            <td>
                @if($company->owner)
                    {{ $company->owner->name }} ({{ $company->owner->email }})
                @else
                    Admin
                @endif
            </td>
        </tr>

        <tr>
            <th>Dibuat Pada</th>
            <td>
                {{ $company->created_at->format('d M Y H:i') }}
            </td>
        </tr>

    </table>

    <hr>

    <div class="d-flex gap-2">

        @if($company->approval_status !== 'approved')
            <form method="POST" action="{{ route('admin.companies.approve', $company->id) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-success btn-sm">
                    Approve
                </button>
            </form>
        @endif

        @if($company->approval_status !== 'pending')
            <form method="POST" action="{{ route('admin.companies.pending', $company->id) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-warning btn-sm">
                    Pending
                </button>
            </form>
        @endif

        @if($company->approval_status !== 'rejected')
            <form method="POST" action="{{ route('admin.companies.reject', $company->id) }}">
                @csrf
                @method('PATCH')
                <button class="btn btn-danger btn-sm">
                    Reject
                </button>
            </form>
        @endif

    </div>

</div>

</div>

@endsection
