<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view("admin/_includes/header.php") ?>
    <?php $this->load->view("admin/_includes/sidebar.php") ?>
    <?php $this->config->load('upload_setting', TRUE); ?>
    <?php $folder = $this->config->item('folder', 'upload_setting') ?>

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
            <small>Info Terbaru</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Info Terbaru</a></li>
            <li><a href="#">Lihat Data Info Terbaru</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <a href="<?php echo base_url('Info_terbaru_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus" title="Tambah"></i></a>
                  <!-- <a href="<?php echo base_url("Info_terbaru_controller/export"); ?>" class="btn btn-carot"><i class="fa fa-fw fa-download"></i>Export Data</a>
                  <a class="btn btn-ijo" href="<?php echo base_url("Info_terbaru_controller/form"); ?>"><i class="fa fa-fw fa-upload"></i>Import Data</a> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Gambar</th>
                        <th>Judul</th>
                        <!-- <th>Isi</th> -->
                        <th>Cuplikan</th>
                        <th>Youtube</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($info_terbaru as $value): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <!-- <td><?php echo $value->img_cuplik?></td> -->
                          <td>
                            <?php if($value->img_cuplik != null) {?>
                              <img src="<?=base_url($folder.$value->img_cuplik)?>" style="width: 100px;">
                            <?php } 
                             else {?>
                                  <div style="margin-bottom:5px;">
                                    (No photo)
                                    <span class="help-block"></span>
                                  </div> 
                            <?php   
                             }?>  
                          </td>
                          <td><?php echo $value->judul ?></td>
                          <!-- <td><?php echo $value->isi ?></td> -->
                          <td><?php echo $value->cuplikan ?></td>
                          <td>
                            <?php 
                            if($value->you_tube != '')
                            {
                                echo'<iframe src="'.$value->you_tube.'?rel=0" frameborder="0" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"></iframe>';
                            }
                          ?>
                          </td>
                          <td>
                            <a class="btn btn-ref" href="<?php echo site_url('Info_terbaru_controller/edit/'.$value->id_info_terbaru) ?>"><i class="fa fa-fw fa-edit" title="Edit"></i></a>
                            <!--<a class="btn btn-primary" href="<?php echo site_url('Manage_slideshow_controller/form_add/'.$value->id_info_terbaru) ?>"><i class="fa fa-fw fa-tasks" title="Manage Slideshow"></i></a> -->
                            <a class="btn btn-primary" href="<?php echo site_url('Info_terbaru_controller/detail/'.$value->id_info_terbaru) ?>"><i class="fa fa-fw fa-eye" title="Detail"></i></a>
                            <?php 
                            if ($value->info_terbaru_img_id == '' ) {?> 
                            <a href="#!" onclick="deleteConfirm('<?php echo site_url('Info_terbaru_controller/delete/'.$value->id_info_terbaru) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
                            <?php } ?>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot style="background: darkslategrey;">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <!-- <th>Isi</th> -->
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
