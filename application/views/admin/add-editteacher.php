<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Teacher Form</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">Teacher Form</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<section class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="card card-primary">
						<div class="card-header">
							<h3 class="card-title">Teacher Form</h3>
						</div>
						<?php echo $this->session->flashdata('msg');
						if(!empty($teacherData)){
						?>
							<form name="edit_teacher_form" id="edit_teacher_form" action="<?php echo base_url();?>admin/editteacher/<?php echo $teacherData['T_ID'];?>" method="post">
						<?php } else{?>
							<form name="teacher_form" id="teacher_form" action="<?php echo base_url();?>admin/addteacher" method="post">
						<?php }?>
						<input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
							<div class="card-body">
								<div class="form-group">
									<label for="username">Name</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter Name" value="<?php if(!empty($teacherData['T_Username'])){echo $teacherData['T_Username'];}?>">
								</div>
								<div class="form-group">
									<label for="surname">SurName</label>
									<input type="text" class="form-control" id="surname" name="surname"placeholder="Enter Surname" value="<?php if(!empty($teacherData['T_Username'])){echo $teacherData['T_Username'];}?>">
								</div>
								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php if(!empty($teacherData['T_Email'])){echo $teacherData['T_Email'];}?>">
								</div>
								<div class="form-group">
									<label>School</label>
									<select class="form-control" id="schooledit" name="school" >
										<option value="">-Select School-</option>
										<?php 
											foreach($School_data as $row){
										?>
											<option value="<?php echo $row['Sc_ID'];?>" <?php if(!empty($teacherData['T_School']) && $teacherData['T_School'] == $row['Sc_ID'] ){ echo 'selected';}?>><?php echo $row['Sc_Name'];?></option>
										<?php } ?>
									</select>
								  </div>
								<div class="form-group">
									<label for="class">Class</label>
									<select class="form-control classcls studentclasscls" id="class" name="class[]" multiple="multiple">
										<option value="">-Select Class-</option>
										<?php 
										if(!empty($class_data)){
										$t_class = json_decode($teacherData['T_Class']);
										foreach($class_data as $row){ 
											?>
											<option value="<?php echo $row->C_ID;?>" <?php if(!empty($t_class) && in_array($row->C_ID, $t_class->C_ID)){ echo 'selected';}?>><?php echo $row->C_Class_Name;?></option>
										<?php } }?>
									</select>
								</div>
								<input type="hidden" name="teacher_id" value=" <?php echo "PAT-S-".($teacher_data_id+100); ?>" placeholder="">
							</div>
							<div class="card-footer">
								<input type= "submit" class="btn btn-primary" name="submit" value="Submit">
							</div>
							 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>