<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'keranjang';

    protected $fillable = [
        'id_barang',
        'harga_awal',
        'harga_jual',
        'qty',
        'subtotal',
    ];
}
