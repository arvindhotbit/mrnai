<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo isset($page_title)?$page_title:'Openline';?></title>

    <link rel="manifest" href="manifest.json" />

    <!-- ios support -->
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-72x72.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-96x96.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-128x128.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-152x152.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-192x192.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-256x256.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-384x384.png');?>" />
    <link rel="apple-touch-icon" href="<?php echo site_url('assets/pwa/icon-512x512.png');?>" />
    <meta name="apple-mobile-web-app-status-bar" content="#07535d" />
    <meta name="theme-color" content="#07535d" />

    <meta property="og:title" content="<?php echo isset($page_title)?$page_title:'Openline';?>">
    <meta property="og:site_name" content="<?php echo isset($page_title)?$page_title:'Openline';?>">
    <meta property="og:url" content="<?php echo isset($page_url)?$page_url:site_url();?>">
    <meta property="og:description" content="<?php echo isset($page_description)?$page_description:'saloon,clinic,services';?>">
    <meta property="og:type" content="article">
    <meta property="og:image" content="<?php echo isset($share_img)?$share_img:site_url('assets/front/images/img_pattern.png');?>">
    <meta name="keywords" content="<?php echo isset($page_description)?$page_description:'saloon,clinic,services';?>">
    <meta name="robots" content="index, follow">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="English">
    <meta name="title" content="<?php echo isset($page_title)?$page_title:'Openline';?>">
    <meta name="description" content="<?php echo isset($page_description)?$page_description:'saloon,clinic,services';?>">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:site" content="@">
    <meta name="twitter:title" content="<?php echo isset($page_title)?$page_title:'Openline';?>">
    <meta name="twitter:description" content="<?php echo isset($page_description)?$page_description:'saloon,clinic,services';?>">
    <meta name="twitter:image" content="<?php echo isset($share_img)?$share_img:site_url('assets/front/images/img_pattern.png');?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo site_url('assets/front/images/favicon.ico');?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/front/css/bootstrap.min.css');?>">
    <link rel="stylesheet" href="<?php echo site_url('assets/front/css/owl.carousel.min.css');?>">

    <link rel="stylesheet" href="<?php echo site_url('assets/front/css/style.css');?>">
    <script src="<?php echo site_url('assets/front/js/jquery.min.js');?>"></script>
    <script src="<?php echo site_url('assets/js/parsley-min.js');?>"></script>
    <script type="text/javascript">
    if ("serviceWorker" in navigator) {
      window.addEventListener("load", function() {
        navigator.serviceWorker
          .register("/serviceWorker.js")
          .then(res => console.log("service worker registered"))
          .catch(err => console.log("service worker not registered", err));
      });
    }
    </script>
</head>
<div class="loading-info title_center_desing error" id="loader" style="display:none;">
	<img src="<?php echo base_url();?>assets/front/loading.gif" />
</div>
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
.error,.inputerror{
  color: #ff0000!important;
  /*font-weight: 400;*/
}

.parsley-required {
  color: #ff0000!important;
  font-size: 12px;
  list-style: none;
  margin-left:0px;
}
.parsley-errors-list {
  color: #ff0000!important;
  font-size: 12px;
  list-style: none;
  margin-left:0px;
  padding-left:0px;
}
</style>