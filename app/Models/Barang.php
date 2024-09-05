<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'barang';

    protected $fillable = [
        'id_barang',
        'nama_barang',
        'merk_barang',
        'harga_awal',
        'harga_jual'
    ];
}
