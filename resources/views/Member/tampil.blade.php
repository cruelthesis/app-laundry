@extends('main')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pelanggan</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <a class="btn btn-primary mb-4" href="{{ url('laundry/member/tambah') }}">Tambah Data Pelanggan</a>
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Jenis Kelamin</th>
                        <th>Telp</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($member as $member )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $member->nama }}</td>
                        <td>{{ $member->alamat }}</td>
                        <td>{{ $member->jeniskelamin }}</td>
                        <td>{{ $member->telp }}</td>
                        <td><a href="{{ url('laundry/member/edit/'.$member->idmember) }}" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a><a href="{{ url('laundry/member/hapus/'.$member->idmember) }}" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                    </tr>  
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection

