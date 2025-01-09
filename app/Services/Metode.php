<?php

namespace App\Services;

use App\Models\Kerusakan;

class Metode
{
    public function forwardChaining($jawabanUser)
    {
        $kerusakanTerkait = [];
        $kerusakan = Kerusakan::with('aturan')->get();

        foreach ($kerusakan as $kerusakanItem) {
            foreach ($kerusakanItem->aturan as $aturan) {
                if (isset($jawabanUser[$aturan->kode_gejala])) {
                    $kerusakanTerkait[$kerusakanItem->id]['kerusakan'] = $kerusakanItem->kode;
                    $kerusakanTerkait[$kerusakanItem->id]['aturan'][] = $aturan;
                }
            }
        }

        return $kerusakanTerkait;
    }

    public function hitungCF($kerusakanTerkait, $jawabanUser)
    {
        $hasil = [];

        foreach ($kerusakanTerkait as $kerusakanId => $kerusakanData) {
            $cfCombine = 0;

            foreach ($kerusakanData['aturan'] as $aturan) {
                $cfUser = $jawabanUser[$aturan->kode_gejala]; // CF dari user
                $cfPakar = $aturan->cf_pakar; // CF dari pakar

                $cf = $cfUser * $cfPakar;

                if ($cfCombine == 0) {
                    $cfCombine = $cf;
                } else {
                    $cfCombine = $cfCombine + $cf * (1 - $cfCombine);
                }
            }

            $hasil[] = [
                'kerusakan' => $kerusakanData['kerusakan'],
                'nilai_cf' => $cfCombine * 100 // Dalam persen
            ];
        }

        usort($hasil, function ($a, $b) {
            return $b['nilai_cf'] <=> $a['nilai_cf'];
        });

        return $hasil;
    }
}
