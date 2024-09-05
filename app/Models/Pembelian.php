<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'pembelian';

    protected $fillable = [
        'no_pembelian',
        'no_bon',
        'supplier',
        'id_petugas',
        'tanggal',
        'total_pembelian',
    ];
}
