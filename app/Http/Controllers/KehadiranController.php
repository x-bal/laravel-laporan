<?php

namespace App\Http\Controllers;

use App\Jenis;
use App\Karyawan;
use App\Kehadiran;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class KehadiranController extends Controller
{
    public function index()
    {
        // Setting Limit
        $limit = 12;

        $users = User::get();
        $jeniss = Jenis::get();
        if (request('jenis')) {
            $jenis = Jenis::find(request('jenis'));

            $kehadiran = Kehadiran::with('user')->where('jeni_id', request('jenis'))->where('status', 'Diproses')->latest()->get();

            $accept = Kehadiran::with('user')->where('jeni_id', request('jenis'))->where('status', 'Disetujui')->latest()->get();

            $reject = Kehadiran::with('user')->where('jeni_id', request('jenis'))->where('status', 'Ditolak')->latest()->get();
        } else {
            $kehadiran = null;
        }
        return view('kehadiran.index', compact('kehadiran', 'jenis', 'users', 'accept', 'reject', 'jeniss', 'limit'));
    }

    public function create()
    {
        $totalCuti = Kehadiran::where('jeni_id', 4)->where('user_id', auth()->user()->id)->where('status', 'Disetujui')->count();
        // Setting Limit
        $limit = 12;

        $now = Carbon::now();
        $start = Carbon::parse("07:00:00")->format("Y-m-d H:i:s");
        $end = Carbon::parse("21:00:00")->format("Y-m-d H:i:s");

        $where = [
            'user_id' => auth()->user()->id,
        ];

        $hadir = Kehadiran::where($where)->whereDate('created_at', date('Y-m-d'))->first();

        $jenis = Jenis::where('id', '!=', 1)->where('name', '!=', 'Lembur')->where('name', '!=', 'BPJS')->where('name', '!=', 'Izin Setengah Hari')->where('name', '!=', 'Tidak Hadir')->get();


        return view('kehadiran.create', compact('jenis', 'hadir', 'start', 'end', 'now'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->level == 'A') {
            Kehadiran::create([
                'user_id' => request('user'),
                'jeni_id' => request('jenis'),
                'tanggal' => Carbon::now(),
                'dari' => request('dari'),
                'sampai' => request('sampai'),
                'keterangan' => request('keterangan'),
            ]);

            return redirect()->back()->with('masuk', 'Kehadiran berhasil dilakukan');
        } else {
            if (request('jenis') == 5) {
                Kehadiran::create([
                    'user_id' => auth()->user()->id,
                    'jeni_id' => request('jenis'),
                    'tanggal' => Carbon::now(),
                    'dari' => request('dari'),
                    'sampai' => request('sampai'),
                    'keterangan' => request('keterangan'),
                ]);

                return redirect()->back()->with('masuk', 'Lembur berhasil dilakukan');
            } elseif (request('jenis')) {
                Kehadiran::create([
                    'user_id' => auth()->user()->id,
                    'jeni_id' => request('jenis'),
                    'tanggal' => Carbon::now(),
                    'dari' => request('dari'),
                    'sampai' => request('sampai'),
                    'keterangan' => request('keterangan'),
                ]);

                return redirect()->back()->with('masuk', 'Izin berhasil dilakukan');
            } else {
                Kehadiran::create([
                    'user_id' => auth()->user()->id,
                    'jeni_id' => 1,
                    'tanggal' => Carbon::now(),
                    'keterangan' => 'Hadir'
                ]);

                return redirect()->back()->with('masuk', 'Kehadiran berhasil diajukan');
            }
        }
    }

    public function show(Kehadiran $kehadiran)
    {
        return view('kehadiran.show', compact('kehadiran'));
    }

    public function edit(Kehadiran $kehadiran)
    {
        //
    }

    public function update(Request $request, Kehadiran $kehadiran)
    {
        //
    }

    public function destroy(Kehadiran $kehadiran)
    {
        $kehadiran->delete();

        return back()->with('masuk', 'Kehadiran berhasil dihapus');
    }

    public function lembur()
    {
        return view('kehadiran.lembur');
    }

    public function accept(Kehadiran $kehadiran)
    {
        $kehadiran->update([
            'status' => 'Disetujui'
        ]);

        return redirect()->back()->with('masuk', 'Kehadiran berhasil disetujui');
    }

    public function reject(Kehadiran $kehadiran)
    {
        $kehadiran->update([
            'status' => 'Ditolak'
        ]);

        return redirect()->back()->with('masuk', 'Kehadiran berhasil ditolak');
    }

    public function cuti($id)
    {
        $karyawan = Karyawan::where('user_id', $id)->first();
        $cuti = [];

        // Setting Limit
        $limit = 12;

        if (request('tahun')) {
            $where = [
                'user_id' => $id,
                'jeni_id' => 4,
                'status' => 'Disetujui'
            ];

            $cuti = Kehadiran::with('user')->where($where)->whereYear('created_at', request('tahun'))->latest()->get();

            return view('kehadiran.cuti', compact('karyawan', 'cuti', 'limit'));
        }

        return view('kehadiran.cuti', compact('karyawan', 'cuti', 'limit'));
    }
}
