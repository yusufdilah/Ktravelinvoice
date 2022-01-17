<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view("admin/_includes/header.php") ?>
    <?php $this->load->view("admin/_includes/sidebar.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->

      <section class="content-header">
        <h1>
          Kelola
          <small>Parameter Kategori</small>
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Kategori</a></li>
          <li><a href="#">Lihat Data Kategori</a></li>
          <li><a href="#">Tambah Data Kategori</a></li>
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
              <form role="form" action="<?php echo base_url('Kategori_controller/edit/'.$dataParameterKategori->parameter_category_id) ?>" method="post" enctype="multipart/form-data">
                <div class="box-body">
                  <div class="form-group">
                    <input name="parameter_category_id" required="" class="form-control <?php echo form_error('parameter_category_id') ? 'is-invalid':'' ?>" type="hidden" value="<?php echo $dataParameterKategori->parameter_category_id ?>" >
                  </div>
                  
                  <div class="form-group">
                    <label>Parameter Kategori</label>
                    <input value="<?php echo $dataParameterKategori->parameter_category?>" required="" name="parameter_category" class="form-control <?php echo form_error('parameter_category') ? 'is-invalid':'' ?>" placeholder="Masukan Parameter" type="text"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('parameter_category') ?>
                    </div>
                  </div>
                  
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <input value="<?php echo $dataParameterKategori->desc?>" required="" name="desc" class="form-control <?php echo form_error('desc') ? 'is-invalid':'' ?>" placeholder="Masukan Parameter" type="text"/>
                    <div class="invalid-feedback">
                      <?php echo form_error('desc') ?>
                    </div>
                  </div>
                  
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button class="btn btn-success" type="submit" value="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  
                  <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
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

 
 <!-- ./wrapper -->
 <?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
 <!-- page script -->
</body>
</html>
