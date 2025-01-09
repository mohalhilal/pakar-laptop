<?php

namespace App\Exports;

use App\Models\Gejala;
use Maatwebsite\Excel\Concerns\FromCollection;

class GejalaExport implements FromCollection
{
    public function collection()
    {
        return Gejala::select('kode', 'nama_gejala')->get();
    }
}
