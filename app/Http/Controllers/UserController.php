<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\Map;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $users = User::with('karyawan')->where('level', 'A')->get();
        return view('admin/index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 'A',
        ]);

        Karyawan::create([
            'user_id' => $user->id,
            'nama' => request('nama'),
            'jk' => request('jk'),
            'gaji' => 0
        ]);

        return redirect()->back()->with('masuk', 'Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $user = User::with('karyawan')->find($id);
        return view('admin/edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|unique:users',
            ]);
        }

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'jk' => $request->jk,
        ]);

        return redirect('admin')->with('update', 'Data Berhasil Di Update');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $hitung = User::where('level', 'A')->count();

        if ($hitung == 1) {
            return redirect('admin')->with('gagal', 'Tidak Bisa Menghapus Admin Karena Sisa 1 Admin');
        }

        $user->karyawan()->delete();
        $user->delete();
        return redirect('admin')->with('update', 'Data Berhasil Di Hapus');
    }

    public function index2()
    {

        $users = User::with('karyawan')->where('level', 'U')->get();
        return view('user/index', compact('users'));
    }

    public function store2(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'level' => 'U',
        ]);

        $user->karyawan()->create([
            'jk' => $request->jk,
            'nama' => $request->nama,
        ]);

        return redirect()->back()->with('masuk', 'Data Berhasil Di Input');
    }

    public function edit2($id)
    {
        $user = User::with('karyawan')->find($id);
        return view('user/edit', compact('user'));
    }

    public function update2(Request $request)
    {
        $user = User::find($request->id);

        if ($request->email != $user->email) {
            $request->validate([
                'email' => 'required|unique:users',
            ]);
        }

        $user->update([
            'email' => $request->email,
        ]);

        $user->karyawan()->update([
            'nama' => $request->nama,
            'jk' => $request->jk,
        ]);

        return redirect('user')->with('update', 'Data Berhasil Di Update');
    }

    public function delete2($id)
    {
        $user = User::find($id);
        $hitung = Map::where('user_id', $id)->count();

        if ($hitung != 0) {
            return redirect('user')->with('gagal', 'Tidak Bisa Menghapus User Karena User Tersebut Sudah Mengerjakan Salah Satu Map');
        }

        $user->karyawan()->delete();
        $user->delete();
        return redirect('user')->with('update', 'Data Berhasil Di Hapus');
    }
}
