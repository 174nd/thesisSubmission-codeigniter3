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
                  <label class="float-right" for="nm_konsentrasi">Konsentasi</label>
                  <input type="text" name="nm_konsentrasi" class="form-control" id="nm_konsentrasi" placeholder="Konsentasi" value="<?= set_valup('nm_konsentrasi', $konsentrasi); ?>">
                  <?= form_error('nm_konsentrasi', '<span class="invalid-feedback d-block">', '</span>'); ?>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="row w-100 mx-0">
                <div class="col-md-12 mb-0">
                  <div class="row">
                    <div class="col-12">
                      <label class="float-right" for="id_prodi">Program Studi</label>
                    </div>
                    <div class="col-12">
                      <select name="id_prodi" id="id_prodi" class="form-control custom-select select2">
                        <?php foreach ($prodi as $a) { ?>
                          <option value="<?= $a['id_prodi']; ?>" <?= cekSama(set_valup('id_prodi', $konsentrasi), $a['id_prodi']) ?>><?= $a['nm_prodi']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <?= form_error('id_prodi', '<span class="invalid-feedback d-block">', '</span>'); ?>
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
              <select id="column_konsentrasi" class="form-control custom-select">
                <option value="0">Konsentrasi</option>
                <option value="1">Program Studi</option>
              </select>
            </div>
            <div class="col-md-8 mb-2">
              <input type="text" class="form-control" placeholder="Cari Data" id="field_konsentrasi">
            </div>
          </div>
          <div class="table-responsive">
            <table id="table_konsentrasi" class="table table-bordered table-hover" style="min-width: 400px;">
              <thead>
                <tr>
                  <th>Konsentrasi</th>
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


<div class="modal fade" id="data-konsentrasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Konsentrasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_konsentrasi">
            <b>Nama Konsentrasi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_prodi">
            <b>Program Studi</b><span class="float-right">x</span>
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


<div class="modal fade" id="konsentrasi-delete">
  <form method="POST" action="<?= base_url('konsentrasi/delete') ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Konsentrasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4 class="modal-title">Anda yakin ingin menghapus Data Konsentrasi Ini?</h4>
        <input type="hidden" name="id_konsentrasi" id="id_konsentrasi">
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-outline-success" data-dismiss="modal">Batal</button>
          <input type="submit" name="delete-konsentrasi" class="btn btn-outline-danger" value="Hapus">
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </form>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->