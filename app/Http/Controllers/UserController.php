<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        $outlets = Outlet::all();

        $users = User::join('outlets', 'users.idoutlet', '=', 'outlets.idoutlet')
        ->select(['users.*', 'outlets.*'])
        ->get();

        return view('User.tampil', ['user'=>$users, 'outlet' => $outlets]);
    }

    public function create(){

        $outlets = Outlet::all();
        $users = User::all();
        return view('User.tambah', ['outlet'=>$outlets, 'user'=>$users]);
    }

    public function store(Request $request){
        $data = $request -> validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            
        ]);

        User::create([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'idoutlet'=>$request->idoutlet,
            'role' => $request->role,
            'password' => bcrypt($data['password'])
        ]);

        return redirect('laundry/user');
    }

    public function edit($id){
        $outlets = Outlet::all();

        $users = User::where('id', $id)->first();

        return view('User.perbarui', ['outlet'=>$outlets, 'user' => $users]);

    }

    public function update(Request $request, $id){
        User::where('id',$id)->update([
            'nama' => $request->nama,
            'username' => $request->username,
            'idoutlet' => $request->idoutlet,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);   

        return redirect('laundry/user');
    }

    public function hapus($id){
        $users = User::where('id', $id)->get();
        $role = User::where('role', $users[0]['role']);
        $jumlah = $role->count();

        if ($jumlah == 1){
            session()->flash('pesan', 'Data hanya ada satu!');
        }else{
            User::where('id',$id)->delete();
        }

        return redirect('laundry/user');
    }
}
