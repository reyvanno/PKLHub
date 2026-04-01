<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // hanya admin yang bisa CRUD
        return auth()->check() && auth()->user()->role === 'admin';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jurusan_id' => 'required|exists:jurusans,id',
            'status_kuota' => 'required|in:open,hampir_penuh,penuh',
            'deskripsi' => 'nullable|string',
            'benefit' => 'nullable|string',
            'kontak' => 'nullable|regex:/^[0-9,\s+()-]+$/|max:255',
            'telepon' => 'nullable|regex:/^[0-9,\s+()-]+$/|max:255',
            'email' => 'nullable|email|max:255',
            'website' => 'nullable|url|max:255',
        ];
    }
}
