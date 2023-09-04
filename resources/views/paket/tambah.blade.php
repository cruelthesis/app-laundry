@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Tambah Paket</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/paket/tambahdata') }}" method="post">
                @csrf

                <div class="mb-3">
                    <select class="form-select form-control " id="exampleSelect" name="idoutlet" >
                        <option value="" disable selected>Daftar Outlet</option>
                        @foreach ($outlet as $outlet)
                            <option value="{{ $outlet->idoutlet }}">{{ $outlet->namaoutlet }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Nama</label>
                    <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" name="namapaket">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Jenis Barang</label><br>
                    <input type="radio" name="jenis" value="kiloan">
                    <label for="jeniskelamin">Kiloan</label><br>
                    <input type="radio" name="jenis" value="selimut">
                    <label for="jeniskelamin">Selimut</label><br>
                    <input type="radio" name="jenis" value="bedcover">
                    <label for="jeniskelamin">Bed Cover</label><br>
                    <input type="radio" name="jenis" value="kaos">
                    <label for="jeniskelamin">Kaos</label><br>
                    <input type="radio" name="jenis" value="lain">
                    <label for="jeniskelamin">Lain</label><br>
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Harga</label>
                    <input type="number" class="form-control" id="exampleFormControlInput1" placeholder="" name="harga">
                </div>

                <button class="btn btn-primary mb-4">Tambah</button>
            </form>
            
        </div>
    </div>
</div>

@endsection