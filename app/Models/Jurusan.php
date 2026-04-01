<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    public function companies()
    {
        return $this->hasMany(Company::class);
    }
}
