<?php

namespace App\Http\Controllers;

use App\Models\Kerusakan;
use Illuminate\Http\Request;
use App\Exports\KerusakanExport;
use App\Imports\KerusakanImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KerusakanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kerusakan = Kerusakan::all();
        return view('admin.kerusakan.index', compact('kerusakan'))->with('act_kerusakan', 'kerusakan');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kerusakan.create')->with('kerusakan', 'kerusakan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama_kerusakan' => 'required|string|max:255',
        ]);

        // Ambil kode kerusakan terakhir
        $lastKerusakan = Kerusakan::orderBy('id', 'desc')->first();

        // Generate kode kerusakan baru
        $newKode = 'K001'; // Default jika tidak ada data
        if ($lastKerusakan) {
            $lastKode = $lastKerusakan->kode;
            $lastNumber = (int) substr($lastKode, 1); // Ambil angka setelah "K"
            $newKode = 'K' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Format Kxxx
        }

        // Simpan data kerusakan
        Kerusakan::create([
            'kode' => $newKode,
            'nama_kerusakan' => $validated['nama_kerusakan'],
        ]);

        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Kerusakan $kerusakan)
    {
        return view('admin.kerusakan.edit', compact('kerusakan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Kerusakan $kerusakan)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:kerusakan,kode,' . $kerusakan->id,
            'nama_kerusakan' => 'required|max:255',
        ]);

        $kerusakan->update($request->all());
        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Kerusakan $kerusakan)
    {
        $kerusakan->delete();
        return redirect()->route('kerusakan.index')->with('success', 'Kerusakan berhasil dihapus.');
    }

    public function export()
    {
        return Excel::download(new KerusakanExport, 'kerusakan-' . date('d-m-Y') . '.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new KerusakanImport, $request->file('file'));

        return redirect()->back()->with('success', 'Data kerusakan berhasil diimport.');
    }

    public function clear(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            // Hapus semua data gejala
            Kerusakan::query()->delete();
            return redirect()->route('kerusakan.index')->with('success', 'Semua data kerusakan berhasil dihapus.');
        }

        // Jika password salah
        return redirect()->route('kerusakan.index')->with('error', 'Password yang dimasukkan salah.');
    }
}
