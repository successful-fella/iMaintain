<!DOCTYPE html>
<html lang="en">

<?php
	$title = "Home";
	include __DIR__."/includes/head.php";
?>

<body class="">
		<?php
			include __DIR__.'/includes/nav.php';
		?>
		<!-- Header -->
		<div class="header bg-gradient-primary pb-8 pt-5 pt-md-8">
			<div class="container-fluid">
				<div class="header-body">
					<!-- Card stats -->
					<div class="row">
						<div class="col-xl-3 col-lg-6">
							<div class="card card-stats mb-4 mb-xl-0">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Reports</h5>
											<span class="h2 font-weight-bold mb-0"><?= count($services) ?></span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-danger text-white rounded-circle shadow">
												<i class="fas fa-chart-bar"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card card-stats mb-4 mb-xl-0">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Items</h5>
											<span class="h2 font-weight-bold mb-0"><?= $equipment_count ?></span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-warning text-white rounded-circle shadow">
												<i class="fas fa-chart-pie"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card card-stats mb-4 mb-xl-0">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Employees</h5>
											<span class="h2 font-weight-bold mb-0"><?= $engineer_count ?></span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-yellow text-white rounded-circle shadow">
												<i class="fas fa-users"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-xl-3 col-lg-6">
							<div class="card card-stats mb-4 mb-xl-0">
								<div class="card-body">
									<div class="row">
										<div class="col">
											<h5 class="card-title text-uppercase text-muted mb-0">Departments</h5>
											<span class="h2 font-weight-bold mb-0"><?= $department_count ?></span>
										</div>
										<div class="col-auto">
											<div class="icon icon-shape bg-info text-white rounded-circle shadow">
												<i class="fas fa-percent"></i>
											</div>
										</div>
									</div>
									<!-- <p class="mt-3 mb-0 text-muted text-sm">
										<span class="text-success mr-2"><i class="fas fa-arrow-up"></i> 12%</span>
										<span class="text-nowrap">Since last month</span>
									</p> -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		 <div class="container-fluid mt--7">
			
			<div class="col-xl-12 mb-5 mb-xl-0">
				<div class="row mt-5">
					<div class="col-xl-7 mb-5 mb-xl-0">
						<div class="card shadow">
							<div class="card-header border-0">
								<div class="row align-items-center">
									<div class="col">
										<h3 class="mb-0">Notifications/Tasks</h3>
									</div>
									<div class="col text-right">
										<a href="#!" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#notification_modal">Send New Notification</a>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<!-- Projects table -->
								<table class="table align-items-center table-flush">
									<thead class="thead-light">
										<tr>
											<th scope="col">Date</th>
											<th scope="col">Time</th>
											<th scope="col">Notification</th>
											<th scope="col">Employee</th>

										</tr>
									</thead>
									<tbody>
										<?php foreach($notifications as $notification): ?>
											<tr>
												<td><?= date_format(date_create($notification->notification_date), 'd/m/Y') ?></td>
												<td><?= $notification->notification_time ?></td>
												<td style="white-space: normal;"><?= $notification->notification_text ?></td>
												<td><?= (empty($notification->user_id))?'Everyone':$notification->user_name." (".$notification->user_id.")" ?></td>
											</tr>
										<?php endforeach; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>

					<div class="col-xl-5 mb-5 mb-xl-0">
						<div class="card shadow">
							<div class="card-header border-0">
								<div class="row align-items-center">
									<div class="col">
										<h3 class="mb-0">Employee Activities</h3>
									</div>
								</div>
							</div>
							<div class="table-responsive">
								<!-- Projects table -->
								<table class="table align-items-center table-flush">
									<thead class="thead-light">
										<tr>
											<th scope="col">Activity</th>
											<th scope="col">Date/Time</th>
										</tr>
									</thead>
									<tbody id="ajax_activity">
										<tr>
											<th>Loading right away...</th>
											<th></th>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>

				</div>
			</div>
			
			<div class="row mt-5">
				<div class="col-xl-12 mb-5 mb-xl-0">
					<div class="card shadow">
						<div class="card-header border-0">
							<div class="row align-items-center">
								<div class="col">
									<h3 class="mb-0">Maintainence Record</h3>
								</div>
							</div>
						</div>
						<div class="table-responsive">
							<!-- Projects table -->
							<table class="table align-items-center table-flush">
								<thead class="thead-light">
									<tr>
										<th scope="col">Employee Name</th>
										<th scope="col">Date</th>
										<th scope="col">Item ID</th>
										<th scope="col">Item Name</th>
										<th scope="col">Status</th>
										<th scope="col">Report</th>

									</tr>
								</thead>
								<tbody>
									<?php foreach($services as $service): ?>
										<tr>
											<th scope="row"><?= $service->user_name ?></th>
											<td><?= date_format(date_create($service->service_date), 'd/m/Y') ?></td>
											<td><?= $service->equipment_id ?></td>
											<td><?= $service->equipment_name ?></td>
											<td>
												<?php
													switch($service->service_status) {
														case '1':
															echo '<i class="fas fa-arrow-down text-red mr-3"></i>Pending';
															break;
														case '2':
															echo '<i class="fas fa-arrow-up text-success mr-3"></i>Completed';
															break;
														case '3':
															echo '<i class="fas fa-arrow-up text-warning mr-3"></i>Shifted';
															break;
													}
												?>
											</td>
											<td>
												<a href="<?= base_url('engineer/downloadsinglereport/'.$service->service_id) ?>"><button class="btn"><i class="fa fa-download"></i> Download</button></a>
											</td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
			<?php
				include __DIR__.'/includes/footer.php';
			?>
		</div>
	</div>
	<?php
		include __DIR__.'/includes/scripts.php';
	?>


	<div class="modal fade" id="notification_modal" tabindex="-1" role="dialog" aria-labelledby="update_modal" aria-hidden="true">
		<form method="POST" action="<?= base_url('supervisor/sendnotification') ?>">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">New Notification</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Employee ID <small>(Leave empty to send to all)</small></label>
							<input type="text" onkeyup="searchEng()" class="form-control" placeholder="Enter ID/Name or Leave Empty" id="eng_id_search" autocomplete="off">
							<div class="modal-title card container-fluid">
								<p id="eng_data"></p>
							</div>
							<input type="hidden" class="form-control" name="eng_id" id="eng_id">
						</div>
						<div class="form-group">
							<label>Notification</label>
							<textarea type="text" class="form-control" placeholder="What notification is about?" name="notification" id="notification" required=""></textarea>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-primary">Send <i class="fa fa-paper-plane"></i></button>
					</div>
				</div>
			</div>
		</form>
	</div>

</body>

<script type="text/javascript">
	function delay(callback, ms) {
		var timer = 0;
		return function() {
			var context = this, args = arguments;
			clearTimeout(timer);
			timer = setTimeout(function () {
				callback.apply(context, args);
			}, ms || 0);
		};
	}

	function searchEngineer(key) {
		$.ajax({
			url: base_url + 'api/getengineer/'+key,
			success: function(resp) {
				var res = JSON.parse(resp)
				$('#eng_data').html('<span onclick=\'selectEng('+res.user_id+', "'+res.user_name+'")\'>'+res.user_name + " (" + res.user_id +")</span>")
			}
		})
	}

	function selectEng(id, name) {
		$('#eng_id').val(id);
		$('#eng_id_search').val(name+" (" + id + ")")
		$('#eng_data').empty()
	}

	$('#eng_id_search').keyup(delay(function() {
		searchEngineer($('#eng_id_search').val())
	}, 1000))
	
	setInterval(function() {
		$.ajax({
			url: base_url + 'api/getrecentactivities',
			success: function(resp) {
				var result = JSON.parse(resp)
				var html = ''
				for(var i = 0; i < result.length; i++) {
					html += '<tr><td style="white-space: normal;">'+result[i].activity_title+'</td><td>'+result[i].activity_time+' @ '+result[i].activity_date+'</td></tr>'
				}
				$('#ajax_activity').html(html)
			}
		})
	}, 2500)
</script>

</html>