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
            <small>PIC</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> PIC</a></li>
            <li><a href="#">Lihat Data PIC</a></li>
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
                        <th>NIP</th>
                        <th>Divisi</th>
                        <th>PIC</th>
                        <th>Nama Customer</th>
                        <th>Status</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($pic as $value): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->nip_pic ?></td>
                          <td><?php echo $value->nama_divisi?></td>
                          <td><?php echo $value->pic?></td>
                          <td><?php echo $value->nama_customer ?></td>
                          <!-- <td><?php echo $value->is_anggota_kopkar ?></td> -->
                          <td><?php 
                               if ($value->status == 1) {?>
                                   <?php echo "Active";

                               } else {?>
                                  <?php echo "Inactive";
                                }
                              ?>
                          </td> 
                          <td><?php echo $value->no_hp?></td>
                          <td>
                            <!-- <a href="#!" onclick="editConfirm()" class="btn btn-ref"><i class="fa fa-fw fa-edit" title="Edit"></i></a> -->
                            <a data-toggle="modal" data-target="#modal-edit<?=$value->pic_id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil"></i></a>
                            
                            <a href="#!" onclick="deleteConfirm('<?php echo site_url('Pic_controller/delete/'.$value->pic_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
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
    <form  role="form" action="<?php echo base_url('Pic_controller/add') ?>" method="post">   
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Tambah Data</h3>
      </div>
      <!-- <div class="modal-body">Apakah anda yakin untuk menyetujui data ini ?</div> -->
      <div class="form-group">
        
        
        
        <!-- <div class="box-body">
            <label>Customer</label>
            <select  class="form-control" id="customer" name="customer" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataCustomer as $customer) : ?>
                      <option value="<?php echo $customer->customer_id;?>"> <?php echo $customer->nama_customer; ?></option>
                     <?php endforeach; ?>
            </select>

        </div> -->

         <div class="box-body">
            <label>Divisi</label>
            <select  class="form-control" id="divisi" name="divisi" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataDivisi as $divisi) : ?>
                      <option value="<?php echo $divisi->divisi_id;?>"> <?php echo $divisi->nama_divisi; ?></option>
                     <?php endforeach; ?>
            </select>

        </div>

        <!-- <div class="box-body">
            <label>Divisi</label>
            <select id="divisi" name="divisi" class="form-control select2">
                        <!-<option value="" selected>Pilih Divisi</option>
            </select>
        </div> --> 

        <div class="box-body">
          <label>NIP</label>
          <input required=""  name="nip_pic" class="form-control <?php echo form_error('nip_pic') ? 'is-invalid':'' ?>" placeholder="Masukan NIP" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('nip_pic')?>
          </div>
        </div>

        <div class="box-body">
          <label>PIC</label>
          <input required="" name="pic" class="form-control <?php echo form_error('pic') ? 'is-invalid':'' ?>" placeholder="Masukan Nama PIC" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('pic')?>
          </div>
        </div>

        <div class="box-body">
          <label>Status</label>
            <div class="radio">
              <label>
                <input type="radio" class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="1" checked="">
                        Active
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="0">
                        Inactive
              </label>
            </div>
        </div>  

        <div class="box-body">
          <label>No HP</label>
          <input required="" name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>" placeholder="Masukan No Hp" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('no_hp')?>
          </div>
        </div>
      </div>
      
     <!--  <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div> -->

      <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus" ></i>Simpan</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
      </div>

    </form>  
    </div>
  </div>
</div>


<?php $no=0; foreach($pic as $value): $no++; ?>
<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div class="row">  
<div id="modal-edit<?=$value->pic_id;?>" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Pic_controller/edit') ?>" method="post">   
      
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Edit Data</h3>
      </div>
      <!-- <div class="modal-body"> -->
      <input type="hidden" readonly value="<?=$value->pic_id;?>" name="pic_id" class="form-control" >
      <div class="form-group">
        
        

        <!-- <div class="box-body">
            <label>Nama Customer</label>
            <select  class="form-control" id="customer" name="customer" required>
                     
              <?php foreach ($dataCustomer as $customer) {
                ?>
                  <option value="<?php echo $customer->customer_id; ?>" <?php if($customer->customer_id == $value->customer){echo "selected='selected'";} ?>>
                    <?php echo $customer->nama_customer; ?>
                    
                  </option>
                  <?php
              }?>     
            </select>
        </div> -->

        <div class="box-body">
            <label>Divisi</label>
            
            <select  class="form-control" id="divisi" name="divisi" required>
              <?php foreach ($dataDivisi as $divisi) {
                ?>
                  <option value="<?php echo $divisi->divisi_id; ?>" <?php if($divisi->divisi_id == $value->divisi){echo "selected='selected'";} ?>>
                    <?php echo $divisi->nama_divisi; ?>
                    
                  </option>
                  <?php
              }?>
            </select>

        </div>

        <div class="box-body">
          <label>NIP</label>
          <input required=""  name="nip_pic" class="form-control <?php echo form_error('nip_pic') ? 'is-invalid':'' ?>" placeholder="Masukan NIP" value="<?php echo $value->nip_pic?>" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('nip_pic')?>
          </div>
        </div>
        
        <div class="box-body">
          <label>PIC</label>
          <input required=""  name="pic" class="form-control <?php echo form_error('pic') ? 'is-invalid':'' ?>" placeholder="Masukan PIC" value="<?php echo $value->pic?>" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('pic')?>
          </div>
        </div>

        <div class="box-body">
          <label>Status</label>
            <div class="radio">
              <label>
                <input type="radio" <?php if ($value->status == '1') {
                          echo "checked";
                } ?> class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="1" checked="">
                        Active
              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio" <?php if ($value->status == '0') {
                          echo "checked";
                } ?> class="<?php echo form_error('status') ? 'is-invalid':'' ?>" name="status" value="0">
                        Inactive
              </label>
            </div>
        </div>  

        <div class="box-body">
          <label>No Hp</label>
          <input required=""  name="no_hp" class="form-control <?php echo form_error('no_hp') ? 'is-invalid':'' ?>" placeholder="Masukan No Hp" value="<?php echo $value->no_hp?>" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('no_hp')?>
          </div>
        </div>

      </div>
    
      <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-pencil" title="Simpan"></i>Simpan</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" title="Batal"></i>Batal</button>
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
<script type="text/javascript">
    // Divisi
        $(document).ready(function() {
            $("#divisi").select2({
                ajax: {
                    url: '<?= base_url() ?>Pic_controller/getdataDivisi',
                    type: "post",
                    dataType: 'json',
                    delay: 200,
                    data: function(params) {
                        return {
                            searchTerm: params.term
                        };
                    },
                    processResults: function(response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

</script>
</body>
</html>
