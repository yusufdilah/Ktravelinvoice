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
            <small>Vendor</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Vendor</a></li>
            <li><a href="#">Lihat Data Vendor</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!-- <a href="<?php echo base_url('Faq_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus" title="Tambah"></i></a> -->
                  <a href="#!"  class="btn btn-tosca" type="button" onclick="addConfirm()"><i class="fa fa-fw fa-plus" title="Tambah"></i></a>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Nama Vendor</th>
                        <th>Alamat</th>
                        <th>No Telepon</th>
                        <th>Mark Up</th>
                        <th>PIC</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($vendor as $value): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->nm_vendor ?></td>
                          <td><?php echo $value->alamat_vendor ?></td>
                          <td><?php echo $value->no_telepon ?></td>
                          <td><?php echo $value->mark_up*100 ?> %</td>
                          <td><?php echo $value->pic ?></td>
                          <td>
                            <!-- <a href="#!" onclick="editConfirm()" class="btn btn-ref"><i class="fa fa-fw fa-edit" title="Edit"></i></a> -->
                            <a data-toggle="modal" data-target="#modal-edit<?=$value->vendor_id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil"></i></a>
                            
                            <a href="#!" onclick="deleteConfirm('<?php echo site_url('Vendor_controller/delete/'.$value->vendor_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
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

 <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Vendor_controller/add') ?>" method="post">   
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Tambah Data</h3>
      </div>
      <!-- <div class="modal-body">Apakah anda yakin untuk menyetujui data ini ?</div> -->
      <div class="form-group">
        <div class="box-body">
          <label>Nama Vendor</label>
          <input required="" name="nm_vendor" class="form-control <?php echo form_error('nm_vendor') ? 'is-invalid':'' ?>" placeholder="Masukan Nama Vendor" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('nm_vendor')?>
          </div>
        </div>
        <div class="box-body">
          <label>Alamat </label>
          <input  name="alamat_vendor" class="form-control <?php echo form_error('alamat_vendor') ? 'is-invalid':'' ?>" placeholder="Masukan Alamat Vendor" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('alamat_vendor')?>
          </div>
        </div>
        <div class="box-body">
          <label>No Telepon</label>
          <input name="no_telepon" class="form-control <?php echo form_error('no_telepon') ? 'is-invalid':'' ?>" placeholder="Masukan No Telepon" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('no_telepon')?>
          </div>
        </div>

        <div class="box-body">
          <label>Mark Up</label><br>
          <input name="mark_up" class="form <?php echo form_error('mark_up') ? 'is-invalid':'' ?>" placeholder="(Input harus angka)" type="number"/> %
          <div class="invalid-feedback">
              <?php echo form_error('mark_up')?>
          </div>
          
        </div>
        

        <div class="box-body">
            <label>PIC</label>
            <input name="pic" class="form-control <?php echo form_error('pic') ? 'is-invalid':'' ?>" placeholder="Masukan PIC" type="text"/>
            <div class="invalid-feedback">
                <?php echo form_error('pic')?>
            </div>

        </div>
          
      </div>
      
     <!--  <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div> -->

      <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus" title="Simpan"></i>Tambah</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
      </div>

    </form>  
    </div>
  </div>
</div>


<?php $no=0; foreach($vendor as $value): $no++; ?>
<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div class="row">  
<div id="modal-edit<?=$value->vendor_id;?>" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Vendor_controller/edit') ?>" method="post">   
      
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Edit Data</h3>
      </div>
      <!-- <div class="modal-body"> -->
      <input type="hidden" readonly value="<?=$value->vendor_id;?>" name="vendor_id" class="form-control" >
      <div class="form-group">
         <div class="box-body">
          <label>Nama Vendor</label>
          <input value="<?php  echo $value->nm_vendor ?>" required="" name="nm_vendor" class="form-control <?php echo form_error('nm_vendor') ? 'is-invalid':'' ?>" placeholder="Masukan Nama Vendor" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('nm_vendor')?>
          </div>
        </div>
        <div class="box-body">
          <label>Alamat </label>
          <input value="<?php echo $value->alamat_vendor ?>"  name="alamat_vendor" class="form-control <?php echo form_error('alamat_vendor') ? 'is-invalid':'' ?>" placeholder="Masukan Alamat Vendor" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('alamat_vendor')?>
          </div>
        </div>
        <div class="box-body">
          <label>No Telepon</label>
          <input value="<?php echo $value->no_telepon ?>" name="no_telepon" class="form-control <?php echo form_error('no_telepon') ? 'is-invalid':'' ?>" placeholder="Masukan No Telepon" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('no_telepon')?>
          </div>
        </div>  

        <div class="box-body">
          <label>Mark Up</label><br>
          <input value="<?php echo $value->mark_up*100 ?>" name="mark_up" class="form <?php echo form_error('mark_up') ? 'is-invalid':'' ?>" placeholder="(Input harus angka)" type="number"/> %
          <div class="invalid-feedback">
              <?php echo form_error('mark_up')?>
          </div>
          
        </div>

        <div class="box-body">
            <label>PIC</label>
            <input value="<?php echo $value->pic ?>"  name="pic" class="form-control <?php echo form_error('pic') ? 'is-invalid':'' ?>" placeholder="Masukan PIC" type="text"/>
            <div class="invalid-feedback">
                <?php echo form_error('pic')?>
            </div>

        </div>

      </div>
      <!-- </div> -->
      
     <!--  <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div> -->

      <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-pencil" >Simpan</i></button>
          
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
      </div>



    </form>  
    </div>
  </div>
</div>
</div>
<?php endforeach; ?>

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
  function addConfirm(url){
    $('#btn-approve').attr('href', url);
    $('#addModal').modal();
  }
</script>

<script>
  function editConfirm(url){
    $('#btn-approve').attr('href', url);
    $('#editModal').modal();
  }
</script>

<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>
</body>
</html>
