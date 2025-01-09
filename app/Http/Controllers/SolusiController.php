<?php

namespace App\Http\Controllers;

use App\Exports\SolusiExport;
use App\Imports\SolusiImport;
use App\Models\Kerusakan;
use App\Models\Solusi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class SolusiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solusi = Solusi::with('kerusakan')->get(); // Ambil data dengan relasi ke kerusakan
        return view('admin.solusi.index', compact('solusi'))->with('act_solusi', 'solusi');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kerusakan = Kerusakan::all(); // Data untuk dropdown
        return view('admin.solusi.create', compact('kerusakan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_kerusakan' => 'required',
            'solusi' => 'required',
        ]);

        Solusi::create($request->all());
        return redirect()->route('solusi.index')->with('success', 'Solusi berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solusi $solusi)
    {
        $kerusakan = Kerusakan::all(); // Data untuk dropdown
        return view('admin.solusi.edit', compact('solusi', 'kerusakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solusi $solusi)
    {
        $request->validate([
            'kode_kerusakan' => 'required',
            'solusi' => 'required',
        ]);

        $solusi->update($request->all());
        return redirect()->route('solusi.index')->with('success', 'Solusi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solusi $solusi)
    {
        $solusi->delete();
        return redirect()->route('solusi.index')->with('success', 'Solusi berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new SolusiExport, 'solusi-' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SolusiImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data solusi berhasil diimport.');
    }

    public function clear(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            // Hapus semua data gejala
            Solusi::query()->delete();
            return redirect()->route('solusi.index')->with('success', 'Semua data solusi berhasil dihapus.');
        }

        // Jika password salah
        return redirect()->route('solusi.index')->with('error', 'Password yang dimasukkan salah.');
    }
}
