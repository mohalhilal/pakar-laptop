<?php

namespace App\Imports;

use App\Models\Solusi;
use Maatwebsite\Excel\Concerns\ToModel;

class SolusiImport implements ToModel
{
    public function model(array $row)
    {
        return new Solusi([
            'kode_kerusakan' => $row[0], // Kolom kedua di Excel
            'solusi' => $row[1],       // Kolom ketiga di Excel
        ]);
    }
}
