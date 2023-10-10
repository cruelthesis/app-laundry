<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Struk</title>

    <style>
        .container {
            width: 60mm;
            height: auto;
            position: absolute;
            left: 50%;
            /* width:200px;
            height:200px; */
            transform: translate(-50%, -0%);
        }

        .header {
            margin: 0;
            text-align: center;
        }

        h2 {
            margin: 0;
            font-size: 12pt;
        }

        p {
            margin: 0;
            font-size: 8pt;
        }

        small {
            font-size: 8pt;
        }

        .flex-container-1 {
            display: flex;
            margin-top: 10px;
        }

        .flex-container-1>div {
            text-align: left;
        }

        .flex-container-1 .right {
            text-align: right;
            width: 60mm;
        }

        .flex-container-1 .left {
            width: 15mm;
        }

        .flex-container {
            width: 60mm;
            display: flex;
        }

        .flex-container>div {
            -ms-flex: 1;
            /* IE 10 */
            flex: 1;
            font-size: 10pt;
        }

        ul {
            display: contents;
        }

        ul li {
            display: block;
            font-size: 10pt;
        }

        hr {
            border-style: dashed;
        }

        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }
    </style>

</head>
<body>
    <div class="container">
        <div class="header" style="margin-bottom: 10px;">
            <h2>Laundry {{ $alamat->namaoutlet }}</h2>
            <small>{{ $alamat->alamat }}
            </small>
        </div>
        <hr>
        <div class="flex-container-1">
            <div class="left">
                <ul>
                    <li>Kasir</li>
                    <li>No Order</li>
                    <li>Pelanggan</li>
                    <li>Tanggal</li>
                    <li>Status</li>
                </ul>
            </div>
            <div class="right">
                <ul>
                    <li>{{ Auth::user()->nama }}</li>
                    <li> {{ $transaksi->kode_invoice }} </li>
                    <li> {{ $pelanggan->nama }} </li>
                    <li> {{ $transaksi->tanggal }} </li>
                    <li>{{ $transaksi->pembayaran }}</li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="flex-container" style="margin-bottom: 10px; text-align:right;">
            <div style="text-align: left;">Nama</div>
            <div>Harga/Qty</div>
            <div>Total</div>
        </div>
        @php
            $total = 0;
        @endphp
        @foreach ($struk as $struk)
            @php
                $total = $total + $struk->harga * $struk->qty;
            @endphp
            <div class="flex-container" style="text-align: right;">
                <div style="text-align: left;">{{ $struk->namapaket }}</div>
                <div>Rp.{{ number_format($struk->harga, 0, ',', '.') }}*{{ $struk->qty }} </div>
                <div>Rp.{{ number_format($struk->harga * $struk->qty, 0, ',', '.') }}</div>
            </div>
            <br>
        @endforeach
        <hr>
        <div class="flex-container" style="text-align: right; margin-top: 5px;">
            <div>
                <ul>
                    <li>Diskon</li>
                    <li>Biaya Tambahan</li>
                    <li>Pajak</li>
                    <li>Total Biaya</li>
                </ul>
            </div>
            <div style="text-align: right;">
                <ul>
                    <li>Rp. {{ number_format($transaksi->diskon, 0, ',', '.') }} </li>
                    <li>Rp. {{ number_format($transaksi->biayatambahan, 0, ',', '.') }}</li>
                    <li>Rp. {{ number_format($transaksi->pajak, 0, ',', '.') }}</li>
                    <li>Rp.
                        {{ number_format($total + $transaksi->biayatambahan - $transaksi->diskon + $transaksi->pajak, 0, ',', '.') }}
                    </li>
                </ul>
            </div>
        </div>
        <hr>
        <div class="header" style="margin-top: 5px;">
            <h3>Terimakasih</h3>
            <p>Silahkan berkunjung kembali</p>
        </div>
    </div>
    
</body>
</html>


<script>
    if (!localStorage.getItem('reloaded')) {
        localStorage.setItem('reloaded', 'yes');
        window.location.reload();
    } else {
        localStorage.removeItem('reloaded');

        setTimeout(function(){
            window.print();

            window.close();
        }, 500);
    }
</script>