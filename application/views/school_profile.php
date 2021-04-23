<style type="text/css">
	.error{
		color: #f11010;
	}
	.sucess{
		color: green;
    	font-size: 16px;
    }
</style>
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
<form action="<?php echo base_url();?>profile" method="post" id="profile_school" enctype="multipart/form-data">
<tr class="acc-body">
<td colspan="5">
<div class="student--profile">
		<table width="100%">
			<tr>
				<td class="right-align" colspan="5"> <a class="icon--close" href="javascript:;"><i class="material-icons dp48">close</i></a>
				</td>
			<tr>
				<td>
					<div class="profile" id="profile_img_edit"  style=" z-index: 1; background-position: center; background-repeat: no-repeat; border-radius: 50% 50%;
						background-image: url('<?php echo base_url();?>assets/images/<?php echo $school_profile->Sc_Image;?>');
						">
						<span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
						</i>
						</span>
					</div>
				</td>
				<td colspan="4" class="user--top__detail">
					<div class="row">
						<div class="input-field col s6">
							<input type="text" name="update_email" value="" hidden>
							<input value="<?php echo $school_profile->Sc_Name;?>" id="school_name" name="school_name" type="text" class="validate">
							<label class="active" for="edit_name">School Name</label>
							<div class="edit_namecls"></div>
						</div>
						<div class="input-field col s6">
							<input value="<?php echo $school_profile->Sc_Email;?>" id="school_email" name="school_email" type="text" class="validate" readonly="">
							<label class="active" for="school_email">Email ID</label>
							<div class="edit_emailcls"></div>
						</div>
					</div>
					<div class="row">
					</div>
</div>
</td>
</tr>
<tr>
	<td colspan="1">&nbsp;</td>
	<td colspan="3">
		<div class="row">
			<div class="input-field col s6">
				<input value="<?php echo $school_profile->Sc_Phone;?>" id="school_phone" name="school_phone" type="text" class="validate">
				<label class="active" for="school_phone">Phone</label>
			</div>
			<div class="input-field col s6">
				<Button type="submit" name="submit" value="submit" id="edit" class="waves-effect waves-light btn">Update</Button>
			</div>
		</div>
		<div class="edit_phonecls"></div>
	</td>
</tr>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
</form>