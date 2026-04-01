<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Public\CompanyController as PublicCompanyController;
use App\Http\Controllers\User\CompanyController as UserCompanyController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/tentang', function () {
    return view('public.tentang');
})->name('public.tentang');

Route::get('/panduam', function () {
    return view('public.panduan');
})->name('public.panduan');

Route::get('/companies', [PublicCompanyController::class, 'index'])
    ->name('public.companies.index');

Route::get('/companies/{slug}', 
    [PublicCompanyController::class, 'show']
)->name('public.companies.show');

/*
|--------------------------------------------------------------------------
| PROFILE ROUTES (GLOBAL AUTH)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/companies/{company}/review', [ReviewController::class, 'store'])
        ->middleware(['auth', 'throttle:5,1'])
        ->name('reviews.store');
});

Route::middleware('auth')->prefix('user')->name('user.')->group(function () {
    Route::get('/companies', [UserCompanyController::class, 'index'])
        ->name('companies.index');
    Route::get('/companies/create', [UserCompanyController::class, 'create'])
        ->name('companies.create');
    Route::post('/companies', [UserCompanyController::class, 'store'])
        ->name('companies.store');
    // EDIT COMPANY
    Route::get('/companies/{company}/edit', [UserCompanyController::class, 'edit'])
        ->name('companies.edit');
    // UPDATE COMPANY
    Route::patch('/companies/{company}', [UserCompanyController::class, 'update'])
        ->name('companies.update');
    // DELETE COMPANY
    Route::delete('/companies/{company}', [UserCompanyController::class, 'destroy'])
        ->name('companies.destroy');
});

Route::post('/user/save-draft', function (\Illuminate\Http\Request $request) {
    session(['company_draft' => $request->all()]);
    return response()->json(['success' => true]);
})->name('user.saveDraft');

Route::get('/user/clear-draft', function (Request $request) {

    session()->forget([
        'company_draft',
        'company_similar',
        'company_warning'
    ]);

    $from = $request->query('from');

    if ($from === 'welcome') {
        return redirect()->route('welcome');
    }

    return redirect()->route('user.companies.index');
})->name('user.clearDraft');

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('companies', CompanyController::class);

        Route::patch('/companies/{company}/approve', [CompanyController::class, 'approve'])
            ->name('companies.approve');

        Route::patch('/companies/{company}/pending', [CompanyController::class, 'pending'])
            ->name('companies.pending');

        Route::patch('/companies/{company}/reject', [CompanyController::class, 'reject'])
            ->name('companies.reject');

        Route::resource('reviews', \App\Http\Controllers\Admin\ReviewController::class)
            ->only(['index','destroy']);

        Route::patch('/reviews/{review}/approve',
            [\App\Http\Controllers\Admin\ReviewController::class, 'approve'])
            ->name('reviews.approve');

        Route::patch('/reviews/{review}/reject',
            [\App\Http\Controllers\Admin\ReviewController::class, 'reject'])
            ->name('reviews.reject');

});

require __DIR__.'/auth.php';
