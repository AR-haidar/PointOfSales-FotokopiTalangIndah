<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class DashboardController extends Controller
{
    public function dashboard()
    {
        $data = DB::select("SELECT `months`.`month`,
        COALESCE(SUM(penjualan.total_pembelian),0) AS total_pembelian
        FROM (
            SELECT 1 AS MONTH UNION
            SELECT 2 UNION
            SELECT 3 UNION
            SELECT 4 UNION
            SELECT 5 UNION
            SELECT 6 UNION
            SELECT 7 UNION
            SELECT 8 UNION
            SELECT 9 UNION
            SELECT 10 UNION
            SELECT 11 UNION
            SELECT 12) AS months
        LEFT JOIN `penjualan` ON months.month = MONTH(penjualan.tanggal) AND YEAR(penjualan.tanggal) = " . date('Y') . "
        GROUP BY `months`.`month`");
        $dataMax = DB::table('penjualan')
            ->whereYear('tanggal', date('Y'))
            ->max('total_pembelian');

        $totMasuk1 = 0;
        $pemasukan1 = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->select(
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->whereMonth('penjualan.waktu', date('m'))
            ->whereYear('penjualan.waktu', date('Y'))
            ->groupBy('penjualan_detail.id_barang')
            ->get();

        $totKeluar1 = 0;
        $pengeluaran1 = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->select(
                DB::raw('SUM(pembelian_detail.qty) as barangTerjual'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->whereMonth('pembelian.waktu', date('m'))
            ->whereYear('pembelian.waktu', date('Y'))
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        foreach ($pemasukan1 as $pemasukan1) {
            $totMasuk1 += $pemasukan1->pemasukan;
        }
        foreach ($pengeluaran1 as $pengeluaran1) {
            $totKeluar1 += $pengeluaran1->pengeluaran;
        }

        $laba1 = $totMasuk1 - $totKeluar1;

        $totMasuk = 0;
        $pemasukan = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->select(
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->groupBy('penjualan_detail.id_barang')
            ->get();

        $totKeluar = 0;
        $pengeluaran = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->select(
                DB::raw('SUM(pembelian_detail.qty) as barangTerjual'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        foreach ($pemasukan as $pemasukan) {
            $totMasuk += $pemasukan->pemasukan;
        }
        foreach ($pengeluaran as $pengeluaran) {
            $totKeluar += $pengeluaran->pengeluaran;
        }

        $laba = $totMasuk - $totKeluar;

        return view('page.dashboard', [
            "title"   => "Dashboard",
            "sidebar" => "dashboard",
            "data" => $data,
            "dataMax" => $dataMax,
            "pendapatan1" => $totMasuk1,
            "pendapatan" => $totMasuk,
            "laba1" => $laba1,
            "laba" => $laba,
        ]);
    }

    public function cari($tahun)
    {
        Session::forget('tahun');

        $data = DB::select("SELECT `months`.`month`,
        COALESCE(SUM(penjualan.total_pembelian),0) AS total_pembelian
        FROM (
            SELECT 1 AS MONTH UNION
            SELECT 2 UNION
            SELECT 3 UNION
            SELECT 4 UNION
            SELECT 5 UNION
            SELECT 6 UNION
            SELECT 7 UNION
            SELECT 8 UNION
            SELECT 9 UNION
            SELECT 10 UNION
            SELECT 11 UNION
            SELECT 12) AS months
        LEFT JOIN `penjualan` ON months.month = MONTH(penjualan.tanggal) AND YEAR(penjualan.tanggal) = $tahun GROUP BY `months`.`month`");
        $dataMax = DB::table('penjualan')
        ->whereYear('tanggal', $tahun)
        ->max('total_pembelian');

        Session::put('tahun', $tahun);

        $totMasuk1 = 0;
        $pemasukan1 = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->select(
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->whereMonth('penjualan.waktu', date('m'))
            ->whereYear('penjualan.waktu', date('Y'))
            ->groupBy('penjualan_detail.id_barang')
            ->get();

        $totKeluar1 = 0;
        $pengeluaran1 = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->select(
                DB::raw('SUM(pembelian_detail.qty) as barangTerjual'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->whereMonth('pembelian.waktu', date('m'))
            ->whereYear('pembelian.waktu', date('Y'))
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        foreach ($pemasukan1 as $pemasukan1) {
            $totMasuk1 += $pemasukan1->pemasukan;
        }
        foreach ($pengeluaran1 as $pengeluaran1) {
            $totKeluar1 += $pengeluaran1->pengeluaran;
        }

        $laba1 = $totMasuk1 - $totKeluar1;

        $totMasuk = 0;
        $pemasukan = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->select(
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->groupBy('penjualan_detail.id_barang')
            ->get();

        $totKeluar = 0;
        $pengeluaran = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->select(
                DB::raw('SUM(pembelian_detail.qty) as barangTerjual'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        foreach ($pemasukan as $pemasukan) {
            $totMasuk += $pemasukan->pemasukan;
        }
        foreach ($pengeluaran as $pengeluaran) {
            $totKeluar += $pengeluaran->pengeluaran;
        }

        $laba = $totMasuk - $totKeluar;

        return view('page.dashboard', [
            "title"   => "Dashboard",
            "sidebar" => "dashboard",
            "data" => $data,
            "dataMax" => $dataMax,
            "pendapatan1" => $totMasuk1,
            "pendapatan" => $totMasuk,
            "laba1" => $laba1,
            "laba" => $laba,
            "tahun" => session()->get('tahun')
        ]);
    }
}
