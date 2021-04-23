<body>
   <style type="text/css" media="screen">
      .error{
         color:red;
      }   
   </style>
   <div id="student--listing">
      <div class="container">
         <section class="content">
            <div class="row valign-wrapper">
               <div class="col s6">
                  <h2 class="phead">Classes</h2>
               </div>
               <div class="col s6 right-align">
                  <?php if ($this->session->userdata('role')==3): ?>
                     <a href="#add-class" class="waves-effect waves-light btn-small modal-trigger"><i class="material-icons left dp48">add</i> Add Class</a>
                  <?php endif ?>
                  <form id="search--bar" method="get" action="#">
                     <input type="search" name="search" placeholder="Search by Class">
                     <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                  </form>
               </div>
            </div>
            <div class="row resource--table" id="class--table">
               <div class="col s12">
                  <table class="highlight responsive-table">
                     <thead>
                        <tr>
                           <th>Classes</th>
                           <th class="right-align">Student</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php if (!empty($classes_list)): ?>
                           <?php $j=0; foreach ($classes_list as $key => $value): ?>  
                              <?php if ($this->session->userdata('role')==2): ?>
                                 <tr class="acc-header" onclick="window.location='student/<?php echo $value[0] ?>'">
                                 <td><?php echo $value[1] ?></td>
                                 <td class="right-align"><?php echo $value[2] ?></td>
                              </tr>

                           <?php endif ?>
                           <?php if ($this->session->userdata('role')==3): $C_ID[$j]=$value[0]; ?>
                              <tr class="acc-header" id="class_row<?php echo $j; ?>">
                                 <td><?php echo $value[1] ?></td>
                                 <td onclick="window.location='student/<?php echo $value[0] ?>'" class="right-align"><?php echo $value[2] ?></td>
                              </tr>
                              <tr class="acc-body" style="display: none;">
                                 <td>
                                    <div>
                                      <form method="post" id="add_class" action="edit_class" class="col s12">
                                       <div class="row">
                                          <div class="input-field col s6">
                                             <input id="class_name" name="class_name" value="<?php echo $value[1]; ?>" type="text" class="validate">
                                             <label for="class_name">Class Name</label>
                                             <div class="class_namecls"></div>
                                          </div>
                                          <div class="input-field col s6">
                                             <strong>ID: <?php echo "PAT".($value[0]+100) ?></strong>
                                             <input type="text" hidden="" name="class_id" value=" <?php echo "PAT".($value[0]+100) ?>" placeholder="">
                                             <input type="text" name="C_ID" hidden="" value="<?php echo $value[0] ?>" placeholder="">
                                          </div>

                                       </div>
                                       <div class="row">
                                        <div class="input-field col s6">

                                          <select name="teachers[]" id="teachers" multiple>
                                             <?php foreach ($teachers_data as $key1 => $value1): ?>
                                                <option value="<?php echo $value1['T_ID'] ?>" <?php foreach (json_decode($value1['T_Class'])->C_ID as $key2 => $value2): ?>
                                                <?php if ($value[0]==$value2): ?>
                                                   selected
                                                <?php endif ?>
                                                <?php endforeach ?> ><?php echo $value1['T_Username']?></option>
                                             <?php endforeach ?>
                                          </select>
                                          <label for="teachers">Add Teachers In Class</label>
                                          <div class="teacherscls"></div>
                                       </div> 
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <input href="#delete-class<?php echo $j; ?>" type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                    <a href="#delete-class<?php echo $j; ?>"  class="modal-trigger waves-effect waves-green btn-flat">Delete</a>
                                    <button type="submit" class="waves-effect waves-light btn-small">Save</button>
                                    <!-- <button type="submit" class="modal-close waves-effect waves-light btn-small">Save</button> -->
                                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                                 </form>

                              </div>
                           </td>
                           <td>
                              <div>

                              </div>
                           </td>
                        </tr>
                     <?php $j++; endif ?>
                  <?php endforeach ?>
               <?php endif ?>
            </tbody>
         </table>
      </div>
   </div>
           <!--  <div class="row valign-wrapper">
               <ul class="pagination">
                  <li><a href="#!"><i class="material-icons left">chevron_left</i>Previous<br/> Class</a></li>
                  <li><a href="#!"><i class="material-icons right">chevron_right</i> Next<br/>Class</a></li>
               </ul>
            </div> -->
            <?php echo $pages ?>
         </section>

         <!-- Modal Structure -->
      <div id="add-class" class="modal">
         <div class="modal-content">
            <h4>Add Class</h4>
            <form method="post" id="add_class_model" action="add_class" class="col s12">
               <div class="row">
                  <div class="input-field col s6">
                     <input id="model_class_name" name="class_name" type="text" class="validate">
                     <label class="active" for="model_class_name">Class Name</label>
                     <div class="class_namecls"></div>
                  </div>
                  <div class="input-field col s6">
                     <strong>ID: <?php echo "PAT".($class_id+100) ?></strong>
                     <input type="text" hidden="" name="class_id" value=" <?php echo "PAT".($class_id+100) ?>" placeholder="">
                  </div>

               </div>
               <div class="row">
                <div class="input-field col s6">

                  <select name="teachers[]" id="teachers" multiple>
                     <?php foreach ($teachers_data as $key => $value): ?>
                        <option value="<?php echo $value['T_ID'] ?>"><?php echo $value['T_Username']?></option>
                     <?php endforeach ?>
                  </select>
                  <label for="teachers">Add Teachers In Class</label>
                  <div class="teacherscls"></div>
               </div> 
            </div>
         </div>
         <div class="modal-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            <button type="button" class="modal-close waves-effect waves-green btn-flat">Close</button>
            <button type="submit" class="waves-effect waves-light btn-small">Save</button>
            <!-- <button type="submit" class="modal-close waves-effect waves-light btn-small">Save</button> -->
      </div>
         </form>
   </div>
</div>

</div>
      <form method="post" action="" id="del">
         <?php if (!empty($classes_list)): ?>
            
         
<?php $j=0; foreach ($classes_list as $key => $value): ?>  
   <?php if ($this->session->userdata('role')==3): ?>
        <div id="delete-class<?php echo $j ?>" class="modal">
            <div class="modal-content">
                <h4>Delete Class</h4>
                <p>Are you sure you want to delete this Class from the system</p>
            </div>
            <div class="modal-footer">
                
                <div style='display: none'>
                    <input type="text" name="delete_id" id="delete_id<?php echo $j ?>" value="<?php echo $C_ID[$j] ?>" placeholder="">
                   
                    <input type="hidden" id="s_delete_token<?php echo $j ?>" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </div>
                <a href="#deleted" id="c_delete<?php echo $j ?>" class="modal-trigger modal-close waves-effect waves-light btn-small">Yes, Delete</a>
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">No, Cancel</a>
            </div>
        </div>   

   <?php $j++; endif ?>
<?php  endforeach ?>
<?php endif ?>
</form>
<!-- Modal Structure for Student Profile Deleted -->
<div class="modal" id="deleted" style="display: none;">
    <div class="modal-content">
        <p class="deleted-profile">
            <span><i class="material-icons dp48">check</i></span>
            You successfully deleted student information! <br/>Thanks
        </p>
    </div>
</div>