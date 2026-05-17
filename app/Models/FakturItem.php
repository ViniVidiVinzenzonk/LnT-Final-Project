<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FakturItem extends Model
{
    protected $fillable = [
        'faktur_id',
        'barang_id',
        'nama_barang',
        'harga_satuan',
        'kuantitas',
        'subtotal'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }
}