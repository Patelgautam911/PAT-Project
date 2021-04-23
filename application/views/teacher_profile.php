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
<form action="<?php echo base_url();?>profile" method="post" id="profile_teacher" enctype="multipart/form-data">
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
						background-image: url('<?php echo base_url();?>/assets/images/<?php echo $teacher_profile->T_Image;?>');
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
							<input value="<?php echo $teacher_profile->T_Username;?>" id="username" name="username" type="text" class="validate" readonly="">
							<label class="active" for="username">UserName</label>
							<div class="edit_namecls"></div>
						</div>
						<div class="input-field col s6">
							<input value="<?php echo $teacher_profile->T_Email;?>" id="teacher_email" name="teacher_email" type="text" class="validate" readonly="">
							<label class="active" for="teacher_email">Email ID</label>
							<div class="edit_emailcls"></div>
						</div>
					</div>

</div>
</td>
</tr>
<tr>
	<td colspan="1">&nbsp;</td>
	<td colspan="3">
		<div class="row">
			<div class="input-field col s6">
				<select name="teacher_heightft" id="teacher_heightft">
					<option value="">Select Feet</option>
					<?php $i=1;
						for($i=1;$i<=7;$i++){
					?>
					<option value="<?php echo $i;?>" <?php if($teacher_profile->T_HeightFeet == $i){ echo 'selected';}?>><?php echo $i;?>'</option>
					<?php } ?>
				</select>
				<label>Feet</label>
			</div>
			<div class="input-field col s6">
				<select name="teacher_heightinch" id="teacher_heightinch">
					<option value="">Select Inch</option>
					<?php $i=1;
						for($i=1;$i<=11;$i++){
					?>
					<option value="<?php echo $i;?>"<?php if($teacher_profile->T_HeightInch == $i){ echo 'selected';}?>><?php echo $i;?>"</option>
					<?php } ?>
				</select>
				<label>Inch</label>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input value="<?php echo $teacher_profile->T_Weight;?>" id="teacher_weight" name="teacher_weight" type="text" class="validate">
				<label class="active" for="teacher_weight">Weight</label>
				<div class="edit_weightcls"></div>
			</div>
			<div class="input-field col s6">
				<input value="<?php echo $teacher_profile->T_Dob;?>" id="teacher_dob" min="01/01/1850" type="text" name="teacher_dob"  class="datepicker">
				<label class="active" for="teacher_dob">Date of Birth</label>
				<div class="edit_dobcls"></div>
			</div>
		</div>
		<div class="row">
			<div class="input-field col s6">
				<input value="<?php echo $teacher_profile->T_Phone;?>" id="teacher_phone" name="teacher_phone" type="text" class="validate">
				<label class="active" for="teacher_phone">Phone</label>
				<div class="teacher_phonecls"></div>
			</div>
			<div class="input-field col s6">
				<Button type="submit" id="edit" name="submit" value="submit" class="waves-effect waves-light btn">Update</Button>
			</div>
		</div>
	</td>
</tr>
<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
</form>