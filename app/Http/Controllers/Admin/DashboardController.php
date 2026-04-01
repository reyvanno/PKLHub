<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Jurusan;
use App\Models\Review;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalCompanies = Company::count();
        $totalJurusan = Jurusan::count();
        $totalUser = User::count();

        $totalReviews = Review::count();
        $averageRating = Review::avg('rating');
        
        $totalOpen = Company::where('status_kuota', 'open')->count();
        $totalAlmostFull = Company::where('status_kuota', 'hampir_penuh')->count();
        $totalFull = Company::where('status_kuota', 'penuh')->count();

        return view('admin.dashboard', compact(
            'totalCompanies',
            'totalJurusan',
            'totalUser',
            'totalReviews',
            'averageRating',
            'totalOpen',
            'totalAlmostFull',
            'totalFull'
        ));
    }
}
