<div class="content-wrapper">
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>School Listing</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
						<li class="breadcrumb-item active">School</li>
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
						<h3 class="card-title"><a href="<?php echo base_url();?>admin/addschool" class="btn btn-block btn-outline-primary">Add New School</a></h3>
					</div>
					<div class="card-body">
						<table id="schooltable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th>Name</th>
									<th>CreatedDate</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($allSchool as $row){?>
									<tr>
										<td><?php echo $row['Sc_Name'];?></td>
										<td><?php echo $row['Created_date']?></td>
										<td><a href="editschool/<?php echo $row['Sc_ID']?>"><i class="fas fa-edit"></i></a></td>
									</tr>
								<?php } ?>
							</tbody>
							<tfoot>
								<tr>
									<th>Name</th>
									<th>Create Date</th>
									<th>Action</th>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>