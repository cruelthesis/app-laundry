@extends('main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Outlet</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{ url('laundry/outlet/tambah') }}" class="btn btn-primary mb-4">Tambah Data</a>
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Telpon</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($outlet as $outlet )
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $outlet->namaoutlet }}</td>
                            <td>{{ $outlet->alamat }}</td>
                            <td>{{ $outlet->telp }}</td>
                            <td><a href="{{ url('laundry/outlet/edit/'.$outlet->idoutlet) }}" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a><a href="{{ url('laundry/outlet/hapus/'.$outlet->idoutlet) }}" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                        </tr>
                        


                    
                      
                    
                    
                          
                      

                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection