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
        <div class="card-body">
                <form id="formEdit">
                <div class="form-group">
                    <input type="hidden" name="user_id" id="user_id" value="{{$staff->user_id}}">
                    <label for="nama">Nama</label>
                    <input type="text" class="form-control nama" name="nama" id="nama" placeholder="masukkan nama" value="{{$staff->nama}}">
                    <div class="invalid-feedback error-nama"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="jenis-kelamin">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis-kelamin" class="form-control jenis_kelamin">
                        <option value="">Pilih jenis kelamin...</option>
                        <option value="1" {{$staff->jenis_kelamin == 1 ? 'selected' : ''}}>Laki - Laki</option>
                        <option value="0" {{$staff->jenis_kelamin == 0 ? 'selected' : ''}}>Perempuan</option>
                    </select>
                    <div class="invalid-feedback error-jenis_kelamin"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="telepon">No. Telp</label>
                    <input type="text" class="form-control telepon" name="telepon" id="telepon" placeholder="masukkan no. telp" value="{{$staff->telepon}}">
                    <div class="invalid-feedback error-telepon"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="alamat">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control alamat" rows="6">{{$staff->alamat}}</textarea>
                    <div class="invalid-feedback error-alamat"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="username">Username</label>
                    <input type="text" class="form-control username" name="username" id="username" placeholder="masukkan username" value="{{$staff->user->username}}">
                    <div class="invalid-feedback error-username"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="current-password">Password Sekarang</label>
                    <input type="password" class="form-control current_password" name="current_password" id="current-password" placeholder="masukkan password sekarang">
                    <div class="invalid-feedback error-current_password"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="new-password">Password Baru</label>
                    <input type="password" class="form-control new_password" name="new_password" id="new-password" placeholder="masukkan password baru">
                    <div class="invalid-feedback error-new_password"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="confirmation-password">Re-Password</label>
                    <input type="password" class="form-control confirmation_password" name="confirmation_password" id="confirmation-password" placeholder="masukkan konfirmasi password">
                    <div class="invalid-feedback error-confirmation_password"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="foto">Foto</label>
                    <input type="file" class="form-control foto" name="foto" id="foto" placeholder="masukkan foto">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-foto"></div>
                </div>
                <div class="form-group mt-2">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control status">
                        <option value="">Pilih Status</option>
                        <option value="1" {{$staff->user->status == 1 ? 'selected' : ''}}>Aktif</option>
                        <option value="0" {{$staff->user->status == 0 ? 'selected' : ''}}>Tidak Aktif</option>
                    </select>
                    <div class="invalid-feedback error-status"></div>
                </div>
                <div class="form-group mt-2">
                    <button class="btn btn-success btn-update pull-right" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>