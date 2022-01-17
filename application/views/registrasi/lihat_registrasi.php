<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php $this->load->view("admin/_includes/header.php") ?>
    <?php $this->load->view("admin/_includes/sidebar.php") ?>
    <?php $this->load->helper('date'); ?>


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
            <small>Registrasi</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Registrasi</a></li>
            <li><a href="#">List Data Registrasi</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <?php
            $jml_reject = $count_reject;
          ?>
          <ul class="nav nav-tabs">
            <li class="active">
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Registrasi_controller/list_reject') ?>"><i style="margin-left: -3px;" ></i>Registrasi ditolak (<?php echo $jml_reject; ?>)</a></button>
              
            </li>
          </ul>

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!-- <a href="<?php echo base_url('Registrasi_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus"></i>Tambah</a> -->
                  <!-- <a href="<?php echo base_url("Registrasi_controller/export"); ?>" class="btn btn-carot"><i class="fa fa-fw fa-download"></i>Export Data</a>
                  <a class="btn btn-ijo" href="<?php echo base_url("Registrasi_controller/form"); ?>"><i class="fa fa-fw fa-upload"></i>Import Data</a> -->
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>NIP</th>
                        <th>Simpanan Pokok</th>
                        <th>Simpanan Wajib</th>
                        <th>Metode Pembayaran</th>
                        <th>Tanggal Registrasi</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($registrasi as $value): 
                        $date = $value->created_date; 
                        date_default_timezone_set("Asia/Jakarta");
                        ?>
                       
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->nama ?></td> 
                          <td><?php echo $value->email ?></td>
                          <td><?php echo $value->nip ?></td>
                          <td><?php echo $value->simpanan_pokok ?></td>
                          <td><?php echo $value->simpanan_wajib ?></td>
                          <td><?php echo $value->metode_pembayaran ?></td>
                          <!-- <td><?php echo $value->created_date ?></td> -->
                          <td><?php echo date("d-M-Y H:i",strtotime($date)) ?></td>

                          <td>
                            <!-- <a class="btn btn-ref" href="<?php echo site_url('Registrasi_controller/approve/'.$value->registrasi_id) ?>"><i class="fa fa-fw fa-eye"></i>Lihat</a> -->
                            <a class="btn btn-ref" href="<?php echo site_url('Registrasi_controller/lihat_approval/'.$value->registrasi_id) ?>"><i class="fa fa-fw fa-eye" title="Lihat"></i></a>
                            <!-- <a href="#!" onclick="deleteConfirm('<?php echo site_url('Registrasi_controller/delete/'.$value->registrasi_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash"></i>Hapus</a> -->
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                    <tfoot style="background: darkslategrey;">
                      <tr>
                        <th></th>
                        <th></th>
                        <th></th>
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
