<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>admin | Ktravel</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/bootstrap/dist/css/bootstrap.css'); ?>" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/font-awesome/css/font-awesome.min.css'); ?>" rel="stylesheet">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/Ionicons/css/ionicons.min.css'); ?>" rel="stylesheet">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url('assetAdmin/dist/css/AdminLTE.min.css'); ?>"  rel="stylesheet">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
   folder instead of downloading all of them to reduce the load. -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/dist/css/skins/_all-skins.min.css'); ?>" rel="stylesheet">
   <!-- Morris chart -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/morris.js/morris.css'); ?>" rel="stylesheet">
   <!-- jvectormap -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/jvectormap/jquery-jvectormap.css'); ?>" rel="stylesheet">
   <!-- Date Picker -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css'); ?>" rel="stylesheet">
   <!-- Daterange picker -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/bootstrap-daterangepicker/daterangepicker.css'); ?>" rel="stylesheet">
   <!-- bootstrap wysihtml5 - text editor -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css'); ?>" rel="stylesheet">
   <!-- DataTables -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css'); ?>">
  <!-- Google Font -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/plugins/google-fonts/google-font.css'); ?>" rel="stylesheet">
   <!-- select2 -->
   <link rel="stylesheet" href="<?php echo base_url('assetAdmin/bower_components/select2/select2.css'); ?>" rel="stylesheet">

   <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

<![endif]-->

<style type="text/css">

.btn-tosca {
  background-color: #1abc9c;
  border-color: #1abc9c;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-carot {
  background-color: #e67e22;
  border-color: #e67e22;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-ijo {
  background-color: #2ecc71;
  border-color: #2ecc71;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-emerald {
  background-color: #2ecc71;
  border-color: #2ecc71;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-pomerganate {
  background-color: #e55039;
  border-color: #e55039;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-ref {
  background-color: #079992;
  border-color: #079992;
  text-align: center;
  color: white;
  font-family: arial;
}

.btn-mandarin {
  background-color: #e55039;
  border-color: #e55039;
  text-align: center;
  color: white;
  font-family: arial;
}

</style>

<!-- <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script> -->
<script src="http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<!-- Select2 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.css" integrity="sha512-iVAPZRCMdOOiZWYKdeY78tlHFUKf/PqAJEf/0bfnkxJ8MHQHqNXB/wK2y6RH/LmoQ0avRlGphSn06IMMxSW+xw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2-bootstrap.min.css" integrity="sha512-eNfdYTp1nlHTSXvQD4vfpGnJdEibiBbCmaXHQyizI93wUnbCZTlrs1bUhD7pVnFtKRChncH5lpodpXrLpEdPfQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
