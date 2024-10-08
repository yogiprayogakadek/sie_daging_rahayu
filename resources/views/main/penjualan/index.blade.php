@extends('templates.master')

@section('title', 'Transaksi')
@section('pwd', 'Transaksi')
@section('sub-pwd', 'Transaksi')

@section('content')
<div class="row g-3 row-deck render">
    <div class="col-5">
        <div class="card d-block">
            <div class="card-header">
                <div class="card-title">Data Produk</div>
                <div class="card-options">
                    <button class="btn btn-primary btn-clear" style="margin-left: 2px">
                        <i class="fa fa-undo"></i> Refresh
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group"> 
                    <div class="input-group"> 
                        <input type="text" class="form-control" name="slug" aria-label="Example text with button addon" aria-describedby="button-addon1"> 
                        <button class="btn btn-light btn-search" type="button" id="button-addon2">
                            <i class="fa fa-search"></i> Cari
                        </button> 
                    </div> 
                </div>

                <div class="mt-3 data-product">
                    <table class="table table-hover" id="tableProduct">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Harga Produk</th>
                                <th>Stok Produk</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    <div class="col-7">
        <div class="card d-block">
            <div class="card-header">
                <div class="card-title">Keranjang Belanja</div>
            </div>
            <div class="card-body">
                <table class="table table-hover table-responsive-lg" id="tableCart">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Produk</th>
                            <th>Harga Produk</th>
                            <th>Kuantitas</th>
                            <th>Satuan</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse (\cart() as $cart)
                            <tr>
                                <td><img src="{{asset($cart->associatedModel['gambar'])}}" width="100px"></td>
                                <td>{{$cart['name']}}</td>
                                <td class="text-end">{{convertToRupiah($cart['price'])}}</td>
                                {{-- <td>{{$cart['quantity']}}</td> --}}
                                <td>
                                    <div class="handle-counter" id="handleCounter4"> 
                                        <button type="button" class="btn btn-white lh-2 shadow-none {{$cart->quantity == 1 ? 'btn-remove' : 'counter-minus'}}" data-id="{{$cart->id}}"> 
                                            <i class="fa fa-minus text-muted"></i> 
                                        </button> 
                                        <input id="qty"type="text" value="{{$cart->quantity}}" class="qty form-control-sm text-center" name="qty" data-id="{{$cart->id}}"> 
                                        <button type="button" class="counter-plus btn btn-white lh-2 shadow-none" data-id="{{$cart->id}}"> 
                                            <i class="fa fa-plus text-muted"></i> 
                                        </button>
                                    </div>
                                </td>
                                <td>{{$cart->associatedModel['satuan']}}</td>
                                <td>{{convertToRupiah($cart['quantity']*$cart['price'])}}</td>
                                <td>
                                    <button class="btn btn-remove btn-danger" data-id="{{$cart['id']}}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">
                                    <h3>Tidak ada data pada keranjang...</h3>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="card-footer block-hide" hidden>
                <div class="row">
                    <div class="col-6 text-start">
                        <button class="btn btn-danger btn-remove-discount" type="button">
                            <i class="fa fa-trash"></i> Hapus Diskon
                        </button>
                    </div>
                    <div class="col-6 text-end">
                        <div class="input-group mb-1"> 
                            <input type="text" class="form-control" name="discount"> 
                            <span class="input-group-text btn btn-primary btn-discount">Terapkan Diskon</span> 
                        </div>
                        <p class="text-muted text-small">*diskon berupa persentase</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- total --}}
    <div class="col-5 block-hide" hidden></div>
    <div class="col-7 block-hide" hidden>
        <div class="card d-block">
            <div class="card-header">
                <div class="card-title">Total Keranjang</div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-borderless" id="tableTotalCart">
                        <tbody>
                            <tr>
                                <td class="text-start">Sub Total</td>
                                <td class="text-end sub-total">{{subTotal()}}</td>
                            </tr>
                            <tr>
                                <td class="text-start">Diskon</td>
                                <td class="text-end total-discount">0%</td>
                            </tr>
                            <tr>
                                <td class="text-start"></td>
                                <td class="text-end price-cut">0</td>
                            </tr>
                            <tr>
                                <td class="text-start">Total Bayar</td>
                                <td class="text-end total-price"></td>
                            </tr>
                            <tr>
                                <td class="text-start">Tunai:</td>
                                <td>
                                    <input type="text" class="form-control text-end" name="tunai" aria-label="tunai"
                                            placeholder="masukkan jumlah uang tunai" value="0" id="tunai">
                                </td>
                            </tr>
                            <tr>
                                <td class="text-start">Kembalian:</td>
                                <td style=" text-align: right" id="kembalian"></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-6 text-start"></div>
                    <div class="col-6 text-end">
                        <button class="btn btn-primary btn-checkout">
                            <i class="fa fa-arrow-right"></i> Proses Transaksi
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script src="{{asset('assets/functions/main/main.js')}}"></script>
<script src="{{asset('assets/functions/penjualan/main.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery.session@1.0.0/jquery.session.min.js"></script>
    <script>
        function assets(url) {
            var url = '{{ url("") }}/' + url;
            return url;
        }
    </script>
@endpush