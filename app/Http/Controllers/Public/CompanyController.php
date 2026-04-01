<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Jurusan;
use App\Filters\CompanyFilter;

class CompanyController extends Controller
{
    public function index(CompanyFilter $filter)
    {
        $query = Company::approved()
            ->with(['jurusan'])
            ->withAvg(['reviews as reviews_avg_rating' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews as reviews_count' => function ($query) {
                $query->where('status', 'approved');
            }]);

        // APPLY FILTER CLASS
        $filter->apply($query);

        $companies = $query->paginate(9)->withQueryString();

        // TOP RATED
        $topRated = Company::approved()
            ->withAvg(['reviews as reviews_avg_rating' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews as reviews_count' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->having('reviews_count', '>', 0)
            ->orderByDesc('reviews_avg_rating')
            ->take(3)
            ->get();

        $topRatedIds = $topRated->pluck('id')->toArray();

        $jurusans = Jurusan::all();

        return view('public.companies.index', compact(
            'companies',
            'jurusans',
            'topRated',
            'topRatedIds'
        ));
    }

    public function show($slug)
    {
        $company = Company::approved()
            ->with([
                'jurusan',
                'reviews' => function ($query) {
                    $query->where('status', 'approved')
                        ->with('user');
                }
            ])
            ->withAvg(['reviews as reviews_avg_rating' => function ($query) {
                $query->where('status', 'approved');
            }], 'rating')
            ->withCount(['reviews as reviews_count' => function ($query) {
                $query->where('status', 'approved');
            }])
            ->where('slug', $slug)
            ->firstOrFail();

        $from = request('from');
        $origin = request('origin');

        return view('public.companies.show', compact('company', 'from', 'origin'));
    }

    public function welcome()
    {
        return view('welcome');
    }
}
