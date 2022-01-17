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
  <?php $this->config->load('upload_setting', TRUE); ?>
  <?php $folder = $this->config->item('registrasi_view', 'upload_setting') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <a href="<?php echo base_url('Registrasi_controller/index') ?>">Ok</a>
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
              <h3 class="box-title">Pengisian Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <form role="form" action="<?php echo base_url('Registrasi_controller/approve/'.$registrasi->registrasi_id) ?>" method="post"> -->
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
                  <label>Perusahaan Sebelum</label>
                  <input name="perusahaan_sebelum" class="form-control <?php echo form_error('perusahaan_sebelum') ? 'is-invalid':'' ?>"  value="<?php echo $registrasi->perusahaan_sebelum?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('perusahaan_sebelum')?>
                  </div>
                </div>
                <div class="form-group">
                      <!-- <div class="profile-info-name"> Gambar </div> -->
                        <label>Foto Selfie + Pegang ID Card</label>
                        <div style="margin-bottom: 5px;"><img src="<?php echo''.$folder.''.$registrasi->foto.'';?>" width="75%"></div>
                </div>
                <div class="form-group">
                  <label>Simpanan Pokok</label>
                  <input name="simpanan_pokok" class="form-control <?php echo form_error('simpanan_pokok') ? 'is-invalid':'' ?>" placeholder="Masukan Simpanan Pokok" value="<?php echo $registrasi->simpanan_pokok?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('simpanan_pokok')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Simpanan Wajib</label>
                  <input name="simpanan_wajib" class="form-control <?php echo form_error('simpanan_wajib') ? 'is-invalid':'' ?>" placeholder="Masukan Simpanan Wajib" value="<?php echo $registrasi->simpanan_wajib?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('simpanan_wajib')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Metode Pembayaran</label>
                  <input name="metode_pembayaran" class="form-control <?php echo form_error('metode_pembayaran') ? 'is-invalid':'' ?>" placeholder="Masukan Metode Pembayaran" value="<?php echo $registrasi->metode_pembayaran?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('metode_pembayaran')?>
                  </div>
                </div>

              </div>
              <!-- /.box-body -->

              <div class="box-footer">

               <!--  <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check"></i>Approve</button> -->
               <a class="btn btn-ref" href="<?php echo site_url('Registrasi_controller/form_approval/'.$registrasi->registrasi_id) ?>"><i class="fa fa-fw fa-question"></i>Approve</a>
                <button class="btn btn-danger" name="submit" type="submit"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Reject</button>
                <a href="<?php echo base_url('Registrasi_controller/index') ?>" class="btn btn-info"><i class="fa fa-fw fa-arrow-left"></i>Cancel</a>

              </div>
            <!-- </form> -->
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
