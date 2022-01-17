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

      <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('message'); ?>
          <a href="<?php echo base_url('registrasi/approve_registrasi') ?>"></a>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
        </div>
      <?php endif; ?>  

      <section class="content-header">
        <h1>
          Kelola
          <small>Data Info Terbaru</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Info Terbaru</a></li>
          <li><a href="<?php echo base_url('Info_terbaru_controller/index') ?>">Lihat Data Info Terbaru</a></li>
          <li><a href="<?php echo base_url('Info_terbaru_controller/add') ?>">Tambah Data Info Terbaru</a></li>
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
              <form role="form" action="<?php echo base_url('Info_terbaru_controller/add') ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label>Judul</label>
                    <input name="judul" class="form-control <?php echo form_error('judul') ? 'is-invalid':'' ?>" placeholder="Masukan Judul" type="text"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('judul') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Cuplikan</label>
                    <input name="cuplikan" class="form-control <?php echo form_error('cuplikan') ? 'is-invalid':'' ?>" placeholder="Masukan Cuplikan" type="text"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('cuplikan') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Isi</label>
                    <!-- <input name="isi" class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" id="isi" placeholder="Masukan Isi" type="text"> -->
                    <textarea class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" name="isi" id="isi" placeholder="Masukan Isi"></textarea>
                    <div class="invalid-feedback">
                      <?php echo form_error('isi') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Youtube</label>
                    <input name="you_tube" class="form-control" placeholder="Masukan link Youtube" type="text"/>
                    
                  </div>
                  <div class="form-group">
                      <!-- <div class="profile-info-name"> Gambar (Max 609*609) </div> -->
                        <label>Gambar (Max 609*609)</label>
                        <input type="file" name="img_cuplik" class="form-control">
                  </div>  
                  <div class="form-group">
                    <label>Status</label>
                    <div class="radio">
                      <label>
                        <input type="radio" class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="1" checked="">
                        Active
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="0">
                        Inactive
                      </label>
                    </div>
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
