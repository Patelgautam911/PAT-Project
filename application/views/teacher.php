<div id="student--listing">
    <style type="text/css" media="screen">
        #addusername-error{
        color:red;
        }
        #addclass-error{ 
        color:red;
        }
        #addemail-error{
        color:red;
        }
        #addphone-error{
        color:red;
        } 
        #addpassword-error{
        color:red;
        }
        label[id$="error"]{
        color:red;
        margin-top:10px;
        padding-top: 1px;
        }
        .resource--table td,th,tr{
        text-align: right;
        }
        .resource--table th{
        text-align: right;
        }
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
                    <h2 class="phead"><strong>Teacher</strong></h2>
                </div>
                <div class="col s6 right-align">
                    <a href="#add-teacher" class="waves-effect waves-light btn-small modal-trigger"><i class="material-icons left dp48">add</i> Add Teacher</a>
                    <form id="search--bar" method="get" action="#">
                        <input type="search" name="search" id="search" placeholder="Search">
                        <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                    </form>
                </div>
            </div>
            <div class="sucessmsg">
                <?php echo $this->session->flashdata('msg');?>
            </div>
            <div class="row resource--table" id="student--table">
                <table class="highlight responsive-table">
                    <thead>
                        <tr>
                            <th>Teacher</th>
                            <th class="right-align">Class</th>
                        </tr>
                    </thead>
                </table>
                <?php $id = 1;
                    $teachers=array();
                    $teacher_email=array();
                    ?>
                <?php foreach ($teacher_data as $key => $value) {
                    array_push($teachers,$value['T_ID']);
                    array_push($teacher_email, $value['T_Email']);
                    $ar=array();
                    $ary=json_decode($value['T_Class'],true);
                    if(!empty($ary['C_ID'])){
                        $implode_class = implode(",", $ary['C_ID']);                       
                        $class_name = $this->TeacherModel->get_class_name($implode_class);
                    }
                   // foreach ($ary as $class_key => $class_value) { 
                   // }
                    ?>
                <div class="col s12" id="teacher_row<?php echo $id ?>">
                    <form id="edit_teacher<?php echo $id; ?>" action="edit_teacher" method="post" enctype="multipart/form-data">
                        <table class="highlight responsive-table">
                            <tbody>
                                <tr class="acc-header">
                                    <td><i class="material-icons left dp48 user--icon">account_circle</i>  <span class="user--name"><?php echo $value['T_Username']; ?></span>
                                    </td>
                                    <td class="right-align">
                                        <?php
                                            if(!empty($class_name)){
                                            	$Classes_name = array();
                                                foreach ($class_name as $row) {
                                                    $Classes_name[] = $row['C_Class_Name'];
                                                }
                                                echo implode(",", $Classes_name);
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <tr class="acc-body" style="display: none;">
                                    <td colspan="2">
                                        <div class="student--profile">
                                            <table width="100%">
                                                <tr>
                                                    <td class="right-align" colspan="2"> <a href="javascript:;" class="icon--close"><i class="material-icons">close</i></a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="profile" id="profile_img_edit<?php echo $id ?>"  style=" z-index: 1; background-position: center; background-size: 120px 120px; background-repeat: no-repeat; border-radius: 50% 50%;
                                                            background-image: url('assets/images/<?php echo $value['T_Image'] ?>');
                                                            ">
                                                            <span style="position: absolute; z-index: -2;" class="user--profile__edit"><input type="file" id="profile_image<?php echo $id ?>" name="profile_image" value="" placeholder="" style="opacity: 0; position: absolute; z-index: 3; height: 80%;width: 80%;"><i class="material-icons dp48">create
                                                            </i>
                                                            </span>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                               <div class="row">
                                                        <div style="float: right;" class="input-field col s6">
                                                             <strong>ID: <?php echo "PAT-T-".($value['T_ID']+100); ?></strong>
                                                         </div>
                                                     </div>
                                                            <div class="input-field col s6">
                                                                <input name="username" value="<?php echo $value['T_Username']; ?>" id="username<?php echo $id; ?>"   type="text" class="validate">
                                                                <label class="active" for="username<?php echo $id; ?>">Username</label>
                                                                <div class="usernamecls"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <select name="class[]" id="class<?php echo $id; ?>" multiple>
                                                                    <?php 
                                                                    $class_json = json_decode($value['T_Class']);
                                                                    ?>
                                                                    <?php foreach ($class_data as $cdk => $cdv):?>
                                                                    <option value="<?php echo $cdv['C_ID'];?>"<?php if(!empty($class_json->C_ID) && in_array($cdv['C_ID'], $class_json->C_ID)) { echo ' selected';}?>><?php echo $cdv['C_Class_Name'];?></option>
                                                                    <?php endforeach ?>
                                                                </select>
                                                                <label>Class</label>
                                                                <div class="classcls"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s6">
                                                                <input name="email" value="<?php echo $value['T_Email']; ?>" id="email<?php echo $id; ?>" type="text" class="validate">
                                                                <input type="text" name="id" value="<?php echo $value['T_Email']; ?>" readonly hidden placeholder="">
                                                                <label class="active" for="email<?php echo $id; ?>">Email ID</label>
                                                                <div class="emailcls"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <input name="userid" value="<?php echo $value['T_UserId']; ?>" id="userid<?php echo $id; ?>" type="text" class="validate">
                                                                <label class="active" for="userid<?php echo $id; ?>">User ID</label>
                                                                <div class="userid"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row student--ldet">
                                                            <div class="input-field col s6">
                                                                <select name="heightft" id="heightft<?php echo $id; ?>">
                                                                    <option value="0" disabled>Feet</option>
                                                                    <option value="1" <?php if ($value['T_HeightFeet']=="1"): echo "selected"; ?>
                                                                        <?php endif ?>>1'</option>
                                                                    <option value="2" <?php if ($value['T_HeightFeet']=="2"): echo "selected"; ?>
                                                                        <?php endif ?>>2'</option>
                                                                    <option value="3" <?php if ($value['T_HeightFeet']=="3"): echo "selected"; ?>
                                                                        <?php endif ?>>3'</option>
                                                                    <option value="4" <?php if ($value['T_HeightFeet']=="4"): echo "selected"; ?>
                                                                        <?php endif ?>>4'</option>
                                                                    <option value="5" <?php if ($value['T_HeightFeet']=="5"): echo "selected"; ?>
                                                                        <?php endif ?>>5'</option>
                                                                    <option value="6" <?php if ($value['T_HeightFeet']=="6"): echo "selected"; ?>
                                                                        <?php endif ?>>6'</option>
                                                                    <option value="7" <?php if ($value['T_HeightFeet']=="7"): echo "selected"; ?>
                                                                        <?php endif ?>>7'</option>
                                                                </select>
                                                                <label class="active" for="heightft<?php echo $id; ?>">
                                                                    <h6>Height</h6>
                                                                </label>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <select name="heightinch" id="heightinch<?php echo $id; ?>">
                                                                    <option value="0" disabled>Inch</option>
                                                                    <option value="1" <?php if ($value['T_HeightInch']=="1"): echo "selected"; ?>
                                                                        <?php endif ?>>1"</option>
                                                                    <option value="2" <?php if ($value['T_HeightInch']=="2"): echo "selected"; ?>
                                                                        <?php endif ?>>2"</option>
                                                                    <option value="3" <?php if ($value['T_HeightInch']=="3"): echo "selected"; ?>
                                                                        <?php endif ?>>3"</option>
                                                                    <option value="4" <?php if ($value['T_HeightInch']=="4"): echo "selected"; ?>
                                                                        <?php endif ?>>4"</option>
                                                                    <option value="5" <?php if ($value['T_HeightInch']=="5"): echo "selected"; ?>
                                                                        <?php endif ?>>5"</option>
                                                                    <option value="6" <?php if ($value['T_HeightInch']=="6"): echo "selected"; ?>
                                                                        <?php endif ?>>6"</option>
                                                                    <option value="7" <?php if ($value['T_HeightInch']=="7"): echo "selected"; ?>
                                                                        <?php endif ?>>7"</option>
                                                                    <option value="8" <?php if ($value['T_HeightInch']=="8"): echo "selected"; ?>
                                                                        <?php endif ?>>8"</option>
                                                                    <option value="9" <?php if ($value['T_HeightInch']=="9"): echo "selected"; ?>
                                                                        <?php endif ?>>9"</option>
                                                                    <option value="10" <?php if ($value['T_HeightInch']=="10"): echo "selected"; ?>
                                                                        <?php endif ?>>10"</option>
                                                                    <option value="11" <?php if ($value['T_HeightInch']=="11"): echo "selected"; ?>
                                                                        <?php endif ?>>11"</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="row student--ldet">
                                                            <div class="input-field col s6">
                                                                <input value="<?php echo $value['T_Weight'] ?>" id="weight<?php echo $id; ?>" name="weight" type="text" class="validate">
                                                                <label class="active" for="weight<?php echo $id; ?>">Weight (KG)</label>
                                                                <div class="weightcls"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <input value="<?php echo $value['T_BMI'] ?>" id="bmi<?php echo $id; ?>" name="bmi" type="text" class="validate">
                                                                <label class="active" for="bmi<?php echo $id; ?>">Body Mass Index</label>
                                                                <div class="bmicls"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s6">
                                                                <input value="<?php echo $value['T_Dob'] ?>" id="dob<?php echo $id; ?>" min="01/01/1850" type="text" name="dob"  class="datepicker">
                                                                <label class="active" for="dob<?php echo $id; ?>">Date of Birth</label>
                                                                <div class="dobcls"></div>
                                                            </div>
                                                            <div class="input-field col s6">
                                                                <input name="phone" value="<?php echo $value['T_Phone']; ?>" id="phone<?php echo $id; ?>" type="text" class="validate">
                                                                <label class="active" for="phone<?php echo $id; ?>">Phone</label>
                                                                <div class="phonecls"></div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="input-field col s6">
                                                                <input name="password" value="<?php echo $value['Password']; ?>" id="password<?php echo $id; ?>" type="text" class="validate">
                                                                <label class="active" for="password<?php echo $id; ?>">Password</label>
                                                                <div class="passwordcls"></div>
                                                            </div>
                                                        </div>
                                        </div>
                                        </td>
                                        </tr>
                                        <tr>
                                        <td class="right-align" colspan="2"> <a id="<?php echo $id ?>" href="#delete-teacher<?php echo $id ?>" class="modal-trigger modal-close waves-effect waves-green btn-flat">Delete</a>
                                        <Button type="submit" value="edit" id="edit<?php echo $id; ?>" class="modal-close waves-effect waves-light btn-small">Save</Button>
                                        </td>
                                        </tr>
                                        </table>
                </div>
                </td>
                </tr>
                </tbody>
                </table>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </form>
            </div>
            <?php $id++;?>
            <?php }?>
    </div>
    <!-- <ul class="pagination">
        <li><a href="#!"><i class="material-icons left">chevron_left</i><span>Previous Class</span></a>
        </li>
        <li><a href="#!"><i class="material-icons right">chevron_right</i> <span>Next Class</span></a>
        </li>
        </ul> -->
    <?php echo $pages ?>
    </section>
    <!-- Modal Structure Add Teacher -->
    <div id="add-teacher" class="modal">
        <div class="modal-content">
            <h4>Add Teacher</h4>
            <form id="add_teacher" class="col s12" action="add_teacher" method="post" enctype="multipart/form-data">
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
                                       <strong>ID: <?php echo "PAT-S-".($teacher_id+100); ?></strong>
                                            <input type="text" hidden="" name="teacher_id" value=" <?php echo "PAT-S-".($teacher_id+100); ?>" placeholder="">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input value="" id="addusername" name="addusername" type="text" class="validate">
                                        <label class="active" for="addusername">User Name</label>
                                        <div class="addusernamecls"></div>
                                    </div>
                                    <div class="input-field col s6">
                                        <select name="addclass[]" id="addclass" multiple>
                                        <?php foreach ($class_data as $key1 => $value1) {
                                            echo "<option value=\"" . $value1['C_ID'] . "\">" . $value1['C_Class_Name'] . "</option>";
                                            }?>
                                        </select>
                                        <label>Class</label>
                                        <div class="addclasscls"></div>
                                    </div>
                                </div>
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="1">&nbsp;</td>
                <td colspan="1">
                <div class="row student--ldet">
                <div class="input-field col s6">
                <input value="" id="addemail" name="addemail" type="text" class="validate">
                <label class="active" for="addemail">Email ID</label>
                <div class="addemailcls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="adduserid" name="adduserid" type="text" class="validate">
                <label class="active" for="adduserid">User ID</label>
                <div class="adduseridcls"></div>
                </div>
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="1">
                &nbsp;
                </td>
                <td colspan="1">
                <div class="row student--ldet">
                <div class="input-field col s6">
                <select name="addheightft" id="addheightft">
                <option value="0" disabled selected>Feet</option>
                <option value="1">1'</option>
                <option value="2">2'</option>
                <option value="3">3'</option>
                <option value="4">4'</option>
                <option value="5">5'</option>
                <option value="6">6'</option>
                <option value="7">7'</option>
                </select>
                <label class="active" for="addheightft"><h6>Height</h6></label>
                </div>  
                <div class="input-field col s6">
                <select name="addheightinch" id="addheightinch">
                <option value="0" disabled selected>Inch</option>
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
                </div>  
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="1">
                &nbsp;
                </td>
                <td colspan="1">
                <div class="row student--ldet">
                <div class="input-field col s6">
                <input value="" id="addweight" name="addweight" type="text" class="validate">
                <label class="active" for="addweight">Weight (KG)</label>
                <div class="addweightcls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="addbmi" name="addbmi" type="text" class="validate">
                <label id="lbladdmi" class="active" for="addbmi">Body Mass Index</label>
                <div class="addbmicls"></div>
                </div>
                </div>
                </td>
                </tr>
                <tr>
                <td colspan="1">
                &nbsp;
                </td>
                <td colspan="1">
                <div class="row student--ldet">
                <div class="input-field col s6">
                <input value="" id="adddob" min="01/01/1850" type="text" name="adddob"  class="datepicker">
                <label class="active" for="adddob">Date of Birth</label>
                <div class="adddobcls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="addphone" name="addphone" type="text" class="validate">
                <label class="active" for="addphone">Phone</label>
                <div class="addphonecls"></div>
                </div>
                <div class="input-field col s6">
                <input value="" id="addpassword" name="addpassword" type="password" class="validate">
                <label class="active" for="addpassword">Password</label>
                <div class="addpasswordcls"></div>
                </div>
                </div>
                </td>
                </tr>
                </table>
                <div class="modal-footer"> <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                    <Button type="submit" value="submit" id="save" class="waves-effect waves-light btn-small">Save</Button>
                </div>
                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
            </form>
        </div>
    </div>
    </div>
    <!-- Modal Structure -->
    <form method="post" action="" id="del">
        <?php for($j=1;$j<$id;$j++){ ?>
        <div id="delete-teacher<?php echo $j ?>" class="modal">
            <div class="modal-content">
                <h4>Delete Teacher</h4>
                <p>Are you sure you want to delete this teacher from the system</p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">No, Cancel</a>
                <div style='display: none'>
                    <input type="text" name="" id="token_id" value="" placeholder="">
                    <input type="text" name="delete_id" id="delete_id<?php echo $j ?>" value="<?php echo $teachers[$j-1] ?>" placeholder="">
                    <input type="text" name="delete_email" id="delete_email<?php echo $j ?>" value="<?php echo $teacher_email[$j-1] ?>" placeholder="">
                     <input type="hidden" id="y_delete_token<?php echo $j ?>" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>" />
                </div>
                <a href="#deleted" id="y_delete<?php echo $j ?>" class="modal-trigger modal-close waves-effect waves-light btn-small">Yes, Delete</a>
            </div>
       
        </div>
        <?php } ?>
    </form>
    <!-- Modal Structure for Student Profile Deleted -->
    <div id="deleted" class="modal" style="display: none;">
        <div class="modal-content">
            <p class="deleted-profile">
                <span><i class="material-icons dp48">check</i></span>
                You successfully deleted teacher information! <br/>Thanks
            </p>
        </div>
    </div>
    </div>
</div>