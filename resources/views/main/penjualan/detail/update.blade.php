<table class="table table-stripped" id="tableData">
    <thead>
        <th>No</th>
        <th>Kode Transaksi</th>
        <th>Staff</th>
        <th>Member</th>
        <th>Discount</th>
        <th>Total</th>
        <th>Tanggal Transaksi</th>
    </thead>
    <tbody>
        @foreach ($data as $data)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$data->transaction_code}}</td>
                <td>{{$data->staff->name}}</td>
                <td>{{$data->member_id != null ? $data->member->name : '-'}}</td>
                <td>{{$data->discount}}%</td>
                <td>{{convertToRupiah($data->total)}}</td>
                <td>{{$data->sale_date}}</td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    $('#tableData').DataTable({
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
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