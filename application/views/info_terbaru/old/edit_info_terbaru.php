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
        <a href="<?php echo base_url('Info_terbaru_controller/index') ?>">Ok</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
      </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('message'); ?>
          
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
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i>Info Terbaru</a></li>
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
            <form role="form" action="<?php echo base_url('Info_terbaru_controller/edit/'.$info_terbaru->info_terbaru_id) ?>" method="post" enctype="multipart/form-data">
              <input type="hidden" name="info_terbaru_id" value="<?php echo $info_terbaru->info_terbaru_id?>" />
              <div class="box-body">
                <div class="form-group">
                  <label>Judul</label>
                  <input name="judul" class="form-control <?php echo form_error('judul') ? 'is-invalid':'' ?>" placeholder="Masukan Judul" value="<?php echo $info_terbaru->judul?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('judul') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Cuplikan</label>
                  <input name="cuplikan" class="form-control <?php echo form_error('cuplikan') ? 'is-invalid':'' ?>" placeholder="Masukan Cuplikan" value="<?php echo $info_terbaru->cuplikan?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('cuplikan') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Isi</label>
                  <!-- <input name="isi" id="isi" class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $info_terbaru->isi?>" type="text"> -->
                  <textarea class="form-control <?php echo form_error('isi') ? 'is-invalid':'' ?>" name="isi" id="isi"><?php echo $info_terbaru->isi?></textarea>
                  <div class="invalid-feedback">
                    <?php echo form_error('isi') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Youtube</label>
                  <input name="you_tube" class="form-control <?php echo form_error('you_tube') ? 'is-invalid':'' ?>" placeholder="Masukan link Youtube" value="<?php echo $info_terbaru->you_tube?>" type="text"/>
                  <div class="invalid-feedback">
                    <?php echo form_error('you_tube')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Gambar (Max 609*609, size file : 220 Kb)</label>
                    <?php if($info_terbaru->img_cuplik !='') {?> 
                      <div style="margin-bottom:5px;">
                        <img src="<?=base_url($folder.$info_terbaru->img_cuplik)?>" width="75%">
                        <input class="form-control" src="<?=base_url($folder.$info_terbaru->img_cuplik)?>" name="old_img" value="<?php echo $info_terbaru->img_cuplik?>" type="hidden"  >
                        <input class="form-control" src="<?=base_url($folder.$info_terbaru->img_cuplik)?>" name="img_cuplik" value="<?php echo $info_terbaru->img_cuplik?>" type="file" >
                      </div>  
                     <?php } 
                     else {?>
                          <div style="margin-bottom:5px;">
                            (No photo)
                            <span class="help-block"></span>
                            <input type="file" name="img_cuplik" class="form-control-file">
                          </div> 
                    <?php   
                     }?> 
                </div>
                <div class="form-group">
                    <label>Status</label>
                    <div class="radio">
                      <label>
                        <input type="radio" <?php if ($info_terbaru->status == '1') {
                          echo "checked";
                        } ?> class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="1" checked="">
                        Active
                      </label>
                    </div>
                    <div class="radio">
                      <label>
                        <input type="radio" <?php if ($info_terbaru->status == '0') {
                          echo "checked";
                        } ?> class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="0">
                        Inactive
                      </label>
                    </div>
                 
                </div>
              </div>
                
              <!-- /.box-body -->

              <div class="box-footer">
                <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                
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
