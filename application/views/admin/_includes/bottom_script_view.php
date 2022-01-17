<!-- JQuery -->
<!-- <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script> -->
<script src="<?php echo base_url('assetAdmin/bower_components/jquery/dist/jquery.min.js'); ?>"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url('assetAdmin/bower_components/bootstrap/dist/js/bootstrap.min.js'); ?>"></script>
<!-- DataTables -->
<script src="<?php echo base_url('assetAdmin/bower_components/datatables.net/js/jquery.dataTables.min.js'); ?> "></script>
<script src="<?php echo base_url('assetAdmin/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js'); ?> "></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assetAdmin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js'); ?> "></script>
<!-- FastClick -->
<script src="<?php echo base_url('assetAdmin/bower_components/fastclick/lib/fastclick.js'); ?> "></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assetAdmin/dist/js/adminlte.min.js'); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assetAdmin/dist/js/demo.js'); ?> "></script>
<!-- select2 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.js" integrity="sha512-jfp1Gv+A3dHho9qOUUWOrZA6NWR08j7GYVn8VXcRI0FsDb3xe0hQHVwasi2UarjZzPYOxT5uvmlHrWLXQ+M4AQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>