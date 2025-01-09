<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Gejala;
use App\Models\Kerusakan;
use App\Models\Aturan;
use Illuminate\Routing\Controllers\Middleware;
use App\Models\Konsultasi;
use App\Models\Jawaban;
use App\Services\Metode;
use App\Models\Hasil;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;

class KonsultasiController extends Controller
{

    public function index()
    {
        if (!Auth::user()) {
            return redirect('/login')->with('error', 'Anda harus login dahulu sebelum memulai konsultasi');
        } else if (Auth::check() && Auth::user()->role === 'admin') {
            return redirect('/admin');
        } else {
            $konsultasi = Konsultasi::with('jawaban')->where('id_user', Auth::user()->id)->get();
            return view('konsultasi', compact('konsultasi'));
        }
    }

    public function form()
    {
        // Ambil semua gejala untuk ditampilkan di form
        $gejala = Gejala::all();
        return view('konsultasi.form', compact('gejala'));
    }

    public function process(Request $request, Metode $metode)
    {
        $jawabanUser = $request->input('jawaban');


        // Langkah 1: Forward Chaining
        $KerusakanTerkait = $metode->forwardChaining($jawabanUser);


        // Langkah 2: Certainty Factor
        $hasilCF = $metode->hitungCF($KerusakanTerkait, $jawabanUser);

        if (empty($hasilCF)) {

            return back()->with('gagal', 'Tidak ada gejala yang dialami ? mungkin laptop anda baik-baik saja');
        }

        try {

            $konsultasi = Konsultasi::create([
                'id_user' => Auth::user()->id,
                'kode_kerusakan' => $hasilCF[0]['kerusakan'],
                'persentase' => $hasilCF[0]['nilai_cf']
            ]);

            $gejala = Gejala::all();

            foreach ($gejala as $g) {
                if (isset($jawabanUser[$g->kode])) {
                    Jawaban::create([
                        'id_konsultasi' => $konsultasi->id,
                        'kode_gejala' => $g->kode,
                        'cf_user' => $jawabanUser[$g->kode]
                    ]);
                }
            }

            foreach ($hasilCF as $hc) {
                Hasil::create([
                    'id_konsultasi' => $konsultasi->id,
                    'kode_kerusakan' => $hc['kerusakan'],
                    'persentase' => $hc['nilai_cf']
                ]);
            }
            return redirect()->route('konsultasi.hasil', $konsultasi->id);
        } catch (Exception $e) {
            return back()->with('gagal', 'Terjadi kesalahan saat memproses konsultasi, coba lagi');
        }
    }

    public function hasil($id)
    {
        $konsultasi = Konsultasi::with('user')->with('jawaban')->with('kerusakan')->find($id);
        return view('konsultasi.result', compact('konsultasi'));
    }

    public function destroy($id)
    {
        $konsultasi = Konsultasi::findOrFail($id);
        $konsultasi->delete();
        if (Auth::user()->role === 'admin') {
            return redirect()->route('kelola-konsultasi.index')->with('success', 'Data konsultasi berhasil dihapus.');
        }
        return redirect()->route('konsultasi')->with('success', 'Data konsultasi berhasil dihapus.');
    }

    public function downloadPDF($id)
    {
        $konsultasi = Konsultasi::with('user')->with('jawaban')->with('kerusakan')->find($id);

        $path = public_path('storage/multinet-logo.png');
        $type = pathinfo($path, PATHINFO_EXTENSION);
        $data = file_get_contents($path);
        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);

        $data = [
            'konsultasi' => $konsultasi,
            'base64' => $base64
        ];

        $pdf = Pdf::loadView('download.hasil-konsultasi', $data);
        return $pdf->download("Hasil-Konsultasi-{$konsultasi->user->name}-{$konsultasi->created_at->format('d-m-Y H:i')}.pdf");
    }
}
