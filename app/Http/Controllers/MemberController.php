<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\UpdateMemberRequest;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $members = Member::all();
        return view('Member.tampil',['member'=>$members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Member.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'telp' => 'required',
        ]);

        Member::create([
            'nama' => $data ['nama'],
            'alamat' => $data ['alamat'],
            'jeniskelamin' => $data ['jeniskelamin'],
            'telp' => $data ['telp'],
        ]);

        return redirect('laundry/member');
    }

    /**
     * Display the specified resource.
     */
    public function show($idmember)
    {
        Member::where('idmember','=',$idmember)->delete();

        return redirect('member');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($idmember)
    {
        $members = Member::where('idmember', $idmember)->first();

        return view('Member.perbarui', ['member'=>$members]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $idmember)
    {
        $data = $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'jeniskelamin' => 'required',
            'telp' => 'required',
        ]);

        Member::where('idmember',$idmember)->update([
            'nama' => $data['nama'],
            'alamat' => $data['alamat'],
            'jeniskelamin' => $data['jeniskelamin'],
            'telp' => $data['telp'],
        ]);

        return redirect('laundry/member');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Member $member)
    {
        //
    }
}
