@extends('layouts.admin')

@section('content')

<h3 class="mb-5 fw-bold">Dashboard Admin</h3>

<section class="py-3 bg-white border-bottom">
    <h3 class="fw-bold mb-4 text-center">
            Data Utama
        </h3>
</section>

{{-- ROW 1: DATA UTAMA (LEFT ALIGNED) --}}
<section class="py-5">
<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card shadow border-2 h-100">
            <div class="card-body">
                <p class="text-muted small mb-1">Total Perusahaan</p>
                <h1 class="fw-bold text-primary mb-0">
                    {{ $totalCompanies }}
                </h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-2 h-100">
            <div class="card-body">
                <p class="text-muted small mb-1">Total User</p>
                <h1 class="fw-bold text-dark mb-0">
                    {{ $totalUser }}
                </h1>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-2 h-100">
            <div class="card-body">
                <p class="text-muted small mb-1">Total Jurusan</p>
                <h1 class="fw-bold text-success mb-0">
                    {{ $totalJurusan }}
                </h1>
            </div>
        </div>
    </div>

</div>
</section>

<section class="py-3 bg-white border-bottom">
    <h3 class="fw-bold mb-4 text-center">
            Status Perusahaan
        </h3>
</section>

{{-- ROW 2: STATUS PERUSAHAAN (CENTERED) --}}
<section class="py-5">
<div class="row g-4 mb-5">

    <div class="col-md-4">
        <div class="card shadow-sm border-2 h-100">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Perusahaan Open</p>
                <h2 class="fw-bold text-success mb-0">
                    {{ $totalOpen }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-2 h-100">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Hampir Penuh</p>
                <h2 class="fw-bold text-warning mb-0">
                    {{ $totalAlmostFull }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow-sm border-2 h-100">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Penuh</p>
                <h2 class="fw-bold text-danger mb-0">
                    {{ $totalFull }}
                </h2>
            </div>
        </div>
    </div>

</div>
</section>

<section class="py-3 bg-white border-bottom">
    <h3 class="fw-bold mb-4 text-center">
            Review
        </h3>
</section>

{{-- ROW 3: REVIEW (MIXED STYLE) --}}
<section class="py-5">
<div class="row g-4 mb-5">

    <div class="col-md-6">
        <div class="card shadow-sm border-2 h-100">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Total Review</p>
                <h2 class="fw-bold mb-0">
                    {{ $totalReviews }}
                </h2>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow-sm border-2 h-100">
            <div class="card-body text-center">
                <p class="text-muted small mb-1">Rata-rata Rating</p>
                <h2 class="fw-bold text-warning mb-0">
                    {{ $averageRating ? number_format($averageRating, 1) : 0 }}
                </h2>
            </div>
        </div>
    </div>

</div>
</section>

<div>
    <a href="{{ route('admin.companies.index') }}" 
       class="btn btn-dark px-4">
        Kelola Perusahaan
    </a>

    <a href="{{ route('admin.reviews.index') }}" 
       class="btn btn-secondary px-4 ms-3">
        Kelola Review
    </a>
</div>

@endsection
