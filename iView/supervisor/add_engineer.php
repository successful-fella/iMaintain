<!DOCTYPE html>
<html lang="en">

<?php
	$title = "Add Employee";
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

			  <div class="col-xl order-xl-1">
				<div class="card bg-secondary shadow">
				  <div class="card-header bg-white border-0">
					<div class="row align-items-center">
					  <div class="col-8">
						<h3 class="mb-0">Add Employees</h3>
					  </div>
					</div>
				  </div>
				  <div class="card-body">
					  <div class="pl-lg-12">
						<div class="row">
						  <div class="col-lg-3">
							<div class="form-group">
							  <label class="form-control-label" for="eng_name">Employee Name</label>
							  <input type="text" name="category_name" id="eng_name" class="form-control form-control-alternative" placeholder="Enter name" required>
							</div>
						  </div>
						  <div class="col-lg-3">
							<div class="form-group">
							  <label class="form-control-label" for="eng_id">Employee ID</label>
							  <input type="text" name="category_name" id="eng_id" class="form-control form-control-alternative" placeholder="Enter Employee ID" required>
							</div>
						  </div>
						  <div class="col-lg-3">
							<div class="form-group">
							  <label class="form-control-label" for="phone">Mobile No.</label>
							  <input type="text" name="category_name" id="phone" class="form-control form-control-alternative" placeholder="Enter Mobile no" required>
							</div>
						  </div>
						  <div class="col-lg-3">
							<div class="form-group">
							  <label class="form-control-label" for="pwd">Password</label>
							  <input type="text" name="category_name" id="pwd" class="form-control form-control-alternative" placeholder="Enter password" required>
							</div>
						  </div>
						</div>
					  </div>
					  <div class="pl-lg-4">
						<div class="form-group">
						  <button type="button" id="add_btn" onclick="addEngineer()" class="btn btn-md btn-primary">Add</button>
						</div>
					  </div>
				  </div>
				</div>
			  </div>

		  </div>
				</div>
			</div>
		</div>
		<div class="container-fluid mt--7">
	  <!-- Table -->
	  <div class="row">
		<div class="col">
		  <div class="card shadow">
		  	<div class="card-header bg-white border-0">
			  <div class="row align-items-center">
			    <div class="col-8">
				  <h3 class="mb-0">Employees</h3>
			    </div>
			  </div>
		    </div>
			<div class="table-responsive py-2">
				<table id="eng_tbl" class="table" style="width:100%">
					<thead>
						<tr>
							<td>Employee Name</td>
							<td>Employee ID</td>
							<td>Phone Number</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody id="list_tbl">
						<?php foreach($engineers as $engineer): ?>
							<tr id="eng_<?= $engineer->user_id ?>">
								<td><?= $engineer->user_name ?></td>
								<td><?= $engineer->user_id ?></td>
								<td><?= $engineer->user_phone ?></td>
								<td>
									<button onclick="updateEngineer(<?= $engineer->user_id ?>)" class="btn btn-primary">Edit</button>
									<button onclick="deleteEng(<?= $engineer->user_id ?>)" class="btn btn-danger">Delete</button>
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

	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="update_modal" aria-hidden="true">
		<form method="POST" action="<?= base_url('supervisor/engineer') ?>">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Update Employee Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Employee ID</label>
							<input type="text" class="form-control" name="eng_id" id="update_id" readonly="">
						</div>
						<div class="form-group">
							<label>Employee Name</label>
							<input type="text" class="form-control" name="eng_name" id="update_name">
						</div>
						<div class="form-group">
							<label>Employee Phone</label>
							<input type="text" class="form-control" name="eng_phone" id="update_phone">
						</div>
						<div class="form-group">
							<label>Employee Password</label>
							<input type="text" class="form-control" name="eng_password" id="update_password" placeholder="Enter New Password">
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button class="btn btn-primary">Save changes</button>
					</div>
				</div>
			</div>
		</form>
	</div>

	<?php
		include __DIR__.'/includes/scripts.php';
	?>
	<script type="text/javascript">
		function addEngineer() {
			$('#add_btn').prop('disabled', true)
			$('#add_btn').html('Adding...')
			if($('#eng_name').val() == '' || $('#eng_id').val() == '' || $('#phone').val() == '' || $('#pwd').val() == '') {
				Swal.fire({
					type: 'warning',
					title: 'Employee Details Empty'
				})
				$('#add_btn').prop('disabled', false)
				$('#add_btn').html('Try Again')
				return;
			}
			$.ajax({
				url: base_url + 'supervisor/engineers',
				data: "eng_name="+$('#eng_name').val()+'&eng_id='+$('#eng_id').val()+'&phone='+$('#phone').val()+'&password='+$('#pwd').val(),
				type: "POST",
				success: function() {
					Swal.fire({
						type: 'success',
						title: 'Employee Added'
					})
					$('#add_btn').prop('disabled', false)
					$('#add_btn').html('Add Another')
					var html = '<tr id="eng_'+$('#eng_id').val()+'"><td>'+$('#eng_name').val()+'</td><td>'+$('#eng_id').val()+'</td><td>'+$('#phone').val()+'</td><td><button class="btn btn-primary">Edit</button><button class="btn btn-danger" onclick="deleteEng('+$('#eng_id').val()+')">Delete</button></td></tr>'
					$('#list_tbl').html(html + $('#list_tbl').html())
					$('#eng_name').val('')
					$('#eng_id').val('')
					$('#phone').val('')
					$('#pwd').val('')
				},
				error: function() {
					Swal.fire({
						type: 'error',
						title: 'There was some error adding engineer. Please verify if Engineer ID already exists.'
					})
					$('#add_btn').prop('disabled', false)
					$('#add_btn').html('Try Again')
				}
			})
		}

		function updateEngineer(id) {
			$('#update_modal').modal('show')
			$.ajax({
				url: base_url + 'supervisor/engineer/'+id,
				success: function(resp) {
					var res = JSON.parse(resp)
					$('#update_id').val(res.user_id)
					$('#update_phone').val(res.user_phone)
					$('#update_name').val(res.user_name)
				}
			})
		}

		function deleteEng(id) {
			Swal.fire({
				type: 'warning',
				title: 'Do you really wanna delete the employee?',
				text: 'It is irreversible',
				showCancelButton: true,
				confirmButtonText: 'Yes, delete',
				confirmButtonColor: '#f5365b'
			}).then(function(result) {
				if(result.value) {
					$('#eng_'+id).remove()
					$.ajax({
						url: base_url + 'supervisor/deleteEngineer',
						type: "POST",
						data: "eng_id="+id,
						success: function() {
							Swal.fire({
								type: 'success',
								title: 'Employee Deleted'
							})
						},
						error: function() {
							Swal.fire({
								type: 'error',
								title: 'There was some error!'
							})
						}
					})
				}
			})
		}
	</script>
</body>

</html>