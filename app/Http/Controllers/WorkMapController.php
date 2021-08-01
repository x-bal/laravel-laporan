<?php

namespace App\Http\Controllers;

use App\WorkMap;
use App\Map;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class WorkMapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $workMap = WorkMap::where('user_id', Auth::user()->id)->where('finish_on', null)->first();
        $map = Map::where('user_id', null)->get();
        return view('work-map/index', compact('workMap', 'map'));
    }

    public function store(Request $request)
    {
        WorkMap::create([
            'user_id' => $request->id,
            'map_id' => $request->map_id,
            'total_map' => $request->total_map,
            'total_key' => $request->total_key,
            'start_on' => $request->start_on,
            'progress' => 0
        ]);

        $map = Map::find($request->map_id);

        $map->update([
            'user_id' => Auth::user()->id
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
        $workMap = WorkMap::find($request->id);

        $workMap->update([
            'progress' => $request->progress,
        ]);

        return redirect('work-map')->with('update', 'Data Berhasil Di Update');
    }

    public function update2(Request $request)
    {
        $workMap = WorkMap::find($request->id);

        $workMap->update([
            'progress' => $request->progress,
        ]);

        return redirect('work-map')->with('update', 'Data Berhasil Di Update');
    }

    public function ambil_priority(Request $request)
    {
        $priority = Map::where("id", $request->map_id)
            ->pluck("priority", "id");
        return response()->json($priority);
    }

    public function finish(Request $request)
    {
        $workMap = WorkMap::find($request->id);

        if ($workMap->progress != 100) {
            return redirect()->back()->with('gagal', 'Progress belum 100 %');
        }
        $workMap->update([
            'finish_on' => $request->finish_on
        ]);

        return redirect()->back()->with('masuk', 'Pekerjaan Telah Selesai');
    }

    public function mapFinish()
    {
        $mapFinish = WorkMap::where('finish_on', '!=', null)->get();

        return view('work-map/finish-map', compact('mapFinish'));
    }

    public function laporemail()
    {
        $mapFinish = WorkMap::where('finish_on', '!=', null)->where('user_id', auth()->user()->id)->get();
        $emails = User::where('level', 'A')->get();

        return view('work-map.laporemail', compact('mapFinish', 'emails'));
    }

    public function sendemail()
    {
        $map = WorkMap::find(request('map'));
        $content  = 'Map Selesai | ' . $map->map->name . ' | Pengerja | ' . auth()->user()->karyawan->nama . ' | Tanggal | ' . Carbon::parse($map->finish_on)->format('d-m-Y');

        $data = [
            'subject' => 'Laporan Map Selesai',
            'email' => request('email'),
            'content' => $content
        ];

        Mail::send('work-map.email', $data, function ($message) use ($data) {
            $message->to($data['email'])->subject($data['subject']);
        });

        return back()->with('masuk', 'Email berhasil dikirim');
    }
}
