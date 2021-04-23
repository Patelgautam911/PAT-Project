<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
<style type="text/css">
	.error{
	color:red;
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
				<form id="resetpassword_form" name="resetpassword_form" method="post" action="resetpassword">
					<div class="error">
						<?php if (!empty($this->session->flashdata('msg'))): ?>
						<?php echo $this->session->flashdata('msg'); ?>
						<?php endif ?>
					</div>
					<div class="row newpasswordcls">
						<div class="input-field col s12">
							<input name="newpassword" id="newpassword" type="text" class="validate" placeholder="New password">
						</div>
					</div>
					<div class="row confirmpasswordcls">
						<div class="input-field col s12">
							<input name="confirmpassword" id="confirmpassword" type="text" class="validate" placeholder="Confirm password">
						</div>
					</div>
					<input type="hidden" name="rember_token" id="rember_token" value="<?php echo $token;?>">
					<div></div>
					<Button type="submit" name="resetpassword" id="login-btn" value="Submit" class="waves-effect waves-light btn-large">Submit</Button>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				</form>
			</div>
		</section>
	</div>