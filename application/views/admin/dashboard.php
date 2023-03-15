<div class="container-fluid">
  <!-- Main row -->
  <div class="row">
    <div class="col-6 col-md-3">
      <!-- small box -->
      <div class="small-box bg-primary pengajuan">
        <div class="inner text-light">
          <h3>x <sup style="font-size: 20px">Pengajuan</sup></h3>
          <p>Total Pengajuan</p>
        </div>
        <div class="icon">
          <i class="fa text-light fa-share-square"></i>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <!-- small box -->
      <div class="small-box bg-success diterima">
        <div class="inner text-light">
          <h3>x <sup style="font-size: 20px">Pengajuan</sup></h3>
          <p>Pengajuan Diterima</p>
        </div>
        <div class="icon">
          <i class="fa text-light fa-check"></i>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <!-- small box -->
      <div class="small-box bg-info mahasiswa">
        <div class="inner text-light">
          <h3>x <sup style="font-size: 20px">Orang</sup></h3>
          <p>Mahasiswa</p>
        </div>
        <div class="icon">
          <i class="fa text-light fa-user-graduate"></i>
        </div>
      </div>
    </div>

    <div class="col-6 col-md-3">
      <!-- small box -->
      <div class="small-box bg-orange dosen">
        <div class="inner text-light">
          <h3>x <sup style="font-size: 20px">Orang</sup></h3>
          <p>Dosen</p>
        </div>
        <div class="icon">
          <i class="fa text-light fa-user-tie"></i>
        </div>
      </div>
    </div>

    <section class="col-md-8 connectedSortable">

      <div class="card card-dark">
        <div class="overlay d-flex justify-content-center align-items-center invisible">
          <i class="fas fa-2x fa-sync fa-spin"></i>
        </div>
        <div class="card-header">
          <h3 class="card-title">Pengajuan</h3>
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
                  <select id="column_spengajuan" class="form-control custom-select">
                    <option value="1">Mahasiswa</option>
                    <option value="0">Tanggal</option>
                  </select>
                </div>
                <div class="col-md-9 mb-2">
                  <input type="text" class="form-control" placeholder="Cari Data" id="field_spengajuan">
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <div class="table-responsive">
                <table id="table_spengajuan" class="table table-bordered table-striped" style="min-width: 500px; width:100%;">
                  <thead>
                    <tr>
                      <th class='text-center'>Tanggal</th>
                      <th class='text-center' style="width: 250px;">Mahasiswa</th>
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

      <div class="card card-dark" id="cari-pengajuan">
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
                <div class="col-md-12 mb-0">
                  <label class="float-right" for="bln_pengajuan">Bulan Pengajuan</label>
                  <div class="input-group">
                    <input type="text" name="bln_pengajuan" class="form-control datepicker" id="bln_pengajuan" placeholder="Bulan Pengajuan" value="<?= date('F Y'); ?>">
                    <div class="input-group-append">
                      <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                    </div>
                  </div>
                </div>
              </div>
            </li>
            <li class="list-group-item">
              <button class="btn w-100 btn-dark" id="mulai-cari">Cari Pengajuan</button>
            </li>
          </ul>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Guest History -->

      <div class="card">
        <div class="card-body bg-primary">
          <button type="button" class="btn btn-block btn-outline-light" data-toggle="modal" data-target="#update-panduan-dosen">Update Panduan Dosen</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Panduan Dosen -->

      <div class="card">
        <div class="card-body bg-primary">
          <button type="button" class="btn btn-block btn-outline-light" data-toggle="modal" data-target="#update-panduan-mahasiswa">Update Panduan Mahasiswa</button>
        </div>
        <!-- /.card-body -->
      </div>
      <!-- /.Panduan Dosen -->

    </section>
  </div>
  <!-- /.row (main row) -->
</div>


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
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#tolak-pengajuan">Tolak Pengajuan</button>
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
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#terima-judul">Terima Judul Ini</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="tolak-pengajuan">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Tolak Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_pengajuan">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-0">
                <label class="float-right" for="ket_pengajuan">Alasan Penolakan</label>
                <textarea name="ket_pengajuan" class="form-control" id="ket_pengajuan" placeholder="Alasan Penolakan"></textarea>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-penolakan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="terima-judul">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Terima Judul</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" id="id_pengajuan">
        <input type="hidden" id="id_judul">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-0">
                <label class="float-right" for="nm_judul">Nama Judul</label>
                <textarea name="nm_judul" class="form-control" id="nm_judul" placeholder="Nama Judul"></textarea>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <div class="row">
                  <div class="col-12">
                    <label class="float-right" for="pemb_1">Pembimbing 1</label>
                  </div>
                  <div class="col-12">
                    <select name="pemb_1" id="pemb_1" class="form-control custom-select select2" required>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="row w-100 mx-0">
              <div class="col-md-12 mb-2">
                <div class="row">
                  <div class="col-12">
                    <label class="float-right" for="pemb_2">Pembimbing 2</label>
                  </div>
                  <div class="col-12">
                    <select name="pemb_2" id="pemb_2" class="form-control custom-select select2" required>
                    </select>
                  </div>
                </div>
              </div>
            </div>
          </li>
        </ul>
      </div>
      <div class="modal-footer">
        <div class="btn-group btn-block">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-pengajuan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->




<div class="modal fade" id="histori-pengajuan">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="overlay d-flex justify-content-center align-items-center invisible">
        <i class="fas fa-2x fa-sync fa-spin"></i>
      </div>
      <div class="modal-header">
        <h4 class="modal-title">Histori Pengajuan</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="row">
              <div class="col-md-3 mb-2">
                <select id="column_dpengajuan" class="form-control custom-select">
                  <option value="2">Mahasiswa</option>
                  <option value="0">Pengajuan</option>
                  <option value="1">Pengecekan</option>
                  <option value="3">Status</option>
                </select>
              </div>
              <div class="col-md-9 mb-2">
                <input type="text" class="form-control" placeholder="Cari Data" id="field_dpengajuan">
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="table-responsive">
              <table id="table_dpengajuan" class="table table-bordered table-striped" style="min-width: 500px; width:100%;">
                <thead>
                  <tr>
                    <th class='text-center'>Pengajuan</th>
                    <th class='text-center'>Pengecekan</th>
                    <th class='text-center' style="width: 250px;">Mahasiswa</th>
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
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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





<div class="modal fade" id="update-panduan-dosen">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Panduan Dosen</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" enctype="multipart/form-data">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="file_pdosen" class="custom-file-input" id="file_pdosen">
                <label class="custom-file-label" for="file_pdosen">Choose file</label>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="btn-group w-100 set-button">
              <a class="btn btn-block btn-success" href="<?= base_url('export/panduan_dosen') ?>" target="_blank">Panduan Dosen</a>
            </div>
          </li>
        </ul>
      </form>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-panduan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="update-panduan-mahasiswa">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Update Panduan Mahasiswa</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="modal-body" enctype="multipart/form-data">
        <ul class="list-group list-group-unbordered">
          <li class="list-group-item">
            <div class="input-group">
              <div class="custom-file">
                <input type="file" name="file_pmahasiswa" class="custom-file-input" id="file_pmahasiswa">
                <label class="custom-file-label" for="file_pmahasiswa">Choose file</label>
              </div>
            </div>
          </li>
          <li class="list-group-item">
            <div class="btn-group w-100 set-button">
              <a class="btn btn-block btn-success" href="<?= base_url('export/panduan_mahasiswa') ?>" target="_blank">Panduan Mahasiswa</a>
            </div>
          </li>
        </ul>
      </form>
      <!-- /.modal-body -->
      <div class="modal-footer">
        <div class="btn-group w-100">
          <button class="btn btn-danger" data-dismiss="modal">Batal</button>
          <button type="button" id="simpan-panduan" class="btn btn-primary">Simpan</button>
        </div>
      </div>
      <!-- /.modal-footer -->
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->