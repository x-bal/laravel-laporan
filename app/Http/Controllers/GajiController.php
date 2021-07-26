<?php

namespace App\Http\Controllers;

use App\Gaji;
use App\Jenis;
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

        if (request('divisi')) {

            if (request('divisi') == 'all') {
                $gaji = User::with('karyawan', 'gaji', 'karyawan')->where('level', '!=', 'A')->get();

                return view('gaji.print', compact('gaji'));
            }

            $gaji = User::with('karyawan', 'gaji', 'karyawan')->whereHas('karyawan', function ($query) {
                return $query->where('divisi', request('divisi'));
            })->get();

            return view('gaji.print', compact('gaji'));
        }

        return view('gaji.index', compact('gaji', 'users'));
    }

    public function store(Request $request)
    {
        Gaji::updateOrCreate(
            [
                'user_id' => request('user'),
            ],
            [
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
        $bpjs = Jenis::find(6);

        if (request('user') && request('bulan')) {
            $gaji = Gaji::where('user_id', request('user'))->first();
            $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', request('user'))->where('jeni_id', 5)->where('status', 'Disetujui')->whereMonth('tanggal', '=', request('bulan'))->get();

            $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', request('user'))->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('jeni_id', '!=', '6')->where('status', 'Disetujui')->whereMonth('tanggal', '=', request('bulan'))->get();

            $totalPend = 0;
            $totalPeng = 0;

            return view('gaji.laporan', compact('users', 'gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'bpjs'));
        } else {
            return view('gaji.laporan', compact('users', 'gaji', 'bpjs'));
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

        $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '5')->whereMonth('tanggal', '=', $tgl)->get();

        $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $tgl)->get();

        $totalPend = 0;
        $totalPeng = 0;
        $bpjs = Jenis::find(6);

        return view('gaji.laporan', compact('gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'bpjs'));
    }

    public function generate($tanggal = null)
    {
        $tgl = Carbon::parse($tanggal)->format('m');
        $id = auth()->user()->id;

        $bpjs = Jenis::find(6);

        $gaji = Gaji::where('user_id', $id)->first();

        $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $tgl)->get();

        $lembur = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '5')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $tgl)->get();

        $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $tgl)->get();

        $totalPend = 0;
        $totalPeng = 0;
        $totalLem = 0;

        return view('gaji.generate', compact('gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'totalLem', 'bpjs', 'lembur'));
    }

    public function generateAdmin($id = null, $bulan = null)
    {

        $gaji = Gaji::where('user_id', $id)->first();

        $user = User::with('karyawan')->find($id);
        $bpjs = Jenis::find(6);
        $pendapatan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $bulan)->get();

        $lembur = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '5')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $bulan)->get();


        $pengurangan = Kehadiran::with('user', 'jenis')->where('user_id', $id)->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('status', 'Disetujui')->whereMonth('tanggal', '=', $bulan)->get();

        $totalPend = 0;
        $totalPeng = 0;
        $totalLem = 0;

        return view('gaji.generate', compact('gaji', 'pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'user', 'bpjs', 'lembur', 'totalLem'));
    }
}
