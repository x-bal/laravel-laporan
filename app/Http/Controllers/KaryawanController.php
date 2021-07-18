<?php

namespace App\Http\Controllers;

use App\Karyawan;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class KaryawanController extends Controller
{
    public function index()
    {
        $users = User::with('karyawan')->where('level', 'U')->get();
        return view('karyawan.index', compact('users'));
    }

    public function create()
    {
        return view('karyawan.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'id_karyawan' => 'required',
            'divisi' => 'required',
            'email' => 'required',
            'password' => 'required',
            'jk' => 'required',
            'nohp' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
        ]);

        $user = User::create([
            'email' => request('email'),
            'password' => Hash::make(request('password')),
            'level' => 'U',
        ]);

        $user->karyawan()->create([
            'divisi' => request('divisi'),
            'id_karyawan' => request('id_karyawan'),
            'nama' => request('nama'),
            'nohp' => request('nohp'),
            'jk' => request('jk'),
            'pendidikan' => request('pendidikan'),
            'alamat' => request('alamat'),
        ]);

        return redirect()->route('karyawan.index')->with('masuk', 'Data Karyawan berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Karyawan  $karyawan
     * @return \Illuminate\Http\Response
     */
    public function show(Karyawan $karyawan)
    {
        //
    }

    public function edit($id)
    {
        $user = User::with('karyawan')->where('id', $id)->first();
        return view('karyawan.edit', compact('user'));
    }

    public function update($id)
    {
        request()->validate([
            'nama' => 'required',
            'id_karyawan' => 'required',
            'email' => 'required',
            'jk' => 'required',
            'nohp' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
            'divisi' => 'required',
        ]);

        $user = User::with('karyawan')->where('id', $id)->first();

        if (request('password') != 'null') {
            $user->update([
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);
        } else {
            $user->update([
                'email' => request('email'),
            ]);
        }

        $user->karyawan()->update([
            'id_karyawan' => request('id_karyawan'),
            'divisi' => request('divisi'),
            'nama' => request('nama'),
            'nohp' => request('nohp'),
            'jk' => request('jk'),
            'pendidikan' => request('pendidikan'),
            'alamat' => request('alamat'),
        ]);

        return redirect()->route('karyawan.index')->with('masuk', 'Data Karyawan berhasil diupdate');
    }

    public function destroy($id)
    {
        $user = User::find($id);
        $user->karyawan()->delete();
        $user->delete();

        return redirect()->route('karyawan.index')->with('masuk', 'Data Karyawan berhasil didelete');
    }
}
