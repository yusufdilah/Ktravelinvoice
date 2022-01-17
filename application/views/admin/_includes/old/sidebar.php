<!-- Left side column. contains the logo and sidebar -->
<?php $this->config->load('upload_setting', TRUE); ?>
<?php $folder = $this->config->item('folder', 'upload_setting') ?>
<?php $logo = "logo_icon.jpg" ?>
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
			<li <?=$this->uri->segment(1) == 'Anggota_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Anggota_controller') ?>"><i class="fa fa-fw fa-child"></i> <span>Anggota</span></a>
			</li>
			<li <?=$this->uri->segment(1) == 'Registrasi_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Registrasi_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Registrasi</span></a>
			</li>
			<li <?=$this->uri->segment(1) == 'Helpdesk_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Helpdesk_controller') ?>"><i class="fa fa-fw fa-file"></i> <span>Helpdesk</span></a>
			</li>
		<?php
		if ($this->session->userdata('level') == "admin") {
		?>
			<li <?=$this->uri->segment(1) == 'Home_slider_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Home_slider_controller') ?>"><i class="fa fa-fw fa-sliders"></i> <span>Homer Slider</span></a>
			</li>
			<li <?=$this->uri->segment(1) == 'Info_terbaru_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Info_terbaru_controller') ?>"><i class="fa fa-fw fa-info"></i> <span>Info Terbaru</span></a>
			</li>
			<li <?=$this->uri->segment(1) == 'Faq_controller' ? 'class="active"' : '' ?>>
				<a href="<?php echo base_url('Faq_controller') ?>"><i class="fa fa-fw fa-question-circle"></i> <span>fAQ</span></a>
			</li>
			<li class="treeview">
				<a href="#">
					<i class="fa fa-fw fa-cog"></i> <span>Setting</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li <?=$this->uri->segment(1) == 'Setting_menu_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Setting_menu_controller') ?>"><i class="fa fa-circle-o"></i> <span>Setting Menu</span></a></li>
					<li <?=$this->uri->segment(1) == 'Underconstruction_mode_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Underconstruction_mode_controller') ?>"><i class="fa fa-circle-o"></i> <span>Undercontroction Mode</span></a></li>
					<li <?=$this->uri->segment(1) == 'Info_terbaru_controller' || $this->uri->segment(1) == '' ? 'class="active"' : '' ?>><a href="<?php echo base_url('Info_terbaru_controller') ?>"><i class="fa fa-circle-o"></i> <span>Kategori</span></a></li>
				</ul>
			</li>
		<?php
		}
		?>
		</ul>
    </section>
    <!-- /.sidebar -->
</aside>