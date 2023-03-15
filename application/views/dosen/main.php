<div class="container-fluid">

  <!-- Main row -->
  <div class="row">

    <section class="col-md-8 connectedSortable">

      <div class="row">
        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-success total">
            <div class="inner text-light">
              <h3>x <sup style="font-size: 20px">Judul</sup></h3>
              <p>Total Membimbing</p>
            </div>
            <div class="icon">
              <i class="fa text-light fa-share-square"></i>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-primary pertama">
            <div class="inner text-light">
              <h3>x <sup style="font-size: 20px">Judul</sup></h3>
              <p>Pembimbing Pertama</p>
            </div>
            <div class="icon">
              <i class="fa text-light fa-dice-one"></i>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <!-- small box -->
          <div class="small-box bg-info kedua">
            <div class="inner text-light">
              <h3>x <sup style="font-size: 20px">Judul</sup></h3>
              <p>Pembimbing Kedua</p>
            </div>
            <div class="icon">
              <i class="fa text-light fa-dice-two"></i>
            </div>
          </div>
        </div>
      </div>




      <div class="card card-dark">
        <div class="overlay d-flex justify-content-center align-items-center invisible">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Histori Pembimbing</h3>
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
                    <option value="2">Pembimbing</option>
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
                      <th class='text-center' style="width: 10px;">Tanggal</th>
                      <th class='text-center'>Judul</th>
                      <th class='text-center' style="width: 10px;">Pembimbing</th>
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
        <!-- /.card-body -->
      </div>
      <!-- /.Guest History -->
    </section>

    <section class="col-md-4 connectedSortable">
      <div class="card card-success card-outline">
        <div class="card-body box-profile">
          <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" src="<?= base_url($dosen['foto_user'] != '' && file_exists(FCPATH . 'uploads/users/' . $dosen['foto_user']) ? 'uploads/users/' . rawurlencode($dosen['foto_user']) : 'dist/img/user.png') ?>" alt="User profile picture">
          </div>

          <h3 class="profile-username text-center"><?= $dosen['nm_dosen']; ?></h3>

          <p class="text-muted text-center"><?= $dosen['nidn_dosen']; ?></p>

          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Fakultas</b> <span class="float-right"><?= $dosen['nm_fakultas']; ?></span>
            </li>
            <li class="list-group-item">
              <b>No. Telepon</b> <span class="float-right"><?= $dosen['no_telp']; ?></span>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>

      <div class="card">
        <div class="card-body bg-success">
          <a class="btn btn-block btn-outline-light" href="<?= base_url('export/panduan_dosen') ?>">Panduan Dosen</a>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Panduan Dosen -->

    </section>
  </div>
  <!-- /.row (main row) -->
</div>




<div class="modal fade" id="detail-pengajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Detail Pengajuan</h4>
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
          <li class="list-group-item" id="stt_pengajuan">
            <b>Status Pengajuan</b><span class="float-right">x</span>
          </li>
          <li class="list-group-item" id="tgl_pengajuan">
            <b>Tanggal Pengajuan</b><span class="float-right">x</span>
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