<?php

namespace App\Http\Controllers;

use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Konsultasi;
use App\Models\User;
use Illuminate\Http\Request;


class AdminController extends Controller
{
    function index()
    {

        // Mengambil jumlah data untuk statistik
        $jumlahGejala = Gejala::count();
        $jumlahKerusakan = Kerusakan::count();
        $jumlahUser = User::where('role', 'user')->count();
        $jumlahKonsul = Konsultasi::count();
        $konsultasiTerbaru = Konsultasi::with('user') // Relasi user
            ->latest() // Urutkan berdasarkan waktu terbaru
            ->take(5) // Batasi 10 data terakhir
            ->get();

        return view('admin.index', compact('jumlahGejala', 'jumlahKerusakan', 'jumlahUser', 'jumlahKonsul', 'konsultasiTerbaru'))->with('act_beranda', 'beranda');
    }
}
