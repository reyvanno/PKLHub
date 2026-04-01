<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            'RPL',
            'ANIMASI',
            'DPIB',
            'TKP',
            'TSM',
            'TPM',
            'TAV',
            'TEI',
            'TITL',
            'TKJ'
        ];
        
        foreach ($data as $jurusan) {
            Jurusan::create([
                'nama' => $jurusan
            ]);
        }
    }
}
