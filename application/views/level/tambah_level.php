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
      <?php if ($this->session->flashdata('success')): ?>
        <div class="box-body">
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        </div>
        <?php endif; ?>

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
          <small>Data Level</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> level</a></li>
          <li><a href="<?php echo base_url('Setting_level_controller') ?>">Lihat Data Level</a></li>
          <li><a href="<?php echo base_url('Setting_level_controller/add') ?>">Tambah Data Level</a></li>
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
              <form role="form" action="<?php echo base_url('Setting_level_controller/save') ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  
                <div class="form-group">
                    <label>Nama User</label>
                    
                    <select required="" class="form-control" id="nasabah_id" name="nasabah_id">
                     <option selected="0">select..</option>
                     <?php foreach($dataAnggota as $anggota) : ?>
                      <option value="<?php echo $anggota->nasabah_id;?>"> <?php echo $anggota->nama_lengkap; ?></option>
                     <?php endforeach; ?>
                    </select>

                    <div class="invalid-feedback">
                      <?php echo form_error('is_karyawan_kopkar') ?>
                    </div>
                </div>
                  <div class="form-group">
                    <label>level</label>
                    <input required="" name="level" class="form-control" placeholder="Masukan Level" type="text"/>
                    
                  </div>
                    
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  
                  <a href="<?php echo base_url('Setting_level_controller') ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
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
