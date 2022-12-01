<html>
    <head>
        <style>
            body {
                padding: 0;
                margin: 0;
            }
            
            .table {
                /* border: 1px solid black; */
                width: 100%;
                text-align: center;
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid black;
                /* border-collapse: collapse; */
            }

            .logo {
                text-align: center;
                padding-top: 10px;
            }

            .company-name {
                text-align: center;
                font-weight: bold;
                margin-top: -40px;
            }
        </style>
    </head>
    <body id="printArea">
        <div class="logo">
            <img src="{{public_path() . '\\'. 'assets/logo/logo.png'}}" height="150px">
        </div>

        <div class="company-name">
            <h2>Laporan Penjualan</h2>
        </div>

        <table class="table">
            <tr style="border: 1px">
                <th>No</th>
                <th>Kode Transaksi</th>
                <th>Staff</th>
                <th>Diskon</th>
                <th>Tanggal Transaksi</th>
                <th>Detail Transaksi</th>
                <th>Total Transaksi</th>
            </tr>
            @foreach ($data as $data)
                <tr>
                    <td class="align-middle">{{$loop->iteration}}</td>
                    <td class="align-middle">{{$data->kode_transaksi}}</td>
                    <td class="align-middle">{{$data->staff->nama}}</td>
                    <td class="align-middle">{{$data->diskon}}%</td>
                    <td class="align-middle">{{$data->tanggal_transaksi}}</td>
                    <td>
                        <table style="width: 100%; border: 0px !important;">
                            @foreach ($data->detail as $detail)
                            <tr>
                                <td>{{$detail->produk->nama}}</td>
                                <td>{{convertToRupiah($detail->produk->harga)}}</td>
                                <td>{{$detail->kuantitas}} pcs</td>
                            </tr>
                            @endforeach
                        </table>
                    </td>
                    <td class="align-middle">{{convertToRupiah($data->total)}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="6">Total</td>
                <td>{{convertToRupiah($total)}}</td>
            </tr>
        </table>
    </body>
</html>