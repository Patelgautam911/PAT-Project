<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Parent Listing</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">Parent</li>
					</ol>
				</div>
			</div>
		</div>
	</section>
	<?php echo $this->session->flashdata('msg');?>
	<div class="successmsg"></div>
	<section class="content">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-header">
						<h3 class="card-title"><a href="<?php echo base_url();?>admin/addparent" class="btn btn-block btn-outline-primary">Add New Parent</a></h3>
					</div>
					<div class="card-body">
						<table id="parenttable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Create Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
							<tfoot>
								<tr>
									<th>Name</th>
									<th>Email</th>
									<th>Create Date</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
						 <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
					</div>
				</div>
			</div>
		</div>
	</section>
</div>