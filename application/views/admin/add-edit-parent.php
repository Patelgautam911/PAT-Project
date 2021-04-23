<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Parent Form</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">Parent Form</li>
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
							<h3 class="card-title">Parent Form</h3>
						</div>
						<?php 
						echo $this->session->flashdata('msg');
						$readOnly = '';
						if(!empty($parent_data)){
							$readOnly = !empty($parent_data['P_Email']) ? 'readonly' : ''; 
						?>
							<form name="edit_parent_form" id="edit_parent_form" action="<?php echo base_url();?>admin/editparent/<?php echo $parent_data['P_ID'];?>" method="post">
						<?php } else{?>
							<form name="parent_form" id="parent_form" action="<?php echo base_url();?>admin/addparent" method="post">
						<?php }?>
							<div class="card-body">
								<div class="form-group">
									<label for="username">Name</label>
									<input type="text" class="form-control" id="username" name="username" placeholder="Enter Name" value="<?php if(!empty($parent_data['P_Name'])){echo $parent_data['P_Name'];}?>">
								</div>

								<div class="form-group">
									<label for="email">Email Address</label>
									<input type="email" class="form-control" id="email" name="email" placeholder="Enter email" value="<?php if(!empty($parent_data['P_Email'])){echo $parent_data['P_Email'];}?>" <?php echo $readOnly;?>>
								</div>
								<div class="form-group">
									<label for="phone">Phone Number</label>
									<input type="text" class="form-control" id="phone" name="phone" placeholder="Enter phone number" value="<?php if(!empty($parent_data['P_Phone'])){echo $parent_data['P_Phone'];}?>">
								</div>
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