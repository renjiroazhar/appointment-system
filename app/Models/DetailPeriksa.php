<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPeriksa extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_dokter',
        'id_periksa',
        'id_obat',
    ];

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter');
    }
    public function periksa()
    {
        return $this->belongsTo(Periksa::class, 'id_periksa');
    }
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
