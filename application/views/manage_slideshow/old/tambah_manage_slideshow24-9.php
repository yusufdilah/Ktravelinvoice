<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>     
  <div class="wrapper">

    <?php $this->load->view("admin/_includes/header.php") ?>
    <?php $this->load->view("admin/_includes/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content-header">
        <h1>
          Kelola
          <small>Data Manage Slide Show</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Manage Slide Show</a></li>
          <li><a href="<?php echo base_url('Manage_slideshow_controller/form_add/'.$info_terbaru->info_terbaru_id) ?>">Tambah Data Manage Slide Show</a></li>
          <li><a href="<?php echo base_url('Info_terbaru_controller/detail/'.$info_terbaru->info_terbaru_id) ?>">Lihat Data Manage Slide Show</a></li>
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
              <form role="form" action="<?php echo base_url('Manage_slideshow_controller/add/') ?>" method="post" enctype="multipart/form-data">
              <!-- <input type="hidden" name="underconstruction_id" value="<?php echo $underconstruction_mode->underconstruction_id?>" /> -->
                
                <div class="box-body">
                  <div class="form-group">
                    <!-- <label>Nama anak </label> -->
                    <input name="info_terbaru_id" required="" class="form-control <?php echo form_error('info_terbaru_id') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" type="text" value="<?php echo $info_terbaru->info_terbaru_id ?>" readonly>
                    <div class="invalid-feedback">
                      <?php echo form_error('info_terbaru_id') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Status </label>
                    <select class="form-control <?php echo form_error('status') ? 'is-invalid':'' ?>" name="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('status') ?>
                    </div>
                  </div>
                  <div class="form-group">
                      <!-- <div class="profile-info-name"> Gambar </div> -->
                        <label>Gambar</label>
                        <input type="file" name="img" class="form-control">
                  </div>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  <!-- <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button> -->
                  <a href="<?php echo base_url('Info_terbaru_controller') ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
                </div>
              </form>
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

 <script>
     CKEDITOR.replace('isi');
 </script>
 <!-- ./wrapper -->
 <?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
 <!-- page script -->
</body>
</html>
