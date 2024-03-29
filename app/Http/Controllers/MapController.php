<?php

namespace App\Http\Controllers;

use App\Map;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $map = Map::all();
        return view('map/index', compact('map'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_map' => 'unique:maps'
        ]);

        Map::create([
            'id_map' => $request->id_map,
            'name' => $request->name,
            'status' => $request->status,
            'date_adopted' => $request->date_adopted,
            'date_expired' => $request->date_expired,
            'priority' => $request->priority,
        ]);

        return redirect()->back()->with('masuk', 'Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $map = Map::find($id);
        return view('map/edit', compact('map'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'id_map' => 'unique:maps,id_map,' . $request->id,
        ]);

        $map = Map::find($request->id);

        $map->update([
            'id_map' => $request->id_map,
            'name' => $request->name,
            'status' => $request->status,
            'date_adopted' => $request->date_adopted,
            'date_expired' => $request->date_expired,
            'priority' => $request->priority,
        ]);

        return redirect('map')->with('update', 'Data Berhasil Di Update');
    }

    public function delete($id)
    {
        $map = Map::find($id);

        if ($map->user_id != null) {
            return redirect()->back()->with('gagal', 'Tidak bisa menghapus map yang sudah di kerjakan oleh karyawan');
        }

        $map->delete();
        return redirect()->back()->with('update', 'Berhasil Menghapus Data');
    }
}
