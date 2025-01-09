<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class GejalaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gejala = Gejala::all();
        return view('admin.gejala.index', compact('gejala'))->with('act_gejala', 'gejala');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gejala.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'nama_gejala' => 'required|string|max:255',
        ]);

        // Ambil kode gejala terakhir
        $lastGejala = Gejala::orderBy('id', 'desc')->first();

        // Generate kode gejala baru
        $newKode = 'G001'; // Default jika tidak ada data
        if ($lastGejala) {
            $lastKode = $lastGejala->kode;
            $lastNumber = (int) substr($lastKode, 1); // Ambil angka setelah "G"
            $newKode = 'G' . str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT); // Format Gxxx
        }

        // Simpan data gejala
        Gejala::create([
            'kode' => $newKode,
            'nama_gejala' => $validated['nama_gejala'],
        ]);
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gejala $gejala)
    {
        return view('admin.gejala.edit', compact('gejala'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gejala $gejala)
    {
        $request->validate([
            'kode' => 'required|max:10|unique:gejala,kode,' . $gejala->id,
            'nama_gejala' => 'required|max:255',
        ]);

        $gejala->update($request->all());
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gejala $gejala)
    {
        $gejala->delete();
        return redirect()->route('gejala.index')->with('success', 'Gejala berhasil dihapus.');
    }

    public function clear(Request $request)
    {
        // Validasi password
        $request->validate([
            'password' => 'required',
        ]);

        if (Hash::check($request->password, Auth::user()->password)) {
            // Hapus semua data gejala
            Gejala::query()->delete();
            return redirect()->route('gejala.index')->with('success', 'Semua data gejala berhasil dihapus.');
        }

        // Jika password salah
        return redirect()->route('gejala.index')->with('error', 'Password yang dimasukkan salah.');
    }
}
