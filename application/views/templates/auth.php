<!DOCTYPE html>
<html>

<head>
  <?php $this->view('templates/dist/header'); ?>
</head>

<body class="hold-transition login-page bg-success">
  <?= $content; ?>
  <?php $this->view('templates/dist/script'); ?>
</body>

</html>