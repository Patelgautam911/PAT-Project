<div class="content-wrapper" style="min-height: 1200.88px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Student Form</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">Student Form</li>
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
							<h3 class="card-title">Student Form</h3>
						</div>
						<?php echo $this->session->flashdata('msg');
						$disabled = !empty($student_data['S_P_ID']) ? "disabled" : '';
						?>
						<form name="student_edit_form" id="student_edit_form" action="<?php echo base_url();?>admin/editstudent/<?php echo $student_data['S_ID']?>" method="post" enctype="multipart/form-data">
							<div class="card-body">
								<div class="form-group">
									<label for="username">Name</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter Name" value='<?php echo $student_data['S_Name'];?>'>
								</div>
								<div class="form-group">
									<label for="surname">SurName</label>
									<input type="text" class="form-control" id="surname" name="surname"placeholder="Enter Surname" value='<?php echo $student_data['S_Surname'];?>'>
								</div>
								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value='<?php echo $student_data['S_Email'];?>' readonly>
								</div>
								<div class="form-group">
									<label for="deviceid">Device ID</label>
									<input type="deviceid" class="form-control" id="deviceid" name="deviceid" placeholder="Enter email" value='<?php echo $student_data['S_BraceletID'];?>'>
								</div>
								<div class="form-group">
									<label>Parent Name</label>
									<select class="form-control" id="parentedit" name="parent" <?php echo $disabled;?>>
										<option value="">-Select Parent Name -</option>
										<?php 
											foreach($parent_data as $row){
										?>
											<option value="<?php echo $row['P_ID'];?>" <?php if(!empty($student_data['S_P_ID']) && $student_data['S_P_ID'] == $row['P_ID'] ){ echo 'selected';}?>><?php echo $row['P_Name'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label>School</label>
									<select class="form-control" id="schooledit" name="school" >
										<option value="">-Select School-</option>
										<?php 
											foreach($School_data as $row){
										?>
											<option value="<?php echo $row['Sc_ID'];?>" <?php if($student_data['S_School'] == $row['Sc_ID'] ){ echo 'selected';}?>><?php echo $row['Sc_Name'];?></option>
										<?php } ?>
									</select>
								  </div>
								<div class="form-group">
									<label for="class">Class</label>
									<select class="form-control studentclasscls" id="class" name="class">
										<option value="">-Select Class-</option>
										<?php 
											foreach($class_data as $row){ ?>
												<option value="<?php echo $row->C_ID;?>" <?php if($student_data['S_Class'] == $row->C_ID ){ echo 'selected';}?>><?php echo $row->C_Class_Name;?></option>
										<?php } ?>
									</select>
								</div>
							</div>
							<div class="card-footer">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
							 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>