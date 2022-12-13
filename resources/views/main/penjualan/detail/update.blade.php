<table class="table table-stripped">
{{-- <table class="table table-stripped" id="tableData"> --}}
    <thead>
        <th>No</th>
        <th>Kode Transaksi</th>
        <th>Staff</th>
        <th>Diskon</th>
        <th>Total</th>
        <th>Tanggal Transaksi</th>
    </thead>
    <tbody>
        @foreach ($data as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->kode_transaksi}}</td>
                <td>{{$data->staff->nama}}</td>
                <td>{{$data->diskon}}%</td>
                <td>{{convertToRupiah($data->total)}}</td>
                <td>{{$data->tanggal_transaksi}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='fa fa-arrow-left'>",
                next: "<i class='fa fa-arrow-right'>"
            },
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            infoEmpty: "Menampilkan 0 sampai 0 dari 0 data",
            lengthMenu: "Menampilkan _MENU_ data",
            search: "Cari:",
            emptyTable: "Tidak ada data tersedia",
            zeroRecords: "Tidak ada data yang cocok",
            loadingRecords: "Memuat data...",
            processing: "Memproses...",
            infoFiltered: "(difilter dari _MAX_ total data)"
        },
        lengthMenu: [
            [5, 10, 15, 20, -1],
            [5, 10, 15, 20, "All"]
        ],
    });
</script>