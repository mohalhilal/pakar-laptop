<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aturan extends Model
{
    use HasFactory;

    protected $table = 'aturan';

    protected $fillable = [
        'kode_gejala',
        'kode_kerusakan',
        'cf_pakar'
    ];

    // Relasi ke Gejala
    public function gejala()
    {
        return $this->belongsTo(Gejala::class, 'kode_gejala', 'kode');
    }

    // Relasi ke Kerusakan
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class, 'kode_kerusakan', 'kode');
    }
}
