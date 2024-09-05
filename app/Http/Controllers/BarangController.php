<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

use App\Http\Requests\StoreBarangRequest;
use App\Http\Requests\UpdateBarangRequest;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Barang::orderBy('stok','asc')->get();
        return view('page.barang')->with([
            "title" => "Data Barang",
            "sidebar" => "barang",
            "barang" => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|unique:barang',
            'nama_barang' => 'required',
            'harga_awal' => 'required|numeric|min:1',
            'harga_jual' => 'required|numeric|gt:harga_awal|min:1',
        ], [
            'id_barang.unique' => 'Kode Barang ' . $request->id_barang . ' sudah ada!',
            'harga_jual.gt' => 'Harga Jual harus lebih besar dari harga beli!',
            'harga_awal.min' => 'Harga awal tidak boleh minus atau 0!',
            'harga_jual.min' => 'Harga jual tidak boleh minus atau 0!'
        ]);

        Barang::create([
            'id_barang' => $request->id_barang,
            'nama_barang' => $request->nama_barang,
            'harga_awal' => $request->harga_awal,
            'harga_jual' => $request->harga_jual
        ]);

        return redirect('/barang')->with('toast_success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang, $id)
    {
        $request->validate([
            'harga_awal' => 'required|numeric|min:1',
            'harga_jual' => 'required|numeric|gt:harga_awal|min:1',
        ], [
            'harga_jual.gt' => 'Harga Jual harus lebih besar dari harga beli!',
            'harga_awal.min' => 'Harga awal tidak boleh minus atau 0!',
            'harga_jual.min' => 'Harga jual tidak boleh minus atau 0!'
        ]);

        $data = $barang->find($id);
        $data->id = $request->id;
        $data->nama_barang = $request->nama_barang;
        $data->harga_awal = $request->harga_awal;
        $data->harga_jual = $request->harga_jual;
        $data->save();

        return redirect('/barang')->with('success','Data Berhasil DIubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus(Barang $barang, $id)
    {
        $data = $barang->find($id);
        $data->delete();
        return redirect('/barang');
    }
    // public function destroy(Barang $barang, $id)
    // {
    //     $data = $barang->find($id);
    //     $data->delete();
    //     return redirect('/barang');
    // }
}
