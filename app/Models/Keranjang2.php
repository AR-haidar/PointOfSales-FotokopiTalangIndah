<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Keranjang2 extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'keranjang2';

    protected $fillable = [
        'id_barang',
        'harga_awal',
        'qty',
        'subtotal',
    ];
}
