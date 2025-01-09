<?php

namespace App\Imports;

use App\Models\Kerusakan;
use Maatwebsite\Excel\Concerns\ToModel;

class KerusakanImport implements ToModel
{
    public function model(array $row)
    {
        if (Kerusakan::count() === 0) {
            return new Kerusakan([
                'kode' => $row[0], // Kolom kedua di Excel
                'nama_kerusakan' => $row[1], // Kolom ketiga di Excel
            ]);
        } else {
            return new Kerusakan([
                'kode' => $row[0], // Kolom kedua di Excel
                'nama_kerusakan' => $row[1], // Kolom ketiga di Excel
            ]);
        }
    }
}
