@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Tambah Outlet</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/outlet/tambahdata') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="namaoutlet">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="alamat">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Telpon</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="telp">
                </div>

                <button class="btn btn-primary mb-4">Tambah</button>
            </form>
            
        </div>
    </div>
</div>

@endsection