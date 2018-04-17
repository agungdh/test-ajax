<!DOCTYPE html>

<html>
  <head>
    <?php $this->load->view('template/meta'); ?>
  </head>
  <?php
  $bg = base_url('assets/gambar/5.jpg');
  ?>
  <br>
  <br>
  <body class="hold-transition login-page" style="background-size:cover; background-image: url('<?php echo $bg; ?>');">
    <div class="login-box">
      <div class="login-box-body" style="opacity: 0.75">
        <div class="login-logo">
          <a><b>Login</b></a>
          <br>
          <a href="<?php echo base_url(); ?>">Aplikasi Monitoring Limbah B3 PLN</a>
        </div><!-- /.login-logo -->
        <!-- <p class="login-box-msg">Isi Username dan Password</p> -->
        <form role="form" method="post" name="loginForm" id="loginForm" action="<?php echo base_url('welcome/aksi_login'); ?>">
          
          <div class="form-group has-feedback">
            <input required name="username" id="username" type="text" class="form-control" placeholder="Username:">
            <span class="glyphicon glyphicon-user form-control-feedback"></span>
          </div>
          
          <div class="form-group has-feedback">
            <input required name="password" id="password" type="password" class="form-control" placeholder="Password:">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          
          <div class="row">
            <div class="col-xs-4">
            </div><!-- /.col -->
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button>
            </div><!-- /.col -->
            <div class="col-xs-4">
              <!-- <a class="btn btn-primary btn-block btn-flat" href="<?php echo base_url("lihat_nilai") ?>">Lihat Nilai</a> -->
              <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button> -->
              <!-- <button type="submit" class="btn btn-primary btn-block btn-flat">Log In</button> -->
            </div><!-- /.col -->
          </div>
                            
        </form>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  </body>
</html>

<?php
if ($this->input->get('error') == '1') {
  ?>
    <script type="text/javascript">
      swal("ERROR!!!", "Password salah !!!", "error");
    </script>
  <?php
}
?>
