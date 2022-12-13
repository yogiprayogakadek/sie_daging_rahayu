<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Data Produk</div>
            <div class="card-options">
                <button class="btn btn-default btn-data" type="button">
                    <i class="fa fa-eye"></i> Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="formEdit">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$produk->id}}">
                    <label for="kategori">Nama Kategori</label>
                    <select name="kategori" id="kategori" class="form-control kategori">
                        @foreach ($kategori as $key => $value)
                        <option value="{{$key}}" {{$produk->kategori_id == $key ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-kategori"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control nama" name="nama" id="nama"
                        placeholder="masukkan nama produk" value="{{$produk->nama}}">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="harga">Harga Produk</label>
                    <input type="text" class="form-control harga" name="harga" id="harga"
                        placeholder="masukkan harga produk" value="{{$produk->harga}}">
                    {{-- <input type="text" class="form-control harga" name="harga" id="harga"
                        placeholder="masukkan harga produk" value="{{convertToRupiah($produk->harga)}}"> --}}
                    <div class="invalid-feedback error-harga"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="satuan">Satuan Produk</label>
                    <select name="satuan" id="satuan" class="form-control satuan">
                        <option value="">Pilih satuan produk...</option>
                        @foreach ($satuan as $value)
                        <option value="{{$value}}" {{$value == $produk->satuan ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-satuan"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="gambar">Foto Produk</label>
                    <input type="file" class="form-control gambar" name="gambar" id="gambar">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-gambar"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="stok">Stok Produk</label>
                    <input type="text" class="form-control stok" name="stok" id="stok"
                        placeholder="masukkan stok produk"
                        value="{{$produk->atribut != null ? $produk->atribut->stok : 0}}">
                    <div class="invalid-feedback error-stok"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="rejected">Produk Rejected</label>
                    <input type="text" class="form-control rejected" name="rejected" id="rejected"
                        placeholder="masukkan stok produk"
                        value="{{$produk->atribut != null ? $produk->atribut->produk_rejected : 0}}">
                    <div class="invalid-feedback error-rejected"></div>
                </div>
                <div class="form-group">
                    <label for="pemasok">Pemasok</label>
                    <select name="pemasok" id="pemasok" class="form-control pemasok">
                        @foreach ($pemasok as $key => $value)
                        <option value="{{$key}}" {{$produk->pemasok_id == $key ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-pemasok"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control status">
                        <option value="">Pilih Status</option>
                        <option value="1" {{$produk->status == 1 ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$produk->status == 0 ? 'selected' : ''}}>Tidak Aktif</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success btn-update pull-right" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    // $('.select2-show-search').select2({
    //     minimumResultsForSearch: '',
    //     // width: '100%'
    // });
    $("#harga").inputFilter(function(value) {
        return /^\d*$/.test(value); }, "Tidak bisa negatif");

    $("#stok").inputFilter(function(value) {
        return /^\d*$/.test(value);
    },"Hanya mengandung angka");

    $("#rejected").inputFilter(function(value) {
        return /^\d*$/.test(value);
    },"Hanya mengandung angka");
</script>