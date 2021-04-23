<body id="login" class="user--login">
<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
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
				<form id="parent_register_form" name="parent_register_form" method="post" action="parentregister">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					<div class="row usernamecls">
						<div class="input-field col s12">
							<input type="text" name="username" id="username" class="validate" placeholder="UserName">
						</div>
					</div>
					<div class="row braceletcls">
						<div class="input-field col s12">
							<input type="text" name="braceletid" id="braceletid" class="validate" placeholder="Series number">
						</div>
					</div>
					<div class="row emailcls">
						<div class="input-field col s12 ">
							<input type="text" name="email" id="email" class="validate" placeholder="Email ID">
						</div>
					</div>
					<div class="row phonecls">
						<div class="input-field col s12 ">
							<input type="text" name="phone" id="phone" class="validate" placeholder="Phone">
						</div>
					</div>
					<div class="row">
						<div class="input-field col s12">
							<input name="password" id="password" type="password" class="validate" placeholder="Password">
							<i class="material-icons dp48 eye">remove_red_eye</i>
						</div>
						<div class="pwdcls">
						</div>
					</div>
					<Button type="submit" name="submit" id="register-btn" value="Register" class="waves-effect waves-light btn-large register-btn">Register</Button>
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
				</form>
			</div>
		</section>
	</div>
						
	