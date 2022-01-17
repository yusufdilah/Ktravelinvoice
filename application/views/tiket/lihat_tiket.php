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
      <?php if ($this->session->flashdata('message')): ?>
        <div class="alert alert-danger" role="alert">
          <?php echo $this->session->flashdata('message'); ?>
          <!-- <a href="<?php echo base_url('registrasi/approve_registrasi') ?>"></a> -->
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
        </div>
      <?php endif; ?>

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
            <small>Tiket</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Tiket</a></li>
            <li><a href="#">Lihat Data Tiket</a></li>
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
                  <!-- <?php $jml_foll_up = $jml_foll_up;?> -->
          		<button class="btn btn-ref"  name="submit" type="submit"><a style="color: black"  href="<?php echo base_url('Tiket_controller/list_tiket_closed') ?>"><i style="margin-left: -3px;" ></i>Tiket Close (<?php echo $jml_close_tiket; ?>)</a></button>
                  
                </div>
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-bordered table-hover">
                    <thead>
                      <tr style="color: darkslategrey;">
                        <th><input type="checkbox" name="cheack-all" id="check-all"></th>
                        <th>No</th>
                        <th>Tanggal Issued</th>
                        <th>Tangal Berangkat</th>
                        <th>Nama</th>
                        <th>Divisi</th>
                        <th>No Memo</th>
                        <th>Akomodasi</th>
                        <th>Maskapai</th>
                        <th>Route</th>
                        <th>Vendor</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1;?>
                      <?php foreach ($tiket as $value): ?>
                        <tr>
                          <!-- <td><input type="checkbox" name="tiket_id[]" id="tiket_id" value="<?php echo $value->tiket_id ?><"></td> -->
                          <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value->tiket_id; ?>"></td>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $value->tgl_issued ?></td>
                          <td><?php echo $value->tgl_berangkat ?></td>
                          <td><?php echo $value->nama_customer ?></td>
                          <td><?php echo $value->nama_divisi ?></td>
                          <td><?php echo $value->no_memo ?></td>
                          <td><?php echo $value->nm_akomodasi ?></td>
                          <td><?php echo $value->nama_maskapai ?></td>
                          <td><?php echo $value->keterangan ?></td>
                          <td><?php echo $value->nm_vendor ?></td>
                          
                          <td>
                            <!-- <a href="#!" onclick="editConfirm()" class="btn btn-ref"><i class="fa fa-fw fa-edit" title="Edit"></i></a> -->
                            <!-- <a data-toggle="modal" data-target="#modal-edit<?=$value->tiket_id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil"></i></a>
                            
                            <a href="#!" onclick="deleteConfirm('<?php echo site_url('Tiket_controller/delete/'.$value->tiket_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>

                            <a href="#!" onclick="closeConfirm('<?php echo site_url('Tiket_controller/close_tiket/'.$value->tiket_id) ?>')" class="btn btn-tosca"><i class="fa fa-fw fa-check" title="CloseTiket"></i></a> -->
                            <?php
                            if ($value->is_close == 1 ) {?>
                                   <!--  <a class="btn btn-ref" 
                                    href="<?php echo site_url('Helpdesk_controller/close_tiket/'.$value->tiket_id   ) ?>"><i class="fa fa-fw fa-fw"></i>Close</a> -->
                                     <a ><i class="fa fa-fw fa-fw" title="Close Tiket">Closed</i></a>

                              <?php } else{?> 
                              		<a data-toggle="modal" data-target="#modal-edit<?=$value->tiket_id;?>" class="btn btn-warning btn-circle" data-popup="tooltip" data-placement="top" title="Edit Data"><i class="fa fa-pencil"></i></a>
                            		<a href="#!" onclick="deleteConfirm('<?php echo site_url('Tiket_controller/delete/'.$value->tiket_id) ?>')" class="btn btn-mandarin"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
                            		<a href="#!" onclick="closeConfirm('<?php echo site_url('Tiket_controller/close_tiket/'.$value->tiket_id) ?>')" class="btn btn-tosca"><i class="fa fa-fw fa-check" title="CloseTiket"></i></a>
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
                  <!-- <input id="submit_close" name="submit_close" type="submit" class="btn btn-tosca" value="Close All" />   -->
                  <button style="margin-bottom: 10px" class="btn btn-tosca submit_close" data-url="Tiket_controller/close_tiket_all">Submit close</button>
                  <!-- <button style="margin-bottom: 10px" class="btn btn-danger submit_delete" data-url="Tiket_controller/close_tiket_all">Submit Delete</button> -->
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

 <!-- ADD MODAL -->
    <div class="modal fade bd-example-modal-lg" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Tambah Data</h3>
                </div>
                <!-- <div class="modal-body">Apakah anda yakin untuk menyetujui data ini ?</div> -->
                <form action="<?= base_url('Tiket_controller/add') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                            	<div class="form-group">
                                    <label for="tgl_issued">Tanggal Issued</label>
                                    <label style="color: #FF0000 ">*</label>
            						<input required="" type="date"  name="tgl_issued" id="tgl_issued" class="form-control" >
                                </div>
                                <div class="form-group">
	                                <label>Kode Booking</label>
                                  <label style="color: #FF0000 ">*</label>
          	          						<input required=""  name="kode_booking" class="form-control" placeholder="Masukkan Kode Booking" type="text"/>	
                							  </div>
                                <div class="form-group">
                                	<label>Customer</label>
                                  <label style="color: #FF0000 ">*</label>
                                	<select  class="form-control" id="customer" name="customer" required>
  						                     <option selected disabled value="">select..</option>
  						                     <?php foreach($dataCustomer as $customer) : ?>
  						                      <option value="<?php echo $customer->customer_id;?>"> <?php echo $customer->nama_customer; ?></option>
  						                     <?php endforeach; ?>
						                    </select>
                                </div>
                                <div class="form-group">
                                	<label>Akomodasi</label>
                                  <label style="color: #FF0000 ">*</label>
          						            <select  class="form-control <?php echo form_error('akomodasi') ? 'is-invalid':'' ?>" id="akomodasi" name="akomodasi" required>
          						                     <option selected disabled  value="">select..</option>
          						                     <?php foreach($dataAkomodasi as $akomodasi) : ?>
          						                      <option value="<?php echo $akomodasi->akomodasi_id;?>"> <?php echo $akomodasi->akomodasi; ?></option>
          						                     <?php endforeach; ?>
          						            </select>
          						            <div class="invalid-feedback">
          						              <?php echo form_error('akomodasi')?>
          						            </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Hotel</label>
          							            <input  name="hotel" class="form-control" placeholder="Masukkan Nama Hotel" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label>Route</label>
            						            <select  class="form-control" id="route" name="route" required>
            						                     <option selected value="">select..</option>
            						                     <?php foreach($dataRoute as $route) : ?>
            						                      <option value="<?php echo $route->route_id;?>"> 
            						                        <?php echo $route->kd_route.' - '.$route->keterangan; ?></option>
            						                     <?php endforeach; ?>
            						            </select>
                                </div>
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <label style="color: #FF0000 ">*</label>
            						            <select   class="form-control" id="vendor" name="vendor" required>
            						                     <option selected value="">select..</option>
            						                     <?php foreach($dataVendor as $vendor) : ?>
            						                      <option data-mark_up="<?php echo $vendor->mark_up;?>" value="<?php echo $vendor->vendor_id;?>"> <?php echo $vendor->nm_vendor; ?></option>
            						                     <?php endforeach; ?>
            						            </select>
            						            <input readonly="" size="50%" id="mark_up_persen" type="number" placeholder="Nilai Mark Up" name="mark_up_persen">(%) 
            						            <br>
            						            <input onchange="hpp_hitung()" size="70%" id="mark_up_koma" type="hidden" placeholder="Mark Up sesuai vendor yang dipilih" name="mark_up_koma">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="hidden" name="" id="" class="form-control" required><br>
                                    <input type="hidden" name="" id="" class="form-control" required><br>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('') ?>
                                    </div>
                                </div>
                                <div class= "form-group">
                                     <label>Service Fee</label>
                                     <label style="color: #FF0000 ">*</label>
          							             <input required="" onkeypress="return isNumber(event)" id="service_fee"  name="service_fee" class="form-control <?php echo form_error('service_fee') ? 'is-invalid':'' ?>" placeholder="Masukkan Service Fee" type="text"/>
          							             <div class="invalid-feedback">
              							           <?php echo form_error('service_fee')?>
          							             </div>
                                </div>

                                <div class="form-group">
                                    <label>Harga Jual</label>
          								<input id="harga_jual"  name="harga_jual" class="form-control <?php echo form_error('harga_jual') ? 'is-invalid':'' ?>"  type="text"/>
          								<div class="invalid-feedback">
              								<?php echo form_error('harga_jual')?>
          								</div>
                                </div>

                                <div class="form-group">
                                    <label>Bookers</label>
          							<input  name="bookers" class="form-control <?php echo form_error('bookers') ? 'is-invalid':'' ?>" placeholder="Masukkan Nama Bookers" type="text"/>
          							<div class="invalid-feedback">
              							<?php echo form_error('bookers')?>
          							</div>
                                </div>
                                <div class="form-group">
                                    <label>Upload Tiket</label>
          							<input type="file" name="tiket_file" class="form-control">
                                </div>
                                <!-- <div class="box-footer"> -->
						          <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-plus" title="Simpan"></i>Tambah</button>
						          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
						      <!-- </div> -->
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tgl_berangkat">Tanggal Berangkat</label>
                                    <label style="color: #FF0000 ">*</label>
            						            <input required="" type="date"  name="tgl_berangkat" id="tgl_berangkat" class="form-control <?php echo form_error('hotel') ? 'is-invalid':'' ?>"  >
            						            <div class="invalid-feedback">
            						              <?php echo form_error('tgl_berangkat')?>
            						            </div>
                                </div>
                                <div class="form-group">
                                    <label>No Memo</label>
          							<input  name="no_memo" class="form-control" placeholder="Masukkan No Memo" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label for="divisi">Divisi</label>
                                    <select name="divisi" id="divisi" class="form-control" required>
                                        <option selected disabled value="">select..</option>
                                        <?php foreach ($dataDivisi as $d) : ?>
                                            <option value="<?= $d->divisi_id ?>" data-perusahaan_id="<?= $d->perusahaan_id; ?>"><?= $d->nama_divisi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('divisi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                	<label>Maskapai</label>
            						            <select  class="form-control" id="maskapai" name="maskapai" required>
            						                     <option selected   value="">select..</option>
            						                     
            						            </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Hotel</label>
          							<input  name="alamat_hotel" class="form-control" placeholder="Masukkan Alamat Hotel" type="text"/>
                                </div>
                                <div class="form-group">
                                    <!-- <div class="box-body"> -->
							          <label></label><br>
							          <label></label><br>
							          <label></label><br>
							          <input id="hpp_mark_up"  name="hpp_mark_up" class="form-control" placeholder="HPP + Mark Up" type="hidden"/>
							          
							        <!-- </div> -->
                                </div>
                                <div class="form-group">
                                    <!-- <label>HPP</label><br> -->
                                    <label>HPP</label>
                                    <!-- <label></label> -->
                                    <label style="color: #FF0000 ">*</label><br>
            						            <input required="" onchange="hpp_hitung()"  placeholder="Masukkan HPP" size="60%" id="hpp_persen_mark_up" placeholder="Mark Up sesuai vendor yang dipilih" name="hpp_persen_mark_up">
                                </div>
                                <div class="form-group">
                                    <label>HPP Total</label>
              							        <input id="hpp"  name="hpp" class="form-control <?php echo form_error('hpp') ? 'is-invalid':'' ?>" placeholder="HPP + Mark Up" />
              							        <div class="invalid-feedback">
              							              <?php echo form_error('hpp')?>
              							        </div>
                                </div>
                                <div class="form-group">
                                    <label>Biaya Lain - lain</label>
                                    <label style="color: #FF0000 ">*</label>
                      							<input id="biaya_lain"  name="biaya_lain" class="form-control <?php echo form_error('biaya_lain') ? 'is-invalid':'' ?>"  />
                      							<div class="invalid-feedback">
                          								<?php echo form_error('biaya_lain')?>
                      							</div>
                                </div>
                                <div class="form-group">
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
							        <input id=""  name="" class="form-control <?php echo form_error('') ? 'is-invalid':'' ?>" placeholder="" type="hidden"/>
							        <div class="invalid-feedback">
							              <?php echo form_error('')?>
							        </div>
                                </div>
                                <div class="form-group">
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
							        <input id=""  name="" class="form-control <?php echo form_error('') ? 'is-invalid':'' ?>" placeholder="" type="hidden"/>
							        <div class="invalid-feedback">
							              <?php echo form_error('')?>
							        </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Upload SPJ</label>
          							<input type="file" name="spj_file" class="form-control">
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>


<?php $no=0; foreach($tiket as $value): $no++; ?>
<!-- <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"> -->
<!-- <div class="row">   -->
<div id="modal-edit<?=$value->tiket_id;?>" class="modal fade" aria-hidden="true" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      
      
      <div class="modal-header bg-primary">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h3 class="modal-title">Edit Data</h3>
      </div>
      <!-- <div class="modal-body"> -->
      <form  role="form" action="<?php echo base_url('Tiket_controller/upadate') ?>" method="post" enctype="multipart/form-data">   
      <div class="modal-body">
           <div class="row">
                            <div class="col-lg-6 col-sm-12">
                              <div class="form-group">
                                    <label for="tgl_issued">Tanggal Issued</label>
                                    <label style="color: #FF0000 ">*</label>
                        <input value="<?php echo $value->tgl_issued; ?>" required="" type="date"  name="tgl_issued" id="tgl_issued" class="form-control" >
                                </div>
                                <div class="form-group">
                                  <label>Kode Booking</label>
                                  <label style="color: #FF0000 ">*</label>
                                  <input value="<?php echo $value->kode_booking; ?>" required=""  name="kode_booking" class="form-control" placeholder="Masukkan Kode Booking" type="text"/>  
                                </div>
                                <div class="form-group">
                                  <label>Customer</label>
                                  <label style="color: #FF0000 ">*</label>
                                  <select  class="form-control" id="customer_edit" name="customer" required>
                                   <option selected value="">select..</option>
                                   <?php foreach($dataCustomer as $customer) : ?>
                                    <option value="<?php echo $customer->divisi_id; ?>" <?php if($customer->customer_id == $value->customer){echo "selected='selected'";} ?>>
                                      <?php echo $customer->nama_customer; ?>
                                    </option>
                                   <?php endforeach; ?>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label>Akomodasi</label>
                                  <label style="color: #FF0000 ">*</label>
                                  <select  class="form-control <?php echo form_error('akomodasi') ? 'is-invalid':'' ?>" id="akomodasi_edit" name="akomodasi" required>
                                           <option selected value="">select..</option>
                                           <?php foreach($dataAkomodasi as $akomodasi) : ?>
                                            <option value="<?php echo $akomodasi->akomodasi_id; ?>" <?php if($akomodasi->akomodasi_id == $value->akomodasi){echo "selected='selected'";} ?>>
                                              <?php echo $akomodasi->akomodasi; ?>
                                            </option>
                                           <?php endforeach; ?>
                                  </select>
                                  <div class="invalid-feedback">
                                    <?php echo form_error('akomodasi')?>
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Hotel</label>
                                    <input value="<?php echo $value->hotel; ?>"  name="hotel" class="form-control" placeholder="Masukkan Nama Hotel" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label>Route</label>
                                    <select  class="form-control" id="route" name="route" required>
                                             <option selected value="">select..</option>
                                             <!-- <?php foreach($dataRoute as $route) : ?>
                                              <option value="<?php echo $route->route_id;?>"> 
                                                <?php echo $route->kd_route.' - '.$route->keterangan; ?></option>
                                             <?php endforeach; ?> -->

                                            <?php foreach($dataRoute as $route) : ?>
                                            <option value="<?php echo $route->route_id; ?>" <?php if($route->route_id == $value->route){echo "selected='selected'";} ?>>
                                              <?php echo $route->kd_route.' - '.$route->keterangan; ?>
                                            </option>
                                           <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Vendor</label>
                                    <label style="color: #FF0000 ">*</label>
                                    <select   class="form-control" id="vendor_edit" name="vendor" required>
                                             <option selected value="">select..</option>
                                             <!-- <?php foreach($dataVendor as $vendor) : ?>
                                              <option data-mark_up="<?php echo $vendor->mark_up;?>" value="<?php echo $vendor->vendor_id;?>"> <?php echo $vendor->nm_vendor; ?></option>
                                             <?php endforeach; ?> -->

                                            <?php foreach($dataVendor as $vendor) : ?>
                                            <option data-mark_up_edit="<?php echo $vendor->mark_up;?>" value="<?php echo $vendor->vendor_id; ?>" <?php if($vendor->vendor_id == $value->vendor){echo "selected='selected'";} ?>>
                                              <?php echo $vendor->nm_vendor; ?>
                                            </option>
                                           <?php endforeach; ?>
                                    </select>
                                    <input readonly="" size="50%" id="mark_up_persen_edit" type="number" placeholder="Nilai Mark Up" name="mark_up_persen_edit">(%) 
                                    <br>
                                    <input onchange="hpp_hitung_edit()" size="70%" id="mark_up_koma_edit" type="hidden" placeholder="Mark Up sesuai vendor yang dipilih" name="mark_up_koma_edit">
                                </div>
                                <div class="form-group">
                                    <label></label>
                                    <input type="hidden" name="" id="" class="form-control" required><br>
                                    <input type="hidden" name="" id="" class="form-control" required><br>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('') ?>
                                    </div>
                                </div>
                                <div class= "form-group">
                                     <label>Service Fee</label>
                                     <label style="color: #FF0000 ">*</label>
                                     <input value="<?php echo $value->service_fee; ?>" required="" onkeypress="return isNumber(event)" id="service_fee_edit"  name="service_fee" class="form-control <?php echo form_error('service_fee') ? 'is-invalid':'' ?>" placeholder="Masukkan Service Fee" type="text"/>
                                     <div class="invalid-feedback">
                                       <?php echo form_error('service_fee')?>
                                     </div>
                                </div>

                                <div class="form-group">
                                    <label>Harga Jual</label>
                                    <input value="<?php echo $value->harga_jual; ?>" id="harga_jual_edit"  name="harga_jual" class="form-control <?php echo form_error('harga_jual') ? 'is-invalid':'' ?>"  type="text"/>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('harga_jual')?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Bookers</label>
                                    <input value="<?php echo $value->bookers; ?>"  name="bookers" class="form-control <?php echo form_error('bookers') ? 'is-invalid':'' ?>" placeholder="Masukkan Nama Bookers" type="text"/>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('bookers')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Upload Tiket</label>
                                    <input type="file" name="tiket_file" class="form-control">
                                    <?php if($value->tiket_file !='') {?> 
                                    <div style="margin-bottom:5px;">
                                      <img style="width: 80%" src="<?=base_url($folder.$value->tiket_file)?>">
                                      <input class="form-control" src="<?=base_url($folder.$value->tiket_file)?>" name="old_img" value="<?php echo $value->tiket_file?>" type="hidden"  >
                                      <input class="form-control" src="<?=base_url($folder.$value->tiket_file)?>" name="img" value="<?php echo $value->tiket_file?>" type="file" > 
                                    </div>  
                                   <?php } 
                                   else {?>
                                        <div style="margin-bottom:5px;">
                                          (No File)
                                              <span class="help-block"></span>
                                              <input type="file" name="tiket_file" class="form-control-file">
                                        </div> 
                                  <?php   
                                   }?> 
                                </div>
                                <!-- <div class="box-footer"> -->
                                <button class="btn btn-success" type="submit"><i class="fa fa-fw fa-check" title="Simpan"></i>Update</button>
                                <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
                  <!-- </div> -->
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="tgl_berangkat">Tanggal Berangkat</label>
                                    <label style="color: #FF0000 ">*</label>
                                    <input value="<?php echo $value->tgl_berangkat; ?>" required="" type="date"  name="tgl_berangkat" id="tgl_berangkat" class="form-control <?php echo form_error('hotel') ? 'is-invalid':'' ?>"  >
                                    <div class="invalid-feedback">
                                      <?php echo form_error('tgl_berangkat')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>No Memo</label>
                                    <input value="<?php echo $value->no_memo; ?>"  name="no_memo" class="form-control" placeholder="Masukkan No Memo" type="text"/>
                                </div>
                                <div class="form-group">
                                    <label for="divisi">Divisi</label>
                                    <select name="divisi" id="divisi_edit" class="form-control" required>
                                        <option selected disabled value="">select..</option>
                                        <!-- <?php foreach ($dataDivisi as $d) : ?>
                                            <option value="<?= $d->divisi_id ?>" data-perusahaan_id="<?= $d->perusahaan_id; ?>"><?= $d->nama_divisi ?></option>
                                        <?php endforeach; ?> -->

                                        <?php foreach($dataDivisi as $d) : ?>
                                          <option  value="<?php echo $d->divisi_id; ?>" <?php if($d->divisi_id == $value->divisi){echo "selected='selected'";} ?>>
                                            <?php echo $d->nama_divisi; ?>
                                          </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('divisi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                  <label>Maskapai</label>
                        <select  class="form-control" id="maskapai_edit" name="maskapai" required>
                                 <option selected disabled  value="">select..</option>
                                 <?php foreach($dataMaskapai as $m) : ?>
                                          <option  value="<?php echo $m->maskapai_id; ?>" <?php if($m->maskapai_id == $value->maskapai){echo "selected='selected'";} ?>>
                                            <?php echo $m->nama_maskapai; ?>
                                          </option>
                                <?php endforeach; ?>
                                 
                        </select>
                                </div>
                                <div class="form-group">
                                    <label>Alamat Hotel</label>
                        <input  name="alamat_hotel" class="form-control" placeholder="Masukkan Alamat Hotel" type="text"/>
                                </div>
                                <div class="form-group">
                                    <!-- <div class="box-body"> -->
                        <label></label><br>
                        <label></label><br>
                        <label></label><br>
                        <input id="hpp_mark_up_edit"  name="hpp_mark_up_edit" class="form-control" placeholder="HPP + Mark Up" type="hidden"/>
                        
                      <!-- </div> -->
                                </div>
                                <div class="form-group">
                                    <!-- <label>HPP</label><br> -->
                                    <label>HPP</label>
                                    <!-- <label></label> -->
                                    <!-- <label style="color: #FF0000 ">*</label><br> -->
                                    <input onchange="hpp_hitung_edit()"  placeholder="Masukkan HPP" size="60%" id="hpp_persen_mark_up_edit" placeholder="Mark Up sesuai vendor yang dipilih" name="hpp_persen_mark_up_edit">
                                </div>
                                <div class="form-group">
                                    <label>HPP Total</label>
                                    <input value="<?php echo $value->hpp; ?>" id="hpp_edit"  name="hpp" class="form-control <?php echo form_error('hpp') ? 'is-invalid':'' ?>" placeholder="HPP + Mark Up" />
                                    <div class="invalid-feedback">
                                          <?php echo form_error('hpp')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Biaya Lain - lain</label>
                                    <label style="color: #FF0000 ">*</label>
                                    <input value="<?php echo $value->biaya_lain; ?>"  id="biaya_lain_edit"  name="biaya_lain" class="form-control <?php echo form_error('biaya_lain') ? 'is-invalid':'' ?>"  />
                                    <div class="invalid-feedback">
                                          <?php echo form_error('biaya_lain')?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                      <input id=""  name="" class="form-control <?php echo form_error('') ? 'is-invalid':'' ?>" placeholder="" type="hidden"/>
                      <div class="invalid-feedback">
                            <?php echo form_error('')?>
                      </div>
                                </div>
                                <div class="form-group">
                                    <label></label><br>
                                    <label></label><br>
                                    <label></label><br>
                      <input id=""  name="" class="form-control <?php echo form_error('') ? 'is-invalid':'' ?>" placeholder="" type="hidden"/>
                      <div class="invalid-feedback">
                            <?php echo form_error('')?>
                      </div>
                                </div>
                                
                                <div class="form-group">
                                    <label>Upload SPJ</label>
                                    <input type="file" name="spj_file" class="form-control">
                                </div>
                                
                            </div>
                        </div>             
      </div>
    
      <!-- <div class="box-footer">
          <button class="btn btn-success" type="submit"><i class="fa fa-pencil" >Simpan</i></button>
          <button class="btn btn-danger" type="button" data-dismiss="modal"><i style="margin-left: -3px;" class="fa fa-fw fa-times" ></i>Batal</button>
      </div> -->
    </form>  
    </div>
  </div>
</div>
<!-- </div> -->
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

 <div class="modal fade" id="closeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Tiket akan di Close (tidak bisa di edit).</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-close_tiket" class="btn btn-primary" href="#">Close Tiket</a>
      </div>
    </div>
  </div>
</div>
<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
<!-- page script -->

 <!-- check all -->
    <!-- <script>
        $("#check-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script> -->

    <!-- ambil data id tiket -->
    <!-- <script>
        $('#submit_close').on('click', function() {
            let values = $("input[name='tiket_id[]']").map(function() {
                return $(this).val();
            }).get();
        });
    </script> -->

<script type="text/javascript">

    $(document).ready(function () {

 

        $('#check-all').on('click', function(e) {

         if($(this).is(':checked',true))  

         {

            $(".sub_chk").prop('checked', true);  

         } else {  

            $(".sub_chk").prop('checked',false);  

         }  

        });

 

        $('.submit_close').on('click', function(e) {

            var allVals = [];  

            $(".sub_chk:checked").each(function() {  

                allVals.push($(this).attr('data-id'));

            });  
 
            if(allVals.length <=0)  

            {  

                alert("Please select row.");  

            }  else {  

                var check = confirm("Apakah kamu yakin ingin mengclose tiket ini ?");  

                if(check == true){  

                    var join_selected_values = allVals.join(","); 

                    $.ajax({

                        url: $(this).data('url'),

                        type: 'POST',

                        data: 'ids='+join_selected_values,

                        success: function (data) {

                          console.log(data);

                          $(".sub_chk:checked").each(function() {  

                              $(this).parents("tr").remove();

                          });

                          alert("Tiket berhasil di Close.");
                          window.location.reload();

                        },

                        error: function (data) {

                            alert(data.responseText);

                        }

                    });

                  $.each(allVals, function( index, value ) {

                      $('table tr').filter("[data-row-id='" + value + "']").remove();

                  });

                }  

            }  

        });

    });

</script>    

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

<script>
  function closeConfirm(url){
    $('#btn-close_tiket').attr('href', url);
    $('#closeModal').modal();
  }
</script>

<script>
        $('#customer').select2();
        $('#divisi').select2();
        $('#perusahaan').select2();
        $('#pic').select2();
        $('#akomodasi').select2();
        $('#maskapai').select2();
        $('#route').select2();
        $('#vendor').select2();

        $('#customer_edit').select2();
        $('#divisi_edit').select2();
        $('#perusahaan_edit').select2();
        $('#pic_edit').select2();
        $('#akomodasi_edit').select2();
        $('#maskapai_edit').select2();
        $('#route_edit').select2();
        $('#vendor_edit').select2();
</script>


<!-- <script>
$(document).ready(function() {
  $("#divisi").select2({
    dropdownParent: $("#addModal")
  });
});

</script> -->

<script type="text/javascript">
  // Restricts input for the given textbox to the given inputFilter.
function setInputFilter(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

// Install input filters.
setInputFilter(document.getElementById("hpp_persen_mark_up"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("hpp"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("service_fee"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("biaya_lain"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter(document.getElementById("harga_jual"), function(value) {
  return /^-?\d*$/.test(value); });

</script>

<script type="text/javascript">
  // Restricts input for the given textbox to the given inputFilter.
function setInputFilter_edit(textbox, inputFilter) {
  ["input", "keydown", "keyup", "mousedown", "mouseup", "select", "contextmenu", "drop"].forEach(function(event) {
    textbox.addEventListener(event, function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  });
}

// Install input filters.
setInputFilter_edit(document.getElementById("hpp_persen_mark_up_edit"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter_edit(document.getElementById("hpp_edit"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter_edit(document.getElementById("service_fee_edit"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter_edit(document.getElementById("biaya_lain_edit"), function(value) {
  return /^-?\d*$/.test(value); });
setInputFilter_edit(document.getElementById("harga_jual_edit"), function(value) {
  return /^-?\d*$/.test(value); });

</script>

<script type="text/javascript">
    function hpp_hitung() {
    
    var hpp_persen_mark_up = document.getElementById('hpp_persen_mark_up').value ;
    var mark_up_koma = document.getElementById('mark_up_koma').value;
    var hpp_mark_up = hpp_persen_mark_up * mark_up_koma;
    var hpp_total = parseInt(hpp_persen_mark_up)  + parseInt(hpp_mark_up) ;
    document.getElementById('hpp_mark_up').value = hpp_mark_up;
    document.getElementById('hpp').value = hpp_total;
    }
</script>

<script type="text/javascript">
    function hpp_hitung_edit() {
    
    var hpp_persen_mark_up_edit = document.getElementById('hpp_persen_mark_up_edit').value ;
    var mark_up_koma_edit = document.getElementById('mark_up_koma_edit').value;
    var hpp_mark_up_edit = hpp_persen_mark_up_edit * mark_up_koma_edit;
    var hpp_total_edit = parseInt(hpp_persen_mark_up_edit)  + parseInt(hpp_mark_up_edit) ;
    document.getElementById('hpp_mark_up_edit').value = hpp_mark_up_edit;
    document.getElementById('hpp_edit').value = hpp_total_edit;
    }
</script>
<script type="text/javascript">
    $('#vendor').on('change', function(){
      // ambil data dari elemen option yang dipilih
      const mark_up = $('#vendor option:selected').data('mark_up');
      // const discount = $('#vendor option:selected').data('discount');
      
      // kalkulasi total harga
      
      const mark_up_persen = mark_up * 100;
      
      // tampilkan data ke element
      $('[name=mark_up_persen]').val(mark_up_persen);
      // $('[name=discount]').val(totalDiscount);
      
      $('#mark_up_persen').text(`Rp ${mark_up_persen}`);
  });
</script>
<script type="text/javascript">
    $('#vendor_edit').on('change', function(){
      // ambil data dari elemen option yang dipilih
      const mark_up_edit = $('#vendor_edit option:selected').data('mark_up_edit');
      // const discount = $('#vendor option:selected').data('discount');
      
      // kalkulasi total harga
      
      const mark_up_persen_edit = mark_up_edit * 100;
      
      // tampilkan data ke element
      $('[name=mark_up_persen_edit]').val(mark_up_persen_edit);
      // $('[name=discount]').val(totalDiscount);
      
      $('#mark_up_persen_edit').text(`Rp ${mark_up_persen_edit}`);
  });
</script>
<script type="text/javascript">
    $('#vendor_edit').on('change', function(){
      // ambil data dari elemen option yang dipilih
      const mark_up_edit = $('#vendor option:selected').data('mark_up_edit');
      // const discount = $('#vendor option:selected').data('discount');
      
      // kalkulasi total harga
      
      const mark_up_koma_edit = mark_up_edit ;
      
      // tampilkan data ke element
      $('[name=mark_up_koma_edit]').val(mark_up_koma_edit);
      // $('[name=discount]').val(totalDiscount);
      
      $('#mark_up_koma_edit').text(`Rp ${mark_up_koma_edit}`);
  });
</script>
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#mark_up, #service_fee").keyup(function() {
            // var mark_up = $("#mark_up").val();
            var mark_up = $("#mark_up").val();
            var persen = 100;
            // var hpp = $("#hpp").val();
            var hpp =  parseInt(mark_up) + 100;
            parseInt($("#hpp").val(hpp))
            ;
        });
    });
</script> -->
<!-- <script type="text/javascript">
    $(document).ready(function() {
        $("#barang, #service_fee").keyup(function() {
            // var mark_up = $("#mark_up").val();
            var barang = $("#barang").val();
            var service_fee = $('#service_fee').val();
            // var hpp = $("#hpp").val();
            var hpp =  (parseInt(barang)  * 2) + parseInt(service_fee) ;
            parseInt($("#hpp").val(hpp))
            ;
        });
    });
</script> -->
<script type="text/javascript">
    $(document).ready(function() {
        $("#mark_up_koma,#hpp_persen_mark_up").keyup(function() {
            var mark_up_koma = $("mark_up_koma").val();
            var hpp_persen_mark_up  = $("#hpp_persen_mark_up").val();
            var hpp = parseInt(hpp_persen_mark_up) * parseInt(mark_up_koma);
            parseInt($("#hpp").val(hpp))
            ;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#mark_up_koma_edit,#hpp_persen_mark_up_edit").keyup(function() {
            var mark_up_koma_edit = $("mark_up_koma_edit").val();
            var hpp_persen_mark_up_edit  = $("#hpp_persen_mark_up_edit").val();
            var hpp_edit = parseInt(hpp_persen_mark_up_edit) * parseInt(mark_up_koma_edit);
            parseInt($("#hpp_edit").val(hpp_edit))
            ;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#hpp, #service_fee, #biaya_lain").keyup(function() {
            var hpp  = $("#hpp").val();
            var service_fee = $("#service_fee").val();
            var biaya_lain = $("#biaya_lain").val();

            var harga_jual = parseInt(hpp) + parseInt(service_fee) + parseInt(biaya_lain);
            parseInt($("#harga_jual").val(harga_jual))
            ;
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#hpp_edit, #service_fee_edit, #biaya_lain_edit").keyup(function() {
            var hpp_edit  = $("#hpp_edit").val();
            var service_fee_edit = $("#service_fee_edit").val();
            var biaya_lain_edit = $("#biaya_lain_edit").val();

            var harga_jual_edit = parseInt(hpp_edit) + parseInt(service_fee_edit) + parseInt(biaya_lain_edit);
            parseInt($("#harga_jual_edit").val(harga_jual_edit))
            ;
        });
    });
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
                            html += '<option value='+data[i].maskapai_id+'>'+data[i].nama_maskapai+'</option>';
                        }
                        $('#maskapai').html(html);
                        // $('#maskapai').html('<option selected value="">select..</option>');

                    }
                });
                return false;
            }); 
            
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#akomodasi_edit').change(function(){ 
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
                        $('#maskapai_edit').html(html);

                    }
                });
                return false;
            }); 
            
    });
  </script>
<script type="text/javascript">
    $(document).ready(function(){

      $('#vendor').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Tiket_controller/get_vendor');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].vendor_id+'>'+data[i].mark_up*100+'</option>';

                             // html += '<input type="number" name="harga_'+id+'" id="harga_'+id+'" value='+data[i].vendor_id+'>'+data[i].mark_up*100+'>';
                        }
                        $('#mark_up').html(html);

                    }
                });
                return false;
            }); 
            
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){

      $('#vendor_edit').change(function(){ 
                var id=$(this).val();
                $.ajax({
                    url : "<?php echo site_url('Tiket_controller/get_vendor');?>",
                    method : "POST",
                    data : {id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        
                        var html = '';
                        var i;
                        for(i=0; i<data.length; i++){
                            html += '<option value='+data[i].vendor_id+'>'+data[i].mark_up*100+'</option>';

                             // html += '<input type="number" name="harga_'+id+'" id="harga_'+id+'" value='+data[i].vendor_id+'>'+data[i].mark_up*100+'>';
                        }
                        $('#mark_up_edit').html(html);

                    }
                });
                return false;
            }); 
            
    });
  </script>
<!-- <script>
        $('.select2divisi').select2({
            placeholder: "Pilih Bahasa Pemrograman",
            theme: 'bootstrap4',
            ajax: {
                dataType: 'json',
                delay: 250,
                url: '<?php echo site_url('Tiket_controller/get_divisi'); ?>',
                data: function(params) {
                    return {
                        searchTerm: params.term
                    }
                },
                processResults: function(data) {
                    return {
                        results: $.map(data, function(obj) {
                            return {
                                id: obj.divisi_id,
                                text: obj.nama_divisi
                            };
                        })
                    };
                }
            }
        });
    </script> -->

   
  
</body>
</html>

