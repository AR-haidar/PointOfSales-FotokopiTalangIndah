<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

use App\Models\Laporan;
use App\Models\Penjualan;
use App\Models\Pembelian;
use App\Models\PenjualanDetail;
use Illuminate\Support\Carbon;


class LaporanController extends Controller
{
    public function index()
    {
        $pengeluaran = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
            ->select(
                'pembelian_detail.id',
                'pembelian.waktu',
                'barang.nama_barang',
                'barang.harga_awal',
                DB::raw('SUM(pembelian_detail.qty) as barangMasuk'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->groupBy('pembelian_detail.id')
            ->get();


        $pemasukan = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
            ->select(
                'penjualan.waktu',
                'barang.nama_barang',
                'barang.harga_jual',
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->groupBy('penjualan_detail.id')
            ->get();

        return view('page.laporan-penjualan')->with([
            "title" => "Laporan Penjualan",
            "sidebar" => "laporan-jual",
            "pemasukan" => $pemasukan,
            "pengeluaran" => $pengeluaran
        ]);
    }

    // public function cari(Request $request)
    // {
    //     $bulan = $request->bulan;
    //     $tahun = $request->tahun;

    //     $request->session()->forget('bulan');
    //     $request->session()->forget('tahun');


    //     if ($bulan == null && $tahun == null) {
    //         return redirect()->back();
    //     } else if ($bulan == null) {
    //         return redirect()->back();
    //     } else if ($tahun == null) {
    //         return redirect()->back();
    //     }


    //     $pengeluaran = DB::table('pembelian')
    //         ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
    //         ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
    //         ->select(
    //             'pembelian_detail.id',
    //             'pembelian.waktu',
    //             'barang.nama_barang',
    //             'barang.harga_awal',
    //             DB::raw('SUM(pembelian_detail.qty) as barangMasuk'),
    //             DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
    //         )
    //         // ->whereYear('pembelian.waktu', $tahun)
    //         // ->whereMonth('pembelian.waktu', $bulan)
    //         ->whereBetween('pembelian.waktu',[])
    //         ->groupBy('pembelian_detail.id_barang')
    //         ->get();

    //     $pemasukan = DB::table('penjualan')
    //         ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
    //         ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
    //         ->select(
    //             'penjualan.waktu',
    //             'barang.nama_barang',
    //             'barang.harga_jual',
    //             DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
    //             DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
    //         )
    //         ->whereYear('penjualan.waktu', $tahun)
    //         ->whereMonth('penjualan.waktu', $bulan)
    //         ->groupBy('penjualan_detail.id_barang')
    //         ->get();


    //     Session::put('bulan', $request->bulan);
    //     Session::put('tahun', $request->tahun);

    //     return view('page.laporan-penjualan')->with([
    //         "title" => "Laporan Penjualan",
    //         "sidebar" => "laporan-jual",
    //         "pemasukan" => $pemasukan,
    //         "pengeluaran" => $pengeluaran,
    //         "sesBulan" => Session::get('bulan'),
    //         "sesTahun" => Session::get('tahun')
    //     ]);
    // }
    public function cari(Request $request)
    {
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;

        $request->session()->forget('tglawal');
        $request->session()->forget('tglakhir');


        if ($tglawal == null && $tglakhir == null) {
            return redirect()->back();
        } else if ($tglawal == null) {
            return redirect()->back();
        } else if ($tglakhir == null) {
            return redirect()->back();
        }


        $pengeluaran = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
            ->select(
                'pembelian_detail.id',
                'pembelian.waktu',
                'pembelian.tanggal',
                'barang.nama_barang',
                'barang.harga_awal',
                DB::raw('SUM(pembelian_detail.qty) as barangMasuk'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            // ->whereYear('pembelian.waktu', $tahun)
            // ->whereMonth('pembelian.waktu', $bulan)
            ->whereBetween('pembelian.tanggal', [$tglawal, $tglakhir])
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        $pemasukan = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
            ->select(
                'penjualan.waktu',
                'penjualan.tanggal',
                'barang.nama_barang',
                'barang.harga_jual',
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->whereBetween('penjualan.tanggal', [$tglawal, $tglakhir])
            ->groupBy('penjualan_detail.id_barang')
            ->get();


        Session::put('tglawal', $request->tglawal);
        Session::put('tglakhir', $request->tglakhir);

        return view('page.laporan-penjualan')->with([
            "title" => "Laporan Penjualan",
            "sidebar" => "laporan-jual",
            "pemasukan" => $pemasukan,
            "pengeluaran" => $pengeluaran,
            "sesAwal" => Session::get('tglawal'),
            "sesAkhir" => Session::get('tglakhir')
        ]);
    }

    // public function cetaklaporan($bulan, $tahun)
    // {
    //     $pengeluaran = DB::table('pembelian')
    //         ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
    //         ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
    //         ->select(
    //             'pembelian_detail.id',
    //             'pembelian.waktu',
    //             'barang.nama_barang',
    //             'barang.harga_awal',
    //             DB::raw('SUM(pembelian_detail.qty) as barangMasuk'),
    //             DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
    //         )
    //         ->whereMonth('pembelian.waktu', $bulan)
    //         ->whereYear('pembelian.waktu', $tahun)
    //         ->groupBy('pembelian_detail.id_barang')
    //         ->get();

    //     $pemasukan = DB::table('penjualan')
    //         ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
    //         ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
    //         ->select(
    //             'penjualan.waktu',
    //             'barang.nama_barang',
    //             'barang.harga_jual',
    //             DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
    //             DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
    //         )
    //         ->whereMonth('penjualan.waktu', $bulan)
    //         ->whereYear('penjualan.waktu', $tahun)
    //         ->groupBy('penjualan_detail.id_barang')
    //         ->get();

    //     $stokbarang = DB::table('barang')
    //         ->where('stok', '<', 20)
    //         ->orderBy('stok', 'asc')
    //         ->get();
    //     return view('page.cetak-laporan-penjualan')->with([
    //         "pemasukan" => $pemasukan,
    //         "pengeluaran" => $pengeluaran,
    //         "stok" => $stokbarang,
    //         "bulan" => $bulan,
    //         "tahun" => $tahun,
    //     ]);
    // }
    public function cetaklaporan($tglawal, $tglakhir)
    {
        $pengeluaran = DB::table('pembelian')
            ->join('pembelian_detail', 'pembelian.no_pembelian', '=', 'pembelian_detail.no_pembelian')
            ->join('barang', 'barang.id_barang', '=', 'pembelian_detail.id_barang')
            ->select(
                'pembelian_detail.id',
                'pembelian.waktu',
                'pembelian.tanggal',
                'barang.nama_barang',
                'barang.harga_awal',
                DB::raw('SUM(pembelian_detail.qty) as barangMasuk'),
                DB::raw('(SUM(pembelian_detail.qty) * pembelian_detail.harga_awal) AS pengeluaran')
            )
            ->whereBetween('pembelian.tanggal', [$tglawal, $tglakhir])
            ->groupBy('pembelian_detail.id_barang')
            ->get();

        $pemasukan = DB::table('penjualan')
            ->join('penjualan_detail', 'penjualan.no_penjualan', '=', 'penjualan_detail.no_penjualan')
            ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
            ->select(
                'penjualan.waktu',
                'penjualan.tanggal',
                'barang.nama_barang',
                'barang.harga_awal',
                'barang.harga_jual',
                DB::raw('SUM(penjualan_detail.qty) as barangTerjual'),
                DB::raw('(SUM(penjualan_detail.qty) * penjualan_detail.harga_jual) AS pemasukan')
            )
            ->whereBetween('penjualan.tanggal', [$tglawal, $tglakhir])
            ->groupBy('penjualan_detail.id_barang')
            ->get();

        $stokbarang = DB::table('barang')
            ->where('stok', '<', 20)
            ->orderBy('stok', 'asc')
            ->get();
        return view('page.cetak-laporan-penjualan')->with([
            "pemasukan" => $pemasukan,
            "pengeluaran" => $pengeluaran,
            "stok" => $stokbarang,
            "Awal" => $tglawal,
            "Akhir" => $tglakhir,
        ]);
    }
}
