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
            <form id="formEdit">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$pemasok->id}}">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama"
                        value="{{$pemasok->nama}}">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="telepon">No. Telp</label>
                    <input type="text" class="form-control telepon" name="telepon" id="telepon"
                        placeholder="masukkan no. telp" value="{{$pemasok->telepon}}">
                    <div class="invalid-feedback error-telepon"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control alamat"
                        rows="6">{{$pemasok->alamat}}</textarea>
                    <div class="invalid-feedback error-alamat"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control status">
                        <option value="">Pilih Status</option>
                        <option value="1" {{$kategori->status == 1 ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$kategori->status == 0 ? 'selected' : ''}}>Tidak Aktif</option>
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