<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo isset($title)?$title:'';?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <script> var base_url = "<?php echo base_url(); ?>";</script>
    <base href="<?php echo base_url(); ?>">

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- jvectormap -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/datatables/dataTables.bootstrap.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/AdminLTE.min.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins. -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/skins/_all-skins.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/dist/css/custom_theme.css">

    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap-fileupload.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>assets/css/developer.css" rel="stylesheet" />

    <!-- extrac -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin/plugins/daterangepicker/daterangepicker-bs3.css">
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-1.8.3.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-migrate-1.2.1.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/parsley-min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/developer.js"></script>
    <script> var site_url = '<?php echo site_url(); ?>'</script>
    <script src="<?php echo base_url(); ?>assets/js/function.js"></script>
    <!-- //extra -->
</head>
<!-- <body class="hold-transition skin-blue sidebar-mini"> -->
<body class="hold-transition skin-purple sidebar-mini">
  <div class="loading-info title_center_desing error" id="loader" style="display:none;">
    <img src="assets/images/loadings.gif" />
  </div>
    <div class="wrapper">
    	<header class="main-header">
        <!-- Logo -->
        <!-- <a href="<?php echo base_url(); ?>index.php/admin/dashboard" class="logo" style="padding: 0"> -->
        	<!-- mini logo for sidebar mini 50x50 pixels -->
        	<!-- <span class="logo-mini"> Welcome </span> -->
        	<!-- logo for regular state and mobile devices -->
        	<!-- <span class="logo-lg">Welcome  </span> -->
        <!-- </a> -->
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
        	<!-- Sidebar toggle button-->
        	<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
          	<span class="sr-only">Toggle navigation </span>
        	</a>
        	<!-- Navbar Right Menu -->
        	<div class="navbar-custom-menu">
          	<ul class="nav navbar-nav">
      				<li class="dropdown user user-menu">
      					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <?php 
                    $admin_image = $this->Common_model->getRecords('admin', 'profile_pic',array('admin_id'=>$this->session->userdata('admin_id')),"", true);
                ?>
                <?php if(!empty($admin_image['profile_pic'])){ ?>
      						<img src="<?php echo base_url().$admin_image['profile_pic']; ?>" class="user-image" alt="User Image"><?php } ?>
      						<span class="hidden-xs"><?php echo $this->session->user_name; ?></span>
      					</a>
      					<ul class="dropdown-menu">
      						<li><a href="admin/edit_profile">Profile</a></li>
      						<li><a href="admin/change_password" >Change Password</a></li>
      						<li class="footer"><a href="admin/logout">Logout</a></li>
      					</ul>
      				</li>
            	</ul>
          	</div>
        </nav>
    </header>
<style type="text/css">

.loading-info {
background-color: rgba(250, 250, 250, 0.5);
height: 100%;
left: 0;
position: fixed;
top: 0;
width: 100%;
z-index: 9999;
}
.loading-info img {
left: 50%;
position: absolute;
top: 50%;
transform: translate(-50%, -50%);
}
table thead th{
vertical-align: top!important;
}
.box-tab{
margin-top: 15px;
margin-left: 20px;"
}
.box-nav-tab-agency{
margin-left: 10px !important;  
margin-top: 10px !important;
}
@media (max-width: 767px){
.skin-purple .main-header .navbar .dropdown-menu li a {
    color: #252121;
}
}
</style>
