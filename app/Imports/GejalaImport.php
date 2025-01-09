<?php

namespace App\Imports;

use App\Models\Gejala;
use Maatwebsite\Excel\Concerns\ToModel;

class GejalaImport implements ToModel
{
    public function model(array $row)
    {
        return new Gejala([
            'kode' => $row[0], // Kolom 2 di Excel (kolom pertama = 0)
            'nama_gejala' => $row[1], // Kolom 3 di Excel
        ]);
    }
}
