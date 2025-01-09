<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solusi extends Model
{
    use HasFactory;

    protected $table = 'solusi';

    protected $fillable = [
        'kode_kerusakan',
        'solusi',
    ];

    /**
     * Relasi ke model Kerusakan.
     */
    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class, 'kode_kerusakan', 'kode');
    }
}
