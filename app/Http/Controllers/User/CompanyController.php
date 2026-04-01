<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Jurusan;
use App\Http\Requests\StoreUserCompanyRequest;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $companies = Company::where('owner_id', auth()->id())
            ->latest()
            ->get();

        $from = $request->query('from');

        return view('user.companies.index', compact('companies', 'from'));
    }

    public function create(Request $request)
    {
        $jurusans = Jurusan::all();
        $from = $request->query('from');

        $draft = session('company_draft');
        $similar = session('company_similar');
        $warning = session('company_warning');

        return view('user.companies.create', compact(
            'jurusans',
            'from',
            'draft',
            'similar',
            'warning'
        ));
    }

    public function store(StoreUserCompanyRequest $request)
    {
        $data = $request->validated();
        $confirm = $request->input('confirm_duplicate');

        // 🔎 CEK PERUSAHAAN YANG MIRIP (HANYA YANG APPROVED)
        $similarCompanies = Company::approved()
            ->where(function ($query) use ($data) {

                $query->where('nama', 'like', '%' . $data['nama'] . '%')
                    ->orWhere('nama', 'like', $data['nama'] . '%');
            })
            ->orWhere(function ($query) use ($data) {

                $query->where('alamat', 'like', '%' . $data['alamat'] . '%')
                    ->orWhere('alamat', 'like', $data['alamat'] . '%');
            })
            ->limit(3)
            ->get();

        // 🚨 STOP JIKA TERDETEK MIRIP
        if ($similarCompanies->isNotEmpty() && !$confirm) {

            session([
                'company_draft'   => $data,
                'company_similar' => $similarCompanies,
                'company_warning' => 'Ditemukan perusahaan yang mirip dengan data yang kamu masukkan.'
            ]);

            return redirect()->route('user.companies.create', [
                'from' => $request->query('from')
            ]);
        }

        // SIMPAN PERUSAHAAN
        $data['owner_id'] = auth()->id();
        $data['approval_status'] = 'pending';

        Company::create($data);

        // HAPUS DRAFT
        session()->forget([
            'company_draft',
            'company_similar',
            'company_warning'
        ]);

        return redirect()->route('user.companies.index', [
            'from' => $request->query('from')
        ])->with('success', 'Perusahaan berhasil diajukan dan sedang menunggu persetujuan admin.');
    }

    public function edit(Company $company)
    {
        // Pastikan hanya owner yang boleh edit
        abort_if($company->owner_id !== auth()->id(), 403);

        $jurusans = Jurusan::all();

        return view('user.companies.edit', compact('company', 'jurusans'));
    }

    public function update(Request $request, Company $company)
    {
        abort_if($company->owner_id !== auth()->id(), 403);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'status_kuota' => 'required|in:open,hampir_penuh,penuh',
            'deskripsi' => 'nullable|string',
            'benefit' => 'nullable|string',
            'email' => 'nullable|email',
            'telepon' => 'nullable|string',
            'kontak' => 'nullable|string',
            'website' => 'nullable|string',
        ]);

        $editedFields = [];

        foreach ($data as $field => $value) {

            if ($company->$field != $value) {

                $editedFields[] = $field;
            }
        }

        $data['approval_status'] = 'pending';
        $data['is_edited'] = true;
        $data['edited_fields'] = $editedFields;

        $company->update($data);

        return redirect()
            ->route('user.companies.index')
            ->with('success', 'Perubahan berhasil disimpan dan menunggu verifikasi admin.');
    }

    public function destroy(Company $company)
    {
        // Pastikan hanya owner yang boleh menghapus
        abort_if($company->owner_id !== auth()->id(), 403);

        $company->delete();

        return redirect()
            ->route('user.companies.index')
            ->with('success', 'Perusahaan berhasil dihapus.');
    }
}
