<div id="help--center">
	<section class="container">
		<div class="row valign-wrapper">
			<div class="col s12">
				<h2 class="phead">Help Center</h2>
				<p>How we calculate move performance</p>
			</div>
		</div>
		<ul class="tabs valign-wrapper" id="tabs-swipe-demo">
		    <li class="tab"><a class="active" href="#step_day">Step / day</a></li>
		  <!--   <li class="tab"><a href="#calories">Calories</a></li> -->
		    <li class="tab"><a href="#pat_point">PAT Points</a></li>
		    <li class="tab"><a href="#jump">Jumps</a></li>
		</ul>
		  <div id="step_day" class="col s12 tabs--content">
		  		<div class="row">
		  			<div class="col s12 m4 l4 center-align pat-image">
		  				<img src="<?php echo base_url(); ?>assets/frontend/images/tracker-steps-icon.svg" alt="Total Steps">
		  			</div>
		  			<div class="col s12 m8 l8">
		  				<h3>Step / Day</h3>
		  				<p>The minimum recommended daily steps for 6-12 years of old children are 12,000 steps/day for girls and 15,000 steps/day for boys.</p>
		  				<h3>Steps & Meters</h3>
		  				<p>To calculate the distance covered (TOTAL METERS), since we know the individual’s height and there is a formula which estimates stride length. The stride length is multiplied by the step frequency and this product is the distance covered in meters. The daily recommendation for girls aged 6-14 is 12000 steps and for boys is 15000 steps.</p>
						<p>
						PAT provides the possibility to calculate your own stride length. Calculate using an exact known distance covered (e.g. 50 m) and count how many steps you walk. The longer the distance, the more accurate the measurement.
						By dividing a known distance of say 30m or 50m by the exact number of steps taken, this will provide a more precise individual reading which can be entered in cm into each student’s profile page.
						</p>
		  			</div>
		  			<div class="col s12 gap"></div>
		  			<div class="col s10 table--content">
		  				<table>
					        <thead>
					          <tr>
					              <th>Activity Level</th>
					              <th>Boys</th>
					              <th>Girls</th>
					              <th>Adults</th>
					          </tr>
					        </thead>

					        <tbody>
					          <tr>
					          	<td>Sedentary</td>
					            <td>&lt; 10.000</td>
					            <td>&lt; 7.000</td>
					            <td>&lt; 5.000</td>
					          </tr>
					          <tr>
					            <td>Low Active</td>
					            <td>10.000 - 14.499</td>
					            <td>7.000 - 9.499</td>
					            <td>5.000 - 7.499</td>
					          </tr>
					          <tr>
					            <td>Somewhat Active</td>
					            <td>14.499 - 12.500</td>
					            <td>9.500 - 11.999</td>
					            <td>7.500 - 9.999</td>
					          </tr>
					          <tr>
					            <td>Active</td>
					            <td>15.000 - 17.499</td>
					            <td>12.000 - 14.499</td>
					            <td>10.000 - 12.499</td>
					          </tr>
					          <tr>
					            <td>Highly Active</td>
					            <td>&gt; 17.500</td>
					            <td>&gt; 14.500</td>
					            <td>&gt; 12.500</td>
					          </tr>
					        </tbody>
					      </table>
		  			</div>

		  			<div class="col s6 table--content">
		  				<table>
					        <thead>
					          <tr>
					              <th>Steps / Minutes</th>
					              <th>Intensity</th>
					           </tr>
					        </thead>
					        <tbody>
					          <tr>
					            <td>&gt; 40</td>
					            <td>Sitting</td>
					          </tr>
					          <tr>
					            <td>41 - 80</td>
					            <td>Walking Slow</td>
					          </tr>
					          <tr>
					            <td>81 - 100</td>
					            <td>Walking</td>
					          </tr>
					          <tr>
					            <td>101 - 240</td>
					            <td>Running</td>
					          </tr>
					          <tr>
					            <td>+ 170</td>
					            <td>Running Fast</td>
					          </tr>
					        </tbody>
					      </table>
		  			</div>
		  			<!-- <div class="col s12">
		  				<h3>Steps and meters</h3>
		  				<p>To calculate the distance covered (total meters), since we know the individual’s height and there is a formula which estimates stride length. The stride length is multiplied by the step frequency and this product is the distance covered in meters. The daily recommendation for girls aged 6-14 is 12000 steps and for boys is 15000 steps.</p>
		  				<p>PAT provides the possibility to calculate your own stride length. Calculate using an exact known distance covered (ex. 50 m) and count how many steps you walk. The longer the distance, the more accurate the measurement.</p>
		  				<p>By dividing a known distance of say 30m or 50m by the exact number of steps taken, this will provide a more precise individual reading which can be entered in cm into each student’s profile page.</p>
		  			</div> -->
		  		</div>
		  </div>

		  <div id="calories" class="col s12 tabs--content hide">
		  		<div class="row">
		  			<div class="col s12 m4 l4 center-align pat-image">

		  			</div>
		  			<div class="col s12 m8 l8">
		  				<h3>Calories</h3>
		  				<p>A calorie is a unit of energy which is related to nutrition and physical activity. Calories refer to:</p>
						<p><strong>Energy Intake:</strong> through eating and drinking <br/><strong>Energy Expenditure:</strong> through physical functions such as digesting food, breathing, reading, exercising…</p>
		  			</div>
		  			<div class="col s12">
		  				<p>Nutrition and physical activity are very important in order to keep a healthy lifestyle. Daily energy intake should be similar to energy expenditure. If we provide additional energy, we gain weight. However, if we do not get the required energy intake, we start to use other energy resources which lead to weight lost.</p>
						<p>PAT will help you to know what you really do on your daily activity, knowing the amount of sedentary behaviour is an important criteria & monitoring physical activity is one of the ways to fight against a sendentary lifestyle. PAT motivates you to improve overall wellness by knowing when, where, for how long and at what intensity activity has taken place.</p>
		  			</div>
		  		</div>
		  </div>

		  <div id="pat_point" class="col s12 tabs--content">
		  		<div class="row">
		  			<div class="col s12 m4 l4 center-align pat-image">
		  				<img src="<?php echo base_url(); ?>assets/frontend/images/pat-points.png" alt="Pat Points" width="192">
		  			</div>
		  			<div class="col s12 m8 l8">
		  				<h3>PAT Points</h3>
		  				<p>Pat Points are calculated according to the intensity of activity during school time activity. Pat Points are calculated using the following formula:</p>
		  				<p>T (m) X Intensity / 10</p>
		  			</div>
		  		</div>
		  </div>

		  <div id="jump" class="col s12 tabs--content">
		  		<div class="row">
		  			<div class="col s12 m4 l4 center-align pat-image">
		  				<img src="<?php echo base_url(); ?>assets/frontend/images/tracker-calories.svg" alt="Total Calories">
		  			</div>
		  			<div class="col s12 m8 l8">
		  				<h3>Jump</h3>
		  				<p>Text to be added</p>
		  			</div>
		  		</div>
		  </div>
	</section>
</div>