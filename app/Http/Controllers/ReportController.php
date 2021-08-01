<?php

namespace App\Http\Controllers;

use App\Error;
use App\Exports\MapError;
use App\Exports\MapFinish;
use App\Exports\MapIn as ExportsMapIn;
use App\Exports\MapProgress;
use App\Exports\MapTotal;
use App\Map;
use App\{WorkMap, Gaji, Jenis, User, Kehadiran};
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Excel;
use Exports\MapIn;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

class ReportController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('report/index');
    }

    public function in(Request $request)
    {

        $in = Map::whereBetween('created_at', [$request->req1, $request->req2])->get();

        $hitung = count($in);
        $req1 = $request->req1;
        $req2 = $request->req2;

        return view('report/in/index', compact('in', 'req1', 'req2', 'hitung'));
    }

    public function exportIn(Request $request)
    {
        $data = Map::whereBetween('created_at', [$request->req1, $request->req2])->get();
        return Excel::download(new ExportsMapIn($data), 'mapin.xlsx');
    }

    public function finish(Request $request)
    {

        $workMap = WorkMap::whereBetween('finish_on', [$request->req1, $request->req2])->get();

        $hitung = count($workMap);
        $req1 = $request->req1;
        $req2 = $request->req2;

        return view('report/finish/index', compact('workMap', 'req1', 'req2', 'hitung'));
    }

    public function exportFinish(Request $request)
    {
        $data = WorkMap::whereBetween('finish_on', [$request->req1, $request->req2])->get();
        return Excel::download(new MapFinish($data), 'mapFinish.xlsx');
    }

    public function error(Request $request)
    {

        $error = Error::whereBetween('date', [$request->req1, $request->req2])->get();

        $hitung = count($error);
        $req1 = $request->req1;
        $req2 = $request->req2;

        return view('report/error/index', compact('error', 'req1', 'req2', 'hitung'));
    }

    public function exportError(Request $request)
    {
        $data = Error::whereBetween('date', [$request->req1, $request->req2])->get();
        return Excel::download(new MapError($data), 'mapError.xlsx');
    }

    public function progress()
    {
        $workMap = WorkMap::where('finish_on', null)->get();
        return view('report/progress/index', compact('workMap'));
    }

    public function exportProgress()
    {
        $data = WorkMap::where('finish_on', null)->get();
        return Excel::download(new MapProgress($data), 'Map Progress.xlsx');
    }

    public function total(Request $request)
    {
        $workMap = [];

        if (request('req1') && request('req2')) {
            $workMap = WorkMap::whereBetween('finish_on', [$request->req1, $request->req2])->orderBy('user_id', 'ASC')->get();
        }

        return view('report/total/index', compact('workMap'));
    }

    public function exportTotal(Request $request)
    {
        $data = [];
        if (request('req1') && request('req2')) {
            $data = WorkMap::whereBetween('finish_on', [$request->req1, $request->req2])->get();
        }


        return Excel::download(new MapTotal($data), 'Map Total.xlsx');
    }

    public function akumulasi()
    {
        if (request('req1') && request('req2')) {

            $mulai = Carbon::parse(request('req1'))->format('F');
            $sampai = Carbon::parse(request('req2'))->format('F');

            // $users = User::with('karyawan')->get();
            $akumulasi = User::with('karyawan', 'gaji',)->where('level', '!=', 'A')->get();

            $pendapatan = Kehadiran::with('user', 'jenis')->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '1')->where('status', 'Disetujui')->whereBetween('tanggal', [request('req1'), request('req2')])->get();

            $pengurangan = Kehadiran::with('user', 'jenis')->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('status', 'Disetujui')->whereBetween('tanggal', [request('req1'), request('req2')])->get();

            $totalPend = 0;
            $totalPeng = 0;
            $totalGaji = 0;
            $bpjs = Jenis::find(6);

            return view('report.gaji.akumulasi-bulanan', compact('pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'akumulasi', 'bpjs', 'totalGaji', 'mulai', 'sampai'));
        } elseif (request('tahun')) {
            $tahun = request('tahun');

            $gaji = Gaji::whereYear('created_at', '=', $tahun)->first();

            // $users = User::with('karyawan')->get();
            $akumulasi = User::with('karyawan', 'gaji', 'kehadiran')->whereHas('kehadiran', function ($query) {
                return $query->where('status', 'Disetujui')->whereYear('created_at', '=', request('tahun'));
            })->get();


            $pendapatan = Kehadiran::with('user', 'jenis')->where('jeni_id', '!=', '2')->where('jeni_id', '!=', '3')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '1')->where('status', 'Disetujui')->whereYear('tanggal', '=', $tahun)->get();

            $pengurangan = Kehadiran::with('user', 'jenis')->where('jeni_id', '!=', '1')->where('jeni_id', '!=', '4')->where('jeni_id', '!=', '5')->where('status', 'Disetujui')->whereYear('tanggal', '=', $tahun)->get();

            $totalPend = 0;
            $totalPeng = 0;
            $bpjs = Jenis::find(6);

            return view('report.gaji.akumulasi-tahunan', compact('pendapatan', 'pengurangan', 'totalPend', 'totalPeng', 'akumulasi', 'tahun', 'bpjs'));
        }

        return view('report.gaji.akumulasi');
    }

    public function cuti()
    {
        if (request('tahun')) {
            $cuti = Kehadiran::with('user', 'jenis')->where('jeni_id', '4')->where('status', 'Disetujui')->whereYear('tanggal', '=', request('tahun'))->get();

            return view('report.cuti.laporan', compact('cuti'));
        }

        return view('report.cuti.preview');
    }
}
