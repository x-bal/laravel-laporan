<?php

namespace App\Http\Controllers;

use App\WorkMap;
use App\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ErrorMapController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $error=Error::all();
        return view('error-map/index',compact('error'));
    }

    public function create()
    {
        $workmap=Workmap::where('user_id',Auth::user()->id)->where('finish_on',null)->get();
        return view('error-map/create',compact('workmap'));
    }

    public function store(Request $request)
    {
        $image = $request->file('image');
        $nama_image = time() . "_" . $image->getClientOriginalName();
        $tujuan_upload_image = 'image';
        $image->move($tujuan_upload_image, $nama_image);

        Error::create([
            'work_map_id'=> $request->work_map_id,
            'date' => $request->date,
            'image'=>$nama_image,
            'comments'=>$request->comments
        ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $error = Error::find($id);
        return view('error-map/edit',compact('error'));
    }

    public function update(Request $request)
    {
        $error = Error::find($request->id);

        $error->update([
            'comments'=>$request->comments,
        ]);

        return redirect('error-map')->with('update','Data Berhasil Di Update');
    }
    

    public function delete($id)
    {
        Error::find($id)->delete();

        return redirect('error-map')->with('update','Data Berhasil Di Hapus');
    }
    
}
