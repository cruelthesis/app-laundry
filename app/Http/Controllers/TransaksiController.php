<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Http\Requests\StoreTransaksiRequest;
use App\Http\Requests\UpdateTransaksiRequest;
use App\Models\DetailTransaksi;
use App\Models\Member;
use App\Models\Outlet;
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

        $pakets = Paket::where('idoutlet',$users->idoutlet)->get();

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
        $kode_invoice = date('YmdHis');
        $pembayaran = $request->pembayaran;
        $status = "baru";
        $tanggal = now();
        $bataswaktu = date('Y-m-d', strtotime('+3 days', strtotime($tanggal)));
        $total = $request->total;
        $diskon = $request->diskon;
        $tambahan = $request->biayatambahan;
        $subtotal = 0;

        $hasil = $total-$pembayaran;

        // dd($hasil);


        foreach(session('cart') as $cart){
            $subtotal += $cart['jumlah']*$cart['harga'];
        }

        $pajak = 0.11*$subtotal;

        if ($pembayaran > $total){
            $data = [
                'idoutlet' => $users->idoutlet,
                'idmember' => $request->idmember,
                'iduser' => $users->id,
                'tanggal' => $tanggal,
                'kode_invoice' => $kode_invoice,
                'bataswaktu' => $bataswaktu,
                'diskon'=> $diskon,
                'pajak' => $pajak,
                'biayatambahan' => $tambahan,
                'status' => $status,
                'tanggalbayar' => now(),
                'pembayaran' => 'sudahdibayar'

            ];
        }else if($pembayaran < $total){
            $data = [
                'idoutlet' => $users->idoutlet,
                'idmember' => $request->idmember,
                'iduser' => $users->id,
                'tanggal' => $tanggal,
                'kode_invoice' => $kode_invoice,
                'bataswaktu' => $bataswaktu,
                'diskon'=> $diskon,
                'pajak' => $pajak,
                'biayatambahan' => $tambahan,
                'status' => $status,
                'pembayaran' => 'belumdibayar'

            ];
        }
        Transaksi::create($data);
        $idtransaksi = Transaksi::latest()->first()->idtransaksi;

        
        foreach(session('cart')as $cart){
            $detailtransaksi = [
                'idtransaksi' => $idtransaksi,
                'idpaket' => $cart['idpaket'],
                'qty' => $cart['jumlah'],
                'keterangan' => ''

            ];

            // dd($detailtransaksi);

            DetailTransaksi::create($detailtransaksi);
        }

        session()->forget('cart');
        return back();


        

    
        
        // $users = Auth::user();
        // $idoutlet = $users->idoutlet;
        // $kode_invoice = date('YmdHis');
        // $idmember = $request->idmember;
        // $tanggal = now();
        // $bataswaktu = date('Y-m-d', strtotime('+3 days', strtotime($tanggal)));
        // $biayatambahan = $request->biayatambahan;
        // $diskon = $request->diskon;
        // $total = $request->total;
        // $pembayaran = $request->pembayaran;
        // $status = "baru";
        // $subtotal = 0;

        

        // $pajak = 0.11*$subtotal;
        // if ($pembayaran >= $total) {
        //     $tanggalbayar = now();
        //     $pembayaran = "sudahdibayar";
        // }else{
        //     $tanggalbayar = "";
        //     $pembayaran = "belumdibayar";
        // }

        // $data = [
        //     'idoutlet'=>$idoutlet,
        //     'kode_invoice'=>$kode_invoice,
        //     'idmember' => $idmember,
        //     'tanggal'=>$tanggal,
        //     'bataswaktu'=>$bataswaktu,
        //     'tanggalbayar'=>$tanggalbayar,
        //     'biayatambahan'=>$biayatambahan,
        //     'diskon'=>$diskon,
        //     'pajak'=>$pajak,
        //     'status'=>$status,
        //     'pembayaran'=>$pembayaran,
        //     'iduser'=>$users->id
        // ];

        // Transaksi::create($data);
        // $transaksi = Transaksi::latest()->first()->id;

        // dd($data);

        // return redirect('laundry/transaksi');


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

    public function struk(Request $request){
        $auth = Auth::User();

        $transaksi = Transaksi::latest()->first();
        $alamat = Outlet::where('idoutlet', $auth->idoutlet)->first();
        $pelanggan = Member::where('idmember', $transaksi->idmember)->first();

        $struk = DetailTransaksi::join('transaksis', 'detail_transaksis.idtransaksi', '=', 'transaksis.idtransaksi')
        ->join('pakets', 'detail_transaksis.idpaket', '=', 'pakets.idpaket')
        ->where('transaksis.idtransaksi', $transaksi->idtransaksi)
        ->select(['detail_transaksis.*','pakets.*','transaksis.*'])
        ->get();

        return view('Transaksi.struk3', ['transaksi'=>$transaksi, 'alamat'=>$alamat, 'pelanggan'=>$pelanggan, 'struk'=>$struk]);
    }


    public function riwayat(Request $request){

        $user = Auth::user();
        $transaksi = Transaksi::
        join('members', 'transaksis.idmember', '=', 'members.idmember')
        ->join('outlets', 'transaksis.idoutlet', '=', 'outlets.idoutlet')
        ->select(['transaksis.*', 'members.*', 'outlets.*'])
        ->where('transaksis.idoutlet', $user->idoutlet)
        ->orderBy('status', 'ASC')
        ->get();



        return view ('Transaksi.riwayat', ['transaksi'=>$transaksi]);
    }

    public function bayar($idtransaksi){

        $transaksi = Transaksi::join('members', 'transaksis.idmember', '=', 'members.idmember')
        ->select(['transaksis.*', 'members.*'])
        ->where('idtransaksi', $idtransaksi)->first();

        $detail = DetailTransaksi::join('pakets', 'detail_transaksis.idpaket', '=', 'pakets.idpaket')
        ->select(['pakets.*', 'detail_transaksis.*'])
        ->where('idtransaksi', $transaksi->idtransaksi)->get();

        return view('Transaksi.bayar', ['transaksi'=> $transaksi, 'detail'=>$detail]);
    }

    public function updatepembayaran(Request $request, $idtransaksi){
        $pembayaran = ['pembayaran'=>'sudahdibayar'];

        Transaksi::where('idtransaksi', $idtransaksi)->update($pembayaran);

        return redirect('laundry/transaksi/riwayat');
    }
}
