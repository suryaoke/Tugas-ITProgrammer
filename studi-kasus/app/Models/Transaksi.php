<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    // Di model Transaksi.php
    public function detailTransaksis()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    /**
     * Relasi ke model Dokter.
     */
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'dokter_id');
    }

    
}
