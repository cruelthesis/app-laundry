<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Outlet;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use App\Models\DetailTransaksi;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDetailTransaksiRequest;
use App\Http\Requests\UpdateDetailTransaksiRequest;

class DetailTransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($idtransaksi)
    {
        $user = Auth::user();
        // $member = Member::where('transaksis.idmember');

        $detail = Transaksi::join('detail_transaksis', 'transaksis.idtransaksi', '=', 'detail_transaksis.idtransaksi')
        ->join('pakets', 'detail_transaksis.idpaket', '=', 'pakets.idpaket')
        ->join('members', 'transaksis.idmember', '=', 'members.idmember')
        ->join('outlets', 'transaksis.idoutlet', '=', 'outlets.idoutlet')
        ->where('transaksis.idoutlet', $user->idoutlet)
        ->where('transaksis.idtransaksi', $idtransaksi)
        ->select('transaksis.*', 'detail_transaksis.*', 'pakets.*', 'members.*', 'outlets.*')
        ->get();

        // dd($detail);
        return view('Transaksi.detail', ['detail'=>$detail]);
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
    public function store(StoreDetailTransaksiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($idtransaksi)
    {
        $user = Auth::user();

        $transaksi = Transaksi::where('idtransaksi', $idtransaksi)->first();
        $alamat = Outlet::where('idoutlet', $user->idoutlet)->first();
        $member = Member::where('idmember', $transaksi->idmember)->first();

        $struk = DetailTransaksi::join('transaksis', 'detail_transaksis.idtransaksi', '=', 'transaksis.idtransaksi')
        ->join('pakets', 'detail_transaksis.idpaket', '=', 'pakets.idpaket')
        ->where('transaksis.idtransaksi', $transaksi->idtransaksi)
        ->select(['transaksis.*', 'pakets.*', 'detail_transaksis.*'])
        ->get();

        return view('Transaksi.strukupdate', ['transaksi'=>$transaksi, 'alamat'=>$alamat, 'pelanggan'=>$member, 'struk'=>$struk]);



    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDetailTransaksiRequest $request, DetailTransaksi $detailTransaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DetailTransaksi $detailTransaksi)
    {
        //
    }

    public function status(Request $request, $idtransaksi){
        Transaksi::where('idtransaksi', $idtransaksi)->update([
            'status'=>$request->status
        ]);

        return back();
    }

    public function filter(Request $request){
        $tglawal = $request->tglawal;
        $tglakhir = $request->tglakhir;
        $status = $request->status;
        $where = "";

        if ($tglawal != null && $tglakhir != null) {
            $where = "left(tanggal,10) between '$tglawal' and '$tglakhir'";
        }
        if ($status != null) {
            if (!empty($where)) {
                $where = $where."and pembayaran = '$status'";
            }else{
                $where = $where."pembayaran = '$status'";
            }
        }

        if ($tglawal == null && $tglakhir == null && $status == null) {
            return redirect('laundry/transaksi/riwayat');
        }

        $auth = Auth::user();

        $transaksi = Transaksi::join('outlets', 'transaksis.idoutlet', '=', 'outlets.idoutlet')
        ->join('members', 'transaksis.idmember', '=', 'members.idmember')
        ->select(['transaksis.*', 'outlets.*', 'members.*'])
        ->where('transaksis.idoutlet', $auth->idoutlet)
        ->whereRaw($where)
        ->get();

        return view('Transaksi.riwayat', ['transaksi'=>$transaksi]);
    }
}
