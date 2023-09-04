

@extends('main')

@section('transaksi')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Transaksi</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <div class="btn btn-primary mb-4">Tambah Transaksi</div>
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Diskon</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($transaksi as $transaksi )
                      <tr>
                        <a href="">
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi->idmember }}</td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ $transaksi->diskon }}</td>
                        <td>{{ $transaksi->status }}</td>
                        <td>{{ $transaksi->pembayaran }}</td>
                        </a>
                        <td><a href="" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a><a href="" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                    </tr>  
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection