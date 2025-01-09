<?php

namespace App\Exports;

use App\Models\Kerusakan;
use Maatwebsite\Excel\Concerns\FromCollection;

class KerusakanExport implements FromCollection
{
    public function collection()
    {
        return Kerusakan::select('kode', 'nama_kerusakan')->get();
    }
}
