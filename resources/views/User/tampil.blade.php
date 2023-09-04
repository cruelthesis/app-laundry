@extends('main')

@section('content')

<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Pegawai</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <a class="btn btn-primary mb-4" href="{{ url('laundry/user/tambah') }}">Tambah Pegawai</a>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Username</th>
                        <th>Outlet</th>
                        <th>Role</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($user as $user )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $user->nama }}</td>
                        <td>{{ $user->username }}</td>
                        <td>{{ $user->namaoutlet }}</td>
                        <td>{{ $user->role }}</td>
                        <td><a href="{{ url('laundry/user/edit/'.$user->id) }}" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a><a href="{{ url('laundry/user/hapus/'.$user->id) }}" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                    </tr>  
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection


