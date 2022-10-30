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
            <form id="formAdd">
                <div class="form-group">
                    <label for="kategori">Nama Kategori</label>
                    <select name="kategori" id="kategori" class="form-control kategori">
                        @foreach ($kategori as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-kategori"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="nama">Nama Produk</label>
                    <input type="text" class="form-control nama" name="nama" id="nama"
                        placeholder="masukkan nama produk">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="harga">Harga Produk</label>
                    <input type="text" class="form-control harga" name="harga" id="harga"
                        placeholder="masukkan harga produk">
                    <div class="invalid-feedback error-harga"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="gambar">Foto Produk</label>
                    <input type="file" class="form-control gambar" name="gambar" id="gambar">
                    <div class="invalid-feedback error-gambar"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="pemasok">Pemasok</label>
                    <select name="pemasok" id="pemasok" class="form-control pemasok">
                        @foreach ($pemasok as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-pemasok"></div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success btn-save pull-right" type="button">
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
</script>