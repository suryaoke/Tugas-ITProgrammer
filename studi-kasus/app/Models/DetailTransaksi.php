<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    public function obat()
    {
        return $this->belongsTo(Obat::class, 'obat_id');
    }
}
