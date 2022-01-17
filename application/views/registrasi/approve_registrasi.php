<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
<!-- <script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script>   -->

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
        <small>Data Registrasi</small>
      </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Registrasi</a></li>
          <li><a href="<?php echo base_url('Registrasi_controller/index') ?>">List Data Registrasi</a></li>
          <li>
              <a href="<?php echo base_url('Registrasi_controller/index') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-backward"></i></a>
          </li>
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
              <h3 class="box-title">Pengisian Form Approval </h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action="<?php echo base_url('Registrasi_controller/approve/'.$registrasi->registrasi_id) ?>" method="post">
              <input type="hidden" name="registrasi_id" value="<?php echo $registrasi->registrasi_id?>" />
              <div class="box-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" value="<?php echo $registrasi->nama?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nama') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Email</label>
                  <input name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $registrasi->email?>" type="text" readonly>
                </div>
                <div class="form-group">
                  <label>NIP</label>
                  <input name="nip" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" placeholder="Masukan link Youtube" value="<?php echo $registrasi->nip?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nip')?>
                  </div>
                </div>
                <div class="form-group">
                  
                  <input name="" class="form-control  
                       value="" type="text" style="background: cadetblue;" readonly />
                  <input name="" class="form-control  
                       value="" type="text" style="background: cadetblue;" readonly />
                </div>
                <div class="form-group">
                    <label>Karyawan Kopkar BSM ?</label>
                    <select required="" class="form-control" name="is_karyawan_kopkar">
                      <option value="" selected>Silahkan Pilih</option>
                      <option value="1">Ya</option>
                      <option value="0">Tidak</option>
                    </select>
                    <div class="invalid-feedback">
                      <?php echo form_error('is_karyawan_kopkar') ?>
                    </div>
                </div>
                <div class="form-group">
                  <label>ID Nasabah</label>
                  <input required="" name="nasabah_id" class="form-control <?php echo form_error('nasabah_id') ? 'is-invalid':'' ?>" placeholder="Masukan ID Nasabah" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nasabah_id')?>
                  </div>
                </div>
                <div class="form-group">
                  <!-- <label>Foto</label> -->
                  <input name="password" id="password" class="form-control <?php echo form_error('password') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $registrasi->password?>" type="hidden" readonly>
                </div>
                <div class="form-group">
                  <!-- <label>Foto</label> -->
                  <input name="foto" id="foto" class="form-control <?php echo form_error('foto') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $registrasi->foto?>" type="hidden" readonly>
                </div>
                <div class="form-group">
                  <!-- <label>Perusahaan Sebelum</label> -->
                  <input name="perusahaan_sebelum" id="perusahaan_sebelum" class="form-control <?php echo form_error('perusahaan_sebelum') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $registrasi->perusahaan_sebelum?>" type="hidden" readonly>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check"></i>Approve</button>
                <!-- <button class="btn btn-danger" name="submit" type="submit"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Reject</button> -->
                <a href="<?php echo base_url('Registrasi_controller/index') ?>" class="btn btn-info"><i class="fa fa-fw fa-arrow-left"></i>Cancel</a>

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
<!-- </div>
<script>
     CKEDITOR.replace('isi');
</script> -->
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
</body>
</html>