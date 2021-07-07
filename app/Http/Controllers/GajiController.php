<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Kehadiran;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GajiController extends Controller
{
    public function index()
    {
        $gaji = Gaji::get();
        $users = User::with('karyawan')->get();
        return view('gaji.index', compact('gaji', 'users'));
    }

    public function store(Request $request)
    {
        Gaji::updateOrCreate(
            [
                'user_id' => request('user'),
            ],
            [
                'nohp' => request('nohp'),
                'tgl_masuk' => request('tgl_masuk'),
                'tgl_bayar' => request('tgl_bayar'),
                'gaji' => request('gaji'),
            ]
        );

        return redirect()->back()->with('masuk', 'Gaji Karyawan berhasil ditambahkan');
    }

    public function update(Request $request, Gaji $gaji)
    {
        $gaji->update([
            'nohp' => request('nohp'),
            'tgl_masuk' => request('tgl_masuk'),
            'tgl_bayar' => request('tgl_bayar'),
            'gaji' => request('gaji'),
        ]);

        return redirect()->back()->with('masuk', 'Gaji Karyawan berhasil diupdate');
    }

    public function destroy(Gaji $gaji)
    {
        //
    }

    public function laporan()
    {
        $users = User::with('karyawan')->get();
        $gaji = null;

        if (request('user') && request('bulan')) {
            $gaji = Gaji::where('user_id', request('user'))->first();
            $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', request('user'))->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->whereMonth('tanggal', '=', request('bulan'))->get();
            $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', request('user'))->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->whereMonth('tanggal', '=', request('bulan'))->get();

            $totalPend = 0;
            $totalPeng = 0;

            return view('gaji.laporan', compact('users', 'gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng'));
        } else {
            return view('gaji.laporan', compact('users', 'gaji'));
        }
    }

    public function slip()
    {
        $id = auth()->user()->id;
        $months = Kehadiran::with('user')->where('user_id', $id)->groupBy(DB::raw("DATE_FORMAT(tanggal, '%m-%Y')"))->get();

        return view('gaji.slip', compact('months'));
    }

    public function laporanKaryawan($tanggal)
    {
        $tgl = Carbon::parse($tanggal)->format('m');
        $id = auth()->user()->id;
        $gaji = Gaji::where('user_id', $id)->first();

        $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->whereMonth('tanggal', '=', $tgl)->get();
        $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->whereMonth('tanggal', '=', $tgl)->get();

        $totalPend = 0;
        $totalPeng = 0;

        return view('gaji.laporan', compact('gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng'));
    }
}
