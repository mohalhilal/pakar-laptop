<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Konsultasi extends Model
{
    use HasFactory;

    protected $table = 'konsultasi';

    protected $fillable = ['id_user', 'kode_kerusakan', 'persentase'];

    public function jawaban()
    {
        return $this->hasMany(Jawaban::class, 'id_konsultasi');
    }

    public function hasil()
    {
        return $this->hasMany(Hasil::class, 'id_konsultasi');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function kerusakan()
    {
        return $this->belongsTo(Kerusakan::class, 'kode_kerusakan', 'kode');
    }
}
