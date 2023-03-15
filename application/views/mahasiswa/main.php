<div class="container-fluid">

  <!-- Main row -->
  <div class="row">

    <section class="col-md-8 connectedSortable">
      <div class="alert alert-primary status_none">
        <h5 class="m-0"><i class="icon fas fa-address-card"></i> Silahkan Lakukan Pengajuan Judul!</h5>
      </div>
      <div class="alert alert-success status_terima">
        <h5><i class="icon fas fa-check"></i> Pengajuan Anda Diterima!</h5>
        Pengajuan Anda Telah Diterima, dengan judul :
        <p class="m-0 font-weight-bold">x</p>
      </div>

      <div class="alert alert-warning status_proses">
        <h5 class="m-0"><i class="icon fas fa-sync"></i> Pengajuan Anda Segera Diperiksa!</h5>
      </div>

      <div class="alert alert-danger status_tolak">
        <h5><i class="icon fas fa-exclamation-triangle"></i> Pengajuan Anda Ditolak!</h5>
        Silahkan Melakukan Pengajuan Ulang dikarenakan Pengajuan anda ditolak dengan alasan sebagai berikut :
        <p class="m-0">xxx</p>
      </div>

      <div class="card card-dark">
        <div class="overlay d-flex justify-content-center align-items-center invisible">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Histori Pengajuan</h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse">
              <i class="fas fa-minus"></i>
            </button>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <div class="row">
                <div class="col-md-3 mb-2">
                  <select id="column_hpengajuan" class="form-control custom-select">
                    <option value="1">Judul</option>
                    <option value="0">Tanggal</option>
                    <option value="2">Status</option>
                  </select>
                </div>
                <div class="col-md-9 mb-2">
                  <input type="text" class="form-control" placeholder="Cari Data" id="field_hpengajuan">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="table-responsive">
                <table id="table_hpengajuan" class="table table-bordered table-striped" style="min-width: 500px; width:100%;">
                  <thead>
                    <tr>
                      <th class='text-center' style="width: 50px;">Tanggal</th>
                      <th class='text-center'>Judul</th>
                      <th class='text-center' style="width: 50px;">Status</th>
                      <th class='text-center' style="width: 50px;">Act</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Guest History -->
    </section>

    <section class="col-md-4 connectedSortable">
      <div class="card card-success card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?= base_url($mahasiswa['foto_user'] != '' && file_exists(FCPATH . 'uploads/users/' . $mahasiswa['foto_user']) ? 'uploads/users/' . rawurlencode($mahasiswa['foto_user']) : 'dist/img/user.png') ?>" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center"><?= $mahasiswa['nm_mahasiswa']; ?></h3>

          <p class="text-muted text-center"><?= $mahasiswa['nim_mahasiswa']; ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Program Studi</b> <span class="float-right"><?= $mahasiswa['nm_prodi']; ?></span>
            </li>
            <li class="list-group-item">
              <b>Email</b> <span class="float-right"><?= $mahasiswa['email_mahasiswa']; ?></span>
            </li>
            <li class="list-group-item">
              <b>No. Telepon</b> <span class="float-right"><?= $mahasiswa['no_telp']; ?></span>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>



      <div class="card d-none pilih_konsentrasi">
        <div class="card-body bg-success">
          <button type="button" class="btn btn-block btn-outline-light" data-toggle="modal" data-target="#pilih-konsentrasi">Pilih Konsentrasi</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Pilih Konsentrasi -->


      <div class="card d-none input_pengajuan">
        <div class="card-body bg-primary">
          <button type="button" class="btn btn-block btn-outline-light" data-toggle="modal" data-target="#input-pengajuan">Input Pengajuan</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Input Pengajuan -->


      <div class="card d-none data_pengajuan">
        <div class="card-body bg-dark">
          <button type="button" class="btn btn-block btn-outline-light" data-toggle="modal" data-target="#data-pengajuan">Data Pengajuan</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Data Pengajuan -->


      <div class="card cetak_sk">
        <div class="card-body bg-dark">
          <a class="btn btn-block btn-outline-light" href="<?= base_url('export/cetak_sk') ?>" target="_blank">Cetak SK</a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Cetak SK -->


      <div class="card">
        <div class="card-body bg-success">
          <a class="btn btn-block btn-outline-light" href="<?= base_url('export/panduan_mahasiswa') ?>">Panduan Mahasiswa</a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Panduan Dosen -->

    </section>
  </div>
  <!-- /.row (main row) -->
</div>





<div class="modal fade" id="pilih-konsentrasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Pilih Konsentrasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="col-md-12">
              <div class="row">
                <div class="col-12">
                  <label class="float-right" for="id_konsentrasi">Konsentrasi</label>
                </div>
                <div class="col-12">
                  <select name="id_konsentrasi" id="id_konsentrasi" class="form-control custom-select select2" required>
                  </select>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-konsentrasi" class="btn btn-primary">Pilih</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="input-pengajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Input Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_mahasiswa">
            <b>Nama Mahasiswa</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nim_mahasiswa">
            <b>No. Induk</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_prodi">
            <b>Program Studi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_fakultas">
            <b>Fakultas</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_konsentrasi">
            <b>Konsentrasi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="no_telp">
            <b>No. Telepon</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item">
            <div class="btn-group w-100 set-button">
              <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#ubah-konsentrasi">Ubah Konsentrasi</button>
              <button type="button" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ajukan-judul">Ajukan Judul</button>
            </div>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table class="table table-bordered" style="margin: 0; min-width: 300px; width:100%;">
                <thead>
                  <tr>
                    <th class='text-center'>Judul</th>
                    <th class='text-center' style="width: 50px;">Status</th>
                    <th class='text-center' style="width: 10px;">Act</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button class="btn btn-primary" data-toggle="modal" data-target="#konfirmasi-pengajuan">Ajukan</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="ubah-konsentrasi">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Ubah Konsentrasi</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="col-md-12">
              <div class="row">
                <div class="col-12">
                  <label class="float-right" for="id_konsentrasi">Konsentrasi</label>
                </div>
                <div class="col-12">
                  <select name="id_konsentrasi" id="id_konsentrasi" class="form-control custom-select select2" required>
                  </select>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-konsentrasi" class="btn btn-primary">Pilih</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="konfirmasi-pengajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Konfirmasi Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Anda yakin ingin Mengajukan Judul-Judul Ini? Mohon diperiksa kembali judul yang anda ajukan sebelum melakukan konfirmasi pada pengajuan ini</h4>
        <input type="hidden" name="id_judul" id="id_judul">
      </div>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-konfirmasi" class="btn btn-primary">Konfirmasi</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<div class="modal fade" id="ajukan-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Ajukan Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- <input type="hidden" id="id_pengajuan"> -->


        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="nm_judul">Nama Judul</label>
                <input type="text" name="nm_judul" class="form-control" id="nm_judul" placeholder="Nama Judul">
              </div>
            </div>
          </li>
          <!-- <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="nm_judul">Nama Judul</label>
                <textarea name="nm_judul" class="form-control" id="nm_judul" placeholder="Nama Judul"></textarea>
              </div>
            </div -->
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-4 mb-2">
                <div class="row">
                  <div class="col-12">
                    <label class="float-right" for="id_pimpinan">Unsur Pimpinan</label>
                  </div>
                  <div class="col-12">
                    <select name="id_pimpinan" id="id_pimpinan" class="form-control custom-select select2" required>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8 mb-2">
                <label class="float-right" for="nm_perusahaan">Nama Perusahaan</label>
                <input type="text" name="nm_perusahaan" class="form-control" id="nm_perusahaan" placeholder="Nama Perusahaan">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="kelebihan_judul">Latar Belakang</label>
                <textarea name="latar_belakang" class="form-control" id="latar_belakang" placeholder="Latar Belakang"></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="gambaran_judul">Gambaran Judul</label>
                <textarea name="gambaran_judul" class="form-control" id="gambaran_judul" placeholder="Gambaran Judul"></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-0">
                <label class="float-right" for="kelebihan_judul">Kelebihan Judul</label>
                <textarea name="kelebihan_judul" class="form-control" id="kelebihan_judul" placeholder="Kelebihan Judul"></textarea>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-judul" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="data-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_judul">
            <b class="float-right">Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="unsur_perusahaan">
            <b class="float-right mb-2">Unsur Pimpinan - Perusahaan</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="latar_belakang">
            <b class="float-right mb-2">Latar Belakang</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="gambaran_judul">
            <b class="float-right mb-2">Gambaran Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="kelebihan_judul">
            <b class="float-right mb-2">Kelebihan Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item">
            <div class="btn-group w-100 set-button">
              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#hapus-judul">Hapus Judul</button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ubah-judul" id_judul="#">Ubah Judul</button>
              <button type="button" class="btn btn-success" data-toggle="modal" data-target="#tambah-jurnal">Tambah Jurnal</button>
            </div>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table class="table table-bordered" style="margin: 0; min-width: 300px; width:100%;">
                <thead>
                  <tr>
                    <th class='text-center'>File</th>
                    <th class='text-center' style="width: 10px;">Act</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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

<div class="modal fade" id="ubah-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Ubah Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_judul">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="nm_judul">Nama Judul</label>
                <input type="text" name="nm_judul" class="form-control" id="nm_judul" placeholder="Nama Judul">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-4 mb-2">
                <div class="row">
                  <div class="col-12">
                    <label class="float-right" for="id_pimpinan">Unsur Pimpinan</label>
                  </div>
                  <div class="col-12">
                    <select name="id_pimpinan" id="id_pimpinan" class="form-control custom-select select2" required>
                    </select>
                  </div>
                </div>
              </div>
              <div class="col-md-8 mb-2">
                <label class="float-right" for="nm_perusahaan">Nama Perusahaan</label>
                <input type="text" name="nm_perusahaan" class="form-control" id="nm_perusahaan" placeholder="Nama Perusahaan">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="kelebihan_judul">Latar Belakang</label>
                <textarea name="latar_belakang" class="form-control" id="latar_belakang" placeholder="Latar Belakang"></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <label class="float-right" for="gambaran_judul">Gambaran Judul</label>
                <textarea name="gambaran_judul" class="form-control" id="gambaran_judul" placeholder="Gambaran Judul"></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-0">
                <label class="float-right" for="kelebihan_judul">Kelebihan Judul</label>
                <textarea name="kelebihan_judul" class="form-control" id="kelebihan_judul" placeholder="Kelebihan Judul"></textarea>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-judul" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="hapus-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Anda yakin ingin menghapus Judul Ini?</h4>
        <input type="hidden" name="id_judul" id="id_judul">
      </div>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-primary" data-dismiss="modal">Batal</button>
          <button type="button" id="konfirmasi-hapus" class="btn btn-danger">Konfirmasi</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="tambah-jurnal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Jurnal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" enctype="multipart/form-data">
        <input type="hidden" name="set" value="save-tambah_jurnal">
        <input type="hidden" name="id_judul" id="id_judul">
        <div class="input-group">
          <div class="custom-file">
            <input type="file" name="file_jurnal" class="custom-file-input" id="file_jurnal">
            <label class="custom-file-label" for="file_jurnal">Choose file</label>
          </div>
        </div>
      </form>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-jurnal" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="hapus-jurnal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Hapus Jurnal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h4>Anda yakin ingin menghapus Jurnal Ini?</h4>
        <input type="hidden" name="id_jurnal" id="id_jurnal">
      </div>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-primary" data-dismiss="modal">Batal</button>
          <button type="button" id="konfirmasi-hapus" class="btn btn-danger">Konfirmasi</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->



<div class="modal fade" id="data-pengajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Data Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_mahasiswa">
            <b>Nama Mahasiswa</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nim_mahasiswa">
            <b>No. Induk</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_prodi">
            <b>Program Studi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_fakultas">
            <b>Fakultas</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="nm_konsentrasi">
            <b>Konsentrasi</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="no_telp">
            <b>No. Telepon</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="tgl_pengajuan">
            <b>Tanggal Pengajuan</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="stt_pengajuan">
            <b>Status Pengajuan</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="tgl_pengecekan">
            <b>Tanggal Pengecekan</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="ket_pengajuan">
            <b class="float-right mb-2">Keterangan Penolakan</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="id_judul">
            <b class="float-right mb-2">Judul Diterima</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="pemb_1">
            <b>Pembimbing 1</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="pemb_2">
            <b>Pembimbing 2</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table class="table table-bordered" style="margin: 0; min-width: 300px; width:100%;">
                <thead>
                  <tr>
                    <th class='text-center'>Judul</th>
                    <th class='text-center' style="width: 10px;">Act</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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

<div class="modal fade" id="detail-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Detail Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item" id="nm_judul">
            <b class="float-right">Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="unsur_perusahaan">
            <b class="float-right mb-2">Unsur Pimpinan - Perusahaan</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="latar_belakang">
            <b class="float-right mb-2">Latar Belakang</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="gambaran_judul">
            <b class="float-right mb-2">Gambaran Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item" id="kelebihan_judul">
            <b class="float-right mb-2">Kelebihan Judul</b><br>
            <p class="text-justify mb-0">x</p>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table class="table table-bordered" style="margin: 0; min-width: 300px; width:100%;">
                <thead>
                  <tr>
                    <th class='text-center'>File</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
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