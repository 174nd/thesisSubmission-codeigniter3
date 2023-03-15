<form method="POST" enctype="multipart/form-data" autocomplete="off" id="form-utama">
  <div class="row">
    <div class="col-md-6">
      <div class="card card-success card-outline">
        <div class="overlay d-flex justify-content-center align-items-center invisible">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="card-body">
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-6 mb-2">
                  <label class="float-right" for="username">Username</label>
                  <input type="text" name="username" class="form-control" id="username" placeholder="Username" value="<?= set_valup('username', $user); ?>">
                  <?= form_error('username', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-6 mb-2">
                  <label class="float-right" for="password">Password</label>
                  <input type="text" name="password" class="form-control" id="password" placeholder="Password" value="<?= set_valup('password', $user); ?>">
                  <?= form_error('password', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-8 mb-2">
                  <label class="float-right" for="nm_user">Nama User</label>
                  <input type="text" name="nm_user" class="form-control" id="nm_user" placeholder="Nama User" value="<?= set_valup('nm_user', $user); ?>">
                  <?= form_error('nm_user', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-8 mb-2 d-none">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_dosen">Dosen</label>
                    </div>
                    <div class="col-12">
                      <select name="id_dosen" id="id_dosen" class="form-control custom-select select2">
                        <?php foreach ($dosen as $a) { ?>
                          <option value="<?= $a['id_dosen']; ?>" <?= cekSama(set_valup('id_dosen', $user), $a['id_dosen']) ?>><?= $a['nm_dosen']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_dosen', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-8 mb-2 d-none">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_mahasiswa">Mahasiswa</label>
                    </div>
                    <div class="col-12">
                      <select name="id_mahasiswa" id="id_mahasiswa" class="form-control custom-select select2">
                        <?php foreach ($mahasiswa as $a) { ?>
                          <option value="<?= $a['id_mahasiswa']; ?>" <?= cekSama(set_valup('id_mahasiswa', $user), $a['id_mahasiswa']) ?>><?= $a['nm_mahasiswa']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_mahasiswa', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-4 mb-2">
                  <label class="float-right" for="akses">Akses</label>
                  <select name="akses" id="akses" class="form-control btn-square">
                    <option value="admin" <?= cekSama(set_valup('akses', $user), 'admin') ?>>Admin</option>
                    <option value="dosen" <?= cekSama(set_valup('akses', $user), 'dosen') ?>>Dosen</option>
                    <option value="mahasiswa" <?= cekSama(set_valup('akses', $user), 'mahasiswa') ?>>Mahasiswa</option>
                  </select>
                  <?= form_error('akses', '<p class="help-block text-danger">', '</p>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-12 mb-0">
                  <label class="float-right" for="foto_user">Foto User</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" name="foto_user" class="custom-file-input" id="foto_user">
                      <label class="custom-file-label" for="foto_user"><?= set_valup('foto_user', $user, 'Choose file'); ?></label>
                      <?= form_error('foto_user', '<span class="invalid-feedback d-block">', '</span>'); ?>
                    </div>
                  </div>
                </div>
              </div>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <button type="submit" class="btn btn-block btn-success"><?= $this->uri->segment(3) == '' ? 'Simpan' : 'Ubah'; ?></button>
        </div>
        <!-- /.card-footer -->
      </div>
      <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-6">
      <div class="card card-success card-outline">
        <div class="card-body">
          <div class="row">
            <div class="col-md-4 mb-2">
              <select id="column_user" class="form-control custom-select">
                <option value="0">Nama User</option>
                <option value="1">Username</option>
              </select>
            </div>
            <div class="col-md-8 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_user">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_user" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th>Nama User</th>
                  <th>Username</th>
                  <th>Act</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.nav-tabs-custom -->
    </div>
    <!-- /.col -->
  </div>
</form>


<div class="modal fade" id="data-user">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nama_user">
            <b>Nama User</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="username">
            <b>Username</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="password">
            <b>Password</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="akses">
            <b>Akses</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item">
            <div class="btn-group w-100 set-button">
              <button type="button" class="btn btn-sm btn-danger set-delete">Hapus</button>
              <a href="#" class="btn btn-sm bg-info set-update">Ubah</a>
            </div>
          </li>
        </ul>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="user-delete">
  <form method="POST" action="<?= base_url('user/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus User</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data User Ini?</h4>
        <input type="hidden" name="id_user" id="id_user">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-user" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->