<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use App\Models\Barang;
use App\Models\Keranjang2;
use App\Models\Penjualan;
use App\Models\PenjualanDetail;

class BarangMasukController extends Controller
{
    public function index()
    {
        if (auth()->user()->role != 'Admin') {
            return redirect()->back();
        }
        return view('page.barang-masuk', [
            "title" => "Barang Masuk",
            "sidebar" => "barang masuk",
            "barang" => DB::table('barang')->orderBy('stok','ASC')->get(),
            "keranjang" => DB::table('keranjang2')
                ->join('barang', 'keranjang2.id_barang', '=', 'barang.id_barang')
                ->select('barang.nama_barang', 'keranjang2.*')
                ->get(),
            "nobon" => Session::get('nobon'),
            "supplier" => Session::get('supplier')
        ]);
    }

    public function toKeranjang(Request $request, Barang $a, $id)
    {
        $barang = $a->find($id);

        //cek barang sudah ada di keranjang atau tidak
        $count = DB::table('keranjang2')
            ->where('id_barang', "=", $barang->id_barang)
            ->count();

        //tambah barang yang belum ada di keranjang
        if ($count == 0) {
            Keranjang2::create([
                'id_barang' => $barang->id_barang,
                'harga_awal'  => $barang->harga_awal,
                'qty' => 1,
                'subtotal' => ($barang->harga_awal) * 1
            ]);

            //tambah qty barang jika barang sudah ada di keranjang
        } else {
            $query = DB::table('keranjang2')
                ->where('id_barang', "=", $barang->id_barang)
                ->get();

            foreach ($query as $query) {
                DB::table('keranjang2')
                    ->where('id_barang', "=", $query->id_barang)
                    ->update([
                        'qty' => $query->qty + 1,
                        'subtotal' => $query->harga_awal * ($query->qty + 1)
                    ]);
            }
        }

        return redirect('/barangMasuk');
        // return view('test', ["count" => $count, "keranjang" => $query1]);
    }

    public function bayar(Request $request)
    {
        $keranjangCount = DB::table('keranjang2')->count();
        if ($keranjangCount <= 0) {
            return redirect('/barangMasuk')->with('info', 'Keranjang masih kosong!');
        }

        $request->validate([
            "total" => "required",
            "nobon" => "required",
            "supplier" => "required",
        ]);

        $total = $request->total;
        $nobon = $request->nobon;
        $supplier = $request->supplier;

        $keranjang = DB::table('keranjang2')->get();
        foreach ($keranjang as $keranjang) {
            DB::table('barang')
                ->where('id_barang', '=', $keranjang->id_barang)
                ->increment('stok', $keranjang->qty);
        }

        $no_pembelian = "BL" . Carbon::now()->setTimezone('Asia/Jakarta')->format('YmdHis');

        DB::table('pembelian')
            ->insert([
                'no_pembelian' => $no_pembelian,
                'no_bon' => $nobon,
                'supplier' => $supplier,
                'id_petugas' => auth()->user()->id,
                'tanggal' =>  date(now()),
                'total' => $total,
                'waktu' =>  now(),
                // 'created_at' => now()
            ]);

        DB::statement("INSERT INTO pembelian_detail (no_pembelian, id_barang, harga_awal, qty, subtotal) 
                        SELECT '$no_pembelian', id_barang, harga_awal, qty, subtotal FROM keranjang2");


        DB::table('keranjang2')->truncate();
        // DB::statement('CALL transaksi_penjualan (?,?,?,?,?)', [$no_penjualan, auth()->user()->id, $total, $bayar, $kembali]);

        $request->session()->forget('nobon');
        $request->session()->forget('supplier');
        return redirect('/barangMasuk')->with('toast_success', 'Data Berhasil diInput');
    }

    public function resetKeranjang()
    {
        DB::table('keranjang2')->truncate();
        return redirect('/barangMasuk');
    }

    public function refreshKeranjang(Request $request, Barang $barang, Keranjang2 $keranjang, $id)
    {
        $data = $keranjang->find($id);

        $data->qty = $request->qty;
        $data->subtotal = $data->harga_awal * $request->qty;
        $data->save();


        return redirect('/barangMasuk');
    }

    public function hapusKeranjang(Keranjang2 $keranjang, $id)
    {
        $data = $keranjang->find($id);
        $data->delete();
        return redirect('/barangMasuk');
    }

    public function session(Request $request)
    {
        Session::put('nobon', $request->nobon);
        Session::put('supplier', $request->supplier);
        return back();
    }
}
