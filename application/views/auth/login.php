<div class="login-box">
  <div class="login-logo">
    <a href="<?= base_url(); ?>" class="text-light"><b>Univesitas </b> Ibnu Sina</a>
  </div>
  <?php if ($this->session->flashdata('alert')) {
    $xalert = $this->session->flashdata('alert'); ?>
    <div class="alert alert-<?= $xalert[0] ?> alert-dismissible fade show" role="alert">
      <h5><i class="<?= $xalert[1] ?>"></i> <?= $xalert[2] ?></h5><?= $xalert[3] ?><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
  <?php } ?>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <form action="" method="POST" autocomplete="off">
        <div class="input-group mb-3">
          <input type="text" name="username" class="form-control" placeholder="Username">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          <?= form_error('username', '<span class="invalid-feedback d-block">', '</span>'); ?>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          <?= form_error('password', '<span class="invalid-feedback d-block">', '</span>'); ?>
        </div>
        <div class="row">
          <div class="col-md-4 offset-md-8">
            <button type="submit" name="login" class="btn btn-success btn-block">Log-In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
    </div>
  </div>
</div>
<!-- /.login-box -->