<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>


<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
<?php $this->load->view("admin/_includes/header.php") ?>
<?php $this->load->view("admin/_includes/sidebar.php") ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
	  <!-- Alert -->
	  <!-- <?php if ($this->session->flashdata('success')): ?>
		  <div class="box-body">
			  <div class="alert alert-info alert-dismissible">
				  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
				  <h4><i class="icon fa fa-info"></i>Alert!</h4>
				  <?php echo $this->session->flashdata('success'); ?>
			  </div>
		  </div>
	  <?php endif; ?> -->
	  <!-- Alert -->
    <!-- Content Header (Page header) -->
    <section class="content-header">

		<h1>
			Selamat Datang
			<small><?php echo $this->session->userdata('nama'); ?></small>
		</h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
<?php $this->load->view("admin/_includes/footer.php") ?>
  
<?php $this->load->view("admin/_includes/bottom_script.php") ?>
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->


</body>
</html>
