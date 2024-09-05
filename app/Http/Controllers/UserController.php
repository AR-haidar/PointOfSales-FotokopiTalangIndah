<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->role != 'Admin') {
            return redirect()->back();
        }

        $users = DB::table('users')
            ->where('id', '!=', auth()->user()->id)
            ->latest()
            ->get();
        return view('page.petugas')->with([
            "title" => "Data Petugas",
            "sidebar" => "petugas",
            "users" => $users
        ]);
    }

    public function profile()
    {
        $user = DB::table('users')
            ->where('id', '=', auth()->user()->id)
            ->get();
        return view('page.profile')->with([
            "title" => "NAON",
            "user" => $user
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
        $validateData = $request->validate([
            'username' => 'required|unique:users',
            'name' => 'required',
            'notelp' => 'required',
            'posisi' => 'required',
            'pic' => 'image|mimes:jpeg,png,jpg',
        ]);

        if ($request->hasFile('pic')) {
            $validateData['pic'] = $request->file('pic')->store('user-images');

            User::create(
                [
                    'username' => $request->username,
                    'name' => $request->name,
                    'notelp' => $request->notelp,
                    'password' => Hash::make(123),
                    'role' => $request->role,
                    'pic' => $validateData['pic']
                ],
            );
        } else {

            User::create(
                [
                    'username' => $request->username,
                    'name' => $request->name,
                    'notelp' => $request->notelp,
                    'password' => Hash::make(123),
                    'role' => $request->role,
                    'pic' => null
                ],
            );
        }

        return redirect('/petugas')->with('toast_success', 'Data Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $id)
    {

        if (auth()->user()->role != 'Admin') {
            return redirect()->back();
        }
        return view('page.petugas-detail')->with([
            'data' => $id,
            // 'users' => User::all(),
            'title' => 'Detail Petugas',
            "sidebar" => "petugas"
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateProfile(Request $request, User $user, string $id)
    {
        $request->validate([
            'username' => 'required',
            'name' => 'required',
            'notelp' => 'required',
            'role' => 'required',
        ]);

        $data = $user->find($id);
        $data->id = $request->id;
        $data->username = $request->username;
        $data->name = $request->name;
        $data->notelp = $request->notelp;
        $data->role = $request->role;
        $data->save();

        return back()->with('toast_success', 'Data Berhasil Diubah');
    }
    public function updatePW(Request $request, User $user, string $id)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $data = $user->find($id);
        $data->password = bcrypt($request->password);
        $data->save();

        return back()->with('toast_success', 'Password Berhasil diubah');
    }

    public function updatePic(Request $request, User $user, string $id)
    {

        if ($request->hasFile('pic')) {
            if ($request->oldPic) {
                Storage::delete($request->oldPic);
            }

            $validateData = $request->validate(['pic' => 'image']);
            $validateData['pic'] = $request->file('pic')->store('user-images');

            // $data = $user->find($id);
            // $data->pic = $validateData['pic'];
            User::where('id', $id)
                ->update(['pic' => $validateData['pic']]);
            return back()->with('toast_success', 'Gambar berhasil diubah');
        }
        return redirect()->back();
    }

    public function deletePic(User $user, $id)
    {
        $data = $user->find($id);
        if ($data->pic) {
            Storage::delete($data->pic);
        }
        $data->update(['pic' => null]);
        return redirect()->back()->with('toast_success', 'Foto berhasil dihapus');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapus(User $user, $id)
    {
        $data = $user->find($id);
        $data->delete();
        if ($data->pic) {
            Storage::delete($data->pic);
        }
        return redirect('/petugas')->with('toast_success', 'Data Berhasil Dihapus');
    }
}
