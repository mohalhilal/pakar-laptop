<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\GejalaExport;
use App\Imports\GejalaImport;
use Maatwebsite\Excel\Facades\Excel;

class GejalaExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new GejalaExport, 'gejala-' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new GejalaImport, $request->file('file'));
        return redirect()->back()->with('success', 'Data gejala berhasil diimport.');
    }
}
