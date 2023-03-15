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
                <div class="col-md-12 mb-2">
                  <label class="float-right" for="nm_mahasiswa">Nama Mahasiswa</label>
                  <input type="text" name="nm_mahasiswa" class="form-control" id="nm_mahasiswa" placeholder="Nama Mahasiswa" value="<?= set_valup('nm_mahasiswa', $mahasiswa); ?>">
                  <?= form_error('nm_mahasiswa', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-4 mb-2">
                  <label class="float-right" for="nim_mahasiswa">No. Induk</label>
                  <input type="text" name="nim_mahasiswa" class="form-control" id="nim_mahasiswa" placeholder="No. Induk" value="<?= set_valup('nim_mahasiswa', $mahasiswa); ?>">
                  <?= form_error('nim_mahasiswa', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-8 mb-2">
                  <label class="float-right" for="email_mahasiswa">Email</label>
                  <input type="text" name="email_mahasiswa" class="form-control" id="email_mahasiswa" placeholder="Email" value="<?= set_valup('email_mahasiswa', $mahasiswa); ?>">
                  <?= form_error('email_mahasiswa', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-7 mb-2 mb-md-0">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_prodi">Program Studi</label>
                    </div>
                    <div class="col-12">
                      <select name="id_prodi" id="id_prodi" class="form-control custom-select select2">
                        <?php foreach ($prodi as $a) { ?>
                          <option value="<?= $a['id_prodi']; ?>" <?= cekSama(set_valup('id_prodi', $mahasiswa), $a['id_prodi']) ?>><?= $a['nm_prodi']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_prodi', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-5 mb-0">
                  <label class="float-right" for="no_telp">No. Telepon</label>
                  <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No. Telepon" value="<?= set_valup('no_telp', $mahasiswa); ?>">
                  <?= form_error('no_telp', '<span class="invalid-feedback d-block">', '</span>'); ?>
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
              <select id="column_mahasiswa" class="form-control custom-select">
                <option value="0">Mahasiswa</option>
                <option value="1">Program Studi</option>
              </select>
            </div>
            <div class="col-md-8 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_mahasiswa">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_mahasiswa" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th>Nama Mahasiswa</th>
                  <th>Program Studi</th>
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


<div class="modal fade" id="data-mahasiswa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Mahasiswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nim_mahasiswa">
            <b>No. Induk</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_mahasiswa">
            <b>Nama Mahasiswa</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_prodi">
            <b>Program Studi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="email_mahasiswa">
            <b>Email</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="no_telp">
            <b>No. Telepon</b><span class="float-right">x</span>
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


<div class="modal fade" id="mahasiswa-delete">
  <form method="POST" action="<?= base_url('adm_mahasiswa/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Mahasiswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data Mahasiswa Ini?</h4>
        <input type="hidden" name="id_mahasiswa" id="id_mahasiswa">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-mahasiswa" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->