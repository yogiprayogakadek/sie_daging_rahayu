<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Data Pemasok</div>
            <div class="card-options">
                <button class="btn btn-default btn-data" type="button">
                    <i class="fa fa-eye"></i> Data
                </button>
            </div>
        </div>
        <div class="card-body">
            <form id="formAdd">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="telepon">No. Telp</label>
                    <input type="text" class="form-control telepon" name="telepon" id="telepon"
                        placeholder="masukkan no. telp">
                    <div class="invalid-feedback error-telepon"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control alamat" rows="6"></textarea>
                    <div class="invalid-feedback error-alamat"></div>
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