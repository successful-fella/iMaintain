 <!DOCTYPE html>
<html>

	<?php
		$title = "iMaintain | Equipment";
		include __DIR__.'/includes/head.php';
	?>

	<style type="text/css">

		.s3-details {
			background: #303e45 !important;
			color: #fff;
			border-radius: 50px 50px 0px 0px;
			width: 100%;
			text-align: center;
		}

		.hide-details {
			display: none;
		}
	</style>

<link rel="stylesheet" type="text/css" href="<?= base_url('res/css/table.css') ?>">

<body class="w3-theme-l5">
		
	<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large w3-padding">
				<div class="row w3-col s12">
					<a href="<?= base_url('engineer/home') ?>" class="w3-large">
						<div class="w3-col s2 ">
							<i class="fa fa-arrow-left"></i>
						</div>
					</a>
					<div class="w3-col s8 w3-center">
						Equipment Details
					</div>
					<a href="<?= base_url('engineer/history/'.$equipment->equipment_id) ?>" class="w3-large">
						<div class="w3-col s2 w3-right-align">
							<i class="fa fa-history"></i>
						</div>
					</a>
				</div>	
			</div>
		</div>	
	<div class="w3-container w3-content" style="max-width:1400px;margin-top:40px">    
		<div class="w3-row">
			<div class="w3-col m3"><br>
				<div class="w3-white w3-text-grey w3-card-4">
					<div class="w3-display-container">
						<img src="<?= base_url('res/bg/image_'.rand(1, 6).'.jpg') ?>" style="width:100%; height: 180px;" alt="Equipment Image">
						<div class="w3-display-bottomleft w3-container s3-details" onclick="loadDetails()">
							<h4><?= $equipment->equipment_name ?> <i class="fa fa-caret-down"></i><p class="w3-tiny">click here to check details</p></h4>
						</div>
					</div>
					<div class="hide-details animated fadeIn" id="all_details">
						<div class="w3-panel">
							<div class="" style="margin:0 -16px">
							  <div class="w3-twothird">
								<table class="w3-table w3-striped w3-white">
								  <tr>
									<td><i class="fa fa-id-card w3-text-blue w3-large"></i></td>
									<td>S/N of Equipment</td>
									<td><i><?= $equipment->equipment_id ?></i></td>
								  </tr>
								  <tr>
									<td><i class="fa fa-pencil w3-text-red w3-large"></i></td>
									<td>Department Name</td>
									<td><i><?= $equipment->department_name ?></i></td>
								  </tr>
								  <tr>
									<td><i class="fa fa-calendar w3-text-yellow w3-large"></i></td>
									<td>Date of Installation</td>
									<td><i><?= date_format(date_create($equipment->equipment_doi), 'd/m/Y') ?></i></td>
								  </tr>
								  <tr>
									<td><i class="fa fa-comment w3-text-red w3-large"></i></td>
									<td>Equipment Details</td>
									<td><i><?= $equipment->equipment_detail ?></i></td>
								  </tr>
								</table>
							  </div>
							</div>
						  </div>
					</div>
				</div>
					<form action="<?= base_url('engineer/addservice') ?>" method="POST">
						<div class="w3-container w3-white w3-card"><br>
							<?php if(isset($pending)): ?>
								<div class="w3-panel w3-yellow w3-round-xlarge">
									<p>
										Maintainance for this equipment was marked pending by
										<?= ($pending_by_id == $this->session->eng_id)?'you':$pending_by ?>
										with remark:
										<i><?= $pending_remark ?></i>
									</p>
								</div>
							<?php endif; ?>
							<div class="w3-round-xlarge w3-margin-bottom">
								<div class="w3-center w3-round-xlarge">
									<input type="text" name="equipment_id" value="<?= $equipment->equipment_id ?>" class="s3-input s4-input" readonly>
								</div>
							</div>

							<div class="w3-round-xlarge w3-margin-bottom">
								<div class="w3-center w3-round-xlarge">
									<input type="date" value="<?= date('Y-m-d') ?>" class="s3-input s4-input">
								</div>
							</div>

							<div class="w3-round-xlarge w3-margin-bottom">
								<div class="w3-center w3-round-xlarge">
									<select name="status" required="" class="w3-select" required>
										<option selected disabled>Select Completion Status</option>
										<option value="1">Pending</option>
										<option value="2">Completed</option>
									</select>
								</div>
							</div>

							<div class="w3-round-xlarge w3-margin-bottom">
								<div class="w3-center w3-round-xlarge">
									<textarea type="text" name="service_details" placeholder="Enter Remark" class="s3-input s4-input" style="height: 100px;"></textarea> 
								</div>
							</div>

							<div class="w3-round-xlarge w3-margin-bottom">
								<div class="w3-center w3-round-xlarge">
									<button class="w3-button w3-teal w3-section w3-ripple w3-round-xxlarge no-outline" style="width:75%"> Submit </button>
								</div>
							</div>        
						</div>
					</form>
					<br>
					<div class="container w3-card w3-white" style="overflow-x:auto;">
						<p class="w3-center"><b>Last 3 past service details</b></p>
						<table id="myTable">
						  <tr class="header">
							<th class="tableWidth">Name</th>
							<th class="tableWidth">Engineer ID</th>
							<th class="tableWidth">Service Date</th>
							<th class="tableWidth">Download Report</th>
						  </tr>
						<?php foreach($services as $service): ?>
							<tr>
								<td><?= $service->user_name ?></td>
								<td><?= $service->user_id ?></td>
								<td><?= date_format(date_create($service->service_date), 'd/m/Y') ?></td>
								<td><a href="<?= base_url('engineer/downloadsinglereport/'.$service->service_id) ?>"><button class="w3-button w3-section w3-teal w3-ripple w3-round-xxlarge no-outline">Download</button></a></td>
							</tr>
						<?php endforeach; ?>
						</table>
					</div>	
				<br><br><br><br><br>
			</div>
		</div>
	</div>
	
	<?php
		include __DIR__.'/includes/footer.php';
	?>

	<script type="text/javascript">
		function loadDetails() {
			$('#all_details').toggleClass('hide-details')
		}

		$(document).ready(() => {
			<?php if(!is_null($this->session->flashdata('error'))) { ?>
				Swal.fire({
					type: 'error',
					title: '<?= $this->session->flashdata('error') ?>'
				})	
			<?php } ?>
			<?php if(!is_null($this->session->flashdata('success'))) { ?>
				Swal.fire({
					type: 'success',
					title: '<?= $this->session->flashdata('success') ?>'
				})	
			<?php } ?>
		})
	</script>

</body>
</html>