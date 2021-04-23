<div id="student--listing">
    <style type="text/css" media="screen">
        .error{
        color:red;
        } 
        .sucessmsg{
            color: green;
            margin-left: 27px;
            font-size: 18px;
        }
    </style>
    <div class="container">
        <section class="content">
            <div class="row valign-wrapper">
                <div class="col s6">
                    <h2 class="phead">
                        <strong>Class</strong>
                        <span><?php echo $class_name;?></span>
                    </h2>
                    <p class="total--student"> <?php if(count($teachers_data)>1){echo "Teachers";}else{ echo "Teacher";} ?><?php $i=0; foreach ($teachers_data as $key => $value): ?>
                        <strong> <?php echo $value['T_Username'] ?> <?php if (count($teachers_data)>1 && count($teachers_data)-1!=$i){echo ",";} ?>
                        </strong> 
                        <?php $i++; endforeach ?> 
                        <br/><?php 
                        $totalstudents = !empty($totalstudentCount) ? count($totalstudentCount) : 0;
                        echo $totalstudents." Students";
                        ?>
                    </p>
                </div>
                <div class="col s6 right-align">
                    <a href="#add-student" class="waves-effect waves-light btn-small modal-trigger"><i class="material-icons left dp48">add</i> Add Student</a>
                    <form id="search--bar" method="get" action="#">
                        <input type="search" placeholder="Search" name="search">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                    </form>
                </div>
            </div>
            <div class="sucessmsg">
                <?php echo $this->session->flashdata('msg');?>
            </div>
            <div class="row resource--table" id="student--table">
                <div class="col s12">
                    <table class="highlight responsive-table">
                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Total
                                    <br/>Steps
                                </th>
                                <th>Total
                                    <br/>Meters
                                </th>
                                <th>Total
                                    <br/>Jumps
                                </th>
                                <th>Pat
                                    <br/>Points
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $id=1; 
                                $students=array();
                                $student_email=array(); 
                                foreach ($student_data as $key => $value): 
                                array_push($students,$value['S_ID']);
                                array_push($student_email, $value['S_Email']);
                                if(!empty($student_track_data)){
                                    foreach($student_track_data as $track_data){
                                        if($track_data['S_Email'] == $value['S_Email']){
                                ?>
                                <tr id="student_row<?php echo $id ?>" class="acc-header">
                                    <td><i class="material-icons left dp48 user--icon">account_circle</i>  <span class="user--name"><?php echo $track_data['S_Name']; ?></span>
                                    </td>
                                    <td><?php echo !empty($track_data['Total_Steps']) ? $track_data['Total_Steps'] : "0"; ?></td>
                                    <td><?php echo !empty($track_data['Total_Meters']) ? $track_data['Total_Meters'] : "0"; ?></td>
                                    <td><?php echo !empty($track_data['Total_Jumps']) ? $track_data['Total_Jumps']: "0"; ?></td>
                                    <td><?php echo !empty($track_data['Average_Steps']) && !empty($track_data['Activity_Time']) ? round(($track_data['Activity_Time']*$track_data['Average_Steps'])/10) : "0"; ?></td>
                                </tr>
                            <?php  }else{?>
                              <!--   <tr class="acc-header">
                                    <td><i class="material-icons left dp48 user--icon">account_circle</i>  <span class="user--name"><?php echo $value['S_Name']; ?></span>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr> -->
                            <?php } } } else{?>
                                 <tr class="acc-header">
                                    <td><i class="material-icons left dp48 user--icon">account_circle</i>  <span class="user--name"><?php echo $value['S_Name']; ?></span>
                                    </td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                    <td>0</td>
                                </tr>
                            <?php } ?>
                            <tr  class="acc-body" style="display: none;">
                                <td colspan="5">
                                    <div class="student--profile">
                                        <form action="../edit_student" method="post" id="edit_student<?php echo $id; ?>" enctype="multipart/form-data">
                                            <table width="100%">
                                                <tr>
                                                    <td class="right-align" colspan="5"> <a class="icon--close" href="javascript:;"><i class="material-icons dp48">close</i></a>
                                                    </td>
                                                <tr>
                                                    <td>
                                                        <div class="profile" id="profile_img_edit<?php echo $id ?>"  style=" z-index: 1; background-position: center; background-size: 120px 120px; background-repeat: no-repeat; border-radius: 50% 50%;
                                                            background-image: url('../assets/images/<?php echo $value['S_Image'] ?>');
                                                            ">
                                                            <span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image<?php echo $id ?>" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
                                                            </i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td colspan="4" class="user--top__detail">
                                                        <div class="row">
                                                        <div style="float: right;" class="input-field col s6">
                                                             <strong>ID: <?php echo "PAT-S-".($value['S_ID']+100); ?></strong>
                                                             <input type="text" name="" id="s_id<?php echo $id ?>" value="<?php echo $value['S_ID']; ?>" placeholder="" hidden>
                                                             <input type="text" name="" id="s_class<?php echo $id ?>" value="<?php echo $value['S_Class']; ?>" placeholder="" hidden>
                                                         </div>
                                                     </div>
                                                        <div class="row">
                                                             
                                                            <div class="input-field col s6">
                                                                <input type="text" name="update_email" value="<?php echo $value['S_Email'] ?>" hidden>
                                                                <input value="<?php echo $value['S_Name'] ?>" id="edit_name<?php echo $id ?>" name="edit_name" type="text" class="validate">
                                                                <label class="active" for="edit_name<?php echo $id ?>">Name</label>
                                                                <div class="edit_namecls<?php echo $id ?>"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <select name="edit_class" id="edit_class<?php echo $id ?>">
                                                                    <?php foreach ($class_data as $k=> $v) {?>
                                                                    <option value="<?php echo $v['C_ID'] ?>" <?php if($v['C_ID']==$value['S_Class']){echo "selected";} ?>><?php echo $v['C_Class_Name'] ?></option>
                                                                    <?php  } ?>
                                                                </select>
                                                                <label>Class</label>
                                                                <div class="edit_classcls<?php echo $id ?>"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s6">
                                                                <input value="<?php echo $value['S_BraceletID'] ?>" id="edit_braceletid<?php echo $id ?>" name="edit_braceletid" type="text" class="validate">
                                                                <label class="active" for="edit_braceletid<?php echo $id ?>">Bracelet ID</label>
                                                                <div class="edit_braceletidcls<?php echo $id ?>"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <input value="<?php echo $value['S_Email'] ?>" id="edit_email<?php echo $id ?>" name="edit_email" type="text" class="validate">
                                                                <label class="active" for="edit_email<?php echo $id ?>">Email ID</label>
                                                                <div class="edit_emailcls<?php echo $id ?>"></div>
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
                                                    <select name="edit_heightft" id="edit_heightft<?php echo $id ?>">
                                                        <option disabled="">Feet</option>
                                                        <option value="1" <?php if($value['S_HeightFeet']==1){echo "selected";} ?> >1'</option>
                                                        <option value="2" <?php if($value['S_HeightFeet']==2){echo "selected";} ?>>2'</option>
                                                        <option value="3" <?php if($value['S_HeightFeet']==3){echo "selected";} ?>>3'</option>
                                                        <option value="4" <?php if($value['S_HeightFeet']==4){echo "selected";} ?>>4'</option>
                                                        <option value="5" <?php if($value['S_HeightFeet']==5){echo "selected";} ?>>5'</option>
                                                        <option value="6" <?php if($value['S_HeightFeet']==6){echo "selected";} ?>>6'</option>
                                                        <option value="7" <?php if($value['S_HeightFeet']==7){echo "selected";} ?>>7'</option>
                                                    </select>
                                                    <label>Feet</label>
                                                </div>
                                                <div class="input-field col s6">
                                                    <select name="edit_heightinch" id="edit_heightinch<?php echo $id ?>">
                                                        <option disabled="">Inch</option>
                                                        <option value="1" <?php if($value['S_HeightInch']==1){echo "selected";} ?>>1"</option>
                                                        <option value="2" <?php if($value['S_HeightInch']==2){echo "selected";} ?>>2"</option>
                                                        <option value="3" <?php if($value['S_HeightInch']==3){echo "selected";} ?>>3"</option>
                                                        <option value="4" <?php if($value['S_HeightInch']==4){echo "selected";} ?>>4"</option>
                                                        <option value="5" <?php if($value['S_HeightInch']==5){echo "selected";} ?>>5"</option>
                                                        <option value="6" <?php if($value['S_HeightInch']==6){echo "selected";} ?>>6"</option>
                                                        <option value="7" <?php if($value['S_HeightInch']==7){echo "selected";} ?>>7"</option>
                                                        <option value="8" <?php if($value['S_HeightInch']==8){echo "selected";} ?>>8"</option>
                                                        <option value="9" <?php if($value['S_HeightInch']==9){echo "selected";} ?>>9"</option>
                                                        <option value="10" <?php if($value['S_HeightInch']==10){echo "selected";} ?>>10"</option>
                                                        <option value="11" <?php if($value['S_HeightInch']==11){echo "selected";} ?>>11"</option>
                                                    </select>
                                                    <label>Inch</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['S_Weight'] ?>" id="edit_weight<?php echo $id ?>" name="edit_weight" type="text" class="validate">
                                                    <label class="active" for="edit_weight<?php echo $id ?>">Weight</label>
                                                    <div class="edit_weightcls<?php echo $id ?>"></div>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['S_BMI'] ?>" name="edit_bmi" id="edit_bmi<?php echo $id ?>" type="text" class="validate">
                                                    <label class="active" for="edit_bmi<?php echo $id ?>">Body Mass Index</label>
                                                    <div class="edit_bmicls<?php echo $id ?>"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['S_Dob']; ?>" id="edit_dob<?php echo $id ?>" min="01/01/1850" type="text" name="edit_dob"  class="datepicker">
                                                    <label class="active" for="edit_dob<?php echo $id ?>">Date of Birth</label>
                                                    <div class="edit_dobcls<?php echo $id ?>"></div>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['S_Gender']; ?>" id="edit_gender<?php echo $id ?>" name="edit_gender" type="text"  class="validate">
                                                    <label class="active" for="edit_gender<?php echo $id ?>">Gender</label>
                                                    <div class="edit_gendercls<?php echo $id ?>"></div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['S_Phone']; ?>" id="edit_phone<?php echo $id ?>" name="edit_phone" type="text" class="validate">
                                                    <label class="active" for="edit_phone<?php echo $id ?>">Phone</label>
                                                    <div class="edit_phonecls<?php echo $id ?>"></div>
                                                </div>
                                                <div class="input-field col s6">
                                                    <input value="<?php echo $value['Password']; ?>" id="edit_password<?php echo $id ?>" name="edit_password" type="text" class="validate">
                                                    <label class="active" for="edit_password<?php echo $id ?>">Password</label>
                                                    <div class="edit_passwordcls<?php echo $id ?>"></div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="1">&nbsp;</td>
                                        <td colspan="1">
                                            <div class="row">
                                                <div class="input-field col s12"> <a id="<?php echo $id ?>" href="#delete-student<?php echo $id ?>" class="modal-trigger modal-close waves-effect waves-green btn-flat">Delete</a>
                                                    <Button type="submit" id="edit" class="waves-effect waves-light btn">Save</Button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </table>
                </div>
                </td>
                </tr>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </form>
                <?php $id++; 
           
            endforeach ?>
                </tbody>
                </table>
            </div>
    </div>
    <div class="row valign-wrapper">
    <!-- <ul class="pagination">
        <li><a href="#!"><i class="material-icons left">chevron_left</i><span>Previous Class</span></a>
        </li>
        <li><a href="#!"><i class="material-icons right">chevron_right</i> <span>Next Class</span></a>
        </li>
        </ul> -->
    </div>
    <?php echo $pages ?>
    </section>
    <!-- Modal Structure Add Student -->
    <div id="add-student" class="modal">
        <div class="modal-content">
            <h4>Add Student</h4>
            <form action="../add_student" method="post" id="add_student" class="col s12" enctype="multipart/form-data">
                <div class="student--profile">
                    <table width="100%">
                        <tr>
                            <td>
                                <div class="profile" id="profile_img"  style=" z-index: 1; background-position: center; background-size: 120px 120px; background-repeat: no-repeat; border-radius: 50% 50%;"><i id="person_font" class="material-icons dp48 user--profile__icon">person</i>
                                    <span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
                                    </i>
                                    </span>
                                </div>
                            </td>
                            <td colspan="4" class="user--top__detail">
                                <div class="row">
                                    <div class="input-field col s6">
                                       <strong>ID: <?php echo "PAT-S-".($student_id+100); ?></strong>
                                             <input type="text" hidden="" name="student_id" value=" <?php echo "PAT-S-".($student_id+100); ?>" placeholder="">
                                    </div>
                                </div>
                                     <div class="row">
                                    <div class="input-field col s6">
                                        <input value="" id="name" name="name" type="text" class="validate">
                                        <label class="active" for="name">Name</label>
                                        <div class="namecls"></div>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="class" id="class">
                                            <?php foreach ($class_data as $key => $value): ?>
                                           <option value="<?php echo $value['C_ID'] ?>"<?php if($class_id == $value['C_ID']){  echo "selected";}?>><?php echo $value['C_Class_Name'] ?></option>
                                            <?php endforeach ?>
                                        </select>
                                        <label>Class</label>
                                        <div class="classcls"></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input value="" id="braceletid" name="braceletid" type="text" class="validate">
                                        <label class="active" for="braceletid">Bracelet ID</label>
                                        <div class="braceletidcls"></div>
                                    </div>
                                    <div class="input-field col s6">
                                        <input value="" id="email" name="email" type="text" class="validate">
                                        <label class="active" for="email">Email ID</label>
                                        <div class="emailcls"></div>
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
                <select name="heightft" id="heightft">
                <option selected="" disabled="">Feet</option>
                <option value="1">1'</option>
                <option value="2">2'</option>
                <option value="3">3'</option>
                <option value="4">4'</option>
                <option value="5">5'</option>
                <option value="6">6'</option>
                <option value="7">7'</option>
                </select>
                <label>Feet</label>
                </div> 
                <div class="input-field col s6">
                <select name="heightinch" id="heightinch">
                <option selected="" disabled="">Inch</option>
                <option value="1">1"</option>
                <option value="2">2"</option>
                <option value="3">3"</option>
                <option value="4">4"</option>
                <option value="5">5"</option>
                <option value="6">6"</option>
                <option value="7">7"</option>
                <option value="8">8"</option>
                <option value="9">9"</option>
                <option value="10">10"</option>
                <option value="11">11"</option>
                </select>
                <label>Inch</label>
                </div>
                </div>
                <div class="row">
                <div class="input-field col s6">
                <input value="" id="weight" name="weight" type="text" class="validate">
                <label class="active" for="weight">Weight</label>
                <div class="weightcls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" name="bmi" id="bmi" type="text" class="validate">
                <label class="active" for="bmi">Body Mass Index</label>
                <div class="bmicls"></div>
                </div>
                </div>
                <div class="row">
                <div class="input-field col s6">
                <input value="" id="dob" min="01/01/1850" type="text" name="dob"  class="datepicker">
                <label class="active" for="dob">Date of Birth</label>
                <div class="dobcls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="gender" name="gender" type="text"  class="validate">
                <label class="active" for="gender">Gender</label>
                <div class="gendercls"></div>
                </div>
                </div>
                <div class="row">
                <div class="input-field col s6">
                <input value="" id="phone" name="phone" type="text" class="validate">
                <label class="active" for="phone">Phone</label>
                <div class="phonecls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="password" name="password" type="text" class="validate">
                <label class="active" for="password">Password</label>
                <div class="passwordcls"></div>
                </div>
                </div>
                </td>
                </tr>
                </table>
        </div>
    </div>
    <div class="modal-footer"> <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    <Button type="submit" href="#!" id="save" class="waves-effect waves-light btn-small">Save</Button>
    <input type="hidden" id="token" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
    </form>
    </div>
</div>
<!-- Modal Structure for Delete Student -->
<form method="post" action="" id="del">
    <?php for($j=1;$j<$id;$j++){ ?>
    <div id="delete-student<?php echo $j ?>" class="modal">
        <div class="modal-content">
            <h4>Delete Student</h4>
            <p>Are you sure you want to delete this student from the system</p>
        </div>
        <div class="modal-footer">
            <a href="#!" class="modal-close waves-effect waves-green btn-flat">No, Cancel</a>
            <div style='display: none'>
                <input type="text" name="delete_id" id="delete_id<?php echo $j ?>" value="<?php echo $students[$j-1] ?>" placeholder="">
                <input type="text" name="delete_email" id="delete_email<?php echo $j ?>" value="<?php echo $student_email[$j-1] ?>" placeholder="">
                 <input type="hidden" id="s_delete_token<?php echo $j ?>" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            </div>
            <a href="#deleted" id="s_delete<?php echo $j ?>" class="modal-trigger modal-close waves-effect waves-light btn-small">Yes, Delete</a>
        </div>
    </div>
    <?php } ?>
   
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
</div>