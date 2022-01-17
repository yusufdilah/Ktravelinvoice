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
            <small>Reminder</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Reminder</a></li>
            <li><a href="#">Lihat Data Reminder</a></li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
         <?php $jml_foll_up = $jml_foll_up;?>
          <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Reminder_controller/list_reminder') ?>"><i style="margin-left: -3px;" ></i>History Follow Up (<?php echo $jml_foll_up; ?>)</a></button>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  <!-- <a href="<?php echo base_url('Faq_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus" title="Tambah"></i></a> -->
                  <!-- <a href="#!"  class="btn btn-tosca" type="button" onclick="addConfirm()"><i class="fa fa-fw fa-plus" title="Tambah"></i></a> -->
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Tanggal Invoice</th>
                        <th>No Invoice</th>
                        <th>Total Harga</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($reminder as $value): ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->tgl_invoice ?></td>
                          <td><?php echo $value->no_invoice ?></td>
                          <td><?php echo $value->harga_jual ?></td>
                          
                          <td>
                            <!-- <a href="#!" onclick="editConfirm()" class="btn btn-ref"><i class="fa fa-fw fa-edit" title="Edit"></i></a> -->
                            <a data-toggle="modal" data-target="#modal-edit<?=$value->invoice_id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-sticky-note"></i></a>
                            
                            <!-- <a href="#!" onclick="deleteConfirm('<?php echo site_url('Perusahaan_controller/delete/'.$value->perusahaan_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a> -->
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
    <form  role="form" action="<?php echo base_url('Perusahaan_controller/add') ?>" method="post">   
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Tambah Data</h3>
      </div>
      <!-- <div class="modal-body">Apakah anda yakin untuk menyetujui data ini ?</div> -->
      <div class="form-group">
        <div class="box-body">
            <label for="tgl_issued">Tanggal Issued</label>
            <input required="" type="date"  name="tgl_issued" id="tgl_issued" class="form-control" >
        </div>
        <div class="box-body">
            <label for="tgl_berangkat">Tanggal Berangkat</label>
            <input required="" type="date"  name="tgl_berangkat" id="tgl_berangkat" class="form-control" >
        </div>
        <div class="box-body">
            <label>Divisi</label>
            <select  class="form-control" id="divisi" name="divisi" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataDivisi as $divisi) : ?>
                      <option value="<?php echo $divisi->divisi_id;?>"> <?php echo $divisi->nama_divisi; ?></option>
                     <?php endforeach; ?>
            </select>

        </div>
        <div class="box-body">
            <label>Akomodasi</label>
            <select  class="form-control" id="akomodasi" name="akomodasi" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataAkomodasi as $akomodasi) : ?>
                      <option value="<?php echo $akomodasi->akomodasi_id;?>"> <?php echo $akomodasi->akomodasi; ?></option>
                     <?php endforeach; ?>
            </select>

        </div>
        <!-- <div class="box-body">
            <label>Maskapai</label>
            <select  class="form-control" id="maskapai" name="maskapai" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataMaskapai as $maskapai) : ?>
                      <option value="<?php echo $maskapai->divisi_id;?>"> <?php echo $maskapai->nama_maskapai; ?></option>
                     <?php endforeach; ?>
            </select>
        </div> -->
        <div class="box-body">
            <label>Maskapai</label>
            <select  class="form-control" id="maskapai" name="maskapai" required>
                     <option  value="">select..</option>
                     
            </select>
        </div>
        <div class="box-body">
          <label>Hotel</label>
          <input  name="hotel" class="form-control <?php echo form_error('hotel') ? 'is-invalid':'' ?>" placeholder="Masukkan Nama Hotel" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('hotel')?>
          </div>
        </div>
        <div class="box-body">
          <label>Alamat Hotel</label>
          <input  name="alamat_hotel" class="form-control <?php echo form_error('alamat_hotel') ? 'is-invalid':'' ?>" placeholder="Masukkan Alamat Hotel" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('alamat_hotel')?>
          </div>
        </div>
        <div class="box-body">
            <label>Route</label>
            <select  class="form-control" id="maskapai" name="maskapai" required>
                     <option selected value="">select..</option>
                     <?php foreach($dataMaskapai as $maskapai) : ?>
                      <option value="<?php echo $maskapai->divisi_id;?>"> <?php echo $maskapai->nama_maskapai; ?></option>
                     <?php endforeach; ?>
            </select>

        </div>
        <div class="box-body">
          <label>HPP</label>
          <input  name="hpp" class="form-control <?php echo form_error('hpp') ? 'is-invalid':'' ?>" placeholder="Masukkan HPP" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('hpp')?>
          </div>
        </div>
        <div class="box-body">
          <label>Service Fee</label>
          <input  name="service_fee" class="form-control <?php echo form_error('service_fee') ? 'is-invalid':'' ?>" placeholder="Masukkan Service Fee" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('service_fee')?>
          </div>
        </div>
        <div class="box-body">
          <label>Harga Jual </label>
          <input  name="harga_jual" class="form-control <?php echo form_error('harga_jual') ? 'is-invalid':'' ?>"  type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('harga_jual')?>
          </div>
        </div>
        <div class="box-body">
          <label>Biaya Lain - lain</label>
          <input  name="biaya_lain" class="form-control <?php echo form_error('biaya_lain') ? 'is-invalid':'' ?>" pl type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('biaya_lain')?>
          </div>
        </div>
        <div class="box-body">
          <label>Harga Jual</label>
          <input  name="harga_jual" class="form-control <?php echo form_error('harga_jual') ? 'is-invalid':'' ?>" pl type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('harga_jual')?>
          </div>
        </div>
        <div class="box-body">
          <label>Bookers</label>
          <input  name="bookers" class="form-control <?php echo form_error('bookers') ? 'is-invalid':'' ?>" placeholder="Masukkan Nama Bookers" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('bookers')?>
          </div>
        </div>
        <div class="box-body">
          <label>Upload Tiket</label>
          <input type="file" name="file_tiket" class="form-control">
        </div>
        <div class="box-body">
          <label>Upload SPJ</label>
          <input type="file" name="file_tiket" class="form-control">
        </div>
        
      </div>
      
     <!--  <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div> -->

      <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus" ></i>Tambah</button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
      </div>

    </form>  
    </div>
  </div>
</div>


<?php $no=0; foreach($reminder as $value): $no++; ?>
<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<div class="row">  
<div id="modal-edit<?=$value->invoice_id;?>" aria-hidden="true" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" class="modal fade">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Reminder_controller/add') ?>" method="post">   
      
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Edit Data</h3>
      </div>
      <!-- <div class="modal-body"> -->
      <input type="text" readonly value="<?=$value->invoice_id;?>" name="perusahaan_id" class="form-control" >
      <div class="form-group">
        <div class="box-body">
            <?php $curent_date = date('d-m-Y'); ?>  
            <label for="tgl_foll_up">Tanggal Follow Up</label>
            <input readonly="" placeholder="<?=$curent_date?>" type="text"   name="tgl_foll_up" id="tgl_foll_up" class="form-control" >
        </div>
        <div class="box-body">
            <label for="invoice_no">Invoice No</label>
            <input readonly="" type="text" value="<?=$value->no_invoice;?>"  name="invoice_no" id="invoice_no" class="form-control" >
        </div>

        <div class="box-body">
          <label>PIC</label>
          <input name="pic" class="form-control <?php echo form_error('pic') ? 'is-invalid':'' ?>" placeholder="Masukkan PIC" type="text"/>
          <div class="invalid-feedback">
              <?php echo form_error('pic')?>
          </div>
        </div>
        <div class="box-body">
          <label>Keterangan</label>
          <textarea  name="keterangan" class="form-control <?php echo form_error('keterangan') ? 'is-invalid':'' ?>" placeholder="Masukkan Keterangan" >
            </textarea>
          <div class="invalid-feedback">
              <?php echo form_error('keterangan')?>
          </div>
        </div>
      </div>
    
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

<script type="text/javascript">
    $(document).ready(function(){

      $('#akomodasi').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Tiket_controller/get_akomodasi');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].akomodasi_id+'>'+data[i].nama_maskapai+'</option>';
                        }
                        $('#maskapai').html(html);

                    }
                });
                return false;
            }); 
            
    });
  </script>
</body>
</html>
