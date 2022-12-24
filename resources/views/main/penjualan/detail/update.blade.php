<table class="table table-stripped">
{{-- <table class="table table-stripped" id="tableData"> --}}
    <thead>
        <th>No</th>
        <th>Kode Transaksi</th>
        <th>Staff</th>
        <th>Diskon</th>
        <th>Total</th>
        <th>Tanggal Transaksi</th>
        <th></th>
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
                <td>
                    <button type="button" class="btn btn-view btn-primary" data-id="{{$data->id}}">
                        <i class="fa fa-eye"></i> Lihat
                    </button>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<!-- Modal Body -->
<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->
<div class="modal fade" id="modalView" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Detail Transaksi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered" id="tableTransaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Produk</th>
                            <th>Satuan</th>
                            <th>Harga</th>
                            <th>Kuantitas</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Keluar</button>
            </div>
        </div>
    </div>
</div>

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

    $('body').on('click', '.btn-view', function() {
        let id = $(this).data('id');
        $('#tableTransaksi tbody').empty();

        $.get("/penjualan/detail-transaksi/"+id,function (data) {
            $.each(data, function (index, value) { 
                let tr_list = '<tr>' +
                                '<td>' + value.no + '</td>' +
                                '<td>' + value.produk + '</td>' +
                                '<td>' + value.satuan + '</td>' +
                                '<td>' + value.harga + '</td>' +
                                '<td>' + value.kuantitas + '</td>' +
                                '<td>' + value.total + '</td>' +
                            '</tr>';

                $('#tableTransaksi tbody').append(tr_list);
            });
        });

        $('#modalView').modal('show')
    });
</script>