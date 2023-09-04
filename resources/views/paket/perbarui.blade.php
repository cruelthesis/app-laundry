@extends('main')

@section('content')
    
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Update Paket</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/paket/update/'.$paket->idpaket) }}" method="post">
                @csrf

                <div class="mb-3">
                    <label for="">Outlet</label><br>
                    <select class="form-select" name="idoutlet" >
                    @foreach ($outlet as $outlet)
                        <option @selected($outlet->idoutlet==$paket->idoutlet) value="{{ $outlet->idoutlet }}">{{ $outlet->namaoutlet }}</option>
                    @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="">Jenis Barang</label><br>
                    <select class="form-select"  name="jenis" >
                        <option value="{{ $paket->jenis }}">{{ $paket->jenis }}</option>
                        <option value="kiloan">Kiloan</option>
                        <option value="selimut">Selimut</option>
                        <option value="bedcover">Bed Cover</option>
                        <option value="kaos">Kaos</option>
                        <option value="lain">Lain</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label"  for="">Nama Barang</label>
                    <input class="form-control" type="text" name="namapaket" id="" value="{{ $paket->namapaket }}">
                </div>
                <div class="mb-3">
                    <label class="form-label"  for="">Harga</label>
                    <input class="form-control" type="number" name="harga" id="" value="{{ $paket->harga }}">
                </div>
                

                <button class="btn btn-primary mb-4">Simpan</button>
            </form>


                
            
        </div>
    </div>
</div>

@endsection