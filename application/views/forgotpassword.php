<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
<style type="text/css">
	.error{
		color:red;
		font-size: 16px;
	}
	.success{
		color:green;
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
				<form id="forgotpassword_form" name="forgotpassword_form" method="post" action="forgotpasswordCheck">
					<div class="success">
						<?php if (!empty($this->session->flashdata('success'))): ?>
						<?php echo $this->session->flashdata('success'); ?>
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
					<div>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					</div>
					<div class="forgot-password-cls">
						<p class="forgot-pass"><a id="forgot--pass" href="<?php echo base_url();?>login" title="Forgot Password">Login</a></p>
					</div>
					<Button type="submit" name="forgotpassword" id="login-btn" value="Submit" class="waves-effect waves-light btn-large">Submit</Button>
				</form>
			</div>
		</section>
	</div>