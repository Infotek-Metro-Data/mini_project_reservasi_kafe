<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tipe',
        'deskripsi',
        'kapasitas',
        'foto',
        'status'
    ];

    public function reservasis()
    {
        return $this->hasMany(Reservasi::class);
    }
}