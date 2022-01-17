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
          <small>Data Tiket Divisi</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> level</a></li>
          <li><a href="<?php echo base_url('Setting_tiket_divisi_controller') ?>">Lihat Data Tiket Divisi</a></li>
          <li><a href="<?php echo base_url('Setting_tiket_divisi_controller/edit') ?>">Edit Data Tiket Divisi</a></li>
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
              <form role="form" action="<?php echo base_url('Setting_tiket_divisi_controller/edit/'.$dataSettingDivisi->tiket_divisi_id) ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  
                <div class="form-group">
                    <label>Divisi</label>
                    
                    <select  class="form-control" id="divisi_id" name="divisi_id" required>
                     

                     <?php
                        foreach ($dataDivisi as $divisi) {
                          ?>
                          <option value="<?php echo $divisi->id_divisi; ?>" <?php if($divisi->id_divisi == $dataSettingDivisi->divisi_id){echo "selected='selected'";} ?>><?php echo $divisi->divisi; ?></option>
                          <?php
                        }
                        ?>
                    </select>

                </div>

                <div class="form-group">
                    <label>Kategori</label>
                    
                    <select required="" class="form-control" id="tiket_kategori_id" name="tiket_kategori_id">
                     

                     <?php
                        foreach ($dataKategori as $kategori) {
                          ?>
                          <option value="<?php echo $kategori->id_kategori; ?>" <?php if($kategori->id_kategori == $dataSettingDivisi->tiket_kategori_id){echo "selected='selected'";} ?>><?php echo $kategori->kategori; ?></option>
                          <?php
                        }
                        ?>
                    </select>

                </div>
                  
                    
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit" value="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  <!-- <button class="btn btn-danger" ><a href="<?php echo base_url('Setting_tiket_divisi_controller') ?>"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i></a>Batal</button> -->
                  <a href="<?php echo base_url('Setting_tiket_divisi_controller') ?>" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
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

 <!-- <script>
     CKEDITOR.replace('isi');
 </script> -->

 <!-- ./wrapper -->
 <?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
 <!-- page script -->
</body>
</html>
