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

				  	<th scope="col">Equipment SRN</th>
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
									<button class="btn btn-md btn-primary" onclick="generateQrCode(<?= $equipment->equipment_id ?>)">Download QR Code</button>
									<button onclick="editEquipment('<?= $equipment->equipment_id ?>', '<?= $equipment->equipment_name ?>', '<?= $equipment->equipment_doi ?>', '<?= $equipment->department_id ?>', '<?= urlencode($equipment->equipment_detail) ?>')" class="btn btn-md btn-primary">Edit</button>
									<a href="<?= base_url('index.php/supervisor/deleteequipment/'.$equipment->equipment_id) ?>" class="btn btn-md btn-danger">Delete</a>
								</div>
							</td>
						</tr>
					<?php endforeach; ?>

				</tbody>
			  </table>
				<canvas id="qrCanvas" width="1024" height="1024" style="display:none;"></canvas>
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
	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="update_modal" aria-hidden="true">
		<form method="POST" action="<?= base_url('supervisor/updateequipment') ?>">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Update Equipment Details</h5>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Equipment ID</label>
							<input type="text" class="form-control" name="id" id="modal_id" readonly="">
						</div>
						<div class="form-group">
							<label class="form-control-label" for="name">Equipment Name</label>
                            <input type="text" name="name" id="modal_name" class="form-control form-control-alternative" placeholder="Enter Equipment name" required>
						</div>
						<div class="form-group">
							<label class="form-control-label" for="doi">Date of Installation</label>
                            <input type="date" name="doi" id="modal_doi" class="form-control form-control-alternative" placeholder="Enter Date of Installation" required>
						</div>
						<div class="form-group">
							<label class="form-control-label" for="dept_name">Department Name</label>
							<select class="form-control" id="modal_did" name="dept_id">
								<option selected="" disabled="">Select a Department</option>
								<?php foreach($departments as $department): ?>
									<option value="<?= $department->department_id ?>"><?= $department->department_name ?></option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group">
							<label class="form-control-label" for="details">Equipment Details</label>
                            <textarea type="text" name="details" id="modal_details" class="form-control form-control-alternative" placeholder="Enter Equipment Detail" required></textarea>
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
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/qrious/4.0.2/qrious.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/downloadjs/1.4.8/download.min.js"></script>
<script>
	var details
	function editEquipment(id, name, doi, did, detail) {
		$('#modal_id').val(id)
		$('#modal_name').val(name)
		$('#modal_doi').val(doi)
		$('#modal_did').val(did)
		$('#modal_details').val(decodeURIComponent(detail.replace(/\+/g, '%20')))
		$('#update_modal').modal('show')
	}
	
	function generateQrCode(id) {
		var qr = new Image()
		var code = new QRious({
			value: "airport_"+id,
			size: 1024
		})
		qr.src = code.toDataURL()
		qr.onload = () => {
			var c = document.getElementById("qrCanvas")
			var ctx = c.getContext("2d")
			ctx.clearRect(0, 0, 1024, 1024)
			ctx.beginPath()
			ctx.rect(0, 0, 1024, 1024)
			ctx.fillStyle = "white"
			ctx.fill()
			ctx.fillStyle = "black"
			ctx.font = "50px Arial"
			ctx.fillText("Equipment ID: "+id, 350, 50)
			ctx.drawImage(qr, 60, 70, 900, 900)
			ctx.font = "20px Arial"
			ctx.fillText("Powered by iMaintain", 800, 1000)
			var output = c.toDataURL("image/png")
			download(output, 'qr_equipment_'+id+'.png')
		}
	}
</script>

</html>