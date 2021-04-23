<?php ini_set('max_execution_time', 0); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo $title;?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- <link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">	 -->
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/adminlte.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/datatables-bs4/css/dataTables.bootstrap4.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/select2/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/summernote/summernote-bs4.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
	<div class="wrapper">
		<nav class="main-header navbar navbar-expand navbar-white navbar-light">	
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="javascript:void(0);"><i class="fas fa-bars"></i></a>
				</li>
			</ul>
		</nav>
		<aside class="main-sidebar sidebar-dark-primary elevation-4">
			<a href="index3.html" class="brand-link">
				<img src="<?php echo base_url();?>/assets/admin/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
				<span class="brand-text font-weight-light">PAT</span>
			</a>
			<div class="sidebar">
				
				<div class="user-panel mt-3 pb-3 mb-3 d-flex">
					<div class="image">
						<img src="<?php echo base_url();?>/assets/admin/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
					</div>
					<div class="info">
						<a href="javascript:void(0);" class="d-block"><?php echo $this->session->userdata('username');?></a>
					</div>
				</div>
				<nav class="mt-2">
					<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/home" class="nav-link <?php if($this->uri->segment(2)=="home"){echo 'active';}?>">
								<i class="fa fa-user" aria-hidden="true"></i></i>
								<p>Dashboard</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/school" class="nav-link <?php if($this->uri->segment(2)=="school"){echo 'active';}?>">
								<i class="fa fa-university" aria-hidden="true"></i>
								<p>School</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/class" class="nav-link <?php if($this->uri->segment(2)=="class"){echo 'active';}?>">
								<i class="far fa-circle nav-icon"></i>
								<p>Class</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/parent" class="nav-link <?php if($this->uri->segment(2)=="parent"){echo 'active';}?>">
								<i class="fa fa-user" aria-hidden="true"></i> <p> Parent</p>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="<?php echo base_url();?>admin/student" class="nav-link <?php if($this->uri->segment(2)=="student"){echo 'active';}?>">
								<i class="fa fa-user" aria-hidden="true"></i> <p> Student</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/teacher" class="nav-link <?php if($this->uri->segment(2)=="teacher"){echo 'active';}?>">
								<i class="fas fa-chalkboard-teacher"></i> <p>Teacher</p>
							</a>
						</li>
						<li class="nav-item">
							<a href="<?php echo base_url();?>admin/logout" class="nav-link">
								<i class="fas fa-sign-out-alt"></i>
								<p>Logout</p>
							</a>
						</li>
					</ul>
				</nav>
				
			</div>
		</aside>
		<?php echo $output;?>

		  
	  	<footer class="main-footer">
			<strong>Copyright &copy; 2014-2019 <a href="<?php echo base_url();?>">PAT</a>.</strong>All rights reserved.
	  	</footer>
	</div>
	<script type="text/javascript">
		var BASE_URL="<?php echo base_url(); ?>";
	</script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/jquery-ui/jquery-ui.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- <script src="<?php echo base_url();?>/assets/admin/plugins/chart.js/Chart.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/sparklines/sparkline.js"></script> -->
	<!-- <script src="<?php echo base_url();?>/assets/admin/plugins/jqvmap/jquery.vmap.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/jqvmap/maps/jquery.vmap.usa.js"></script> -->
	<!-- <script src="<?php echo base_url();?>/assets/admin/plugins/jquery-knob/jquery.knob.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/moment/moment.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/daterangepicker/daterangepicker.js"></script> -->
	<!-- <script src="<?php echo base_url();?>/assets/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script> -->
	<script src="<?php echo base_url();?>/assets/admin/plugins/datatables/jquery.dataTables.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/select2/js/select2.min.js"></script>
	<!-- <script src="<?php echo base_url();?>/assets/admin/plugins/summernote/summernote-bs4.min.js"></script>
	<script src="<?php echo base_url();?>/assets/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script> -->
	<script src="<?php echo base_url();?>/assets/admin/js/adminlte.js"></script>
	<!-- <script src="<?php echo base_url();?>/assets/admin/js/pages/dashboard.js"></script> -->
	<!-- <script src="<?php echo base_url();?>/assets/admin/js/demo.js"></script> -->
	<script src="<?php echo base_url();?>assets/admin/plugins/jquery/jquery.validate.js"></script>
	<script src="<?php echo base_url();?>assets/admin/plugins/jquery/additional-methods.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js"></script>
	<script src="<?php echo base_url();?>assets/admin/js/custom_js.js"></script>
</body>
</html>
