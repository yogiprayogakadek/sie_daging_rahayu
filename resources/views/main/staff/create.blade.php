<div class="col-12">
    <div class="card">
        <div class="card-header">
            <div class="card-title">Data Staff</div>
            <div class="card-options">
                <button class="btn btn-default btn-data" type="button">
                    <i class="fa fa-eye"></i> Data
                </button>
            </div>
        </div>
        <form id="formAdd">
            <div class="card-body">
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="jenis-kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis-kelamin" class="form-control jenis_kelamin">
                        <option value="">Pilih jenis kelamin...</option>
                        <option value="1">Laki - Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                    <div class="invalid-feedback error-jenis_kelamin"></div>
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
                    <label for="username">Username</label>
                    <input type="text" class="form-control username" name="username" id="username"
                        placeholder="masukkan username">
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="password">Password</label>
                    <input type="password" class="form-control password" name="password" id="password"
                        placeholder="masukkan password">
                    <div class="invalid-feedback error-password"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control foto" name="foto" id="foto" placeholder="masukkan foto">
                    <div class="invalid-feedback error-foto"></div>
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