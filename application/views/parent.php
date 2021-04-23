<div id="student--listing">
<section class="container">
	<div class="row" id="student--activity__info">
		<div class="col s12">
			<div class="col s2 profile--icon">
				<i class="material-icons dp48">person</i>
			</div>
			<div class="col s9 user--name">
				<p><strong>Hello <?php echo $this->session->userdata('username');?></strong></p>
				<p>Track your student activity</p>
			</div>
			<div class="col s1 right-align">
				<a class="waves-effect waves-light btn edit-btn"><i class="material-icons dp48 right">create</i></a>
			</div>
			<div class="col s9 user--activity">
				<p>Filter activity by the last </p>
				<div class="filter--tabs">
					<ul>
						<li><a href="javascript:void(0);">1 Day</a></li>
						<li><a href="javascript:void(0);" class="active"><i class="material-icons">check_circle</i> 1 Week</a></li>
						<li><a href="javascript:void(0);">1 Month</a></li>
						<li><a href="javascript:void(0);">3 Month</a></li>
						<li class="date--range"><input type="text" name="daterange" value="" placeholder="Select date range" /> <i class="material-icons tiny">date_range</i></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<ul class="tabs" id="tabs-swipe-demo">
		<li class="tab"><a class="active" href="#all-class">All Classes</a></li>
		<li class="tab"><a href="#class-1a">Class 1A</a></li>
		<li class="tab"><a href="#class-1b">Class 1B</a></li>
		<li class="tab"><a href="#class-1c">Class 1C</a></li>
	</ul>
	<div id="all-class" class="col s12 tabs--content">
		<p class="show--act">Showing activity from <strong>18 Oct 2019 to 25 Oct 2019 for ALL CLASSES</strong></p>
		<div class="list-of__activity">
			<div>
				<h2>Total Steps <a class="tooltipped" data-position="top" data-tooltip="Total steps tracked on
					the activity period selected."><i class="material-icons tiny">info_outline</i></a></h2>
				<img src="<?php echo base_url();?>/assets/frontend/images/tracker_steps.svg" alt="Total Steps"/>
				<p><?php echo $parent_data['Total_Steps'];?> M</p>
			</div>
			<div>
				<h2>Total Meters <a class="tooltipped" data-position="top" data-tooltip="The stride length is multiplied by the step frequency and this product is the distance covered in meters."><i class="material-icons tiny">info_outline</i></a></h2>
				<img src="<?php echo base_url();?>/assets/frontend/images/tracker_distance.svg" alt="Total Distance"/>
				<p><?php echo $parent_data['Total_Meters'];?></p>
			</div>
			<div>
				<h2>Jumps <a class="tooltipped" data-position="top" data-tooltip="Considered when the arms together bounce from the back to de front, in a 90 degree angle."><i class="material-icons tiny">info_outline</i></a></h2>
				<img src="<?php echo base_url();?>/assets/frontend/images/tracker_calories.svg" alt="Total Calories"/>
				<p><?php echo $parent_data['Total_Jumps'];?></p>
			</div>
			<div>
				<h2>Total Height <a class="tooltipped" data-position="top" data-tooltip="Total Height tooltip"><i class="material-icons tiny">info_outline</i></a></h2>
				<img src="<?php echo base_url();?>/assets/frontend/images/totalHeight.svg" alt="Total Height"/>
				<p>679705</p>
			</div>
			<div>
				<h2>Pat Points <a class="tooltipped" data-position="top" data-tooltip="T (min) X Intensity / 10"><i class="material-icons tiny">info_outline</i></a></h2>
				<img src="<?php echo base_url();?>/assets/frontend/images/PatPoint.svg" alt="Pat Points"/>
				<p>231678890</p>
			</div>
		</div>
		<div class="row">
			<div class="col s12 m5 l5">
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
	<div id="class-1a" class="col s12 tabs--content">
		<p class="show--act">Showing activity from <strong>18 Oct 2019 to 25 Oct 2019 for ALL CLASSES</strong></p>
		<div class="row">
			<div class="col s4">
				<h3>Total Steps</h3>
			</div>
			<div class="col s12 m7 l7">
				<h3>Total Steps</h3>
			</div>
		</div>
	</div>
	<div id="class-1b" class="col s12 tabs--content">
		<p class="show--act">Test 4</p>
	</div>
	<div id="class-1c" class="col s12 tabs--content">
		<p class="show--act">Test 5</p>
	</div>
</section>
</div>