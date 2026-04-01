@extends('layouts.admin')

@section('content')

<h3 class="mb-4">Manajemen Review</h3>

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<form method="GET" class="mb-3">
    <select name="status" class="form-select w-auto d-inline">
        <option value="">Semua Status</option>
        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
        <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
        <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
    </select>

    <button type="submit" class="btn btn-dark btn-sm">
        Filter
    </button>
</form>

<div class="table-responsive">
    <table class="table table-bordered text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>User</th>
                <th>Perusahaan</th>
                <th>Rating</th>
                <th>Komentar</th>
                <th>Status</th>
                <th width="220">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reviews as $review)
                <tr>
                    <td>{{ $review->user->name }}</td>
                    <td>{{ $review->company->nama }}</td>
                    <td>{{ $review->rating }}</td>
                    <td class="text-start">{{ $review->comment }}</td>

                    <td>
                        @if($review->status == 'approved')
                            <span class="badge bg-success">Approved</span>
                        @elseif($review->status == 'pending')
                            <span class="badge bg-warning text-dark">Pending</span>
                        @else
                            <span class="badge bg-danger">Rejected</span>
                        @endif
                    </td>

                    <td>

                        @if($review->status !== 'approved')
                            <form action="{{ route('admin.reviews.approve', $review->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-success btn-sm">
                                    Approve
                                </button>
                            </form>
                        @endif

                        @if($review->status !== 'rejected')
                            <form action="{{ route('admin.reviews.reject', $review->id) }}"
                                  method="POST" class="d-inline">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-danger btn-sm">
                                    Reject
                                </button>
                            </form>
                        @endif

                        <form action="{{ route('admin.reviews.destroy', $review->id) }}"
                              method="POST"
                              class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-secondary btn-sm"
                                    onclick="return confirm('Hapus review ini?')">
                                Hapus
                            </button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada review.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="mt-3">
    {{ $reviews->links() }}
</div>

@endsection