<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'penjualan';

    protected $fillable = [
        'no_penjualan',
        'id_petugas',
        'tanggal',
        'total_pembelian',
        'pembayaran',
        'kembalian',
    ];
}
