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
            Manage
            <small>Helpdesk</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Helpdesk</a></li>
            <li><a href="#">List Data Helpdesk</a></li>
          </ol>
        </section>

        
        <!-- Main content -->
        <section class="content">
          <?php 
           
            $level  = "";
            
            $supervisor = "";
            foreach($spv_tiket->result_array() as $value) {
              $level  = $value['level'];
              $supervisor = $value['supervisor'];
              // $status_user_db = $db_data1['status'];
            }
           
           $jml_tiket = $tiket_jwb_spv;
           $jml_tiket_open = $tiket_open;
           $jml_tiket_answered = $tiket_answered;
           $jml_tiket_closed = $tiket_closed;
           // echo $jml_tiket.'test';
          if ($level == 'supervisor' || $supervisor == 1 ) {?>
          <ul class="nav nav-tabs">
            <li class="active">
             
              
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Helpdesk_controller/list_jwb_spv') ?>"><i style="margin-left: -3px;" ></i>Belum dijawab Staff (<?php echo $jml_tiket; ?>)</a></button>
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Helpdesk_controller/list_answer') ?>"><i style="margin-left: -3px;" ></i>Answered (<?php echo $jml_tiket_answered; ?>)</a></button>
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Helpdesk_controller/list_closed') ?>"><i style="margin-left: -3px;" ></i>Closed (<?php echo $jml_tiket_closed; ?>)</a></button>
            </li>
          </ul>
          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Tiket No</th>
                        <th>Pembuat</th>
                        <th>Ketegori</th>
                        <th>Tipe</th>
                        <th>Prioritas</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Buat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($helpdesk_spv as $value): 
                        $date = $value->created_date; 
                        date_default_timezone_set("Asia/Jakarta");?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->tiket_no ?></td>
                          <td><?php echo $value->pembuat_tiket ?></td>
                          <td><?php echo $value->kategori_tiket ?></td> 
                          <td><?php echo $value->tipe_tiket ?></td>
                          <td><?php echo $value->prioritas_tiket?></td>
                          <td><?php echo $value->judul ?></td>
                          <td><?php echo $value->status_tiket;?></td> 
                          <td><?php echo date("d-M-Y H:i",strtotime($date)) ?></td> 

                          <td>
                            
                            <a class="btn btn-ref" href="<?php echo site_url('Helpdesk_controller/lihat_tiket_spv/'.$value->tiket_id   ) ?>"><i class="fa fa-fw fa-eye"></i>Lihat</a>
                            <br>
                            <?php 
                               if ($value->status_tiket == "Answered" ) {?>
                                   <!--  <a class="btn btn-ref" 
                                    href="<?php echo site_url('Helpdesk_controller/close_tiket/'.$value->tiket_id   ) ?>"><i class="fa fa-fw fa-fw"></i>Close</a> -->
                                     <a href="#!" onclick="deleteConfirm('<?php echo site_url('Helpdesk_controller/close_tiket/'.$value->tiket_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-fw" title="Close Tiket">Close</i></a>

                              <?php } ?> 

                              <!-- // echo $value->status  -->

                              
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
          <?php } 


              
          else {?>

          <ul class="nav nav-tabs">
            <li class="active">
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="#"><i style="margin-left: -3px;" ></i>Tiket Open (<?php echo $jml_tiket_open; ?>)</a></button>
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="#"><i style="margin-left: -3px;" ></i>Dijawab Spv / Answered (<?php echo $jml_tiket_answered; ?>)</a></button>
              <button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Helpdesk_controller/list_closed') ?>"><i style="margin-left: -3px;" ></i>Closed (<?php echo $jml_tiket_closed; ?>)</a></button>
            </li>
          </ul>  

          <div class="row">
            <div class="col-xs-12">
              <div class="box">
                <div class="box-header">
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th>No</th>
                        <th>Tiket No</th>
                        <th>Pembuat</th>
                        <th>Ketegori</th>
                        <th>Tipe</th>
                        <th>Prioritas</th>
                        <th>Judul</th>
                        <th>Status</th>
                        <th>Tanggal Buat</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($helpdesk as $value): 
                        $date = $value->created_date; 
                        date_default_timezone_set("Asia/Jakarta");
                        ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->tiket_no ?></td>
                          <td><?php echo $value->pembuat_tiket ?></td>
                          <td><?php echo $value->kategori_tiket ?></td> 
                          <td><?php echo $value->tipe_tiket ?></td>
                          <td><?php echo $value->prioritas_tiket?></td>
                          <td><?php echo $value->judul ?></td>
                          <!-- <td><?php echo $value->tiket_status ?></td> -->
                          <td>
                                  <?php echo $value->tiket_status;
                              // echo $value->status 
                              ?></td> 
                          <td><?php echo date("d-M-Y H:i",strtotime($date)) ?></td>    
                          <td>
                            <a class="btn btn-ref" href="<?php echo site_url('Helpdesk_controller/lihat_tiket/'.$value->tiket_id   ) ?>"><i class="fa fa-fw fa-eye"></i>Lihat</a>
                            <br>
                              <!-- // echo $value->status  -->
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
        <?php } ?>
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
 <div class="modal fade" id="close_tiketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apa anda yakin akan mengclose tiket ini ?</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-close_tiket" class="btn btn-danger" href="#">Ya</a>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
<script>
  function deleteConfirm(url){
    $('#btn-close_tiket').attr('href', url);
    $('#close_tiketModal').modal();
  }
</script>
</body>
</html>
