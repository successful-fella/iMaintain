<!DOCTYPE html>
<html lang="en">

<?php
	$title = "Add Department";
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
		                        <h3 class="mb-0">Add Department</h3>
		                      </div>
		                    </div>
		                  </div>

		                  <div class="card-body">
		                    <form method="POST">
		                      <div class="pl-lg-12">
		                        <div class="row">
		                          <div class="col-lg-3">
		                            <div class="form-group">
		                              <label class="form-control-label" for="department">Department Name</label>
		                              <input type="text" name="dept_name" id="department" class="form-control form-control-alternative" placeholder="Enter name" required>
		                            </div>
		                          </div>
		                        </div>
		                      </div>
		                      <div class="pl-lg-4">
		                        <div class="form-group">
		                          <button class="btn btn-md btn-primary">Add</button>
		                        </div>
		                      </div>
		                    </form>
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
			<div class="card-header border-0">
			  <h3 class="mb-0">Department</h3>
			</div>
			<div class="table-responsive">

			<?php
				if(count($departments) == 0) {
					echo "<h4>Add a Department first please :P</h4>";
				} else {
			?>

			  <table class="table align-items-center table-flush">

				<thead class="thead-light">
				  <tr>
					<th scope="col">Department Name</th>
					<th scope="col">Edit</th>
				  </tr>
				</thead>

				<tbody>

					<?php foreach($departments as $department): ?>
					    <tr>
							<th scope="row">
							  <div class="media align-items-center">
								<div class="media-body">
								  <span class="mb-0 text-sm"><?= $department->department_name ?></span>
								</div>
							  </div>
							</th>
							<td class="text-right">
							  <div class="col text-right">
								<button onclick="openEditModal(<?= $department->department_id ?>, '<?= $department->department_name ?>')" class="btn btn-md btn-primary">Edit</button>
							  </div>
							</td>
						</tr>
					<?php endforeach; ?>

				</tbody>

			  </table>

			<?php } ?>
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
		<form method="POST" action="<?= base_url('supervisor/updatedepartment') ?>">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Update Department Name</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Department Name</label>
							<input type="text" class="form-control" name="dept_name" id="dept_name">
							<input type="hidden" class="form-control" name="dept_id" id="dept_id" readonly="">
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
		function openEditModal(id, name) {
			$('#dept_name').val(name)
			$('#dept_id').val(id)
			$('#update_modal').modal('show')
		}
	</script>
</body>

</html>