@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Tambah User</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/user/tambahdata') }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="nama">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="username">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Outlet</label>
                    <select class="form-select form-control " id="exampleSelect" name="idoutlet" >
                        <option value="" disable selected>Daftar Outlet</option>
                        @foreach ($outlet as $outlet)
                            <option value="{{ $outlet->idoutlet }}">{{ $outlet->namaoutlet }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Role</label><br>
                        <input type="radio" name="role" value="kasir">
                        <label for="jeniskelamin">Kasir</label><br>
                        <input type="radio" name="role" value="owner">
                        <label for="jeniskelamin">Owner</label><br>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Password</label>
                    <input type="password" class="form-control" id="exampleFormControlInput1" placeholder="" name="password">
                </div>

                <button class="btn btn-primary mb-4">Tambah</button>
            </form>
            
        </div>
    </div>
</div>

@endsection