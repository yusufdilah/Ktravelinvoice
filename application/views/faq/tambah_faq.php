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
          <small>Data FAQ</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Pegawai</a></li>
          <li><a href="<?php echo base_url('Faq_controller/index') ?>">Lihat Data FAQ</a></li>
          <li><a href="<?php echo base_url('Faq_controller/add') ?>">Tambah Data FAQ</a></li>
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
              <form role="form" action="<?php echo base_url('Faq_controller/add') ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <label>Judul</label>
                    <input name="judul" class="form-control <?php echo form_error('judul') ? 'is-invalid':'' ?>" placeholder="Masukan Judul" type="text"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('judul') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Isi</label>
                    
                    <textarea class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" name="isi" id="isi" placeholder="Masukan Isi"></textarea>
                    <div class="invalid-feedback">
                      <?php echo form_error('isi') ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Urutan</label>
                    <input name="seq" class="form-control <?php echo form_error('seq') ? 'is-invalid':'' ?>" placeholder="Masukan Urutan" type="number"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('seq')?>
                    </div>
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
                  <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button>
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
