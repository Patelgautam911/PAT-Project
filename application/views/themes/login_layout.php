<?php ini_set('max_execution_time', 0); ?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<!--Import materialize.css-->
	<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>/assets/frontend/css/materialize.min.css"  media="screen,projection"/>
	<!--Let browser know website is optimized for mobile-->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<link rel="stylesheet" href="<?php echo base_url();?>/assets/frontend/css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script type="text/javascript">
			var BASE_URL = "<?php echo base_url();?>";
	</script>
</head>
		<?php echo $output;?>
		<footer style="display: none;">
			<div class="row">
				<div class="footer--content">
					<div class="col s6">
						<ul>
							<li><a href="javascript:;" title="About PAT">About PAT</a></li>
							<li><a href="javascript:;" title="Support">Support</a></li>
							<li><a href="javascript:;" title="Contact Us">Contact Us</a></li>
						</ul>
					</div>
					<div class="col s6 right-align logo-contain">
						<img src="<?php echo base_url();?>/assets/frontend/images/group-9.svg" alt="" /> 
						<img src="<?php echo base_url();?>/assets/frontend/images/logo-pat-registered.png" alt="PAT Logo" style="height: 100%;"/> 
					</div>
				</div>
				<div class="col s12 copyright">
					<div class="footer--content">
						copyright | Disclaimer | Privacy Policy
					</div>
				</div>
			</div>
		</footer>
	</div>
	
	<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/jquery/jquery.validate.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/admin/plugins/jquery/additional-methods.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/assets/frontend/js/materialize.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
		
	</script>
	<script src="<?php echo base_url();?>assets/frontend/js/pat.js"></script>
	<script src="<?php echo base_url();?>assets/frontend/js/all_js.js"></script>
	<script src="<?php echo base_url();?>assets/frontend/js/jquery.session.js"></script>
	
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>