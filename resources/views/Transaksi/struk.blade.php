
<!DOCTYPE html>
<html>

<head>
    <title>POS (Point Of Sales)By Reelme Project Version 2.0.0</title>
    <style>
        @font-face {
            font-family: myFirstFont;
            src: url('/fonts/typewcond_regular.woff');
        }

        @font-face {
            font-family: myFirstFont bold;
            src: url('/fonts/typewcond_bold.woff');
        }


        * {
            margin: 0;
            padding: 0;
            font-family: myFirstFont;
            font-size: 10pt;
            color: #000;
        }

        body {
            width: 100%;
            font-family: myFirstFont;
            font-size: 10pt;
            margin: 0;
            padding: 0;
        }

        p {
            margin: 0;
            padding: 0;
            margin-left: 0px;
        }

        #wrapper {
            width: 44mm;
            margin: 0 0mm;
        }

        #main {
            float: left;
            width: 0mm;
            background: #ffffff;
            padding: 0mm;
        }

        #sidebar {
            float: right;
            width: 0mm;
            background: #ffffff;
            padding: 0mm;
        }

        .page {
            height: 400mm;
            width: 44mm;
            page-break-after: always;
        }

        table {
            /** border-left: 1px solid #fff;
            border-top: 1px solid #fff; **/
            font-family: myFirstFont;
            border-spacing: 0;
            border-collapse: collapse;

        }

        table td {
            /**border-right: 1px solid #fff;
            border-bottom: 1px solid #fff;**/
            padding: 3mm;

        }


        h1.heading {
            font-size: 10pt;
            color: #000;
            font-weight: normal;
            font-style: italic;


        }

        h2.heading {
            font-size: 10pt;
            color: #000;
            font-weight: normal;
        }

        hr {
            color: #ccc;
            background: #ccc;
        }

        #invoice_body {
            margin-top: 3mm;
            height: auto;
        }

        #invoice_body,
        #invoice_total {
            width: 100%;
        }

        #invoice_body table,
        #invoice_total table {
            width: 100%;
            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/

            border-spacing: 0;
            border-collapse: collapse;

            margin-top: 0mm;
        }

        #invoice_body table td,
        #invoice_total table td {
            text-align: center;
            font-size: 10pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding: 0 0;
            font-weight: normal;
        }

        #invoice_head table td {
            text-align: center;
            font-size: 10pt;
            /** border-right: 1px solid black;
            border-bottom: 1px solid black;**/
            padding: 0 0;
            font-weight: normal;
        }

        #invoice_body table td.mono,
        #invoice_total table td.mono {
            text-align: right;
            padding-right: 0mm;
            font-size: 10pt;
            border: 1px solid white;
            font-weight: normal;
        }

        #footer {
            width: 44mm;
            margin: 0 3mm;
            padding-bottom: 1mm;
        }

        #footer table {
            width: 100%;

            /** border-left: 1px solid #ccc;
            border-top: 1px solid #ccc; **/

            background: #eee;

            border-spacing: 0;
            border-collapse: collapse;
        }

        #footer table td {
            width: 25%;
            text-align: center;
            font-size: 10pt;
            /** border-right: 1px solid #ccc;
            border-bottom: 1px solid #ccc;**/
        }

        @media print {
            @page :footer {
                display: none
            }

            @page :header {
                display: none
            }
        }
    </style>
</head>

<body>
    <div id="wrapper">


        <div id="invoice_head">
            <table style="width:100%; border-spacing:0;">
                <tr>
                    <td style="font-family: myFirstFont bold;">
                        NOTA PEMBAYARAN
                    </td>
                    <td style="text-align:right;">
                        <p
                            style="text-align:right; font-size: 14px; font-weight:bold; border-bottom: black; border-top: black; border-right: black; border-left: black; ">
                        </p>
                    </td>
                </tr>
                <tr style="margin-top: 1px;">
                    <td>
                        <p style="text-align:left; font-size: 10pt; margin-top: 1px; font-weight: bold;"></p>
                    </td>
                    <td style="text-align:right;">
                        <p style="font-size: 10pt; font-weight: bold;">
                        </p>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px none "></td>
                </tr>

            </table>
        </div>
        <div id="invoice_head" style="margin-top: 3mm;">
            <table style="width:100%;">
                <tr>
                    <td style="text-align: left;">
                        {{ date('d-m-Y') }}

                    </td>
                    <td style="text-align: right;">
                        {{ date('H:m:s') }}

                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        Customer

                    </td>
                    <td style="text-align: right;">
                        {{ $members->nama }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        Alamat
                    </td>
                    <td style="text-align: right;">
                      {{ $members->alamat }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        Invoice

                    </td>
                    <td style="text-align: right;">
                        {{ $trans->kode_invoice }}
                    </td>
                </tr>

                <tr>
                    <td style="text-align: left;">
                        Kasir

                    </td>
                    <td style="text-align: right;">
                       {{ Auth::User()->nama }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align: left;">
                        Status

                    </td>
                    <td style="text-align: right;">
                        {{ $trans->dibayar }}
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="border-bottom: 1px dashed black;">


                    </td>

                </tr>
                <tr>
                    <td colspan="2">


                    </td>

                </tr>

                <!--<tr>
        <td> <center><p style="text-align:center; font-size: 14px; font-weight:bold;">Aplikasi Point Of Sales</p></center></td>
        </tr>-->
            </table>
        </div>

        <div id="content">

            <div id="invoice_body">

                <table>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($details as $data)
                    @php
                        $total = $total + $data->harga * $data->qty;
                    @endphp
                        <tr>
                            <td colspan="2" style="word-wrap: break-word; text-align: left;">{{ $data->nama_paket }}</td>
                            <td colspan="2"></td>
                        </tr>
                          
                        <tr style="margin-bottom: 1mm;">
                            <td style="text-align: left;">{{ $data->qty }}x</td>
                            <td>@Rp.{{ number_format($data->harga, 0, ',', '.') }}</td>
                            <td colspan="2" style="text-align: right;">
                                Rp.{{ number_format($data->harga * $data->qty, 0, ',', '.') }}</td>

                        </tr>
                    @endforeach

                </table>
            </div>



            <div id="invoice_total">
                <table>
                    <tr style="margin-bottom: 1mm ;margin-top: 1mm ;  border-top:1px dashed black">

                        <td style="text-align: left;">Sub Total</td>
                        <td colspan="3" style="text-align: right;">
                            {{ $total }}
                        </td>

                    </tr>
                </table>
            </div>

            <div id="invoice_total">
                <table>
                    <tr style="margin-bottom: 1mm ;margin-top: 1mm ; font-style: bold; ">

                        <td style="text-align: left;">Disk toko(%)</td>
                        <td colspan="3" style="text-align: right;">-
                            {{ $trans->diskon }}
                        </td>

                    </tr>
                </table>
            </div>


            <div id="invoice_total">
                <table>
                    <tr style="margin-bottom: 1mm ;margin-top: 1mm ;  font-weight: bold; border-top:1px dashed black">

                        <td style="text-align: left; font-weight: bold;">Total</td>
                        <td colspan="3" style="text-align: right; font-weight: bold;">
                                Rp.{{ number_format($total-$trans->diskon+$trans->pajak, 0, ',', '.') }}
                        </td>

                    </tr>
                </table>
            </div>

            <div id="invoice_total">
                <table>
                    <tr>
                        <td colspan="4" style="text-align:center; font-family: myFirstFont bold;">Terima kasih
                        </td>

                    </tr>
                    <tr>
                        <td style="text-align:left; font-size: 10pt; font-weight: normal;"><i></i></td>
                        <td style="text-align:left; font-size: 10pt; font-weight: bold;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td style="text-align:left; font-size: 10pt;"></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center; font-size: 10pt; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2" style="text-align:center; font-size: 10pt; font-weight: bold;"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td colspan="2"
                            style="text-align:center; font-size: 10pt; font-weight: bold; margin-bottom: 3mm;"></td>
                    </tr>
                </table>
            </div>

        </div>
        <br />
    </div>
    <script>
        setTimeout(function() {
            window.print();
        }, 500);
        window.onfocus = function() {
            setTimeout(function() {
                window.close();
            }, 10000);
        }
    </script>

</body>

</html>