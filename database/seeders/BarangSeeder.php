<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('barang')->insert([
            'id_barang' => 'BRG00001',
            'nama_barang' => 'Cincin Thanos',
            'harga_awal' => '2000',
            'harga_jual' => '10000',
            'stok' => '0'
        ]);
        DB::table('barang')->insert([
            'id_barang' => 'BRG00002',
            'nama_barang' => 'Palu Thor',
            'harga_awal' => '1500',
            'harga_jual' => '50000',
            'stok' => '0'
        ]);
    }
}
