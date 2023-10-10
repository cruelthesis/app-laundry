<html>
<head>
<title>Faktur Pembayaran</title>
<style>
 
#tabel
{
font-size:15px;
border-collapse:collapse;
}
#tabel  td
{
padding-left:5px;
border: 1px solid black;
}
</style>
</head>
<body style='font-family:tahoma; font-size:8pt;'>
<center><table style='width:350px; font-size:16pt; font-family:calibri; border-collapse: collapse;' border = '0'>
<td width='70%' align='CENTER' vertical-align:top'><span style='color:black;'>
<b>Laundry {{ $alamat->namaoutlet }}</b></br>{{ $alamat->alamat }}</span></br>
 
 
<span style='font-size:12pt'>No. Invoice : {{ $transaksi->kode_invoice }}, {{ $transaksi->tanggal }} (User: {{ Auth::user()->nama }}), (Pelanggan: {{ $pelanggan->nama }})</span></br>
</td>
</table>
<style>
    .container {
            width: 62mm;
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
            width: 70mm;
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


        a {
            text-decoration: none;
            text-align: center;
            padding: 10px;
            background: #00e676;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        hr { 
            display: block;
            margin-top: 0.5em;
            margin-bottom: 0.5em;
            margin-left: auto;
            margin-right: auto;
            border-style: inset;
            border-width: 1px;
        } 


</style>

<div class="container">

    <table cellspacing='0' cellpadding='0' style='width:350px; font-size:12pt; font-family:calibri;  border-collapse: collapse;' border='0'>
 
        <tr align='center'>
        <td width='15%'>Barang</td>
        <td width='19%' style='text-align:right;'>Harga</td>
        <td width='17%' style='text-align:right;'>Jumlah</td>
        {{-- <td width='7%'>Diskon %</td>     --}}
        <td width='13%' style='text-align:right;' colspan='5'>Total</td><tr>
        </tr>
        <td colspan='5'><hr></td></tr>
        
        
        
        @php
            $total=0;
        @endphp
        @foreach ($struk as $struk)
            @php
                $total = $total + $struk->harga * $struk->qty;
            @endphp
            <tr><td style='vertical-align:top'>{{ $struk->namapaket }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:2px'>Rp. {{ number_format($struk->harga,  0, ',', '.') }}</td>
                <td style='vertical-align:top; text-align:right; padding-right:10px'>{{ $struk->qty }}</td>
                {{-- <td style='vertical-align:top; text-align:right; padding-right:10px'>0,00%</td> --}}
                <td colspan='5' style='text-align:right; vertical-align:top'>{{ number_format($struk->harga*$struk->qty , 0, ',', '.') }}</td></tr>
            
        @endforeach
        
        <tr>
        <td colspan='5'><hr></td>
        </tr>
        <tr>
        <td colspan = '4'><div style='text-align:right'>Biaya Tambahan : </div></td><td style='text-align:right; font-size:16pt;'>Rp. {{ number_format($transaksi->biayatambahan, 0, ',', '.') }}</td>
        </tr>
        <tr>
        <td colspan = '4'><div style='text-align:right; color:black'>Pajak : </div></td><td style='text-align:right; font-size:16pt; color:black'>Rp. {{ number_format($transaksi->pajak, 0, ',', '.') }}</td>
        </tr>
        <tr>
            <td colspan = '4'><div style='text-align:right; color:black'>Diskon : </div></td><td style='text-align:right; font-size:16pt; color:black'>Rp. {{ number_format($transaksi->diskon, 0, ',', '.') }}</td>
            </tr>
        <tr>
        <td colspan = '4'><div style='text-align:right; color:black'>Total : </div></td><td style='text-align:right; font-size:16pt; color:black'>Rp. {{ number_format($total + $transaksi->biayatambahan - $transaksi->diskon + $transaksi->pajak , 0, ',', '.') }}</td>
        </tr>
        <tr>
        <td colspan = '4'><div style='text-align:right; color:black'>Status Pembayaran : </div></td><td style='text-align:right; font-size:16pt; color:black'>{{ $transaksi->pembayaran }}</td>
        </tr>
        {{-- <tr>
        <td colspan = '4'><div style='text-align:right; color:black'>Kembalian : </div></td><td style='text-align:right; font-size:16pt; color:black'>252.500</td>
        </tr> --}}
        
        </table>
        <table style='width:350; font-size:12pt;' cellspacing='2'><tr></br><td align='center'>****** TERIMAKASIH ******</br></td></tr></table></center></body>

</div>


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