<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\Member;
use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $users = Auth::user();

        $members = Member::all();

        $pakets = Paket::all();

        return view ('Transaksi.tampil', ['user' => $users, 'member'=>$members, 'paket' => $pakets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $users = Auth::user();

        $number = 0;

        foreach (session('cart') as $key => $value ){
            if ($users->role == 'admin'){
                $data = [
                    'idoutlet' => $value['idoutlet'],
                    'idmember' => $request->idmember,
                    'iduser' => $users->id,
                    'tanggal' => now(),
                    'diskon' => $request->diskon,
                    'status' => $request->status,
                    'pembayaran' => $request->pembayaran,
                ];
            }

            $transaksis = Transaksi::create($data);


            
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTransaksiRequest $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }

    public function belipaket(Request $request){
        $idpaket = $request->idpaket;

        $jumlah = $request->jumlah;

        $pakets = Paket::where('idpaket', $idpaket)->first();

        $cart = session()->get('cart', []);

        if(isset($cart[$idpaket])) {
            $cart[$idpaket]['jumlah'] = $jumlah ;
        } else {
            $cart[$idpaket] = [
                'idpaket' => $idpaket,
                'idoutlet' => $pakets->idoutlet,
                'jenis' => $pakets->jenis,
                'namapaket' => $pakets->namapaket,
                'harga' => $pakets->harga,
                'jumlah' => $jumlah,
            ];
        }

        session()->put('cart',$cart);
        return back();
    }

    public function tambah($idpaket){
        $cart = session()->get('cart');
        $cart[$idpaket]['jumlah']++;
        session()->put('cart',$cart);

        return back();
    }

    public function kurang($idpaket){
        $cart = session()->get('cart');
        if ($cart[$idpaket]['jumlah'] > 1) {
            $cart[$idpaket]['jumlah']--;
            session()->put('cart',$cart);
        }else{
            unset($cart[$idpaket]);
            session()->put('cart',$cart);
        }

        return back();
    }

    public function hapus($idpaket){
        $cart = session()->get('cart');
        if (isset($cart[$idpaket])) {
            unset($cart[$idpaket]);
            session()->put('cart',$cart);
        }

        return back();
    }
}
