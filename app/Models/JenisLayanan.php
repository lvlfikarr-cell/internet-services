<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JenisLayanan extends Model
{
    protected $fillable = [
        'nama_layanan',
        'harga',
        'deskripsi'
    ];

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }


}
