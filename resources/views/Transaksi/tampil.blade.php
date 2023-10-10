@extends('main')

@section('content')


<div class="row">
    <div class="col-4">
        <div class="card mb-4">
            <div class="card-body">
                <form action="{{ url('laundry/belipaket') }}" method="">
                    @csrf
                    <select name="idpaket" class="form-control" id="">
                        <option value="">Pilih Paket</option>
                        @foreach ($paket as $paket)
                            <option value="{{ $paket->idpaket }}">{{ $paket->namapaket }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="jumlah" class="form-control mt-2" placeholder="jumlah">
                    <button type="submit" class="btn btn-primary mt-2">Tambah</button>
                </form>
                <hr>
                <form action="{{ url('laundry/transaksi/tambah') }}" method="post">
                    @csrf
                    <select name="idmember" class="form-control" id="">
                        <option value="">Pilih Pelanggan</option>
                        @foreach ($member as $pelanggan)
                            <option value="{{ $pelanggan->idmember }}">{{ $pelanggan->nama }}</option>
                        @endforeach
                    </select>
                    <input type="number" id="tambahan" name="biayatambahan" class="form-control mt-2" placeholder="Biaya Tambahan">
                    <input type="number" id="diskon" name="diskon" class="form-control mt-2" placeholder="Diskon">
                    <input type="number" id="total" name="total" class="form-control mt-2" readonly placeholder="Total">
                    <input type="number" id="pembayaran" name="pembayaran" class="form-control mt-2" placeholder="Uang Bayar">
                    <input type="number" id="kembali" name="kembali" class="form-control mt-2" placeholder="Kembalian" value="0" disabled>
                    <button type="submit" id="btntrans" class="btn btn-success mt-2">Simpan</button>
                </form>
            </div>
        </div>
    </div>
    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered table-striped">
                    <tr>
                        <th>No</th>
                        <th>Paket</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                    @php
                        $no=1;
                        $total=0;
                    @endphp
                    @if (session()->has('cart'))
                        @foreach (session('cart') as $cart)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $cart['namapaket'] }}</td>
                                <td>
                                    <a href="{{ url('laundry/kurang/'.$cart['idpaket']) }}">[-]</a>
                                    {{ $cart['jumlah'] }}
                                    <a href="{{ url('laundry/tambah/'.$cart['idpaket']) }}">[+]</a>
                                </td>
                                <td>{{ $cart['harga'] }}</td>
                                <td>{{ $cart['harga']*$cart['jumlah'] }}</td>
                                <td><a onclick="return confirm('Yakin akan dihapus');" href="{{ url('laundry/transaksi/hapus/'.$cart['idpaket']) }}" class="text-danger"><i class="fa fa-trash"></i></a></td>
                            </tr>
                            @php
                                $total += $cart['harga']*$cart['jumlah'];
                            @endphp
                        @endforeach
                    @endif
                    <tr>
                        <td colspan="4">Jumlah</td>
                        <td colspan="2" id="subtotal">{{ $total }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>



@endsection
@section('script')
    <script>
        $(document).ready(function(){
            var sub = $('#subtotal').text();
            
            $('#tambahan').keyup(function(){
                var pajak = 11/100*parseInt(sub);
                var tambahan = $('#tambahan').val();
                var total = parseInt(sub) + parseInt(tambahan) + pajak;

                $('#total').val(total);
            });

            
            $('#diskon').keyup(function(){
                var pajak = 11/100*parseInt(sub);
                var diskon = $('#diskon').val();
                var total = parseInt(sub) - parseInt(diskon) + pajak;

                $('#total').val(total);
            });
            

            $('#pembayaran').keyup(function(){
                var total = $('#total').val();
                var bayar = $('#pembayaran').val();
                $('#kembali').val(parseInt(bayar)-parseInt(total));
            });
        });

        var btntrans = document.getElementById('btntrans');

        btntrans.addEventListener('click', function(){
        var url = "{{ url('laundry/struk') }}";

        // Membuka URL dalam tab baru
        window.open(url, '_blank');
        });
    </script>
@endsection

    
{{-- <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary" >Tambah Transaksi</h6>
    </div>
    
    <div class="card-body">
        <div class="table-responsive">

            <form action="{{ url('laundry/belipaket') }}" method="get">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Paket</label>
                        <select class="form-select form-control " id="exampleSelect" name="idpaket" >
                            <option value="" disable selected>Pilih Paket</option>
                            @foreach ($paket as $paket)
                                <option value="{{ $paket->idpaket }}">{{ $paket->namapaket }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-2">
                        <button class="btn btn-primary mt-4">Tambah</button>
                    </div>
    
                    
                </div>
            </form>
            
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Barang/Paket</th>
                        <th>Jumlah</th>
                        <th>Harga</th>
                        <th>Total</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no=1;
                    @endphp

                    @if (session()->has('cart'))
                    @foreach (session('cart') as $idpaket => $transaksi)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $transaksi['namapaket'] }}</td>
                        <td>
                            <a href="{{ url('laundry/kurang/'.$transaksi['idpaket']) }}">[-]</a>
                            {{ $transaksi['jumlah'] }}
                            <a href="{{ url('laundry/tambah/'.$transaksi['idpaket']) }}">[+]</a>
                        </td>
                        <td>{{ $transaksi['harga'] }}</td>
                        <td>{{ $transaksi['jumlah']*$transaksi['harga'] }}</td>
                        <td><a href="{{ url('laundry/hapus/'.$transaksi['idpaket']) }}" class="text-danger"><i class="fas fa-fw fa-trash-alt"></a></td>
                    </tr>
                        
                    @endforeach
                        
                    @endif
                    
                </tbody>
                
            </table>

        </div>
    </div>
</div> --}}