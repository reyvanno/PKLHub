<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(Request $request)
    {
        $query = Review::with(['user', 'company']);

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $reviews = $query->oldest()->paginate(10)->withQueryString();

        return view('admin.reviews.index', compact('reviews'));
    }

    public function approve(Review $review)
    {
        $review->update(['status' => 'approved']);

        return back()->with('success', 'Review berhasil disetujui.');
    }

    public function reject(Review $review)
    {
        $review->update(['status' => 'rejected']);

        return back()->with('success', 'Review berhasil ditolak.');
    }

    public function destroy(Review $review)
    {
        $review->delete();

        return back()->with('success', 'Review berhasil dihapus.');
    }
}
