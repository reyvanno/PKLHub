<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Company extends Model
{
    protected $fillable = [
        'nama',
        'slug',
        'approval_status',
        'alamat',
        'deskripsi',
        'jurusan_id',
        'status_kuota',
        'benefit',
        'kontak',
        'telepon',
        'email',
        'website',
        'owner_id',
        'is_edited',
        'edited_fields',
    ];

    protected static function booted()
    {
        static::creating(function ($company) {

            $slug = Str::slug($company->nama);
            $original = $slug;
            $count = 1;

            while (Company::where('slug', $slug)->exists()) {
                $slug = $original . '-' . $count++;
            }

            $company->slug = $slug;
        });
    }

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'edited_fields' => 'array',
    ];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function scopeApproved($query)
    {
        return $query->where('approval_status', 'approved');
    }
}