<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>      -->
  <div class="wrapper">

    <?php $this->load->view("admin/_includes/header.php") ?>
    <?php $this->load->view("admin/_includes/sidebar.php") ?>
    <?php $this->config->load('upload_setting', TRUE); ?>
    <?php $folder = $this->config->item('folder', 'upload_setting') ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content-header">
        <h1>
          Kelola
          <small>Data Underconstruction Mode</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Underconstruction Mode</a></li>
          <li><a href="<?php echo base_url('Underconstruction_mode_controller/index') ?>">Lihat Data Underconstruction Mode</a></li>
          <!-- <li><a href="<?php echo base_url('Underconstruction_mode_controller/edit') ?>">Edit Data Underconstruction Mode</a></li> -->
        </ol>
      </section>


      <!-- Main content -->
      <section class="content">
        <div class="row">
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">Pengisian Form</h3>
              </div>
              <!-- /.box-header -->
              <!-- form start -->
              <!-- <form role="form" action="<?php echo base_url('Underconstruction_mode_controller/edit') ?>" method="post" enctype="multipart/form-data"> -->
              <?php echo form_open_multipart('Underconstruction_mode_controller/edit/'.$underconstruction_mode->underconstruction_id  ) ?>
              <!-- <form role="form" action="<?php echo base_url('Underconstruction_mode_controller/edit/'.$underconstruction_mode->underconstruction_id) ?>" 
              method="post" enctype="multipart/form-data"> -->
                <input type="hidden" name="underconstruction_id" value="<?php echo $underconstruction_mode->underconstruction_id?>" />
                <div class="box-body">
                  <!-- <div class="form-group">
                    <label>Contruction</label>
                    <div class="radio">
                      <label>
                        <input type="radio" class="<?php echo form_error('construction') ? 'is-invalid':'' ?>" name="construction" value="1" checked="">
                        On
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" class="<?php echo form_error('construction') ? 'is-invalid':'' ?>" name="construction" value="0">
                        Off
                      </label>
                    </div>
                  </div> -->
                  <div class="form-group">
                    <label>Construction</label>
                    <div class="radio">
                      <label>
                        <input type="radio" <?php if ($underconstruction_mode->construction == '1') {
                          echo "checked";
                        } ?> class="<?php echo form_error('construction') ? 'is-invalid':'' ?>" name="construction" value="1" checked="">
                        On
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" <?php if ($underconstruction_mode->construction == '0') {
                          echo "checked";
                        } ?> class="<?php echo form_error('construction') ? 'is-invalid':'' ?>" name="construction" value="0">
                        Off
                      </label>
                    </div>
                  </div>
                  <div class="form-group">
                      <!-- <div class="profile-info-name"> Gambar </div> -->
                      <label>Gambar</label>
                        <div style="margin-bottom: 5px;"><img src="<?=base_url($folder.$underconstruction_mode->img)?>" width="75%"></div>
                      <input type="file" name="img" class="form-control">
				          </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button>
                </div>
              <!-- </form> -->
              <?php echo form_close() ?>
            </div>
            <!-- /.box -->

          </div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <?php $this->load->view("admin/_includes/footer.php") ?>
    <?php $this->load->view("admin/_includes/control_sidebar.php") ?>

  <!-- Add the sidebar's background. This div must be placed
   immediately after the control sidebar -->
   <div class="control-sidebar-bg"></div>
 </div>

<!--  <script>
     CKEDITOR.replace('isi');
 </script> -->
 <!-- ./wrapper -->
 <?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
 <!-- page script -->
</body>
</html>
