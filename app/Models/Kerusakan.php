<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kerusakan extends Model
{
    use HasFactory;

    protected $table = 'kerusakan';

    protected $fillable = [
        'kode',
        'nama_kerusakan',
    ];

    public function solusi()
    {
        return $this->hasOne(Solusi::class, 'kode_kerusakan', 'kode');
    }

    public function aturan()
    {
        return $this->hasMany(Aturan::class, 'kode_kerusakan', 'kode');
    }
}
