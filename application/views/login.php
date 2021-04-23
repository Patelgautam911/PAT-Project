<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
<style type="text/css">
	.error{
		color:red;
		font-size: 16px;
	}
	.sucess{
		color: green;
    	font-size: 16px;
    }
</style>
<body id="login" class="user--login">
	<div class="container">
		<header>
			<a href="<?php echo base_url();?>">
				<h1><img src="<?php echo base_url();?>/assets/frontend/images/tracker-pat-logoversion-1-shape-4.svg" alt="PAT" /></h1>
			</a>
		</header>
		<section class="content">
			<h2>Welcome</h2>
			<p class="htext">Track student activity with PAT</p>
			<div class="form--container col s12">
				<form id="login_form" name="login_form" method="post" action="loginusercheck">
					<div class="sucess">
						<?php if (!empty($this->session->flashdata('sucess'))): ?>
							<?php echo $this->session->flashdata('sucess'); ?>
						<?php endif ?>
					</div>
					<div class="error">
						<?php if (!empty($this->session->flashdata('msg'))): ?>
							<?php echo $this->session->flashdata('msg'); ?>
						<?php endif ?>
					</div>
					<div class="row emailcls">
						<div class="input-field col s12">
							<input name="email" id="email" type="email" class="validate" placeholder="Email">
						</div>
					</div>
					<div class="row pwdcls">
						<div class="input-field col s12">
							<input name="password" id="password" type="password" class="validate" placeholder="Password">
							<i class="material-icons dp48 eye">remove_red_eye</i>
						</div>
					</div>
					<div class="forgot-password-cls">
						<p class="forgot-pass"><a id="forgot--pass" href="<?php echo base_url();?>forgotpassword" title="Forgot Password">Forgot Password</a></p>
					</div>

					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />

					<Button type="submit" id="login-btn" value="login" class="waves-effect waves-light btn-large">Login</Button>
					<!-- <a id="login-btn" class="waves-effect waves-light btn-large" href="index.php">Login</a> -->
				</form>
				
			</div>
		</section>
	</div>

	