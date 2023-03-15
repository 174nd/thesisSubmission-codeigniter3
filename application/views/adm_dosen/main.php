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
                <div class="col-md-4 mb-2">
                  <label class="float-right" for="nidn_dosen">NIDN Dosen</label>
                  <input type="text" name="nidn_dosen" class="form-control" id="nidn_dosen" placeholder="NIDN Dosen" value="<?= set_valup('nidn_dosen', $dosen); ?>">
                  <?= form_error('nidn_dosen', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-8 mb-2">
                  <label class="float-right" for="nm_dosen">Nama Dosen</label>
                  <input type="text" name="nm_dosen" class="form-control" id="nm_dosen" placeholder="Nama Dosen" value="<?= set_valup('nm_dosen', $dosen); ?>">
                  <?= form_error('nm_dosen', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-7 mb-2 mb-md-0">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_fakultas">Fakultas</label>
                    </div>
                    <div class="col-12">
                      <select name="id_fakultas" id="id_fakultas" class="form-control custom-select select2">
                        <?php foreach ($fakultas as $a) { ?>
                          <option value="<?= $a['id_fakultas']; ?>" <?= cekSama(set_valup('id_fakultas', $dosen), $a['id_fakultas']) ?>><?= $a['nm_fakultas']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_fakultas', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-5 mb-0">
                  <label class="float-right" for="no_telp">No. Telepon</label>
                  <input type="text" name="no_telp" class="form-control" id="no_telp" placeholder="No. Telepon" value="<?= set_valup('no_telp', $dosen); ?>">
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
              <select id="column_dosen" class="form-control custom-select">
                <option value="0">Nama Dosen</option>
                <option value="1">Nama Fakultas</option>
              </select>
            </div>
            <div class="col-md-8 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_dosen">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_dosen" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th>Nama Dosen</th>
                  <th>Nama Fakultas</th>
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


<div class="modal fade" id="data-dosen">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Dosen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nidn_dosen">
            <b>NIDN Dosen</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_dosen">
            <b>Nama Dosen</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_fakultas">
            <b>Nama Fakultas</b><span class="float-right">x</span>
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


<div class="modal fade" id="dosen-delete">
  <form method="POST" action="<?= base_url('adm_dosen/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Dosen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data Dosen Ini?</h4>
        <input type="hidden" name="id_dosen" id="id_dosen">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-dosen" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->