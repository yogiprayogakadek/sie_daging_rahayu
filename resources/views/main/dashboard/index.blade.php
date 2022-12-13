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
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-2">
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

            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-2">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Jumlah Stok Terkecil ({{produkMinStok()['produk']}})</h6>
                                <h2 class="mb-0 number-font">{{produkMinStok()['stok']['min']}}</h2>
                            </div>
                        </div>
                        <a href="{{route(produkMinStok()['route'])}}">
                            <span class="text-muted fs-12">
                                <span class="text-secondary">
                                    <i class="fe fe-arrow-right-circle text-secondary"></i> Detail
                                </span>
                            </span>
                        </a>
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
                            <div class="col-5">
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
                            </div>
                            <div class="col-2">
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
<script>
    $(document).ready(function(){
        function renderChart(bulan, tahun, filter) {
            $('.render').empty()
            if(bulan == '' || tahun == '' || filter == ''){
                $('.render').html('<div class="text-center"><h4>Tidak ada data</h4></div>')
                Swal.fire({
                    icon: 'warning',
                    title: 'Maaf...',
                    text: 'Pilih Bulan dan Tahun atu Filter terlebih dahulu!',
                });
            }else{
                $.ajax({
                    url: "{{route('dashboard.chart')}}",
                    type: 'POST',
                    data: {
                        filter: filter,
                        bulan: bulan,
                        tahun: tahun,
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
            var bulan = $('#bulan').val();
            var tahun = $('#tahun').val();
            var filter = $('#filter').val();
            renderChart(bulan, tahun, filter);
        });
    });
</script>
@endpush