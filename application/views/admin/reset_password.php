<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title><?php echo $title; ?></title>
        <base href="<?php base_url(); ?>">
        <!-- Tell the browser to be responsive to screen width -->
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/images/favicon.ico">
        <!-- Bootstrap 3.3.5 -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
      
        <!-- Font Awesome -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/font-awesome.min.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/ionicons.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
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
            <div class="login-logo"><?php echo SITE_TITLE; ?>
       <!--  <a href="<?php echo base_url(); ?>">
          <img src="<?php echo base_url(); ?>assets/images/site_logo.png" width="100">
        </a>  -->
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
      <div class="login-box-body">
        <p class="login-box-msg"><b>Reset Password</b></p>
       
			<form id="change_password" role="form" action="<?php echo base_url(); ?>admin/reset_password?token=<?php echo $this->input->get('token'); ?>" method="post" data-parsley-validate>
				<div class="form-group">
				    <!-- <label class="control-label mb-10" for="new_password">New Password</label> -->
				    <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" minlength="6" maxlength="12" required data-parsley-required data-parsley-required-message="Please enter new password.">
				    <?php echo form_error('new_password'); ?> 
				</div>
				<div class="form-group">
				    <!-- <label class="control-label mb-10" for="confirm_password">Confirm Password</label> -->
				    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" data-parsley-equalto="#new_password" required data-parsley-required data-parsley-required-message="Please enter confirm password." data-parsley-equalto-message="New password and confirm password not match.">
				    <?php echo form_error('confirm_password'); ?> 
				</div>
	            <div class="form-group text-center">
	              <button type="submit" name="submit" value="submit" class="btn btn-block btn-info btn-flat" >Submit</button>
	            </div>
          </form>

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