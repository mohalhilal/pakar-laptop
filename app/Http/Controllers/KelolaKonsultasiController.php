<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Konsultasi;
use App\Models\User;

class KelolaKonsultasiController extends Controller
{
    public function index()
    {
        $konsultasi = Konsultasi::with('user')->latest()->get();
        return view('admin.konsultasi.index', compact('konsultasi'))->with('act_konsultasi', 'konsultasi');
    }


    public function edit($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $users = User::all();
        return view('admin.konsultasi.edit', compact('konsultasi', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_user' => 'required|exists:users,id',
            'hasil_kerusakan' => 'required|string|max:255',
            'solusi' => 'required|string',
        ]);

        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->update($request->all());
        return redirect()->route('kelola-konsultasi.index')->with('success', 'Data konsultasi berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();
        return redirect()->route('kelola-konsultasi.index')->with('success', 'Data konsultasi berhasil dihapus.');
    }
}
