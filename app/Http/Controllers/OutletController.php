<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Http\Requests\StoreOutletRequest;
use App\Http\Requests\UpdateOutletRequest;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outlets = Outlet::all();

        return view('Outlet.tampil',['outlet'=>$outlets]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Outlet.tambah');  
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'namaoutlet' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);

        Outlet::create([
            'namaoutlet' => $data ['namaoutlet'],
            'alamat' => $data ['alamat'],
            'telp' => $data ['telp'],
        ]);

        return redirect('laundry/outlet');
    }

    /**
     * Display the specified resource.
     */
    public function show($idoutlet)
    {
        Outlet::where('idoutlet','=',$idoutlet)->delete();

        return redirect('laundry/outlet');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $idoutlet)
    {
        $outlets = Outlet::where('idoutlet', $idoutlet)->first();

        return view('Outlet.perbarui', ['outlet'=>$outlets]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idoutlet)
    {
        $data = $request->validate([
            'namaoutlet' => 'required',
            'alamat' => 'required',
            'telp' => 'required',
        ]);
        

        Outlet::where('idoutlet', $idoutlet)->update([
            'namaoutlet' => $data['namaoutlet'],
            'alamat' => $data['alamat'],
            'telp' => $data['telp'],
        ]);

        return redirect('laundry/outlet');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        //
    }
}
