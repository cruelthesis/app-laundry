<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login');
    }

    public function postlogin(Request $request){
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $data = $request->only('username','password');

        // dd($data);

        // dd($request->input());

        if (Auth::attempt($data)) {
            $user = Auth::user();

            if ($user->role == 'admin') {
                return redirect('laundry/dashboard');
            }
            if ($user->role == 'kasir') {
                return redirect('laundry/dashboard');
            }
            if ($user->role == 'owner') {
                return redirect('laundry/dashboard');
            }
            
        }

        return redirect('/');
    }

    public function logout(){
        session()->flush();
        Auth::logout();

        return redirect('/');
    }
}
