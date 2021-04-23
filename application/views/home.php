<div id="student--listing">
	<section class="container">
		<div class="row" id="student--activity__info">
			<div class="col s12">
				<div class="col s2 profile--icon">
					<i class="material-icons dp48">person</i>
				</div>

				<div class="col s9 user--name">
					<?php if($this->session->userdata('role')==3){?>
						<p><strong>Hello <?php echo $this->session->userdata('Sc_Name');?></strong></p>
					<?php } else{?>
						<p><strong>Hello <?php echo $this->session->userdata('username');?></strong></p>
					<?php }?>
					<p>Track your students activity</p>
				</div>
				<div class="col s1 right-align">
					<!-- 2 for Teacher,3 for school, 4 for parent -->
					<a class="waves-effect waves-light btn edit-btn" href="<?php echo base_url();?>profile"><i class="material-icons dp48 right">create</i></a>

				</div>
				<div class="col s9 user--activity">
					<p>Filter activity by the last </p>
					<div class="filter--tabs">
						<ul>
							<li><a href="dashboard?days=1" class="dayFilter <?php echo $this->input->get('days')==1 ? "active" : ""; ?>">1 Day</a></li>
							<li><a href="dashboard?days=7" class="dayFilter <?php echo $this->input->get('days')==7 ? "active" : ""; ?>">1 Week</a></li>
							<li><a href="dashboard?days=30" class="dayFilter <?php echo $this->input->get('days')==30 ? "active" : ""; ?>">1 Month</a></li>
							<li><a href="dashboard?days=90" class="dayFilter <?php echo $this->input->get('days')==90 ? "active" : ""; ?>">3 Month</a></li>
							<li class="date--range"><input type="text" name="daterange" value="<?php if(!empty($_GET['days'])){echo $_GET['days'];}?>" placeholder="Select date range" id="daterange" class="daterange dayFilter " /></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<ul class="tabs" id="tabs-swipe-demo" style="display: contents;">
			<?php if ($this->session->userdata('role')!=4): ?>
				<li class="tab"><a id="all_class" href="#all-class">All Classes</a></li>
			<?php endif ?>
			<?php  if ($this->session->userdata('role')!=4): ?>
				<?php $i=1; foreach ($classes_data as $key => $value): ?>
				<li class="tab"><a class="class_tab" href="#<?php echo $i ?>"><?php echo $value['C_Class_Name'];  ?></a></li>
				<?php $i++; endforeach ?>
			<?php endif ?>
		</ul>
		<div id="all-class" class="col s12 tabs--content">
			<?php if(!empty($to_date) && !empty($from_date)){?>
				<p class="show--act">Showing activity from <strong><?php echo $from_date;?> to <?php echo $to_date;?> for ALL CLASSES</strong></p>
			<?php } else{
				if(!empty($activity_date)){
					$activitys_date = !empty($activity_date) ? date('d-M-Y',strtotime($activity_date->Created_date)) : '';
				}
				if(!empty($parent_data['Activity_date'])){
					$activitys_date = !empty($parent_data['Activity_date']) ? date('d-M-Y',strtotime($parent_data['Activity_date'])) : '';
				}
				?>
				<p class="show--act">Showing activity from <strong><?php echo !empty($activitys_date) ? $activitys_date : '';?> to <?php echo date('d-M-Y');?> for ALL CLASSES</strong></p>
			<?php }?>
			<div class="list-of__activity">
				<div>
					<h2>Total Steps <a class="tooltipped" data-position="top" data-tooltip="Total steps tracked on the activity period selected." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_steps.svg" alt="Total Steps"/>
					<p id="Total_Steps"><?php echo !empty($parent_data['Total_Steps']) ? $parent_data['Total_Steps'] : "0" ;?></p>
				</div>
				<div>
					<h2>Total Meters <a class="tooltipped" data-position="top" data-tooltip="The stride length is multiplied by the step frequency and this product is the distance covered in meters." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_distance.svg" alt="Total Distance"/>
					<p id="Total_Meters"><?php echo !empty($parent_data['Total_Meters']) ? $parent_data['Total_Meters'] : "0";?></p>
				</div>

				<div>
					<h2>Jumps <a class="tooltipped" data-position="top" data-tooltip="Considered when the arms together bounce from the back to de front, in a 90 degree angle." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_calories.svg" alt="Total Calories"/>
					<p id="Total_Jumps"><?php echo !empty($parent_data['Total_Jumps']) ? $parent_data['Total_Jumps'] : "0" ;?></p>
				</div>
				<div>
					<?php 
					$totalheight = !empty($parent_data['Total_Jumps']) ? (($parent_data['Total_Jumps'] * 20) / 100) : 0;
					?>
					<h2>Total Height <a class="tooltipped" data-position="top" data-tooltip="1 Jump = 20 cm, total height will the sum up all jumps in meters." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/totalHeight.svg" alt="Total Height"/>
					<p id="Total_Height"><?php echo !empty($totalheight) ? $totalheight : 0; ?></p>
				</div>
				<div>
					<h2>Pat Points <a class="tooltipped" data-position="top" data-tooltip="T (min) X Intensity / 10" data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/PatPoint.svg" alt="Pat Points"/>
					<p id="Pat_Points"><?php echo !empty($parent_data['Pat_Points']) ? round($parent_data['Pat_Points']) : "0" ;?></p>
				</div>
			</div>
		</div>
		<?php $class_meters=array(); $class_steps=array(); $class_array=array(); $class_array2=array(); if ($this->session->userdata('role')!= 4): ?>
		<?php $i=1; foreach ($classes_data as $key => $value): ?>
		<div id="<?php echo $i ?>" class="col s12 tabs--content">
			<?php if(!empty($to_date) && !empty($from_date)){?>
				<p class="show--act">Showing activity from <strong><?php echo $from_date;?> to <?php echo $to_date;?> for <?php echo $value['C_Class_Name'] ?></strong></p>
			<?php } else{ 
				$activitys_date = !empty($parent_data['Activity_date']) ? date('d-M-Y',strtotime($parent_data['Activity_date'])) : '';
				?>
				<p class="show--act">Showing activity from <strong><?php echo $activitys_date;?> to <?php echo date('d-M-Y');?> for <?php echo $value['C_Class_Name'] ?></strong></p>
			<?php } ?>
			<div class="list-of__activity">
				<div>
					<h2>Total Steps <a class="tooltipped" data-position="top" data-tooltip="Total steps tracked on the activity period selected." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_steps.svg" alt="Total Steps"/>
					<p id="<?php echo $i ?>Total_Steps"><?php echo !empty($classStudentData['Total_Steps'][$value['C_ID']]) ? $classStudentData['Total_Steps'][$value['C_ID']] : "0" ;
					if($this->session->userdata('role')!=4)
					{ 
						if($classStudentData['Total_Steps'][$value['C_ID']]!==0){
							array_push($class_array, $value['C_Class_Name']);
							$graph_steps=(($classStudentData['Total_Steps'][$value['C_ID']])/12000);
								array_push($class_steps,round($graph_steps,2));
						}
					}
					?></p>
				</div>
				<div>
					<h2>Total Meters <a class="tooltipped" data-position="top" data-tooltip="The stride length is multiplied by the step frequency and this product is the distance covered in meters." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_distance.svg" alt="Total Distance"/>
					<p id="<?php echo $i ?>Total_Meters"><?php echo !empty($classStudentData['Total_Meters'][$value['C_ID']]) ? $classStudentData['Total_Meters'][$value['C_ID']] : "0";
					if($this->session->userdata('role')!=4)
					{
						if($classStudentData['Total_Meters'][$value['C_ID']]!==0){
							array_push($class_array2, $value['C_Class_Name']);
							$graph_meter=(($classStudentData['Total_Meters'][$value['C_ID']])/12000);
							array_push($class_meters,round($graph_meter,2));
						}
					}
					?></p>
				</div>
				<div>
					<h2>Jumps <a class="tooltipped" data-position="top" data-tooltip="Considered when the arms together bounce from the back to de front, in a 90 degree angle." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/tracker_calories.svg" alt="Total Calories"/>
					<p id="<?php echo $i ?>Total_Jumps"><?php echo !empty($classStudentData['Total_Jumps'][$value['C_ID']]) ? $classStudentData['Total_Jumps'][$value['C_ID']] : "0" ;?></p>
				</div>
				<?php 
					$totalheight = (($classStudentData['Total_Jumps'][$value['C_ID']] * 20) / 100);
				?>
				<div>
					<h2>Total Height <a class="tooltipped" data-position="top" data-tooltip="1 Jump = 20 cm, total height will the sum up all jumps in meters." data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/totalHeight.svg" alt="Total Height"/>
					<p id="<?php echo $i ?>Total_Heights"><?php echo $totalheight;?></p>
				</div>
				<div>
					<h2>Pat Points <a class="tooltipped" data-position="top" data-tooltip="T (min) X Intensity / 10" data-toggle="tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
					<img src="<?php echo base_url();?>/assets/frontend/images/PatPoint.svg" alt="Pat Points"/>
					<p id="<?php echo $i ?>Pat_Points"><?php echo !empty($classStudentData['Pat_Points'][$value['C_ID']]) ? round($classStudentData['Pat_Points'][$value['C_ID']]) : "0";?></p>
				</div>
			</div>
		</div>
		<?php $i++; endforeach ?>
		<?php $i=1; foreach ($classes_data as $key => $value): ?>
		<div id="<?php echo $i ?>" class="col s12 tabs--content">
			<?php foreach ($classStudentData as $key1 => $value1): ?>

			<?php endforeach ?>
		</div>
		<?php $i++; endforeach ?>
	<?php endif ?>

	<div id="all-class" class="col s12 tabs--content">
		<div class="list-of__activity">

		</div>
		<div class="row">
			<div class="col s12 m5 l5" id="pieChart">
				<h3>Total Steps</h3>
				<canvas id="stepsChart" width="600" height="400"></canvas>
			</div>
			<div class="col s12 m6 l6">
				<h3>Total Steps</h3>
				<canvas id="myChart4"></canvas>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<h3>Percentage Of Steps / Target</h3>
				<canvas id="barChart"></canvas>
			</div>
		</div>
		<div class="row">
			<div class="col s12">
				<h3>Meters Covered</h3>
				<canvas id="barChart-One"></canvas>
			</div>
		</div>
	</div>
</section>
</div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		$('[data-toggle="tooltip"]').tooltip();
	});
	var Total_Steps=<?php echo !empty($parent_data['Total_Steps']) ? $parent_data['Total_Steps'] : "0" ;?>;
	var Total_Jumps=<?php echo !empty($parent_data['Total_Jumps']) ? $parent_data['Total_Jumps'] : "0" ;?>;
	var Total_Meters=<?php echo !empty($parent_data['Total_Meters']) ? $parent_data['Total_Meters'] : "0" ;?>;
	var Pat_Points=<?php echo !empty($parent_data['Pat_Points']) ? $parent_data['Pat_Points'] : "0" ;?>;
	var temp_total_steps=Total_Steps;
	var temp_total_jumps=Total_Jumps;
	var temp_total_meters=Total_Meters;
	var temp_pat_points=Pat_Points;
	var class_array= [<?php echo '"'.implode('","',  $class_array ).'"' ?>];
	var class_array2= [<?php echo '"'.implode('","',  $class_array2 ).'"' ?>];
	var class_steps= [<?php echo '"'.implode('","',  $class_steps ).'"' ?>];
	var class_meters= [<?php echo '"'.implode('","',  $class_meters ).'"' ?>];
	<?php
	if ($this->session->userdata('role')==4) {
		$class_meters=array();
		$class_steps=array();
		/*array_push($class_meters, ($parent_data['Total_Meters']/12000)*100);
		array_push($class_steps, ($parent_data['Total_Steps']/12000)*100);*/
		array_push($class_meters, ($parent_data['Total_Meters']/12000));
		array_push($class_steps, ($parent_data['Total_Steps']/12000));
		?>

		var class_steps= [<?php echo '"'.implode('","',  $class_steps ).'"' ?>];
		var class_meters= [<?php echo '"'.implode('","',  $class_meters ).'"' ?>];
	<?php }
	?>
</script>