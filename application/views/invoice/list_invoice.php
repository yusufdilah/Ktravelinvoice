<!DOCTYPE html>
<html lang="en">
<?php $this->load->view("admin/_includes/head.php") ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php $this->load->view("admin/_includes/header.php") ?>
        <?php $this->load->view("admin/_includes/sidebar.php") ?>

        <div class="content-wrapper">
            <!-- Alert -->
            <?php if ($this->session->flashdata('success')) : ?>
                <div class="box-body">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i>Alert!</h4>
                        <?php echo $this->session->flashdata('success'); ?>
                    </div>
                </div>
            <?php elseif ($this->session->flashdata('error')) : ?>
                <div class="box-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <h4><i class="icon fa fa-info"></i>Alert!</h4>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                </div>
            <?php endif; ?>
            <!-- Alert -->

            <section class="content-header">
                <h1>
                    Kelola
                    <small>Invoice</small>
                </h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Invoice</a></li>
                    <li><a href="#">Lihat Data Invoice</a></li>
                </ol>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="box">
                            <div class="box-header">
                                <!-- <a href="<?php echo base_url('Faq_controller/add') ?>" class="btn btn-tosca"><i class="fa fa-fw fa-plus" title="Tambah"></i></a> -->
                                <a href="#!" class="btn btn-tosca" type="button" onclick="addConfirm()"><i class="fa fa-fw fa-plus" title="Tambah"></i></a>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body table-responsive">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr style="color: darkslategrey;">
                                            <th>No</th>
                                            <th>Tanggal Invoice</th>
                                            <th>Invoice No</th>
                                            <th>UP (Nama GH)</th>
                                            <th>Deskripsi</th>
                                            <th>Jumlah Tiket</th>
                                            <th>Divisi</th>
                                            <th>Total Harga</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($invoice as $inv) : ?>
                                            <tr>
                                                <td><?= $no++; ?></td>
                                                <td>
                                                    <?= $inv->created_date; ?></td>
                                                <td><?= 'INV-' . $inv->created_date . '-' . $inv->no_invoice; ?></td>
                                                <td><?= $inv->nm_group_head; ?></td>
                                                <td>Tagihan tiket untuk <?= $inv->nama_divisi; ?></td>
                                                <td><?= $inv->jml_tiket; ?></td>
                                                <td><?= $inv->nama_divisi; ?></td>
                                                <td><?php
                                                    $total = $inv->total_harga_jual;
                                                    echo 'Rp. ' . number_format($total, 0, ',', '.');
                                                    ?></td>
                                                <td><?php
                                                    if ($inv->status == 0) {
                                                        echo 'Unprocess';
                                                    } elseif ($inv->status == 1) {
                                                        echo 'Process';
                                                    } elseif ($inv->status == 2) {
                                                        echo 'Paid';
                                                    } else {
                                                        echo 'Overdue';
                                                    }
                                                    ?></td>
                                                <td class="text-center">
                                                    <a data-toggle="modal" class="btn btn-warning btn-circle btn-sm edit-tiket" data-popup="tooltip" data-placement="top" data-id="<?= $inv->invoice_id; ?>" data-no_invoice=" <?= $inv->no_invoice; ?>" id="edit-tiket" title="Edit Data"><i class="fa fa-pencil"></i></a>
                                                    <a href="#!" class="btn btn-mandarin btn-sm deleteInvoice" data-invoiceid="<?= $inv->invoice_id; ?>" id="deleteInvoice"><i class="fa fa-fw fa-trash" title="Hapus"></i></a>
                                                    <a href="<?= base_url('Generate_pdf_controller/index/' . $inv->invoice_id) ?>" target="_blank" class="btn btn-info btn-circle btn-sm" title="pdf"><i class="fa fa-file"></i></a>
                                                    <a data-noinvoicedetail="<?= $inv->no_invoice; ?>" data-divisiid="<?= $inv->divisi_id; ?>" id="detail_invoice" href="#" class="btn btn-light btn-circle btn-sm detail_invoice" title="detail"><i class="fa fa-eye"></i></a>
                                                    <a href="#!" onclick="payConfirm('<?php echo site_url('Invoice_controller/Pay/'.$inv->invoice_id) ?>')" class="btn btn-tosca"><i class="fa fa-fw fa-money" title="Bayar Invoice"></i></a>
                                                    <a href="#!" onclick="sendConfirm()" class="btn btn-tosca"><i class="fa fa-fw fa-send-o" title="Send Cost Center"></i></a>
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
                <!-- /.row -->
            </section>
            <!-- /.content -->
        </div>
        <?php $this->load->view("admin/_includes/footer.php") ?>
        <?php $this->load->view("admin/_includes/control_sidebar.php") ?>
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
                <form action="<?= base_url('Invoice_controller/add') ?>" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="divisi">Divisi</label>
                                    <select name="divisi" id="divisi" class="form-control" required>
                                        <option selected disabled value="">select..</option>
                                        <?php foreach ($divisi as $d) : ?>
                                            <option value="<?= $d->divisi_id ?>" data-perusahaan_id="<?= $d->perusahaan_id; ?>"><?= $d->nama_divisi ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('divisi') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="group_head">Group Head</label>
                                    <input type="text" name="group_head" id="group_head" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="periode">Periode Issued</label>
                                    <br>
                                    <small>From</small>
                                    <input type="date" name="from_periode" id="from_periode" class="form-control" required>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('from_periode') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <small>To</small>
                                    <input type="date" name="to_periode" id="to_periode" class="form-control" required>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('to_periode') ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <label for="perusahaan">Perusahaan</label>
                                    <select name="perusahaan" id="perusahaan" class="form-control" required>
                                        <option selected disabled value="">select..</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('perusahaan') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="pic">PIC</label>
                                    <select name="pic" id="pic" class="form-control" required>
                                        <option selected disabled value="">select..</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        <?php echo form_error('perusahaan') ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" id="alamat" cols="30" rows="6" class="form-control" readonly></textarea>
                                </div>
                                <button type="button" class="btn btn-secondary" id="list-tiket">Generate List Tiket</button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr style="color: darkslategrey;">
                                        <th><input type="checkbox" name="cheack-all" id="check-all"></th>
                                        <th>No</th>
                                        <th>Tanggal Invoice Issued</th>
                                        <th>Tanggal Berangkat</th>
                                        <th>Nama</th>
                                        <th>NIP</th>
                                        <th>Divisi</th>
                                        <th>NO Memo</th>
                                        <th>Route</th>
                                        <th>Kode Booking</th>
                                        <th>Maskapai</th>
                                        <th>Harga Jual</th>
                                        <th>Service Fee</th>
                                        <th>Hpp</th>
                                        <th>Bookers</th>
                                    </tr>
                                </thead>
                                <tbody id="tiket">

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
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div id="submit">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- EDIT MODAL -->
    <div class="modal fade bd-example-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Edit Data</h3>
                </div>
                <!-- TAMPIL DATA DISINI -->
                <div id="tampil_data">

                </div>
            </div>
        </div>
    </div>

    <!-- DETAIL MODAL -->
    <div class="modal fade bd-example-modal-lg" id="modal-detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3 class="modal-title">Detail Data</h3>
                </div>
                <!-- TAMPIL DATA DISINI -->
                <div id="tampil_detail">

                </div>
            </div>
        </div>
    </div>

    <!-- modal delete tiket yang terelasi dengan invoice -->
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
                    <button class="btn btn-secondary cancel" id="cancel" type="button" data-dismiss="modal">Cancel</button>
                    <a data-modal_tiket_id="" id="btn-delete" class="btn btn-danger" href="#" data-dismiss="modal">Delete</a>
                </div>
            </div>
        </div>
    </div>

    <!-- modal delete invoice -->
    <div class="modal fade" id="invoiceDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <button class="btn btn-secondary cancel" type="button" data-dismiss="modal">Cancel</button>
                    <a data-modal_invoice_id="" id="invoiceDelete" class="btn btn-danger" href="#" data-dismiss="modal">Delete</a>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Invoice akan di bayar ?</div>
      <div class="form-group">
            <div class="box-body">
                <!-- <input type="text" name="invoice_id" value="<?php echo $inv->invoice_id?>" />
                <input type="text" name="total_harga_jual" value="<?php echo $inv->total_harga_jual?>" />
                <input type="text" name="total_service_fee" value="<?php echo $inv->total_service_fee?>" /> -->
            </div>
       </div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a id="btn-pay" class="btn btn-primary" href="#">Bayar Invoice</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="sendModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form  role="form" action="<?php echo base_url('Invoice_controller/Syn/'.$inv->invoice_id) ?>" method="post">   
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Invoice akan di send ke Cost Center ?</div>
      <div class="form-group">
            <div class="box-body">
                <input type="text" name="invoice_id" value="<?php echo $inv->invoice_id?>" />
                <input type="text" name="total_harga_jual" value="<?php echo $inv->total_harga_jual?>" />
                <input type="text" name="total_service_fee" value="<?php echo $inv->total_service_fee?>" />
            </div>
       </div>
      
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <!-- <a id="btn-send" class="btn btn-primary" href="#">SendCostCenter</a> -->
        <button class="btn btn-primary" name="submit" type="submit">Send Cost Center</button>
      </div>
    </form>
    </div>
  </div>
</div>

    <!-- ./wrapper -->
    <?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
    <!-- page script -->

    <script>
      function payConfirm(url){
        $('#btn-pay').attr('href', url);
        $('#payModal').modal();
      }
    </script>

    <script>
      function sendConfirm(url){
        $('#btn-send').attr('href', url);
        $('#sendModal').modal();
      }
    </script>

    <script>
        function addConfirm(url) {
            $('#btn-approve').attr('href', url);
            $('#addModal').modal();
        }
    </script>

    <script>
        $('#divisi').select2();
        $('#perusahaan').select2();
        $('#pic').select2();
    </script>

    <!-- ambil data perusahaan untuk chained dropdown -->
    <script>
        let perusahaan_id;
        let divisi_id;
        $('#divisi').change(function() {
            perusahaan_id = $('#divisi option[value="' + $(this).val() + '"]').attr('data-perusahaan_id');
            divisi_id = $(this).val();
            $('#perusahaan').html('<option selected value="">select..</option>');
            $.ajax({
                type: "POST",
                url: "<?= base_url("index.php/Customer_perusahaan_controller/chained_dropdown_perusahaan"); ?>",
                data: {
                    perusahaan_id: perusahaan_id, // id perusahaan
                    divisi_id: divisi_id, // id divisi
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    $("#perusahaan").select2("val", ""); // reset value perusahaan
                    $.each(response.list_perusahaan, function(index, value) {
                        $('#perusahaan').html('<option value="' + value.cust_perusahaan_id + '">' + value.nm_cust_perusahaan + '</option>'); // tampilkan data
                        $('#group_head').val(value.nm_group_head);
                        $('#alamat').val(value.alamat_perusahaan);
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>

    <!-- ambil data pic untuk chained dropdown -->
    <script>
        $('#divisi').change(function() {
            divisi_id = $(this).val();
            $('#pic').html('<option selected value="">select..</option>');
            $.ajax({
                type: "POST",
                url: "<?= base_url("index.php/Pic_controller/chained_dropdown_pic"); ?>",
                data: {
                    divisi_id: divisi_id, // id divisi
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    // console.log(response);
                    $("#pic").select2("val", "");
                    $.each(response, function(index, value) {
                        $('#pic').append('<option value="' + value.pic_id + '">' + value.pic + '</option>'); // tampilkan data pic
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>

    <script>
        const divisi = document.getElementById('divisi');
        const from_periode = document.getElementById('from_periode');
        const to_periode = document.getElementById('to_periode');
        const pic = document.getElementById('pic');

        $('#list-tiket').on('click', function() {
            $('#tiket').children().remove();
            $.ajax({
                type: "POST",
                url: "<?= base_url('index.php/Tiket_controller/genereate_list_tiket'); ?>",
                data: {
                    divisi_id: divisi.value, // id divisi
                    from: from_periode.value, // tgl from
                    to: to_periode.value, // tgl to
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    if (!response.length) {
                        // jika data tidak ditenukan
                        $('#tiket').append(
                            '<tr>' +
                            '<td><input type="checkbox" required hidden name="tiket_id[]" id="tiket_id" value=""></td>' +
                            '<td colspan="15" class="text-center">Data Not Found</td>' +
                            '</tr>'
                        );
                    } else {
                        $.each(response, function(index, value) {
                            // jika data di temukan tampilkan
                            $('#tiket').append(
                                '<tr>' +
                                '<td><input type="checkbox" name="tiket_id[]" id="tiket_id" value="' + value.tiket_id + '"></td>' +
                                '<td>' + (index + 1) + '</td>' +
                                '<td>' + value.tgl_issued + '</td>' +
                                '<td>' + value.tgl_berangkat + '</td>' +
                                '<td>' + value.nama_customer + '</td>' +
                                '<td>' + value.nip_customer + '</td>' +
                                '<td>' + value.nama_divisi + '</td>' +
                                '<td>' + value.no_memo + '</td>' +
                                '<td>' + value.kd_route + '</td>' +
                                '<td>' + value.kode_booking + '</td>' +
                                '<td>' + value.nama_maskapai + '</td>' +
                                '<td>' + value.harga_jual + '</td>' +
                                '<td>' + value.service_fee + '</td>' +
                                '<td>' + value.hpp + '</td>' +
                                '<td>' + value.bookers + '</td>' +
                                +'</tr>'
                            );
                            // tampilkan juga button submit
                            $('#submit').html(
                                '<button type="submit" class="btn btn-secondary" id="submit-invoice">Generate Invoice</button>'
                            );
                        });
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>

    <!-- check all -->
    <script>
        $("#check-all").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>

    <!-- ambil data id tiket -->
    <script>
        $('#submit-invoice').on('click', function() {
            let values = $("input[name='tiket_id[]']").map(function() {
                return $(this).val();
            }).get();
        });
    </script>

    <!-- FOR MODAL EDIT -->
    <script>
        $('.edit-tiket').on('click', function() {
            let no_invoice = $(this).data('no_invoice');
            $.ajax({
                url: '<?php echo base_url(); ?>/Invoice_controller/edit',
                method: 'post',
                data: {
                    invoice_id: $(this).data('id') // no invoice
                },
                success: function(data) {
                    $('#modal-edit').modal("show");
                    $('#tampil_data').html(data); // tampilkan data yang dipilih (file data_edit.php);
                    $('#divisiEdit').select2();
                    $('#perusahaanEdit').select2();
                    $('#picEdit').select2();

                    // PERUSAHAAN EDIT
                    // ambil data perusahaan
                    let perusahaan_id;
                    let divisi_id;
                    $('#divisiEdit').change(function() {
                        // console.log('change');
                        perusahaan_id = $('#divisi option[value="' + $(this).val() + '"]').attr('data-perusahaan_id');
                        divisi_id = $(this).val();
                        $('#perusahaanEdit').html('<option selected value="">select..</option>');
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url("index.php/Customer_perusahaan_controller/chained_dropdown_perusahaan"); ?>",
                            data: {
                                perusahaan_id: perusahaan_id,
                                divisi_id: divisi_id,
                            },
                            dataType: "json",
                            beforeSend: function(e) {
                                if (e && e.overrideMimeType) {
                                    e.overrideMimeType("application/json;charset=UTF-8");
                                }
                            },
                            success: function(response) {
                                $("#perusahaanEdit").select2("val", "");
                                $.each(response.list_perusahaan, function(index, value) {
                                    $('#perusahaanEdit').html('<option value="' + value.cust_perusahaan_id + '">' + value.nm_cust_perusahaan + '</option>');
                                    $('#group_headEdit').val(value.nm_group_head);
                                    $('#alamatEdit').val(value.alamat_perusahaan);
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                            },
                        });
                    });

                    // PIC EDIT
                    // ambil data pic
                    $('#divisiEdit').change(function() {
                        divisi_id = $(this).val();
                        $('#picEdit').html('<option selected value="">select..</option>');
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url("index.php/Pic_controller/chained_dropdown_pic"); ?>",
                            data: {
                                divisi_id: divisi_id,
                            },
                            dataType: "json",
                            beforeSend: function(e) {
                                if (e && e.overrideMimeType) {
                                    e.overrideMimeType("application/json;charset=UTF-8");
                                }
                            },
                            success: function(response) {
                                // console.log(response);
                                $("#picEdit").select2("val", "");
                                $.each(response, function(index, value) {
                                    $('#picEdit').append('<option value="' + value.pic_id + '">' + value.pic + '</option>');
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                                console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                            },
                        });
                    });

                    // CHECK ALL
                    $("#check-all-edit").click(function() {
                        $('input:checkbox').not(this).prop('checked', this.checked);
                    });

                    //GENERATE NEW LIST TIKET
                    const divisiEdit = document.getElementById('divisiEdit');
                    const from_periodeEdit = document.getElementById('from_periodeEdit');
                    const to_periodeEdit = document.getElementById('to_periodeEdit');

                    $('#list-tiket-edit').on('click', function() {
                        $('#tiketEdit').children().remove();
                        $.ajax({
                            type: "POST",
                            url: "<?= base_url('index.php/Tiket_controller/genereate_list_tiket'); ?>",
                            data: {
                                divisi_id: divisiEdit.value,
                                from: from_periodeEdit.value,
                                to: to_periodeEdit.value,
                            },
                            dataType: "json",
                            beforeSend: function(e) {
                                if (e && e.overrideMimeType) {
                                    e.overrideMimeType("application/json;charset=UTF-8");
                                }
                            },
                            success: function(response) {
                                if (!response.length) {
                                    // jika data tidak ditemukan
                                    $('#tiketEdit').append(
                                        '<tr>' +
                                        '<td><input type="checkbox" required hidden name="tiket_id[]" id="tiket_id" value=""></td>' +
                                        '<td colspan="15" class="text-center">Data Not Found</td>' +
                                        '</tr>'
                                    );
                                } else {
                                    $.each(response, function(index, value) {
                                        // cek data apakah sudah pernah terdaftar di invoice yang akan di edit.
                                        // jika iya maka check tiket;
                                        let checked = (parseInt(value.no_invoice) == parseInt(no_invoice)) ? 'checked' : '';

                                        // tampilkan data
                                        $('#tiketEdit').append(
                                            '<tr>' +
                                            '<td><input ' + checked + ' type="checkbox" name="tiket_id[]" id="tiket-' + value.tiket_id + '" value="' + value.tiket_id + '"></td>' +
                                            '<td>' + (index + 1) + '</td>' +
                                            '<td>' + value.tgl_issued + '</td>' +
                                            '<td>' + value.tgl_berangkat + '</td>' +
                                            '<td>' + value.nama_customer + '</td>' +
                                            '<td>' + value.jml_tiket + '</td>' +
                                            '<td>' + value.nama_divisi + '</td>' +
                                            '<td>' + value.no_memo + '</td>' +
                                            '<td>' + value.kd_route + '</td>' +
                                            '<td>' + value.kode_booking + '</td>' +
                                            '<td>' + value.nama_maskapai + '</td>' +
                                            '<td>' + value.harga_jual + '</td>' +
                                            '<td>' + value.service_fee + '</td>' +
                                            '<td>' + value.hpp + '</td>' +
                                            '<td>' + value.bookers + '</td>' +
                                            '<td id="x-' + value.tiket_id + '"></td>' +
                                            +'</tr>'
                                        );

                                        // tampilkan tombol remove tiket dari data invoice
                                        if (parseInt(value.no_invoice) == parseInt(no_invoice)) {
                                            $('#x-' + value.tiket_id).html('<a href="#" class="btn btn-danger btn-sm hapus" data-id_tiket="' + value.tiket_id + '" >x</a>');
                                        }
                                    });
                                }

                                // konfirmasi hapus
                                $('.hapus').on('click', function() {
                                    let tiketID = $(this).data('id_tiket');
                                    $('#btn-delete').data('modal_tiket_id', tiketID);
                                    $('#deleteModal').modal();
                                });
                            },
                            error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                                // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                            },
                        });
                    });

                    // Note: fungsi konfirmasi hapus ada 2, karena jika melakukan pengambilan data baru list tiket
                    // fungsi konfirmasi hapus dibawah tidak berkerja

                    // konfirmasi hapus
                    $('.hapus').on('click', function() {
                        let tiketID = $(this).data('id_tiket');
                        $('#btn-delete').data('modal_tiket_id', tiketID);
                        $('#deleteModal').modal();
                    });
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });

        // Hapu tiket yang ada di invoice
        $('#btn-delete').on('click', function() {
            let btn_data = $(this).data('modal_tiket_id');

            $('#tiket-' + btn_data).prop('checked', false); //uncheked tiket
            $('#x-' + btn_data).children().remove(); // remove tombol hapus tiket

            $.ajax({
                type: "POST",
                url: "<?= base_url("index.php/Tiket_controller/removeTiketFromInvoice"); ?>",
                data: {
                    tiket_id: btn_data,
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    console.log(response); // response
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>

    <script>
        // Delete invoice
        $('.deleteInvoice').on('click', function() {
            let invoiceID = $(this).data('invoiceid');
            $('#invoiceDelete').data('modal_invoice_id', invoiceID);
            $('#invoiceDeleteModal').modal();
        });

        $('#invoiceDelete').on('click', function() {
            let btn_data = $(this).data('modal_invoice_id');
            $.ajax({
                type: "POST",
                url: "<?= base_url("index.php/Invoice_controller/delete"); ?>",
                data: {
                    invoice_id: btn_data,
                },
                dataType: "json",
                beforeSend: function(e) {
                    if (e && e.overrideMimeType) {
                        e.overrideMimeType("application/json;charset=UTF-8");
                    }
                },
                success: function(response) {
                    location.reload(true); // reload jika berhasil
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>

    <!-- modal detail invoice -->
    <script>
        $('.detail_invoice').on('click', function() {
            let noinvoicedetail = $(this).data('noinvoicedetail');
            let divisiid = $(this).data('divisiid');
            $.ajax({
                url: '<?php echo base_url(); ?>Tiket_controller/detailTiketInvoice',
                method: 'post',
                data: {
                    divisiid: divisiid, //id divisi
                    noinvoicedetail: noinvoicedetail // nomor invoice
                },
                success: function(data) {
                    $('#modal-detail').modal("show");
                    $('#tampil_detail').html(data); // tampilkan data yang dipilih

                    $('#cetak_customer').attr("href", "<?= base_url('Generate_excel/exportCustomer/'); ?>" + noinvoicedetail + '/' + divisiid);
                    $('#cetak_akunting').attr("href", "<?= base_url('Generate_excel/exportAkunting/'); ?>" + noinvoicedetail + '/' + divisiid);
                },
                error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
                    // console.log(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
                },
            });
        });
    </script>
</body>

</html>