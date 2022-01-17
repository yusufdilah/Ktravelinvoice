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
  <?php $this->config->load('upload_setting', TRUE); ?>
  <?php $folder = "https://new-my.kopkarbsm.co.id/file.registrasi.567/"; //$this->config->item('folder', 'upload_setting') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <a href="<?php echo base_url('Lupaemail_controller') ?>">Ok</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
      </div>
    <?php endif; ?>

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
        Kelola
        <small>Data Lupa Email</small>
      </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Lupa Email</a></li>
          <li><a href="<?php echo base_url('Lupaemail_controller/index') ?>">List Data Lupa Email</a></li>
          <li>
              <a href="<?php echo base_url('Lupaemail_controller/index') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-backward"></i></a>
          </li>
        </ol>
    </section>
    

    <!-- Main content -->
    <div class="container-fluid">
    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <section class="content">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Pengisian Form</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <!-- <form onclick="return(approveConfirm());" role="form" action="<?php echo base_url('Lupaemail_controller/simpan/'.$lupa_email->lupa_email_id) ?>" method="post"> --> 
                      <!-- <form  role="form" action="" method="post"> -->
                        <input type="hidden" name="lupa_email_id" value="<?php echo $lupa_email->lupa_email_id?>" />
                        <input type="hidden" name="nasabah_id_anggota" value="<?php echo $lupa_email->nasabah_id_anggota?>" />
                        <div class="box-body">
                          <div class="form-group">
                            <label>Nama</label>
                            <input name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" value="<?php echo $lupa_email->nama?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nama') ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Email</label>
                            <input name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $lupa_email->email?>" type="text" readonly>
                          </div>
                          <div class="form-group">
                            <label>NIP</label>
                            <input name="nip" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->nip?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>KTP</label>
                            <input name="ktp" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->ktp?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>

                          <div class="form-group">
                                <!-- <div class="profile-info-name"> Gambar </div> -->
                                  <label>Foto Selfie Pegang KTP + ID Card</label>
                                  <div style="margin-bottom: 5px;"><img src="<?php echo ''.$folder.''.$lupa_email->foto.''; ?>" width="75%"></div>
                          </div>
                        </div>
                        <!-- /.box-body -->

                        <div class="box-footer">  
                            <a href="#!"  class="btn btn-ref" type="button" onclick="approveConfirm()">Approve</a>
                          <button class="btn btn-danger" name="submit" type="button" onclick="rejectConfirm()"><i style="margin-left: -3px;" class="fa fa-fw fa-times"></i>Reject</button>
                          <a href="<?php echo base_url('Lupaemail_controller/index') ?>" class="btn btn-info"><i class="fa fa-fw fa-arrow-left"></i>Cancel</a>

                        </div>
                      <!-- </form> -->
                    </div>
                    <!-- /.box -->

                  </div>
                  <!--/.col (left) -->
                </div>
                <!-- /.row -->
              </section>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card">
          <div class="card-body">
            <div class="row">
              <section class="content">
                <div class="row">
                  <!-- left column -->
                  <div class="col-md-8">
                    <!-- general form elements -->
                    <div class="box box-primary">
                      <div class="box-header with-border">
                        <h3 class="box-title">Data Perkiraan</h3>
                      </div>
                      <!-- /.box-header -->
                      <!-- form start -->
                      <!-- <form role="form" action="<?php echo base_url('Lupaemail_controller/approve/'.$lupa_email->lupa_email_id) ?>" method="post"> -->
                        <input type="hidden" name="lupa_email_id" value="<?php echo $lupa_email->lupa_email_id?>" />
                        <div class="box-body">
                          <div class="form-group">
                            <label>Nasabah ID</label>
                            <input name="nasabah_id_anggota" class="form-control <?php echo form_error('nasabah_id_anggota') ? 'is-invalid':'' ?>"  value="<?php echo $lupa_email->nasabah_id_anggota?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nasabah_id') ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Nama Lengkap</label>
                            <input name="nama_lengkap" id="nama_lengkap" class="form-control <?php echo form_error('nama_lengkap') ? 'is-invalid':'' ?>"  value="<?php echo $lupa_email->nama_lengkap?>" type="text" readonly>
                          </div>
                          <div class="form-group">
                            <label>KTP</label>
                            <input name="ktp_anggota" class="form-control <?php echo form_error('ktp_anggota') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->ktp_anggota?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Alamat domisili</label>
                            <input name="alamat_domisili" class="form-control <?php echo form_error('alamat_domisili') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->alamat_domisili?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Perusahaan</label>
                            <input name="perusahaan" class="form-control <?php echo form_error('perusahaan') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->perusahaan?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Unit Kerja</label>
                            <input name="unit_kerja" class="form-control <?php echo form_error('unit_kerja') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->unit_kerja?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>Jabatan</label>
                            <input name="jabatan" class="form-control <?php echo form_error('jabatan') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->jabatan?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nijabatanp')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <label>No HP</label>
                            <input name="hp" class="form-control <?php echo form_error('hp') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->hp?>" type="text" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>

                          
                        </div>
                        <!-- /.box-body -->

                        
                      <!-- </form> -->
                    </div>
                    <!-- /.box -->

                  </div>
                  <!--/.col (left) -->
                </div>
                <!-- /.row -->
              </section>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
</script>
<!-- ./wrapper -->
<div class="modal fade" id="approveModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Lupaemail_controller/simpan/'.$lupa_email->lupa_email_id) ?>" method="post">   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apakah anda yakin untuk menyetujui data ini ?</div>
      <div class="form-group">
            <div class="box-body">
                          <input type="hidden" name="lupa_email_id" value="<?php echo $lupa_email->lupa_email_id?>" />
                          <input type="hidden" name="nasabah_id_anggota" value="<?php echo $lupa_email->nasabah_id_anggota?>" />
                          <input type="hidden" name="password" value="<?php echo $lupa_email->password?>" />
                          <div class="form-group">
                            <input name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" value="<?php echo $lupa_email->nama?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nama') ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <input name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $lupa_email->email?>" type="hidden" readonly>
                          </div>
                          <div class="form-group">
                            <input name="nip" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->nip?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <input name="ktp" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->ktp?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                        </div>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div>
    </form>  
    </div>
  </div>
</div>

<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Lupaemail_controller/reject/'.$lupa_email->lupa_email_id) ?>" method="post">   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apakah anda yakin untuk mereject data ini ?</div>
      <div class="form-group">
            <div class="box-body">
                          <input type="hidden" name="lupa_email_id" value="<?php echo $lupa_email->lupa_email_id?>" />
                          <input type="hidden" name="nasabah_id_anggota" value="<?php echo $lupa_email->nasabah_id_anggota?>" />
                          <input type="hidden" name="password" value="<?php echo $lupa_email->password?>" />
                          <div class="form-group">
                            <input name="nama" class="form-control <?php echo form_error('nama') ? 'is-invalid':'' ?>" placeholder="Masukan Nama" value="<?php echo $lupa_email->nama?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nama') ?>
                            </div>
                          </div>
                          <div class="form-group">
                            <input name="email" id="email" class="form-control <?php echo form_error('email') ? 'is-invalid':'' ?>" placeholder="Masukan Isi" value="<?php echo $lupa_email->email?>" type="hidden" readonly>
                          </div>
                          <div class="form-group">
                            <input name="nip" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->nip?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                          <div class="form-group">
                            <input name="ktp" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>" value="<?php echo $lupa_email->ktp?>" type="hidden" readonly/>
                            <div class="invalid-feedback">
                              <?php echo form_error('nip')?>
                            </div>
                          </div>
                        </div>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-success" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div>
    </form>  
    </div>
  </div>
</div>
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
<script>
  function approveConfirm(url){
    $('#btn-approve').attr('href', url);
    $('#approveModal').modal();
  }
</script>

<script>
  function rejectConfirm(url){
    $('#btn-reject').attr('href', url);
    $('#rejectModal').modal();
  }
</script>


<script type="text/javascript">
function validate()
{
     var r=confirm("Do you want to update this?")
    if (r==true)
      return true;
    else
      return false;
}
</script>

</body>
</html>
