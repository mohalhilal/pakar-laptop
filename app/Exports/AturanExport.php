<?php

namespace App\Exports;

use App\Models\Aturan;
use Maatwebsite\Excel\Concerns\FromCollection;

class AturanExport implements FromCollection
{
    public function collection()
    {
        return Aturan::select('kode_gejala', 'kode_kerusakan', 'cf_pakar')->get();
    }
}
