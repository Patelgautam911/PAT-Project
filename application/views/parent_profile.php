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
<form action="<?php echo base_url();?>profile" method="post" id="profile_parent" enctype="multipart/form-data">
	<tr class="acc-body">
		<td colspan="5">
			<div class="student--profile">
				<table width="100%">
	<tr>
	<td class="right-align" colspan="5"> <a class="icon--close" href="javascript:;"><i class="material-icons dp48">close</i></a>
	</td>
	<tr>
	<td>
	<?php if(!empty($parent_profile->P_image)){?>
		<div class="profile" id="profile_img_edit"  style=" z-index: 1; background-position: center;background-repeat: no-repeat; border-radius: 50% 50%;
			background-image: url('<?php echo base_url();?>assets/images/<?php echo $parent_profile->P_image;?>');
			">
			<span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
			</i>
			</span>
		</div>
	<?php }else{?>
		<div class="profile" id="profile_img_edit"  style=" z-index: 1; background-position: center;background-repeat: no-repeat; border-radius: 50% 50%;
			background-image: url('<?php echo base_url();?>assets/images/<?php echo $student_profile->S_Image;?>');
			">
			<span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
			</i>
			</span>
		</div>
	<?php }?>
	</td>
	<td colspan="4" class="user--top__detail">
	<div class="row">
	<div class="input-field col s6">
	<input type="text" name="update_email" value="" hidden>
	<input value="<?php echo !empty($parent_profile->Username) ? $parent_profile->Username : $student_profile->Username;?>" id="username" name="username" type="text" class="validate" readonly>
	<label class="active" for="edit_name">User Name</label>
	<div class="edit_namecls"></div>
	</div>
	<div class="input-field col s6">
	<input value="<?php echo !empty($parent_profile->P_Email) ? $parent_profile->P_Email : $student_profile->S_Email;?>" id="parent_email" name="parent_email" type="text" class="validate" readonly="">
	<label class="active" for="parent_email">Email ID</label>
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
					<input value="<?php echo !empty($parent_profile->P_Phone) ? $parent_profile->P_Phone :$student_profile->S_Phone;?>" id="parent_phone" name="parent_phone" type="text" class="validate">
					<label class="active" for="parent_phone">Phone</label>
				</div>
				<div class="input-field col s6">
					<Button type="submit" name="submit" value="submit" id="edit" class="waves-effect waves-light btn">Update</Button>
				</div>
			</div>
			<div class="parent_phonecls"></div>
		</td>
	</tr>
	<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
</form>