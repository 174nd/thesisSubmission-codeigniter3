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
                  <label class="float-right" for="nm_prodi">Nama Program Studi</label>
                  <input type="text" name="nm_prodi" class="form-control" id="nm_prodi" placeholder="Nama Program Studi" value="<?= set_valup('nm_prodi', $prodi); ?>">
                  <?= form_error('nm_prodi', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-12 mb-0">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_fakultas">Fakultas</label>
                    </div>
                    <div class="col-12">
                      <select name="id_fakultas" id="id_fakultas" class="form-control custom-select select2">
                        <?php foreach ($fakultas as $a) { ?>
                          <option value="<?= $a['id_fakultas']; ?>" <?= cekSama(set_valup('id_fakultas', $prodi), $a['id_fakultas']) ?>><?= $a['nm_fakultas']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_fakultas', '<span class="invalid-feedback d-block">', '</span>'); ?>
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
            <div class="col-md-5 mb-2">
              <select id="column_prodi" class="form-control custom-select">
                <option value="0">Nama Program Studi</option>
                <option value="1">Nama Fakultas</option>
              </select>
            </div>
            <div class="col-md-7 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_prodi">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_prodi" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th>Nama Program Studi</th>
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


<div class="modal fade" id="data-prodi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Program Studi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_prodi">
            <b>Nama Program Studi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_fakultas">
            <b>Nama Fakultas</b><span class="float-right">x</span>
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


<div class="modal fade" id="prodi-delete">
  <form method="POST" action="<?= base_url('prodi/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Program Studi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data Program Studi Ini?</h4>
        <input type="hidden" name="id_prodi" id="id_prodi">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-prodi" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->