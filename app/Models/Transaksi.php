<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'idtransaksi',
        'idoutlet',
        'idmember',
        'kode_invoice',
        'tanggal',
        'biayatambahan',
        'diskon',
        'pajak',
        'status',
        'pembayaran',
        'tanggalbayar',
        'bataswaktu',
        'iduser'
    ];
}
