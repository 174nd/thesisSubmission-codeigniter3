<!DOCTYPE html>
<html>

<head>
  <?php $this->view('templates/dist/header'); ?>
</head>

<body class="hold-transition layout-top-nav text-sm">
  <div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-light">
      <div class="container">

        <a href="<?= base_url('dosen'); ?>" class="navbar-brand">
          <img src="<?= base_url('dist/img/logo.png'); ?>" alt="Logo" class="brand-image" style="opacity: 0.8;" />
          <span class="brand-text font-weight-light">Universitas Ibnu Sina</span>
        </a>

        <!-- <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button> -->

        <!-- <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="<?= base_url('dosen'); ?>" class="nav-link">Mahasiswa</a>
            </li>
          </ul>
        </div> -->

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
              <img src="<?= base_url($this->session->userdata('foto_user') != '' && file_exists(FCPATH . 'uploads/users/' . $this->session->userdata('foto_user')) ? 'uploads/users/' . rawurlencode($this->session->userdata('foto_user')) : 'dist/img/user.png') ?>" class="user-image" alt="User Image" />
            </a>
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
              <!-- User image -->
              <li class="user-header bg-success">
                <img src="<?= base_url($this->session->userdata('foto_user') != '' && file_exists(FCPATH . 'uploads/users/' . $this->session->userdata('foto_user')) ? 'uploads/users/' . rawurlencode($this->session->userdata('foto_user')) : 'dist/img/user.png') ?>" class="img-circle elevation-2" alt="User Image" />
                <p>
                  <?= $this->session->userdata('nm_user'); ?>
                  <small>Dosen</small>
                </p>
              </li>
              <li class="user-body">
                <div class="row">
                  <div class="col-12 btn-group btn-block">
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#update-photo">Ubah Foto</button>
                    <button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#update-password">Ubah Password</button>
                  </div>
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <a href="<?= base_url('auth/logout'); ?>" class="btn btn-default btn-flat float-right">Keluar</a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1 class="m-0 text-dark"><?= $set['content']; ?></h1>
              </div>
              <!-- /.col -->
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <?php
                  if (isset($set['breadcrumb'])) {
                    foreach ($set['breadcrumb'] as $key => $value) {
                      if ($value != '#' && $value != "active") {
                        echo "<li class=\"breadcrumb-item\"><a href=\"$value\">$key</a></li>";
                      } else if ($value == "active") {
                        echo "<li class=\"breadcrumb-item active\">$key</li>";
                      } else {
                        echo "<li class=\"breadcrumb-item\">$key</li>";
                      }
                    }
                  }
                  ?>
                </ol>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
          <?php if ($this->session->flashdata('alert')) {
            $xalert = $this->session->flashdata('alert'); ?>
            <div class="alert <?= 'alert-' . $xalert[0] ?> alert-dismissible mx-3">
              <h5><i class="<?= $xalert[1] ?>"></i> <?= $xalert[2] ?></h5><?= $xalert[3] ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          <?php } ?>
        </div>
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <div class="content">
        <div class="container">
          <?= $content; ?>
        </div><!-- /.container -->
      </div>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <div class="container">
      <footer class="main-footer bg-light">
        <?php $this->view('templates/dist/footer'); ?>
      </footer>
    </div>
  </div>
  <!-- ./wrapper -->


  <div class="modal fade" id="update-password">
    <form method="POST" action="<?= base_url('dosen'); ?>" class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Password</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group" style="border-bottom: 1px solid #e9ecef;">
            <div class="input-group">
              <div class="row w-100 ml-0 mr-0">
                <div class="col-md-12 mb-3">
                  <label class="float-right" for="old_pass">Password Lama</label>
                  <input type="password" name="old_pass" class="form-control" id="old_pass" placeholder="Password Lama">
                </div>
              </div>
            </div>
          </div>
          <div class="form-group m-0" style="border-bottom: 1px solid #e9ecef;">
            <div class="input-group">
              <div class="row w-100 ml-0 mr-0">
                <div class="col-md-6 mb-3">
                  <label class="float-right" for="new_pass1">Password Baru</label>
                  <input type="password" name="new_pass1" class="form-control" id="new_pass1" placeholder="Password Baru">
                </div>
                <div class="col-md-6 mb-3">
                  <label class="float-right" for="new_pass2">Konfirmasi Password</label>
                  <input type="password" name="new_pass2" class="form-control" id="new_pass2" placeholder="Konfirmasi Password">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100 ml-0 mr-0">
            <div class="col-md-12">
              <input type="submit" name="u-password" class="btn btn-outline-success btn-block" value="Simpan">
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

  <div class="modal fade" id="update-photo">
    <form method="POST" action="<?= base_url('dosen'); ?>" class="modal-dialog" enctype="multipart/form-data" autocomplete="off">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Ubah Foto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="input-group">
            <div class="custom-file">
              <input type="file" name="foto_user" class="custom-file-input" id="foto_user">
              <label class="custom-file-label" for="foto_user">Choose file</label>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <div class="row w-100 ml-0 mr-0">
            <div class="col-md-12">
              <input type="submit" name="u-foto" class="btn btn-outline-success btn-block" value="Simpan">
            </div>
          </div>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php $this->view('templates/dist/script'); ?>
</body>

</html>