<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class PembelianDetail extends Model
{
    use HasFactory, Notifiable;
    protected $table = 'penjualan_detail';
}
