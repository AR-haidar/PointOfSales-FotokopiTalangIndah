<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function login()
    {
        return view('login.login');
    }
    
    public function dashboard()
    {
        return view('page.dashboard', [
            "title"   => "Dashboard",
            "sidebar" => "dashboard"
        ]);
    }
    public function petugas()
    {
        return view('page.petugas', [
            "title" => "Petugas"
        ]);
    }
    public function barang()
    {
        return view('page.barang', [
            "title" => "Barang"
        ]);
    }
    public function barangMasuk()
    {
        return view('page.barang-masuk', [
            "title" => "Barang Masuk",
            "sidebar" => "barang masuk"
        ]);
    }
}
