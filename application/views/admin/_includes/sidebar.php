<!-- Left side column. contains the logo and sidebar -->
<?php $this->config->load('upload_setting', TRUE); ?>
<?php $folder = $this->config->item('folder', 'upload_setting') ?>
<?php $logo = "capture_ktravel.jpg" ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img style="width: 100px;"src="<?php echo base_url($folder.$logo)?> " class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p><?php echo $this->session->userdata('level'); ?></p>
        <a href="#"><i class="fa fa-circle text-success"></i>Online</a>
      </div>
    </div>

    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">Navigation</li>
      <li <?=$this->uri->segment(1) == 'Dashboard_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Dashboard_controller') ?>"><i class="fa fa-columns"></i> <span>Dashboard</span></a>
      </li>
      
      <li <?=$this->uri->segment(1) == 'Tiket_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Tiket_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Tiket</span></a>
      </li>
      <!-- <li <?=$this->uri->segment(1) == 'Perusahaan_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Perusahaan_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Perusahaan</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Customer_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Customer_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Customer</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Customer_perusahaan_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Customer_perusahaan_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Customer Perusahaan</span></a>
      </li> -->
      <li <?=$this->uri->segment(1) == 'Perusahaan_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Perusahaan_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Kopkar</span></a>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-home"></i> <span>Customer</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <!-- <li <?=$this->uri->segment(1) == 'Perusahaan_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Perusahaan_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Perusahaan</span></a>
          </li> -->
          <li <?=$this->uri->segment(1) == 'Customer_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Customer_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Customer</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'Customer_perusahaan_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Customer_perusahaan_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Customer Perusahaan</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'Divisi_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Divisi_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Divisi</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'Pic_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Pic_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>PIC</span></a>
          </li>
        </ul>
      </li>
      
    <?php
    if ($this->session->userdata('level') == "admin") {
    ?>
      
      <li class="treeview">
        <a href="#">
          <i class="fa fa-fw fa-cog"></i> <span>Setting & Master</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?=$this->uri->segment(1) == 'Setting_level_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Setting_level_controller') ?>"><i class="fa fa-circle-o"></i> <span>Setting Level</span></a></li>
          <!-- <li <?=$this->uri->segment(1) == 'Underconstruction_mode_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Underconstruction_mode_controller') ?>"><i class="fa fa-circle-o"></i> <span>Undercontroction Mode</span></a></li>
          <li <?=$this->uri->segment(1) == 'Kategori_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Kategori_controller') ?>"><i class="fa fa-circle-o"></i> <span>Kategori</span></a></li> -->
          <li <?=$this->uri->segment(1) == 'Maskapai_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Maskapai_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Maskapai</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'Vendor_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Vendor_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Vendor</span></a>
          </li>
          <li <?=$this->uri->segment(1) == 'Route_controller' ? 'class="active"' : '' ?>>
            <a href="<?php echo base_url('Route_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Route</span></a>
          </li>
        </ul>
      </li>
    <?php
    }
    ?>
    <!-- <li <?=$this->uri->segment(1) == 'Divisi_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Divisi_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Divisi</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Pic_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Pic_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>PIC</span></a>
      </li> -->
      <!-- <li <?=$this->uri->segment(1) == 'Maskapai_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Maskapai_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Maskapai</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Vendor_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Vendor_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Vendor</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Route_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Route_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Route</span></a>
      </li> -->
      <li <?=$this->uri->segment(1) == 'Invoice_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Invoice_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Invoice</span></a>
      </li>
      <li <?=$this->uri->segment(1) == 'Reminder_controller' ? 'class="active"' : '' ?>>
        <a href="<?php echo base_url('Reminder_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Reminder</span></a>
      </li>
    </ul>
    </section>
    <!-- /.sidebar -->
</aside>