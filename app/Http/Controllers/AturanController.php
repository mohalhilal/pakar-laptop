<?php

namespace App\Http\Controllers;

use App\Models\Aturan;
use App\Models\Gejala;
use App\Models\Kerusakan;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AturanExport;
use App\Imports\AturanImport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AturanController extends Controller
{
    public function index()
    {
        $aturan = Aturan::all();

        return view('admin.aturan.index', compact('aturan'))->with('act_aturan', 'aturan');
    }

    public function create()
    {
        $kerusakan = Kerusakan::all();
        $gejala = Gejala::all();

        return view('admin.aturan.create', compact('kerusakan', 'gejala'))->with('act_aturan', 'aturan');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_kerusakan' => 'required',
            'kode_gejala' => 'required',
            'cf_pakar' => 'required',
        ]);

        $check = Aturan::where(['kode_kerusakan' => $request->kode_kerusakan, 'kode_gejala' => $request->kode_gejala])->get();

        if ($check->count() > 0) {
            return back()->withErrors('Aturan sudah pernah dibuat sebelumnya');
        }

        Aturan::create($request->all());
        return redirect()->route('aturan')->with('success', 'Aturan berhasil ditambahkan.');
    }



    public function edit($id)
    {
        $gejala = Gejala::all();
        $kerusakan = Kerusakan::all();
        $aturan = Aturan::find($id);
        return view('admin.aturan.edit', compact('kerusakan', 'gejala', 'aturan'));
    }


    public function updateAturan(Request $request, Aturan $aturan)
    {
        $request->validate([
            'kode_kerusakan' => 'required',
            'kode_gejala' => 'required',
            'cf_pakar' => 'required',
        ]);

        $check = Aturan::where(['kode_kerusakan' => $request->kode_kerusakan, 'kode_gejala' => $request->kode_gejala])->where('id', '!=', $request->id)->get();

        if ($check->count() > 0) {
            return back()->withErrors('Aturan sudah pernah dibuat sebelumnya');
        }


        Aturan::where('id', $request->id)->update(request()->except(['_token', '_method']));
        return redirect()->route('aturan')->with('success', 'Aturan berhasil perbarui.');
    }

    public function destroy($id)
    {
        Aturan::find($id)->delete();
        return redirect()->route('aturan')->with('success', 'Aturan berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new AturanExport, 'aturan-' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new AturanImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data Aturan berhasil diimport.');
    }

    public function clear(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            // Hapus semua data gejala
            Aturan::query()->delete();
            return redirect()->route('aturan')->with('success', 'Semua data Aturan berhasil dihapus.');
        }

        // Jika password salah
        return redirect()->route('aturan')->with('error', 'Password yang dimasukkan salah.');
    }
}
