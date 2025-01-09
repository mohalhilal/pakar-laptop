<?php

namespace App\Imports;

use App\Models\Aturan;
use Maatwebsite\Excel\Concerns\ToModel;

class AturanImport implements ToModel
{
    public function model(array $row)
    {
        return new Aturan([
            'kode_gejala' => $row[0],
            'kode_kerusakan' => $row[1],
            'cf_pakar' => (float) $row[2],
        ]);
    }
}
