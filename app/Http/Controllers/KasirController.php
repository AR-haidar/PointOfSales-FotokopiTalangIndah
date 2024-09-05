<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Keranjang;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;

class KasirController extends Controller
{
    public function index()
    {
        return view('page.kasir')->with([
            "title"  => "Kasir",
            "sidebar" => "kasir",
            // "barang" => Barang::all(),
            "barang" => DB::table('barang')
                // ->where('stok', '!=', 0)
                ->get(),
            // "keranjang" => Keranjang::all(),
            "keranjang" => DB::table('keranjang')
                ->join('barang', 'keranjang.id_barang', '=', 'barang.id_barang')
                ->select('barang.nama_barang', 'keranjang.*')
                ->get()
        ]);
    }



    public function bayar(Request $request)
    {
        $total = $request->total;
        $bayar = $request->bayar;
        $kembali = $request->kembali;


        $keranjangCount = DB::table('keranjang')->count();
        if ($keranjangCount <= 0) {
            return redirect('/kasir')->with('info', 'Keranjang masih kosong!');
        }

        if ($kembali < 0) {
            return redirect('/kasir')->with('info', 'Uang Bayar Kurang');
        }

        $keranjang = DB::table('keranjang')->get();
        foreach ($keranjang as $keranjang) {
            DB::table('barang')
                ->where('id_barang', '=', $keranjang->id_barang)
                ->decrement('stok', $keranjang->qty);
        }

        $no_penjualan = Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');
        DB::table('penjualan')
            ->insert([
                'no_penjualan' => $no_penjualan,
                'id_petugas' => auth()->user()->id,
                'tanggal' => date(now()),
                'total_pembelian' => $total,
                'pembayaran' => $bayar,
                'kembalian' => $kembali,
                // 'created_at' => now()
            ]);

        DB::statement("INSERT INTO penjualan_detail (no_penjualan, id_barang, harga_awal, harga_jual, qty, subtotal) 
                        SELECT '$no_penjualan', id_barang, harga_awal, harga_jual, qty, subtotal FROM keranjang");
        DB::table('keranjang')->truncate();
        // DB::statement('CALL transaksi_penjualan (?,?,?,?,?)',[$no_penjualan, auth()->user()->id, $total, $bayar, $kembali]);
        return redirect('/struk/' . $no_penjualan);
    }

    public function struk($no_penjualan)
    {
        $head = DB::table('penjualan')
            ->join('users', 'users.id', '=', 'penjualan.id_petugas')
            ->where('penjualan.no_penjualan', '=', $no_penjualan)
            ->select('penjualan.*', 'users.name')
            ->get();
        $detail = DB::table('penjualan_detail')
            ->join('barang', 'barang.id_barang', '=', 'penjualan_detail.id_barang')
            ->where('penjualan_detail.no_penjualan', '=', $no_penjualan)
            ->select('penjualan_detail.*', 'barang.nama_barang')
            ->get();
        return view('page.struk')->with([
            "head" => $head,
            "detail" => $detail
        ]);
    }

    public function resetKeranjang()
    {
        DB::table('keranjang')->truncate();
        return redirect('/kasir');
    }

    public function toKeranjang(Request $request, Barang $a, $id)
    {
        $barang = $a->find($id);

        //cek barang sudah ada di keranjang atau tidak
        $count = DB::table('keranjang')
            ->where('id_barang', "=", $barang->id_barang)
            ->count();

        //tambah barang yang belum ada di keranjang
        if ($count == 0) {
            Keranjang::create([
                'id_barang' => $barang->id_barang,
                'harga_awal'  => $barang->harga_awal,
                'harga_jual' => $barang->harga_jual,
                'qty' => 1,
                'subtotal' => ($barang->harga_jual) * 1
            ]);

            //tambah qty barang jika barang sudah ada di keranjang
        } else {
            $query = DB::table('keranjang')
                ->where('id_barang', "=", $barang->id_barang)
                ->get();

            foreach ($query as $query) {
                if ($barang->stok - ($query->qty + 1) < 0) {
                    // #3298DC
                    alert()->Info('Info', 'Stok barang kurang!')
                        ->showConfirmButton('OK', '#3298DC')
                        ->autoClose(4000);
                    return redirect('/kasir');
                } else {
                    DB::table('keranjang')
                        ->where('id_barang', "=", $query->id_barang)
                        ->update([
                            'qty' => $query->qty + 1,
                            'subtotal' => $query->harga_jual * ($query->qty + 1)
                        ]);
                }
            }
        }

        return redirect('/kasir');
    }

    public function refreshKeranjang(Request $request, Barang $barang, Keranjang $keranjang, $id)
    {
        if (!is_numeric($request->qty)) {
            return redirect()->back()->with('error','jumlah barang harus berupa angka');
        }
        $data = $keranjang->find($id);
        $data2 = DB::table('barang')
            ->where('id_barang', '=', $data->id_barang)
            ->get();
        foreach ($data2 as $barang) {
            if ($barang->stok - $request->qty < 0) {
                alert()->Info('Info', 'Stok barang kurang!')
                    ->showConfirmButton('OK', '#3298DC')
                    ->autoClose(4000);
                return redirect('/kasir');
            } else {
                $data->qty = $request->qty;
                $data->subtotal = $data->harga_jual * $request->qty;
                $data->save();
            }
        }

        return redirect('/kasir');
    }

    public function hapusKeranjang(Keranjang $keranjang, $id)
    {
        $data = $keranjang->find($id);
        $data->delete();
        return redirect('/kasir');
    }
}
