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

      <!-- Alert -->
        <?php if ($this->session->flashdata('success')): ?>
        <div class="box-body">
          <div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h4><i class="icon fa fa-info"></i>Alert!</h4>
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        </div>
        <?php endif; ?>
      <!-- Alert -->


        <section class="content-header">
          <h1>
            Kelola
            <small>Detail / parameter kategori</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i>Detail / parameter kategori</a></li>
            <li><a href="<?php echo base_url('Kategori_controller') ?>">Lihat Kategori</a></li>
            <li><a href="#">Data Detail / parameter kategori</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a class="btn btn-primary" href="<?php echo site_url('Kategori_controller/newDetail/'.$adddetailKategori->parameter_category_id) ?>"><i class="fa fa-fw fa-plus" title="Add Detail"></i></a>
                  <a href="<?php echo site_url('Kategori_controller')?>" class="btn btn-tosca"><i class="fa fa-fw fa-arrow-left"></i></a>
                 
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Kategori</th>
                        <th>Parameter</th>
                        <th>Deskripsi angka</th>
                        <th>Deskripsi teks</th>
                        
                        <TH></TH>
                        <!-- <th>Aksi</th> -->
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                        <?php foreach ($datadetailKategori as $value): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->kategori?></td>
                          <td><?php echo $value->parameter?></td>
                          <td><?php echo $value->value_int?></td>
                          <td><?php echo $value->value_text?></td>
                          <td>
                            <a class="btn btn-ref" href="<?php echo site_url('Kategori_controller/editDetail/'.$value->parameter_id) ?>"><i class="fa fa-fw fa-edit" title="Edit"></i></a>
                            <a href="#!" onclick="deleteConfirm('<?php echo site_url('Kategori_controller/deleteDetail/'.$value->parameter_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
                          </td>
                          
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        
                      </tr>
                    </tfoot>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
            <!-- /.col -->
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

 <!-- Logout Delete Confirmation-->
 <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-delete" class="btn btn-danger" href="#">Delete</a>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>
</body>
</html>
