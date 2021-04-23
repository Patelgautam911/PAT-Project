<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Log in</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/fontawesome-free/css/all.min.css">
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/admin/css/adminlte.min.css">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		<a href="<?php echo base_url();?>assets/admin/index2.html"><b>Admin</b>LTE</a>
	</div>
	<div class="card">
		<div class="card-body login-card-body">
			<p class="login-box-msg">Sign in to start your session</p>
			<?php echo $this->session->flashdata('msg');?>
			<form action="<?php echo base_url();?>admin/logincheck" method="post" name="login_form" id="login_form">
				<div class="input-group mb-3 email">
					<input type="email" class="form-control" placeholder="Email" name="email">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-envelope"></span>
						</div>
					</div>
				</div>
				<div class="input-group mb-3 password">
					<input type="password" class="form-control" placeholder="Password" name="password">
					<div class="input-group-append">
						<div class="input-group-text">
							<span class="fas fa-lock"></span>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-8">
						<div class="icheck-primary">
							<input type="checkbox" id="remember">
							<label for="remember">
								Remember Me
							</label>
						</div>
					</div>
					<div class="col-4">
						<button type="submit" class="btn btn-primary btn-block">Sign In</button>
					</div>
				</div>
				 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
			</form>
			<p class="mb-1">
				<a href="forgot-password.html">I forgot my password</a>
			</p>
		</div>
	</div>
</div>
<script src="<?php echo base_url();?>assets/admin/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/adminlte.min.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/jquery/jquery.validate.js"></script>
<script src="<?php echo base_url();?>assets/admin/plugins/jquery/additional-methods.js"></script>
<script src="<?php echo base_url();?>assets/admin/js/custom_js.js"></script>

</body>
</html>
