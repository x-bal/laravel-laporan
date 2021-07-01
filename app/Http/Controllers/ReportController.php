<?php

namespace App\Http\Controllers;

use App\Error;
use App\Exports\MapError;
use App\Exports\MapFinish;
use App\Exports\MapIn as ExportsMapIn;
use App\Exports\MapProgress;
use App\Exports\MapTotal;
use App\Map;
use App\WorkMap;
use Illuminate\Http\Request;
use Excel;
use Exports\MapIn;

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
      
        $in = Map::whereBetween('created_at',[$request->req1,$request->req2])->get();

            $hitung=count($in);
            $req1=$request->req1;
            $req2=$request->req2;

        return view('report/in/index', compact('in','req1','req2','hitung'));
    }

    public function exportIn(Request $request)
    {
        $data = Map::whereBetween('created_at',[$request->req1,$request->req2])->get();
        return Excel::download(new ExportsMapIn($data), 'mapin.xlsx');
    }

    public function finish(Request $request)
    {
      
        $workMap = WorkMap::whereBetween('finish_on',[$request->req1,$request->req2])->get();

            $hitung=count($workMap);
            $req1=$request->req1;
            $req2=$request->req2;

        return view('report/finish/index', compact('workMap','req1','req2','hitung'));
    }

    public function exportFinish(Request $request)
    {
        $data = WorkMap::whereBetween('finish_on',[$request->req1,$request->req2])->get();
        return Excel::download(new MapFinish($data), 'mapFinish.xlsx');
    }
    
    public function error(Request $request)
    {
      
        $error = Error::whereBetween('date',[$request->req1,$request->req2])->get();

            $hitung=count($error);
            $req1=$request->req1;
            $req2=$request->req2;

        return view('report/error/index', compact('error','req1','req2','hitung'));
    }

    public function exportError(Request $request)
    {
        $data = Error::whereBetween('date',[$request->req1,$request->req2])->get();
        return Excel::download(new MapError($data), 'mapError.xlsx');
    }

    public function progress()
    {
        $workMap = WorkMap::where('finish_on',null)->get();
        return view('report/progress/index', compact('workMap'));
    }

    public function exportProgress()
    {
        $data = WorkMap::where('finish_on',null)->get();
        return Excel::download(new MapProgress($data), 'Map Progress.xlsx');
    }

    public function total()
    {
        $workMap = WorkMap::orderBy('user_id', 'ASC')->get();
        return view('report/total/index', compact('workMap'));
    }

    public function exportTotal()
    {
        $data = WorkMap::orderBy('user_id', 'ASC')->get();
        return Excel::download(new MapTotal($data), 'Map Total.xlsx');
    }
    
}
