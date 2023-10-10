@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Update Member</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/member/update/'.$member->idmember) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" value="{{ $member->nama }}" class="form-control" id="exampleFormControlInput1" placeholder="" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text"  value="{{ $member->alamat }}" class="form-control" id="exampleFormControlInput1" placeholder="" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="">Jenis Kelamin</label><br>
                    <select class="form-select form-control"  name="jeniskelamin" >
                        <option value="{{ $member->jeniskelamin }}">{{ $member->jeniskelamin }}</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telpon</label>
                    <input type="text"  value="{{ $member->telp }}" class="form-control" id="exampleFormControlInput1" placeholder="" name="telp">
                </div>

                <button class="btn btn-primary mb-4">Simpan</button>
            </form>
            
        </div>
    </div>
</div>

@endsection