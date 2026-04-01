<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Jurusan;
use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CompanyController extends Controller
{
    use AuthorizesRequests;

    public function __construct()
    {
        $this->authorizeResource(Company::class, 'company');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Company::with('jurusan');

        // Search Nama
        if ($request->filled('search')) {
            $query->where('nama', 'like', '%' . $request->search . '%');
        }

        // Filter jurusan
        if ($request->filled('jurusan')) {
            $query->where('jurusan_id', $request->jurusan);
        }

        //Filter Approval Status
        if ($request->filled('approval_status')) {
            $query->where('approval_status', $request->approval_status);
        }

        // Filter Status
        if ($request->filled('status')) {
            $query->where('status_kuota', $request->status);
        }

        $companies = $query->oldest()->paginate(10)->withQueryString();
        $jurusans = Jurusan::all();

        return view('admin.companies.index', compact('companies', 'jurusans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jurusans = Jurusan::all();
        return view('admin.companies.create', compact('jurusans'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCompanyRequest $request)
    {
        $data = $request->validated();
        $data['owner_id'] = null;

        Company::create($data);

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        $company->load('jurusan', 'owner');

        return view('admin.companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        $jurusans = Jurusan::all();

        return view('admin.companies.edit', compact('company', 'jurusans'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCompanyRequest $request, Company $company)
    {
        $company->update($request->validated());

        return redirect()
            ->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil diupdate');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return redirect()->route('admin.companies.index')
            ->with('success', 'Perusahaan berhasil dihapus');
    }

    public function approve(Company $company)
    {
        $company->approval_status = 'approved';
        $company->is_edited = false;
        $company->edited_fields = null;

        $company->save();

        return redirect()
            ->route('admin.companies.show', $company)
            ->with('success', 'Perusahaan berhasil diapprove.');
    }

    public function pending(Company $company)
    {
        $company->update(['approval_status' => 'pending']);

        return back()->with('success', 'Status perusahaan diubah menjadi Pending');
    }

    public function reject(Company $company)
    {
        $company->update(['approval_status' => 'rejected']);

        return back()->with('success', 'Status perusahaan ditolak');
    }
}
