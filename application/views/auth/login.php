<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>siAkad</title>
<!-- Google Font: Source Sans Pro -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/fontawesome-free/css/all.min.css'); ?>">
<!-- icheck bootstrap -->
<link rel="stylesheet" href="<?php echo base_url('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css'); ?>">
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo base_url('assets/dist/css/adminlte.min.css'); ?>">
<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f8f9fa;
    }
    .login-container {
        text-align: center;
    }
    .login-container img {
        width: 200px; /* Adjust the width as needed */
        height: auto;
    }
</style>
</head>
<body class="hold-transition login-page">
<div class="login-container">
<img src="https://www.cybermakassar.com/asset/foto_berita/siakad-app.png" alt="Login Image">
<div class="login-box">
    <br>
<div class="login-logo">
<a href=""><b>Sistem Informasi Akademik</b></a>
<br>
</div>
<!-- /.login-logo -->
<div class="card">
<div class="card-body login-card-body">
<form method="post" action="<?= base_url('auth/login'); ?>">
<div class="form-group">
<label for="username">Nama Pengguna</label>
<input type="text" name="username" class="form-control" required>
</div>
<div class="form-group">
<label for="password">Kata Kunci</label>
<input type="password" name="password" class="form-control" required>
</div>
<!-- button type="submit" class="btn btn-primary btn-block">Login</button -->
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember">
<label for="remember">
Remember Me
</label>
</div>
</div>
<!-- /.col -->
<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Masuk</button>
</div>
<!-- /.col -->
</div>
<br><br>
</form>
    </div>
    <!-- /.login-card-body -->
    </div>
    </div>
    <!-- /.login-box -->
    </div>
    <!-- jQuery -->
    <script src="<?php echo base_url('assets/plugins/jquery/jquery.min.js');?>"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url('assets/plugins/bootstrap/js/bootstrap.bundle.min.js');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url('assets/dist/js/adminlte.min.js'); ?>"></script>
    </body>
    </html>