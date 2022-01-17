<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<!DOCTYPE html>
<html>
<?php $this->load->view("admin/_includes/head.php") ?>
<body class="hold-transition skin-blue sidebar-mini">
<script src="<?= base_url('assets/ckeditor/ckeditor.js'); ?>"></script> 
<style type="text/css">
  .container {
  border: 2px solid #dedede;
  background-color: #f1f1f1;
  border-radius: 5px;
  padding: 10px;
  margin: 10px 0;
}
.anyClass {
  height:300px;
  overflow-y: scroll;
}
</style>
<div class="wrapper">

  <?php $this->load->view("admin/_includes/header.php") ?>
  <?php $this->load->view("admin/_includes/sidebar.php") ?>
  <?php $this->config->load('upload_setting', TRUE); ?>
  <?php $folder = $this->config->item('folder', 'upload_setting') ?>
  <?php $folder_tiket = $this->config->item('folder_tiket', 'upload_setting') ?>

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
        Manage
        <small>Data Tiket</small>
      </h1>
        <ol class="breadcrumb">
          <!-- <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Registrasi</a></li>
          <li><a href="<?php echo base_url('Registrasi_controller/index') ?>">List Data Registrasi</a></li>
          <li>
              <a href="<?php echo base_url('Registrasi_controller/index') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-backward"></i></a>
          </li> -->
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
              <h3 class="box-title"><?php echo $helpdesk->nama_lengkap.' ('.$helpdesk->nasabah_id.')'?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!-- <form role="form" action="<?php echo base_url('Registrasi_controller/approve/'.$registrasi->tiket_history_id) ?>" method="post"> -->
              <div class="box-body">
                <div class="form-group">
      
                  <input name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>"  value="<?php echo $helpdesk->judul?>" type="text" readonly/>

                </div>
                <div class="form-group">
                   <?php echo preg_replace('/\v+|\\\r\\\n/Ui','<br/>',$helpdesk->isi); ?>
                </div>
                <hr>  
                <div class="form-group">
      
                 <small>Attachment :</small><br>
                    
                  
                  <a target="_blank" href="<?=$folder_tiket.$helpdesk->file_1?>">
                   
                    <?php echo $helpdesk->file_1 ?>
                    
                  </a> <br>
                  <a target="_blank" href="<?=$folder_tiket.$helpdesk->file_2?>">
                   
                    <?php echo $helpdesk->file_2 ?>
                    
                  </a>
                  
                </div>
              </div>
              <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>


      

        <section class="col-lg-12 connectedSortable">
          <!-- general form elements -->
          <div class="box box-success; anyClass"">
          <h3><b>History Jawaban</b></h3>
          <hr />
              <?php if(!empty($history)): ?>
                <?php foreach ($history as $value): ?>


              <div class="box-body chat;  id="chat-box">
                <?php if($value->file_1 !='') {?> 
                        <div style="margin-bottom:5px;">
                         <?php if($value->pic_id =='' || $value->pic_id == 0 ) {?>  
                          <!-- <a target="_blank" href="<?=base_url($folder.$value->file_1)?>"> -->
                          <a target="_blank" href="<?=$folder_tiket.$value->file_1?>">  
                            <?php echo $value->file_1 ?>
                          </a>
                         <?php } 
                         else {?>   
                            <a target="_blank" href="<?=base_url($folder.$value->file_1)?>">
                                <?php echo $value->file_1 ?>
                            </a>
                          <?php }?>
                        </div> 
                       <?php } 
                       else {?>
                            <div style="margin-bottom:5px;">
                              <small>Tidak ada gambar / file</small>
                              <!-- <img src="<?=base_url($folder.'default.jpg')?>" width="75%"> -->
                            </div> 
                <?php }?> 
                <?php if($value->file_2 !='') {?> 
                        <div style="margin-bottom:5px;">
                         <?php if($value->pic_id =='' || $value->pic_id == 0 ) {?>  
                          <!-- <a target="_blank" href="<?=base_url($folder.$value->file_1)?>"> -->
                          <a target="_blank" href="<?=$folder_tiket.$value->file_2?>">  
                            <?php echo $value->file_2 ?>
                          </a>
                         <?php } 
                         else {?>   
                            <a target="_blank" href="<?=base_url($folder.$value->file_2)?>">
                                <?php echo $value->file_2 ?>
                            </a>
                          <?php }?>
                        </div> 
                       <?php } 
                       else {?>
                            <div style="margin-bottom:5px;">
                              <small>Tidak ada gambar / file</small>
                            </div> 
                <?php  }?> 
                
              </div>    
              <div class="box-body chat;  id="chat-box">
              <!-- chat item -->
              <!-- <div class="item"> -->
                
                   
                <p >
                  <a>
                   
                    <?php echo $value->nama_lengkap ?>
                    
                  </a>
                  
                </p>

                <p class="message">
                  
                  <?php echo $value->jawaban ?>

                </p>
                <small class="text-muted pull-left">Catatan : </small><br>
                <small class="pull-left"><?php echo $value->internal_note?></small><br>
                <br>
                <hr style="border: 1px solid">
              
              <!-- </div> -->
              <!-- /.item -->
              
              <!-- /.item -->
            </div>
            <?php endforeach ?>
              <?php endif ?>  
          </div>
          <!-- /.box -->

        </section>  

        <section class="col-lg-12 connectedSortable">
          <!-- general form elements -->
          <div class="box box-success">
            <form role="form" action="<?php echo base_url('Helpdesk_controller/tambah_komentar_spv/'.$helpdesk->tiket_id) ?>" method="post" enctype="multipart/form-data"> 
              <input type="hidden" name="tiket_id" value="<?php echo $helpdesk->tiket_id?>" />  
              <input type="hidden" name="pic_id" value="<?php echo $pic_history->pic_id?>" /> 
              <div class="form-group">
                   <textarea class="form-control <?php echo form_error('jawaban') ? 'is-invalid':'' ?>" name="jawaban" id="jawaban" placeholder="Masukan Isi" required></textarea>
                    
                   
                  
                    <!-- <input name="internal_note" id="internal_note" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>;"  value="" type="text" /> -->
              </div>
               
              <div class="form-group">
                     <small class="text-muted pull-left">Catatan : </small><br>
                     <!-- <input name="internal_note" class="form-control <?php echo form_error('judul') ? 'is-invalid':'' ?>" type="text"/> -->
                     <textarea class="form-control <?php echo form_error('internal_note') ? 'is-invalid':'' ?>" name="internal_note" id="internal_note"  ><?php echo $history_spv->internal_note ?></textarea>
              </div>
              
               <div class="box-footer">
                  <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus"></i>Simpan</button>
                  
                  <a href="javascript:history.go(-1)" class="btn btn-danger"><i class="fa fa-fw fa-times"></i>Batal</a>
                </div>
            </form>
          </div>
        </section>  









          </div>
          <!-- /.box -->

        </section>



        
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
     CKEDITOR.replace('jawaban');
</script>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
</body>
</html>
