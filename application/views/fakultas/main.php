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
                <div class="col-md-8 mb-2 mb-md-0">
                  <label class="float-right" for="nm_fakultas">Nama Fakultas</label>
                  <input type="text" name="nm_fakultas" class="form-control" id="nm_fakultas" placeholder="Nama Fakultas" value="<?= set_valup('nm_fakultas', $fakultas); ?>">
                  <?= form_error('nm_fakultas', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
                <div class="col-md-4 mb-0">
                  <label class="float-right" for="form_fakultas">Form</label>
                  <input type="text" name="form_fakultas" class="form-control" id="form_fakultas" placeholder="Form" value="<?= set_valup('form_fakultas', $fakultas); ?>">
                  <?= form_error('form_fakultas', '<span class="invalid-feedback d-block">', '</span>'); ?>
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
            <div class="col-md-3 mb-2">
              <select id="column_fakultas" class="form-control custom-select">
                <option value="0">Fakultas</option>
                <option value="1">Form</option>
              </select>
            </div>
            <div class="col-md-9 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_fakultas">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_fakultas" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th class="text-center">Nama Fakultas</th>
                  <th class="text-center">Form</th>
                  <th class="text-center">Act</th>
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


<div class="modal fade" id="data-fakultas">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Fakultas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_fakultas">
            <b>Nama Fakultas</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="form_fakultas">
            <b>Form</b><span class="float-right">x</span>
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


<div class="modal fade" id="fakultas-delete">
  <form method="POST" action="<?= base_url('fakultas/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Fakultas</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data Fakultas Ini?</h4>
        <input type="hidden" name="id_fakultas" id="id_fakultas">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-fakultas" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->