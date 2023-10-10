<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\Outlet;
use Illuminate\Http\Request;
use App\Http\Requests\StorePaketRequest;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\UpdatePaketRequest;


class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlets = Outlet::all();

        $pakets = Paket::join('outlets','pakets.idoutlet','=','outlets.idoutlet')
        ->select([
            'pakets.*',
            'outlets.*'
        ])->get();
        return view('paket.tampil', ['outlet'=>$outlets,'paket'=>$pakets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $outlets = Outlet::all();
        return view('paket.tambah', ['outlet'=> $outlets]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            
            'jenis' => 'required',
            'namapaket' => 'required',
            'harga' => 'required',
        ]);

        // $id = $request->idoutlet;

        Paket::create([
            'idoutlet'=>$request->idoutlet,
            'jenis' => $data['jenis'],
            'namapaket' => $data['namapaket'],
            'harga' => $data['harga'],
        ]);

        Alert::success('Success', 'Data Berhasil Ditambah');
        return redirect('laundry/paket');
    }

    /**
     * Display the specified resource.
     */
    public function show($idpaket)
    {
        Paket::where('idpaket','=',$idpaket)->delete();


        return redirect('laundry/paket');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idpaket)
    {
        $outlets = Outlet::all();

        $pakets = Paket::where('idpaket', $idpaket)->first();

        return view('Paket.perbarui', ['paket'=> $pakets, 'outlet'=> $outlets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idpaket)
    {
        $data = $request->validate([
            'jenis' => 'required',
            'namapaket' => 'required',
            'harga' => 'required',
        ]);

        Paket::where('idpaket',$idpaket)->update([
            'jenis' => $data['jenis'],
            'namapaket' => $data['namapaket'],
            'harga' => $data['harga'],
        ]);


        return redirect('laundry/paket');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Paket $paket)
    {
        //
    }
}
