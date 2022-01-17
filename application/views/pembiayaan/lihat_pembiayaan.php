

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
            <small>Pembiayaan</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-fw fa-user-plus"></i> Pembiayaan</a></li>
            <li><a href="#">Lihat Data Pembiayaan</a></li>
          </ol>

          
        </section>

        <!-- Main content -->
  
        <section class="content">
        <form method="post" action="<?php echo base_url('Pembiayaan_controller/search') ?>">  
            
          <div class="row">
            <div class="col-md-4">
                <div class="form-group form-inline">
                    <label>Kode Pembiayaan</label>
                    <input required="" type="text" name="kd_pembayaran" id="kd_pembayaran" class="form-control">
                    
                </div>
            </div>
            <div class="col-sm-2">
                <!-- <input type="submit" class="btn btn-warning" name="search-button" value="Search"> -->
                <button id="search" type="submit" name="search" class="btn btn-warning"><i class="fa fa-search"></i> Cari</button>
            </div>

          
            
            <!-- /.col -->
          </div>
          </form>  
          <!-- /.row -->
        <div class="row">
        <div class="col-xs-12">
              <div class="box">
                <!-- <div class="box-header">
                </div> -->
                <!-- /.box-header -->
                <div class="box-body table-responsive">
                  <table id="example1" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <td>No</td>
                            <td>Keterangan</td>
                            <td>Dokumen ID</td>
                            <td>Foto / File</td>
                            
                        </tr>
                    </thead>
                    <tbody>
                        
                            
                        
                         <?php if ($json['response_data'] > 0) { 
                             $no = 1;?>    
                            <?php foreach($json['response_data'] as $row) : ?> 
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    
                                    <td><?php echo $row["keterangan"]; ?></td>
                                    <td><?php echo $row["dokumen_id"]; ?></td>
                                    <td>
                                        <?php 
                                           $file = $row["file"]; 
                                            $jpg     = '.jpg';
                                            $jpeg    = '.jpeg';
                                            $png     = '.png';
                                           $pos_jpg  = strpos($file, $jpg); 
                                           $pos_jpeg = strpos($file, $jpeg); 
                                           $pos_png  = strpos($file, $png); 
                                           if ($pos_jpg !== false || $pos_jpeg !== false || $pos_png !== false) {?>
                                               <img src="<?=$file?>" style="width: 80%;">
                                                 

                                            <?php } else { ?>

                                                 <a target="_blank" href="<?=$row["file"]?>">
                                                    Download
                                                </a>
                                            <?php } ?>
                                    </td>
                                    
                                </tr>
                            <?php endforeach ?>
                       <? } else{?>
                           
                       <?php }?>
                         
                                
                                
                            
                        
                       
                    </tbody>
                </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
            </div>
           </div>
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


<!-- ./wrapper -->
<?php $this->load->view("admin/_includes/bottom_script_view.php") ?>
  
<!-- page script -->
<script>
  function deleteConfirm(url){
    $('#btn-delete').attr('href', url);
    $('#deleteModal').modal();
  }
</script>
<script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- <script type="text/javascript">
    function searchPembiayaan() {
    $('#pembiayaan-list').html('');

    $.ajax({
        url: 'https://new-my.kopkarbsm.co.id',
        type: 'get',
        dataType: 'json',
        data: {
            'apikey': 'dokumen_awal_pembiayaan',
            's': $('#search-input').val()
        },
        success: function (result) {
            if (result.Response == "True") {
                let pembiayaans = result.Search;

                $.each(pembiayaans, function (i, data) {
                    $('#pembiayaan-list').append(`
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <img src="${data.Poster}" class="card-img-top" alt="...">
                                <div class="card-body">
                                <h5 class="card-title">${data.Title}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">${data.Year}</h6>
                                <a href="#" class="card-link see-detail" data-toggle="modal" data-target="#exampleModal" data-id="${data.imdbID}">See Detail</a>
                                </div>
                            </div>
                        </div>
                    `);
                });

                $('#search-input').val('');

            } else {
                $('#pembiayaan-list').html(`
                    <div class="col">
                        <h1 class="text-center">` + result.Error + `</h1>
                    </div>
                `)
            }
        }
    });
}

$('#search-button').on('click', function () {
    searchPembiayaan();
});

$('#search-input').on('keyup', function (e) {
    if (e.which === 13) {
        searchPembiayaan();
    }
});


$('#pembiayaan-list').on('click', '.see-detail', function () {

    $.ajax({
        url: 'dokumen_awal_pembiayaan',
        dataType: 'json',
        type: 'get',
        data: {
            'apikey': 'dca61bcc',
            'i': $(this).data('id')
        },
        success: function (pembiayaan) {
            if (pembiayaan.Response === "True") {

                $('.modal-body').html(`
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="`+ pembiayaan.Poster + `" class="img-fluid">
                            </div>
                            <div class="col-md-8">
                                <ul class="list-group">
                                    <li class="list-group-item"><h3>`+ pembiayaan.Title + `</h3></li>
                                    <li class="list-group-item">Released : `+ pembiayaan.Released + `</li>
                                    <li class="list-group-item">Genre : `+ pembiayaan.Genre + `</li>                 
                                    <li class="list-group-item">Director : `+ pembiayaan.Director + `</li>                 
                                    <li class="list-group-item">Director : `+ pembiayaan.Actors + `</li>                 
                                </ul>
                            </div>
                        </div>
                    </div>
                `);

            }
        }
    });

});
    </script> -->



</body>
</html>
