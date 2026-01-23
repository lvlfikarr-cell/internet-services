<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $fillable = [
        'user_id',
        'nama_pelanggan',
        'alamat',
        'jenis_layanan_id',
        'tanggal_berlangganan'
    ];

    public function jenisLayanan()
    {
        return $this->belongsTo(JenisLayanan::class);
    }
}
