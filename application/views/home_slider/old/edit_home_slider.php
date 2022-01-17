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
  <?php $folder = $this->config->item('folder', 'upload_setting') ?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <a href="<?php echo base_url('Home_slider_controller/index') ?>">Ok</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
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
        <small>Data Pegawai</small>
      </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Pegawai</a></li>
          <li><a href="<?php echo base_url('Home_slider_controller/index') ?>">Lihat Data Home Slider</a></li>
          <li><a href="<?php echo base_url('Home_slider_controller/add') ?>">Tambah Data Home Slider</a></li>
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
            <form role="form" action="<?php echo base_url('Home_slider_controller/edit/'.$home_slider->home_slider_id) ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="home_slider_id" value="<?php echo $home_slider->home_slider_id?>" />
              <div class="box-body">
                <div class="form-group">
                  <label>Judul</label>
                  <input name="judul" class="form-control <?php echo form_error('judul') ? 'is-invalid':'' ?>" placeholder="Masukan Judul" value="<?php echo $home_slider->judul?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('judul') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Isi</label>
                  
                  <textarea class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" name="isi" id="isi"><?php echo $home_slider->isi?></textarea>
                  <div class="invalid-feedback">
                    <?php echo form_error('isi') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Youtube</label>
                  <input name="you_tube" class="form-control <?php echo form_error('you_tube') ? 'is-invalid':'' ?>" placeholder="Masukan link Youtube" value="<?php echo $home_slider->you_tube?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('you_tube')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Gambar (Max 1280*720, size file : 220 Kb)</label>
                    
                     <?php if($home_slider->img !='') {?> 
                      <div style="margin-bottom:5px;">
                        <img style="width: 80%" src="<?=base_url($folder.$home_slider->img)?>">
                        <input class="form-control" src="<?=base_url($folder.$home_slider->img)?>" name="old_img" value="<?php echo $home_slider->img?>" type="hidden"  >
                        <input class="form-control" src="<?=base_url($folder.$home_slider->img)?>" name="img" value="<?php echo $home_slider->img?>" type="file" > 
                      </div>  
                     <?php } 
                     else {?>
                          <div style="margin-bottom:5px;">
                            (No photo)
                                <span class="help-block"></span>
                                <input type="file" name="img" class="form-control-file">
                          </div> 
                    <?php   
                     }?> 
				        </div>

                <div class="form-group">
                    <label for="expired">Expired</label>
                    <input type="date"  name="expired" id="expired" class="form-control" value="<?php echo $home_slider->expired ?>">
                </div>
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                <!-- <button class="btn btn-danger" type="reset"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Batal</button> -->
                <a href="<?php echo base_url('Home_slider_controller') ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
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
