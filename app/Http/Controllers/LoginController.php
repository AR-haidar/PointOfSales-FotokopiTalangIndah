<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\LoginHistory;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.login');
    }

    public function login(Request $request)
    {
        $login = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($login)) {

            $request->session()->regenerate();
            $user = Auth::user();
            LoginHistory::create([
                'user_id'    => $user->id,
                'login_at'   => now(),
            ]);

            return redirect()->intended('/dashboard')->with('toast_success', 'Berhasil Login');
        }

        alert()->error('Login Gagal', 'Username atau Password salah')
            ->showConfirmButton('OK', '#ff1c45')
            ->autoClose(4000);
        return redirect('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function histori()
    {
        if (auth()->user()->role != 'Admin') {
            return redirect()->back();
        }
        
        $data = DB::table('login_histories')
        ->join('users', 'users.id', '=', 'login_histories.user_id')
        ->select('users.name', 'users.pic', 'login_histories.*')
        ->latest()
        ->get();

        return view('page.histori-login')->with([
            "data" => $data
        ]);
    }
}
