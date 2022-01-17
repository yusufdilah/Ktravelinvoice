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
    <?php $folder = $this->config->item('folder', 'upload_setting') ?>
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
              <form role="form" action="<?php echo base_url('Manage_slideshow_controller/edit/'.$manage_slideshow->info_terbaru_img_id) ?>" method="post" enctype="multipart/form-data">
                
                <div class="box-body">
                  <div class="form-group">
                    <!-- <label>Nama anak </label> -->
                    <input type="hidden" name="info_terbaru_img_id" value="<?php echo $manage_slideshow->info_terbaru_img_id?>" />
                    <input type="hidden" name="info_terbaru_id" value="<?php echo $manage_slideshow->info_terbaru_id?>" />
                    
                  </div>
                  <div class="form-group">
                    <label>Status</label>
                          <?php 
                            $Active = ($manage_slideshow->status == 1)?"selected":"";
                            $Inactive = ($manage_slideshow->status == 0)?"selected":"";
                          ?>
                     <select required="" class="form-control <?php echo form_error('status') ? 'is-invalid':'' ?>" name="status">
                              <option selected value="">select..</option>
                              <option value="1" <?php echo $Active;?> > Active </option>
                              <option value="0" <?php echo $Inactive;?> > Inactive</option>
                    </select>
                  </div>
                  

                  <div class="form-group">
                  <label>Gambar (Max 609*609, size file : 220 Kb)</label>
                    <?php if($manage_slideshow->img !='') {?> 
                      <div style="margin-bottom:5px;">
                        <img src="<?=base_url($folder.$manage_slideshow->img)?>" width="75%">
                        <input class="form-control" src="<?=base_url($folder.$manage_slideshow->img)?>" name="old_img" value="<?php echo $manage_slideshow->img?>" type="hidden"  >
                        <input class="form-control" src="<?=base_url($folder.$manage_slideshow->img)?>" name="img" value="<?php echo $manage_slideshow->img?>" type="file" >
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
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  
                  <a href="<?php echo site_url('Info_terbaru_controller/detail/'.$manage_slideshow->info_terbaru_id) ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>

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
