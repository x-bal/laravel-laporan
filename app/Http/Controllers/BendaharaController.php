<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class BendaharaController extends Controller
{
    public function index()
    {
        $bendahara = User::with('karyawan')->where('level', 'B')->get();

        return view('bendahara.index', compact('bendahara'));
    }

    public function create()
    {
        return view('bendahara.create');
    }

    public function store(Request $request)
    {
        request()->validate([
            'nama' => 'required',
            'id_karyawan' => 'required|unique:karyawans',
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
            'level' => 'B',
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

        $user->gaji()->updateOrCreate(
            [
                'user_id' => $user->id,
            ],
            [
                'gaji' => 0

            ]
        );

        return redirect()->route('bendahara.index')->with('masuk', 'Data Bendahara berhasil ditambahkan');
    }

    public function show(User $user)
    {
        //
    }

    public function edit(User $bendahara)
    {
        $bendahara = User::with('karyawan')->where('id', $bendahara->id)->first();
        return view('bendahara.edit', compact('bendahara'));
    }

    public function update(Request $request, User $bendahara)
    {
        request()->validate([
            'nama' => 'required',
            'id_karyawan' => 'required|unique:karyawans,id_karyawan,' . $bendahara->karyawan->id,
            'email' => 'required',
            'jk' => 'required',
            'nohp' => 'required',
            'pendidikan' => 'required',
            'alamat' => 'required',
        ]);


        if (request('password') != null) {
            $bendahara->update([
                'email' => request('email'),
                'password' => Hash::make(request('password')),
            ]);
        } else {
            $bendahara->update([
                'email' => request('email'),
                'password' => $bendahara->password,
            ]);
        }

        $bendahara->karyawan()->update([
            'id_karyawan' => request('id_karyawan'),
            'divisi' => request('divisi'),
            'nama' => request('nama'),
            'nohp' => request('nohp'),
            'jk' => request('jk'),
            'pendidikan' => request('pendidikan'),
            'alamat' => request('alamat'),
        ]);

        $bendahara->gaji()->updateOrCreate(
            [
                'user_id' => $bendahara->id,
            ],
            [
                'gaji' => 0

            ]
        );

        return redirect()->route('bendahara.index')->with('masuk', 'Data Bendahara berhasil diupdate');
    }

    public function destroy(User $bendahara)
    {
        $bendahara->karyawan()->delete();
        $bendahara->delete();

        return redirect()->route('bendahara.index')->with('masuk', 'Data Bendahara berhasil didelete');
    }
}
