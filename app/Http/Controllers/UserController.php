<?php

namespace App\Http\Controllers;

use App\Map;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        
        $user = User::where('level','A')->get();
        return view('admin/index',compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password'=>bcrypt($request->password),
            'level'=>'A',
            'jk'=>$request->jk,
        ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('admin/edit',compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);

        if($request->email != $user->email){
            $request->validate([
                'email' => 'required|unique:users',
            ]);
        }

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'jk'=>$request->jk,
        ]);

        return redirect('admin')->with('update','Data Berhasil Di Update');
    }

    public function delete($id)
    {
        $user = User::find($id);
        $hitung = User::where('level','A')->count();

        if($hitung == 1){
            return redirect('admin')->with('gagal','Tidak Bisa Menghapus Admin Karena Sisa 1 Admin');
        }
        
        $user->delete();
        return redirect('admin')->with('update','Data Berhasil Di Hapus');
    }

    public function index2()
    {
        
        $user = User::where('level','U')->get();
        return view('user/index',compact('user'));
    }

    public function store2(Request $request)
    {
        $request->validate([
            'email' => 'required|unique:users',
            'password' => 'required',
        ]);

        User::create([
            'name'=> $request->name,
            'email' => $request->email,
            'password'=>bcrypt($request->password),
            'level'=>'U',
            'jk'=>$request->jk,
        ]);
        
        return redirect()->back()->with('masuk','Data Berhasil Di Input');
    }

    public function edit2($id)
    {
        $user = User::find($id);
        return view('user/edit',compact('user'));
    }

    public function update2(Request $request)
    {
        $user = User::find($request->id);

        if($request->email != $user->email){
            $request->validate([
                'email' => 'required|unique:users',
            ]);
        }

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'jk'=>$request->jk,
        ]);

        return redirect('user')->with('update','Data Berhasil Di Update');
    }

    public function delete2($id)
    {
        $user = User::find($id);
        $hitung = Map::where('user_id',$id)->count();

        if($hitung != 0){
            return redirect('user')->with('gagal','Tidak Bisa Menghapus User Karena User Tersebut Sudah Mengerjakan Salah Satu Map');
        }
        
        $user->delete();
        return redirect('user')->with('update','Data Berhasil Di Hapus');
    }

}
