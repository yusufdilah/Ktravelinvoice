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
  <?php $folder = $this->config->item('registrasi_view', 'upload_setting') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if ($this->session->flashdata('success')): ?>
      <div class="alert alert-success" role="alert">
        <?php echo $this->session->flashdata('success'); ?>
        <a href="<?php echo base_url('Registrasi_controller/index') ?>">Ok</a>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
      </div>
    <?php endif; ?>

    <section class="content-header">
      <h1>
        Kelola
        <small>Data Registrasi</small>
      </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Registrasi</a></li>
          <li><a href="<?php echo base_url('Registrasi_controller/index') ?>">List Data Registrasi</a></li>
          <li>
              <a href="<?php echo base_url('Registrasi_controller/index') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-backward"></i></a>
          </li>
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
            <!-- <form role="form" action="<?php echo base_url('Registrasi_controller/approve/'.$anggota->registrasi_id) ?>" method="post"> -->
              <input type="hidden" name="registrasi_id" value="<?php echo $anggota->registrasi_id?>" />
              <div class="box-body">
                <div class="form-group">
                  <label>Nama</label>
                  <input name="nama_lengkap" class="form-control <?php echo form_error('nama_lengkap') ? 'is-invalid':'' ?>" value="<?php echo $anggota->nama_lengkap?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nama_lengkap') ?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Nasabah ID</label>
                  <input name="nasabah_id" id="nasabah_id" class="form-control <?php echo form_error('nasabah_id') ? 'is-invalid':'' ?>" value="<?php echo $anggota->nasabah_id?>" type="text" readonly>
                </div>
                <div class="form-group">
                  <label>NIP</label>
                  <input name="nip" class="form-control <?php echo form_error('nip') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->nip?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nip')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Perusahaan</label>
                  <input name="perusahaan" class="form-control <?php echo form_error('perusahaan') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->perusahaan?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('perusahaan')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Unit Kerja</label>
                  <input name="unit_kerja" class="form-control <?php echo form_error('unit_kerja') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->unit_kerja?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('unit_kerja')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Jabatan</label>
                  <input name="jabatan" class="form-control <?php echo form_error('jabatan') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->jabatan?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('jabatan')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>No HP</label>
                  <input name="hp" class="form-control <?php echo form_error('hp') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->hp?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('hp')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>NPWP</label>
                  <input name="npwp" class="form-control <?php echo form_error('npwp') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->npwp?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('npwp')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat</label>
                  <input name="alamat" class="form-control <?php echo form_error('alamat') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->alamat?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('alamat')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kelurahan</label>
                  <input name="nm_kelurahan" class="form-control <?php echo form_error('nm_kelurahan') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->nm_kelurahan?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nm_kelurahan')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kecamatan</label>
                  <input name="nm_kecamatan" class="form-control <?php echo form_error('nm_kecamatan') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->nm_kecamatan?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nm_kecamatan')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kota</label>
                  <input name="nm_kota" class="form-control <?php echo form_error('nm_kota') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->nm_kota?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nm_kota')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Provinsi</label>
                  <input name="nm_provinsi" class="form-control <?php echo form_error('nm_provinsi') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->nm_provinsi?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('nm_provinsi')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Kode Pos</label>
                  <input name="kodepos" class="form-control <?php echo form_error('kodepos') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->kodepos?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('kodepos')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat Domisili</label>
                  <input name="alamat_domisili" class="form-control <?php echo form_error('alamat_domisili') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->alamat_domisili?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('alamat_domisili')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Alamat Kantor</label>
                  <input name="alamat_kantor" class="form-control <?php echo form_error('alamat_kantor') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->alamat_kantor?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('alamat_kantor')?>
                  </div>
                </div>
                <div class="form-group">
                  <label>Perusahaan Sebelum</label>
                  <input name="perusahaan_sebelum" class="form-control <?php echo form_error('perusahaan_sebelum') ? 'is-invalid':'' ?>"  value="<?php echo $anggota->perusahaan_sebelum?>" type="text" readonly/>
                  <div class="invalid-feedback">
                    <?php echo form_error('perusahaan_sebelum')?>
                  </div>
                </div>
                <div class="form-group">
                      <!-- <div class="profile-info-name"> Gambar </div> -->
                        <label>Foto</label>
                        <div style="margin-bottom: 5px;"><img src="<?php echo''.$folder.''.$anggota->foto.'';?>" width="75%"></div>
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
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Registrasi_controller/reject/'.$anggota->registrasi_id) ?>" method="post">   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"></h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Apakah anda yakin untuk mereject data ini ?</div>
      <div class="form-group">
            <div class="box-body">
                  <input type="hidden" name="registrasi_id" value="<?php echo $anggota->registrasi_id?>" />       
                  <div class="form-group">
                          <label>Alasan ditolak</label> <br>
                          
                          <input class="form-control" required="required" type="text" name="alasan_ditolak"  />
                  </div>
                          
            </div>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        

        <button class="btn btn-danger" name="submit" type="submit"><i class="fa fa-fw fa-check" title="Ya"></i></button>
         
      </div>
    </form>  
    </div>
  </div>
</div>
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->
<script>
  function rejectConfirm(url){
    $('#btn-reject').attr('href', url);
    $('#rejectModal').modal();
  }
</script>
</body>
</html>
