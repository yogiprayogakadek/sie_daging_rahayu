@extends('templates.master')

@section('title', 'Dashboard')
@section('pwd', 'Dashboard')
@section('sub-pwd', 'Data')

@section('content')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="alert alert-info">
            <i class="fa fa-exclamation-triangle"></i>
            <strong>Hai!</strong>
            Selamat datang, {{username()}}
        </div>
        <div class="row">
            @foreach (menu() as $key => $menu)
            <div class="col-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah {{$menu}}</h6>
                                <h2 class="mb-0 number-font">{{totalData($menu)}}</h2>
                            </div>
                        </div>
                        <a href="{{route(RouteUrl()[$key])}}">
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> Detail
                                </span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            <div class="col-4">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah Stok Terkecil</h6>
                                <h2 class="mb-0 number-font">{{produkMinStok()['stok']}}</h2>
                            </div>
                        </div>
                        {{-- <a href="{{route(produkMinStok()['route'])}}"> --}}
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> {{produkMinStok()['produk']}}
                                </span>
                            </span>
                        {{-- </a> --}}
                    </div>
                </div>
            </div>

            <div class="col-4 mt-2">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah Penjualan Terbanyak ({{bestSeller()[0]['nama']}})</h6>
                                <h2 class="mb-0 number-font">{{bestSeller()[0]['kuantitas']}}</h2>
                            </div>
                        </div>
                        {{-- <a href="{{route(produkMinStok()['route'])}}">
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> Detail
                                </span>
                            </span>
                        </a> --}}
                    </div>
                </div>
            </div>

            <div class="col-4 mt-2">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah Penjualan Terkecil ({{worstSeller()[0]['nama']}})</h6>
                                <h2 class="mb-0 number-font">{{worstSeller()[0]['kuantitas']}}</h2>
                            </div>
                        </div>
                        {{-- <a href="{{route(produkMinStok()['route'])}}">
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> Detail
                                </span>
                            </span>
                        </a> --}}
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="card-title mb-0">Chart Penjualan Produk</h6>
    
                    <div class="dropdown morphing scale-left">
                        <div class="row">
                            <select class="form-control" id="filter" hidden>
                                <option value="">Pilih Filter</option>
                                <option value="product" selected>Berdasarkan Produk</option>
                                <option value="category">Berdasarkan Kategori</option>
                            </select>
                            {{-- <div class="col-5">
                                <select class="form-control" id="bulan">
                                    <option value="">Pilih Bulan</option>
                                    @foreach (bulan() as $key => $bulan)
                                    <option value="{{$key+1}}">{{$bulan}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-5">
                                <select class="form-control" id="tahun">
                                    <option value="">Pilih Tahun</option>
                                    @for($i = 2022; $i <= 2030; $i++) <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                </select>
                            </div> --}}

                            <div class="col-5">
                                <input type="date" name="start_date" id="start_date" class="form-control start_date" placeholder="tanggal awal">
                            </div> -
                            <div class="col-5">
                                <input type="date" name="end_date" id="end_date" class="form-control end_date" placeholder="tanggal akhir">
                            </div>

                            <div class="col-1">
                                <button class="btn btn-primary" id="btn-search">
                                    <i class="fa fa-search"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body render">
                    <h6 class="text-center">
                        Chart akan tampil disini
                    </h6>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection

@push('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels"></script>
<script>
    $(document).ready(function(){
        flatpickr('#start_date', {
            dateFormat: "d-m-Y"
        })

        flatpickr('#end_date', {
            dateFormat: "d-m-Y"
        })

        function renderChart(start_date, end_date, filter) {
            $('.render').empty()
            // if(bulan == '' || tahun == '' || filter == ''){
            if(start_date == '' || end_date == '' || filter == ''){
                $('.render').html('<div class="text-center"><h4>Tidak ada data</h4></div>')
                Swal.fire({
                    icon: 'warning',
                    title: 'Maaf...',
                    text: 'Pilih tanggal pencarian!',
                });
            }else{
                $.ajax({
                    url: "{{route('dashboard.chart')}}",
                    type: 'POST',
                    data: {
                        filter: filter,
                        start_date: start_date,
                        end_date: end_date,
                        _token: '{{csrf_token()}}'
                    },
                    success: function(data){
                        $('.render').html(data.data);
                    }
                });
            }
        }

        $('#btn-search').click(function(){
            $('.render').empty()
            var start_date = $('#start_date').val();
            var end_date = $('#end_date').val();
            var filter = $('#filter').val();
            renderChart(start_date, end_date, filter);
        });
    });
</script>
@endpush