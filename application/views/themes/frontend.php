<?php ini_set('max_execution_time', 0); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/assets/frontend/css/materialize.min.css"  media="screen,projection"/>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/frontend/css/style.css">
	<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
</head>
<body>
	<div id="cover-spin"></div>
	<div id="my-header">
		<span class="nav--toggle__button">
			<div class="menu-bar menu-bar-top"></div>
			<div class="menu-bar menu-bar-middle"></div>
			<div class="menu-bar menu-bar-bottom"></div>
		</span>
		<div class="menu-wrap open">
			<div class="menu-sidebar">
				<nav id="menu">
					<p id="school-partner_logo">
						<img src="<?php echo base_url();?>/assets/frontend/images/group-9.svg" alt="">
					</p>
					<ul class="menu marginR">
						<li><a href="<?php echo base_url(); ?>dashboard" class="<?php echo ($this->uri->segment(1)==='dashboard')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/dashboard.png" alt="Home" /> Dashboard</a></li>
						<?php if ($this->session->userdata('role')==3): ?>
							
							<li><a href="<?php echo base_url(); ?>classes" class="<?php echo ($this->uri->segment(1)==='classes')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/class.png" alt="Pupil Class" /> Classes</a></li>
							<li><a href="<?php echo base_url();?>teacher" class="<?php echo ($this->uri->segment(1)==='teacher')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/study.svg" alt="Study" /> Teachers</a></li>
						<?php endif ?>

						<?php if ($this->session->userdata('role')==2): ?>
							

							<li><a href="<?php echo base_url(); ?>classes" class="<?php echo ($this->uri->segment(1)==='classes')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/class.png" alt="Pupil Class" /> Classes</a></li>


						<?php endif ?>
						<li><a href="<?php echo base_url()?>help-center" class="<?php echo ($this->uri->segment(1)==='help-center')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/round-help-button.svg" alt="Help" /> Help Center</a></li>
						<li class="empty"></li> <!-- Don't remove -->
						<li><a href="<?php echo base_url()?>about-us" class="<?php echo ($this->uri->segment(1)==='about-us')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/icons-146.png" alt="Home" /> About Pat</a></li>
						<li><a href="<?php echo base_url();?>support" class="<?php echo ($this->uri->segment(1)==='support')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/icons-145.png" alt="Pupil Class" /> Support</a></li>
						<li><a href="<?php echo base_url()?>talk-with-us" class="<?php echo ($this->uri->segment(1)==='talk-with-us')?'active':''?>"><img src="<?php echo base_url();?>/assets/frontend/images/icons-144.png" alt="Study" /> Talk With Us</a></li>
						<li><a href="<?php echo base_url();?>logout"><img src="<?php echo base_url();?>/assets/frontend/images/logout.png" alt="Study" /> Logout</a></li>
					</ul>
					<p class="sticky-footer">
						copyright <a href="javascript:;">Disclaimer</a> <a href="javascript:;">Privacy Policy</a>
					</p>
				</nav>
			</div>
		</div>
	</div>
	<div class="container">
		<header class="mhead">
			<h1><img src="<?php echo base_url();?>/assets/frontend/images/PAT_Logo.png" width="203" alt="PAT" /></h1>
			<div class="login--user">
				<span class="username"><?php echo $this->session->userdata('email');?></span>
				<span class="usericon"><i class="material-icons small">person</i></span>
			</div>
		</header>
		<?php echo $output;?>
	</div>
	<footer style="display: none;">
		<div class="row">
			<div class="footer--content">
				<div class="col s6">
					<ul>
						<li><a href="javascript:;" title="About PAT">About PAT</a></li>
						<li><a href="javascript:;" title="Support">Support</a></li>
						<li><a href="javascript:;" title="Contact Us">Contact Us</a></li>
					</ul>
				</div>
				<div class="col s6 right-align logo-contain">
					<img src="assets/images/frontend/group-9.svg" alt="" /> 
					<img src="assets/images/frontend/logo-pat-registered.png" alt="PAT Logo" style="height: 100%;"/> 
				</div>
			</div>
			<div class="col s12 copyright">
				<div class="footer--content">
					copyright | Disclaimer | Privacy Policy
				</div>
			</div>
		</div>
	</footer>
	<script type="text/javascript">
		var BASE_URL = "<?php echo base_url();?>";
	</script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/jquery/additional-methods.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
		
	</script>
	<script src="<?php echo base_url();?>assets/frontend/js/pat.js"></script>
	<script src="<?php echo base_url();?>assets/frontend/js/all_js.js"></script>
</body>
</html>