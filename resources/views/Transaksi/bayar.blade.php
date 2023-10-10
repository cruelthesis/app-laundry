@extends('main')

@section('content')
    <div class="row">
        <div class="col-4">
            <div class="card mb-4">
                <div class="card-body">
                    <label for="exampleFormControlInput1" class="form-label">Kode Invoice</label>
                    <input type="number" id="" name="" class="form-control mt-2" placeholder="{{ $transaksi->kode_invoice }}" readonly><br>
                    <label for="exampleFormControlInput1" class="form-label">Nama Pelanggan</label>
                    <input type="number" id="" name="" class="form-control mt-2" placeholder="{{ $transaksi->nama }}" readonly><br>

                    <label for="exampleFormControlInput1" class="form-label">Telpon</label>
                    <input type="number" id="" name="" class="form-control mt-2" placeholder="{{ $transaksi->telp }}" readonly><br>
                    <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                    <input type="number" id="" name="" class="form-control mt-2" placeholder="{{ $transaksi->alamat }}" readonly><br>

                    
                
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
                            <th>Harga</th>
                            <th>Jumlah</th>
                            <th>SubTotal</th>
                        </tr>
                        @php
                            $no=1;
                            $total=0;
                        @endphp
                            @foreach ($detail as $detail)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $detail->namapaket }}</td>
                                    <td class="text-right">{{ $detail->harga }}</td>
                                    <td class="text-right">{{ $detail->qty }}</td>
                                    
                                    @php
                                    $subtotal = $detail->harga*$detail->qty;
                                    $total += $subtotal;
                                    @endphp

                                    <td class="text-right">{{ $subtotal }}</td>

                                </tr>

                                

                            @endforeach

                            <form action="{{ url('laundry/updatebayar/'.$transaksi->idtransaksi) }}" method="post">
                                @csrf
                                <tr>
                                    <td colspan="4">Jumlah</td>
                                    <td class="text-right" colspan="2" id="">{{ $total }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Pajak</td>
                                    <td class="text-right" colspan="2" id="">{{ $transaksi->pajak }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Diskon</td>
                                    <td class="text-right" colspan="2" id="">{{ $transaksi->diskon }}</td>
                                </tr>
                                <tr>
                                    <td colspan="4">Biaya Tambahan</td>
                                    <td class="text-right" colspan="2" id="">{{ $transaksi->biayatambahan }}</td>
                                </tr>
                                @php
                                    $keseluruhan = $total + $transaksi->biayatambahan - $transaksi->diskon + $transaksi->pajak;
                                @endphp
                                <tr>
                                    <td colspan="4">Total</td>
                                    <td class="text-right"  colspan="2">
                                        <input name="total" id="total" class="form-control text-right" readonly type="number" value="{{ $keseluruhan }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Uang Bayar</td>
                                    <td class="text-right"  colspan="2">
                                        <input name="pembayaran" id="bayar" class="form-control" type="number">
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4">Kembalian</td>
                                    <td class="text-right" colspan="2">
                                        <input name="kembali" id="kembali" readonly class="form-control" type="number">
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td colspan="5">
                                        <button id="btnbayar" class="disabled btn btn-primary btn-lg btn-block">Bayar</button>
                                    </td>
                                 </tr>
                                
                            </form>
                                
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#bayar').keyup(function(){
                var total = $('#total').val();
                var bayar = $(this).val();
                var kembali = parseInt(bayar)-parseInt(total);
                $('#kembali').val(kembali);
                if (kembali>=0) {
                    $('#btnbayar').removeClass('disabled');
                }else{
                    $('#btnbayar').addClass('disabled');
                }
            });
        });
    </script>
@endsection
