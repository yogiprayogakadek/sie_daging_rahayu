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
    <body>
        <div class="logo">
            <img src="{{public_path() . '\\'. 'assets/logo/logo.png'}}" height="150px">
        </div>

        <div class="company-name">
            <h2>Laporan Penjualan</h2>
        </div>

        <table class="table">
            <tr style="border: 1px">
                <th rowspan="2">No</th>
                <th rowspan="2">Kode Transaksi</th>
                <th rowspan="2">Staff</th>
                <th rowspan="2">Diskon</th>
                <th rowspan="2">Tanggal Transaksi</th>
                <th colspan="3">Detail Transaksi</th>
                <th rowspan="2">Total Transaksi</th>
            </tr>
            </tr>
                <th>Nama Barang</th>
                <th>Harga</th>
                <th>Kuantitas</th>
            <tr>
            @foreach ($data as $data)
                <tr>
                    <td class="align-middle">{{$loop->iteration}}</td>
                    <td class="align-middle">{{$data->kode_transaksi}}</td>
                    <td class="align-middle">{{$data->staff->nama}}</td>
                    <td class="align-middle">{{$data->diskon}}%</td>
                    <td class="align-middle">{{$data->tanggal_transaksi}}</td>
                    @foreach ($data->detail as $detail)
                    <td>{{$detail->produk->nama}}</td>
                    <td>{{convertToRupiah($detail->produk->harga)}}</td>
                    <td>{{$detail->kuantitas}}</td>
                    @endforeach
                    <td class="align-middle">{{convertToRupiah($data->total)}}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="8">Total</td>
                <td>{{convertToRupiah($total)}}</td>
            </tr>
        </table>
    </body>
</html>