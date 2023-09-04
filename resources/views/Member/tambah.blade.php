@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Daftar Outlet</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/member/tambahdata') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Kelamin</label><br>
                    <input type="radio" name="jeniskelamin" value="L">
                    <label for="jeniskelamin">Laki-laki</label><br>
                    <input type="radio" name="jeniskelamin" value="P">
                    <label for="jeniskelamin">Perempuan</label><br>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telp</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="telp">
                </div>

                <button class="btn btn-primary mb-4">Tambah</button>
            </form>
            
        </div>
    </div>
</div>

@endsection