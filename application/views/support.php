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
<div class="support">
	<section class="content">
		<div class="row valign-wrapper">
			<div class="col s12">
				<h2 class="phead"><strong>Talk With Us</strong></h2>
			</div>
		</div>
		<div class="row form--container">
			<div class="col s12">
				<p>Did you encounter any issue with your devices? <br/> Send us your feedback, we will get back to you as soon as possible.</p>
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
				<form name="support_form" id="support_form" action="<?php echo base_url();?>SaveSupport" method="post">
					<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					<div class="row">
						<div class="input-field col s12">
							<input id="name" name="uname" type="name" class="validate" placeholder="Name"/>
						</div>
					</div>
					<div class="name-cls"></div>
					<div class="row">
						<div class="input-field col s12">
							<input id="email" name="email" type="email" class="validate" placeholder="Email">
						</div>
					</div>
					<div class="email_address-cls"></div>
					<div class="row">
						<div class="input-field col s12">
							<input id="phone" name="phone" type="phone" class="validate" placeholder="Phone (Optional)"/>
						</div>
					</div>
					<div class="phone-cls"></div>
					<div class="row">
						<div class="input-field col s12">
							<textarea id="message" name="message" class="materialize-textarea" placeholder="Message"></textarea>
						</div>
					<div class="message-cls"></div>
					</div>
					<button type="submit" name="submit" value="submit" id="login-btn" class="waves-effect waves-light btn-large">Send</button>
				</form>
			</div>
		</div>
	</section>
</div>