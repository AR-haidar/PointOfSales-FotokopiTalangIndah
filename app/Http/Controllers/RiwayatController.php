<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

use App\Models\Laporan;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;
use App\Models\Pembelian;
use App\Models\PembelianDetail;

class RiwayatController extends Controller
{
    //jual
    public function jual()
    {
        $penjualan = DB::table('penjualan')
            ->join('users', 'users.id', '=', 'penjualan.id_petugas')
            ->select('users.name', 'penjualan.*')
            ->orderBy('waktu', 'DESC')
            ->get();
        return view('page.penjualan')->with([
            "title" => "Riwayat Penjualan",
            "sidebar" => "jual",
            "penjualan" => $penjualan,
        ]);
    }
    public function jualdetail($id)
    {
        $penjualan = DB::table('penjualan')
            ->join('users', 'users.id', '=', 'penjualan.id_petugas')
            ->where('no_penjualan', '=', $id)
            ->select('users.name', 'penjualan.*')
            ->get();

        $penjualanDetail = DB::table('penjualan_detail')
            ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
            ->where('no_penjualan', '=', $id)
            ->select('barang.nama_barang', 'penjualan_detail.*')
            ->get();
        return view('page.penjualan-detail')->with([
            "title" => "Riwayat Penjualan",
            "sidebar" => "jual",
            "penjualan" => $penjualan,
            "penjualanDetail" => $penjualanDetail,
        ]);
    }

    //beli
    public function beli()
    {
        $pembelian = DB::table('pembelian')
            ->join('users', 'users.id', '=', 'pembelian.id_petugas')
            ->select('users.name', 'pembelian.*')
            ->orderBy('waktu', 'DESC')
            ->get();
        $pembelianDetail = PembelianDetail::all();
        return view('page.pembelian')->with([
            "title" => "Riwayat Pembelian",
            "sidebar" => "beli",
            "pembelian" => $pembelian,
            "pembelianDetail" => $pembelianDetail
        ]);
    }

    public function belidetail($id)
    {
        $pembelian = DB::table('pembelian')
            ->join('users', 'users.id', '=', 'pembelian.id_petugas')
            ->where('no_pembelian', '=', $id)
            ->select('users.name', 'pembelian.*')
            ->get();

        $pembelianDetail = DB::table('pembelian_detail')
            ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
            ->where('no_pembelian', '=', $id)
            ->select('barang.nama_barang', 'pembelian_detail.*')
            ->get();
        return view('page.pembelian-detail')->with([
            "title" => "Riwayat pembelian",
            "sidebar" => "jual",
            "pembelian" => $pembelian,
            "pembelianDetail" => $pembelianDetail,
        ]);
    }
}
