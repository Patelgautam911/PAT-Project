<div class="content-wrapper" style="min-height: 1200.88px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Class Form</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">Class Form</li>
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
							<h3 class="card-title">Class Form</h3>
						</div>
						<?php echo $this->session->flashdata('msg');
						if(!empty($class_data)){
						?>
							<form name="class_form" id="class_form" action="<?php echo base_url();?>admin/classedit/<?php echo $class_data['C_ID'];?>" method="post">
						<?php }else {?>
							<form name="class_form" id="class_form" action="<?php echo base_url();?>admin/saveclass" method="post">
						<?php }?>
							<div class="card-body">
								<div class="form-group">
									<label>School</label>
									<select class="form-control" id="schoolname" name="schoolname" >
										<option value="">-Select School-</option>
										<?php 
											foreach($School_data as $row){
										?>
											<option value="<?php echo $row['Sc_ID'];?>" <?php if(!empty($class_data['Sc_ID']) && $class_data['Sc_ID'] == $row['Sc_ID'] ){ echo 'selected';}?>><?php echo $row['Sc_Name'];?></option>
										<?php } ?>
									</select>
								</div>
								<div class="form-group">
									<label for="username">Class Name</label>
									<input type="text" class="form-control" id="classname" name="classname" placeholder="Enter Class Name" value="<?php if(!empty($class_data['C_Class_Name'])){ echo $class_data['C_Class_Name'];}?>">
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