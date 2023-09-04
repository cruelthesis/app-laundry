@extends('main')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Paket</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{ url('laundry/paket/tambah') }}" class="btn btn-primary mb-4" >Tambah Paket</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Paket</th>
                        <th>Jenis</th>
                        <th>Outlet</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($paket as $paket )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $paket->namapaket }}</td>
                        <td>{{ $paket->jenis }}</td>
                        <td>{{ $paket->namaoutlet }}</td>
                        <td>{{ $paket->harga }}</td>
                        <td><a href="{{ url('laundry/paket/edit/'.$paket->idpaket) }}" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a><a href="{{ url('laundry/paket/hapus/'.$paket->idpaket) }}" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                    </tr>  
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection

