<!DOCTYPE html>
<html lang="en">

<?php
	$title = "Add Equipment";
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
                        <h3 class="mb-0">Add Equipments</h3>
                      </div>
                    </div>
                  </div>
                  <div class="card-body">
                    <form method="POST">
                      <div class="pl-lg-12">
                        <div class="row">
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label" for="name">Equipment Name</label>
                              <input type="text" name="name" id="name" class="form-control form-control-alternative" placeholder="Enter name" required>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label" for="doi">Date of Installation</label>
                              <input type="date" name="doi" id="doi" class="form-control form-control-alternative" placeholder="Enter Date of Installation" required>
                            </div>
                          </div>
                          <div class="col-lg-3">
                            <div class="form-group">
                              <label class="form-control-label" for="dept_name">Department Name</label>
                              <select class="form-control" name="dept_id">
                              	<option selected="" disabled="">Select a Department</option>
                              	<?php foreach($departments as $department): ?>
                              		<option value="<?= $department->department_id ?>"><?= $department->department_name ?></option>
                              	<?php endforeach; ?>
                              </select>
                            </div>
                          </div>
                          <div class="col-lg-4">
                            <div class="form-group">
                              <label class="form-control-label" for="details">Equipment Details</label>
                              <textarea type="text" name="details" id="details" class="form-control form-control-alternative" placeholder="Enter Equipment Detail" required></textarea>
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
			  <h3 class="mb-0">Equipment</h3>
			</div>
			<div class="table-responsive">
			  <table class="table align-items-center table-flush">
				<thead class="thead-light">
				  <tr>

				  	<th scope="col">Equipment Id</th>
				  	<th scope="col">Equipment Name</th>
					<th scope="col">Date of Installation</th>
					<th scope="col">Department Name</th>
					<th scope="col">Equipment Description</th>
					<th scope="col" class="text-center">Action</th>
					
				  </tr>
				</thead>

				<tbody>
					<?php foreach($equipments as $equipment): ?>
						<tr>
							<th scope="row">
								<div class="media align-items-center">
									<div class="media-body">
										<span class="mb-0 text-sm"><?= $equipment->equipment_id ?></span>
									</div>
								</div>
							</th>
							<td><?= $equipment->equipment_name ?></td>
							<td><?= date_format(date_create($equipment->equipment_doi), 'd/m/Y') ?></td>
							<td><?= $equipment->department_name ?></td>
							<td style="white-space: pre-line;"><?= $equipment->equipment_detail ?></td>
							<td class="text-right">
								<div class="col text-right">
									<button class="btn btn-md btn-primary">Download QR Code</button>
									<a href="edititem/39" class="btn btn-md btn-primary">Edit</a>
									<button onclick="deleteEquipment(39)" class="btn btn-md btn-danger">Delete</button>
								</div>
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
</body>

</html>