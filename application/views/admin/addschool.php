<div class="content-wrapper" style="min-height: 1200.88px;">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>School Form</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">School Form</li>
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
							<h3 class="card-title">School Form</h3>
						</div>
						<?php echo $this->session->flashdata('msg');
						if(!empty($school_data)){
						?>
							<form name="school_form" id="school_form" action="<?php echo base_url();?>admin/edit/<?php echo $school_data['Sc_ID']?>" method="post">
						<?php }else {?>
							<form name="school_form" id="school_form" action="<?php echo base_url();?>admin/save" method="post">
						<?php }?>
							<div class="card-body">
								<div class="form-group">
									<label for="schoolname">School Name</label>
									<input type="text" class="form-control" id="schoolname" name="schoolname" placeholder="Enter Name" value="<?php if(!empty($school_data['Sc_Name'])){ echo $school_data['Sc_Name'];}?>">
								</div>
								<div class="form-group">
									<label for="schoolemail">Email</label>
									<input  type="text" class="form-control" id="schoolemail" name="schoolemail" placeholder="Enter Email" value="<?php if(!empty($school_data['Sc_Email'])){ echo $school_data['Sc_Email'];}?>" <?php if(!empty($school_data['Sc_Email'])){ echo "disabled";}?> >
								</div>
								<div class="form-group">
									<label for="schoolphone">Phone</label>
									<input type="text" class="form-control" id="schoolphone" name="schoolphone" placeholder="Enter Phone Number" value="<?php if(!empty($school_data['Sc_Phone'])){ echo $school_data['Sc_Phone'];}?>">
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