<div class="content-wrapper">
   <section class="content-header">
      <div class="container-fluid">
         <div class="row mb-2">
            <div class="col-sm-6">
               <h1>Teacher Listing</h1>
            </div>
            <div class="col-sm-6">
               <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="<?php echo base_url();?>admin/home">Home</a></li>
                  <li class="breadcrumb-item active">Teacher</li>
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
                  <h3 class="card-title"><a href="<?php echo base_url();?>admin/addteacher" class="btn btn-block btn-outline-primary">Add New Teacher</a></h3>
                   <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
               </div>
               <div class="card-body">
                  <table id="teachertable" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Name</th>
                           <th>DOB</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>School</th>
                           <th>Create Date</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                     </tbody>
                     <tfoot>
                        <tr>
                           <th>Name</th>
                           <th>DOB</th>
                           <th>Email</th>
                           <th>Phone</th>
                           <th>School</th>
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