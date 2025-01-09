<?php

namespace App\Exports;

use App\Models\Solusi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SolusiExport implements FromCollection
{
    public function collection()
    {
        return Solusi::select('kode_kerusakan', 'solusi')->get();
    }
}
