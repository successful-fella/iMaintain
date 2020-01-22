<!DOCTYPE html>
<html>

	<?php
		$title = "iMaintain | Engineer History";
		include __DIR__.'/includes/head.php';
	?>
 	<link rel="stylesheet" type="text/css" href="<?= base_url('res/css/table.css') ?>">

<body class="w3-theme-l5">

		<div class="w3-top">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large w3-padding">
				<div class="row w3-col s12">
					<div class="w3-col s2 ">
						<a href="<?= base_url('engineer/equipment/'.$equipment_id) ?>">
							<i class="fa fa-arrow-left"></i>
						</a>
					</div>
					<div class="w3-col s8 w3-center">
						Past Service History
					</div>
				</div>	
			</div>
		</div>

		<br><br>
		<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name" style="outline: none;">
		<div class="container" style="overflow-x:auto;">

			<div id="history-area" style="justify-content: center; display: flex;">
			</div>
			<table id="myTable">
				<thead>
				  <tr class="header">
					<th class="tableWidth">Name</th>
					<th class="tableWidth">Engineer ID</th>
					<th class="tableWidth">Service Date</th>
					<th class="tableWidth">Download Report</th>
				  </tr>
				</thead>
				<tbody>
			  <?php foreach($services as $service): ?>
				  <tr>
				    <td><?= $service->user_name ?></td>
				    <td><?= $service->user_id ?></td>
				    <td><?= date_format(date_create($service->service_date), 'd/m/Y') ?></td>
				    <td><a href="<?= base_url('engineer/downloadsinglereport/'.$service->service_id) ?>"><button class="w3-button w3-section w3-teal w3-ripple w3-round-xxlarge no-outline">Download</button></a></td>
				  </tr>
				<?php endforeach; ?>
				</tbody>
			</table>
		</div>	
	
	</div>
	
	<?php
		include __DIR__.'/includes/footer.php';
	?>
	<script>

		function myFunction() {
		  var input, filter, table, tr, td, i, txtValue;
		  input = document.getElementById("myInput");
		  filter = input.value.toUpperCase();
		  table = document.getElementById("myTable");
		  tr = table.getElementsByTagName("tr");
		  var temp = 0
		  for (i = 0; i < tr.length; i++) {
		    td = tr[i].getElementsByTagName("td")[0];
		    if (td) {
		      txtValue = td.textContent || td.innerText;
		      if (txtValue.toUpperCase().indexOf(filter) > -1) {
		        tr[i].style.display = "";
		      } else {
		        tr[i].style.display = "none";
				temp++
		      }
		    }       
		  }
		if(temp+1 == tr.length) {
			$('#history-area').html("No record found")
			$('#myTable').attr('style', 'display: none')
		} else {
			$('#history-area').empty()
			$('#myTable').attr('style', 'display: table')
		}
		}
	</script>	

</body>
</html> 
