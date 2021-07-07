<?php

namespace App\Http\Controllers;

use App\Jenis;
use Illuminate\Http\Request;

class JenisController extends Controller
{
    public function index()
    {
        $jenis = Jenis::where('id', '!=', 1)->where('id', '!=', 4)->get();
        return view('jenis.index', compact('jenis'));
    }

    public function store()
    {
        Jenis::create([
            'name' => request('nama'),
            'nominal' => request('nominal'),
        ]);

        return redirect()->back()->with('masuk', 'Jenis berhasil ditambahkan');
    }

    public function update($id)
    {
        $jenis = Jenis::find($id);
        $jenis->update([
            'name' => request('nama'),
            'nominal' => request('nominal'),
        ]);

        return redirect()->back()->with('masuk', 'Jenis berhasil diupdate');
    }
}
