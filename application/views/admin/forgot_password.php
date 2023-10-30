<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <base href="<?php base_url(); ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">

        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
         <!-- Custom Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/custom_theme.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/iCheck/square/blue.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/developer.css">
        <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.8.3.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/parsley-min.js"></script>
        <style type="text/css">
  .login-page, .register-page {
    background-color: #25757c;
  }
  </style>
    </head>

    <body class="hold-transition login-page">
      
      <div class="login-box">
      
      <div class="login-box-body">
          <div class="login-logo"><?php echo SITE_TITLE; ?>
             <!--  <a href="<?php echo base_url(); ?>">
                <img src="<?php echo base_url(); ?>assets/images/site_logo.png" width="100">
              </a> -->
            </div>
            <?php if ($this->session->flashdata('error')) { ?>
              <div class="alert alert-block alert-danger fade in">
                  <button data-dismiss="alert" class="close" type="button">×</button>
                  <?php echo $this->session->flashdata('error') ?>
              </div>
            <?php } ?>
            <?php if ($this->session->flashdata('success')) { ?>
              <div class="alert alert-block alert-success fade in">
                  <button data-dismiss="alert" class="close" type="button">×</button>
                  <?php echo $this->session->flashdata('success') ?>
              </div>
            <?php } ?>
          <!-- /.login-logo -->
        <p class="login-box-msg"><b>Forgot Password</b></p>
       
    <form role="form" action="<?php echo base_url(); ?>admin/forgot_password" method="post" data-parsley-validate>
      <div class="form-group has-feedback">
                <input type="text" class="form-control" placeholder="Email/Username" name="email"  autofocus value="<?php echo set_value('email'); ?>" data-parsley-required data-parsley-required-message="Please enter email/username." >
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                 <?php echo form_error('email'); ?> 
            </div>
      
      <div class="form-group text-center">
        <!-- <button type="submit" name="submit" value="submit" class="btn btn-block  btn-success btn-flat" >Submit</button><br>
        <a href="<?php echo base_url();?>" class="btn btn-block  btn-info btn-flat"> Back</a> -->
         <div class="row">
            <div class="col-xs-6">
                <button type="submit" name="submit" value="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
            </div>
            <div class="col-xs-6">
                <a href="<?php echo base_url();?>admin" class="btn btn-block  btn-default btn-flat">Back</a>
            </div>
        </div>
      </div>
    </form>

       <!--  <a href="#">I forgot my password</a><br>
        <a href="register.html" class="text-center">Register a new membership</a> -->
    
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

    <!-- jQuery 2.1.4 -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?php echo base_url(); ?>assets/admin/bootstrap/js/bootstrap.min.js"></script>
    <!-- iCheck -->
    <script src="<?php echo base_url(); ?>assets/admin/plugins/iCheck/icheck.min.js"></script>
    
  <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>

</html>