@extends('templates.master')

@section('title', 'Detail Transaksi')
@section('pwd', 'Detail Transaksi')
@section('sub-pwd', 'Detail Transaksi')

@section('content')
<div class="row g-3 row-deck">
    <div class="card d-block">
        <div class="card-body">
            <div class="row">
                <div class="col-7">
                    Data Transaksi
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group" style="margin-right: 2px">
                                <label for="">Tanggal Awal</label>
                                <input type="date" class="form-control" id="start_date" value="{{date('Y-m-01')}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group" style="margin-right: 3px">
                                <label for="">Tanggal Akhir</label>
                                <input type="date" class="form-control" id="end_date" value="{{date("Y-m-t", strtotime(date('Y-m-01')))}}" min="{{date('Y-m-01')}}">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group" style="margin-top: 25px">
                                <button class="btn btn-info" id="btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                                <button class="btn btn-success btn-print">
                                    <i class="fa fa-print"></i>
                                </button>
                                <button class="btn btn-primary" id="btn-refresh">
                                    <i class="fa fa-refresh"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        {{-- <div class="card-header">
            <div class="card-title">Data Transaksi</div>
            <div class="card-options">
                <div class="form-group" style="margin-right: 2px">
                    <label for="">Tanggal Awal</label>
                    <input type="date" class="form-control" id="start_date" value="{{date('Y-m-01')}}">
                </div>
                <div class="form-group" style="margin-right: 3px">
                    <label for="">Tanggal Akhir</label>
                    <input type="date" class="form-control" id="end_date" value="{{date("Y-m-t", strtotime(date('Y-m-01')))}}" min="{{date('Y-m-01')}}">
                </div>
                <div class="form-group" style="margin-top: 29px">
                    <button class="btn btn-info btn-lg" id="btn-search">
                        <i class="fa fa-search"></i>
                    </button>
                    <button class="btn btn-success btn-lg btn-print">
                        <i class="fa fa-print"></i>
                    </button>
                    <button class="btn btn-primary btn-lg" id="btn-refresh">
                        <i class="fa fa-refresh"></i>
                    </button>
                </div>
            </div>
        </div> --}}
        <div class="card-body render">
            
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('assets/functions/main.js')}}"></script>
<script src="{{asset('assets/functions/print/main.js')}}"></script>
<script>
    function getData() {
        $.ajax({
            type: "get",
            url: "/penjualan/detail/render",
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    }

    function filterData(start_date, end_date) {
        $.ajax({
            type: "get",
            url: "/penjualan/detail/filter/"+start_date+"/"+end_date,
            dataType: "json",
            success: function (response) {
                $(".render").html(response.data);
                $('#start_date').val(start_date);
                $('#end_date').val(end_date);
            },
            error: function (error) {
                console.log("Error", error);
            },
        });
    }

    getData();

    $('body').on('click', '#btn-refresh', function() {
        getData()
    });

    $('body').on('click', '#btn-search', function() {
        let start_date = $('#start_date').val();
        let end_date = $('#end_date').val();

        filterData(start_date, end_date);
    });

    $('body').on('click', '.btn-print', function () {
        Swal.fire({
            title: 'Cetak data transaksi?',
            text: "Laporan akan dicetak",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, cetak!'
        }).then((result) => {
            if (result.value) {
                var mode = "iframe"; //popup
                var close = mode == "popup";
                var options = {
                    mode: mode,
                    popClose: close,
                    popTitle: 'LaporanDataTransaksi',
                };
                $.ajax({
                    type: "GET",
                    url: "/penjualan/print/"+$('#start_date').val()+"/"+$('#end_date').val(),
                    dataType: "json",
                    success: function (response) {
                        document.title= 'Laporan - ' + new Date().toJSON().slice(0,10).replace(/-/g,'/')
                        $(response.data).find("div.printableArea").printArea(options);
                    }
                });
            }
        })
    });
</script>
@endpush