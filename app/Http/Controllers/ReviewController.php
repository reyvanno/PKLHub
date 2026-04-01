<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\Company;
use App\Http\Requests\StoreReviewRequest;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function store(StoreReviewRequest $request, Company $company)
    {
        $company->reviews()->create([
            'user_id' => auth()->id(),
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review berhasil dikirim dan sedang menunggu verifikasi admin.');
    }
}
