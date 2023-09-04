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
        'tanggal',
        'diskon',
        'status',
        'pembayaran',
        'iduser'
    ];
}
