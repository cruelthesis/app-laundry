@extends('main')

@section('content')
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Transaksi</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">
            <a href="{{ url('laundry/transaksi') }}" class="btn btn-primary mb-3" >Transaksi</a>
            <div class="row ml-0">


                <form action="{{ url('laundry/filter') }}" method="post">
                    @csrf

                    <table class="mb-3">
                        <tr>
                            <td>Tanggal Awal</td>
                            <td>Tanggal Akhir</td>
                            <td>Status Pembayaran</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr class="">
                            <td class="">
                                <input type="date" name="tglawal" class="form-control">
                            </td>
                            <td>
                                <input type="date" name="tglakhir" class="form-control">
                            </td>
                            <td>
                                <select name="status" id="" class="form-control">
                                    <option value="">Pilih Status</option>
                                    <option value="sudahdibayar">Lunas</option>
                                    <option value="belumdibayar">Belum Dibayar</option>
                                </select>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-warning ml-3">Filter</button>
                                <a class="btn btn-primary ml-1" href="{{ url('laundry/transaksi/riwayat') }}">Reset Filter</a>
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Invoice</th>
                        <th>Pelanggan</th>
                        <th>Tanggal</th>
                        <th>Batas Waktu</th>
                        <th>Status</th>
                        <th>Pembayaran</th>
                        
                    </tr>
                </thead>
                @php
                    $no=1;
                @endphp

                <tbody>
                    @foreach ($transaksi as $transaksi )
                      <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi->kode_invoice }}</td>
                        <td><a target="_blank" href="{{ url('laundry/detail/'.$transaksi->idtransaksi) }}">{{ $transaksi->nama }}</a></td>
                        <td>{{ $transaksi->tanggal }}</td>
                        <td>{{ $transaksi->bataswaktu }}</td>
                        <td>
                            <form action="{{ url('laundry/status/'.$transaksi->idtransaksi) }}" method="post">
                                @csrf
                                <select class="form-control" onchange="this.form.submit()" name="status" id="">
                                    <option @selected($transaksi->status =='baru') value="baru">Baru</option>
                                    <option @selected($transaksi->status =='proses') value="proses">Proses</option>
                                    <option @selected($transaksi->status =='selesai') value="selesai">Selesai</option>
                                    <option @selected($transaksi->status =='diambil') value="diambil">Diambil</option>
                                </select>
                            </form>
                        </td>
                        <td>@if ($transaksi->pembayaran == 'sudahdibayar')
                            <button class="btn btn-success">Lunas</button>
                            @else
                            <a href="{{ url('laundry/bayar/'.$transaksi->idtransaksi) }}" class="btn btn-warning">Bayar</a>
                            @endif
                        </td>
                        {{-- <td><a href="{{ url('') }}" class="text-warning mx-4"><i class="fas fa-fw fa-edit"></i></a></td> --}}
                    </tr>  
                    @endforeach
                    
                </tbody>
                
            </table>
        </div>
    </div>
</div>
@endsection