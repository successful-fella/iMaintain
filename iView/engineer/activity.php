<!DOCTYPE html>
<html>

	<?php
		$title = "iMaintain | Engineer Activity";
		include __DIR__.'/includes/head.php';
	?>

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
					<b>Engineer Activity</b>
				</div>
			</div>	
		</div>
	</div>

	<div class="w3-container w3-content animated fadeIn faster" style="max-width:1400px;margin-top:60px">    
		<div class="w3-row">
			<div class="w3-col m3">
				<?php foreach($activities as $activity): ?>
					<div class="w3-card w3-round w3-white">
						<div class="w3-padding">
							<?= $activity->activity_title ?>
						</div>
						<div class="w3-container">
							<div class="row">
								<p class="w3-right w3-tiny"><?= $activity->activity_time ?> @ <?= date_format(date_create($activity->activity_date), 'd/m/Y') ?></p>
							</div>
						</div>
					</div>
					<br>
				<?php endforeach; ?>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
	
	<?php
		include __DIR__.'/includes/footer.php';
	?>
	<script>
		$(document).ready(() => {
			<?php if(isset($_GET['error'])) { ?>
				Swal.fire({
					type: 'error',
					title: '<?= $_GET['error'] ?>'
				})	
			<?php } ?>
		})
	</script>
</body>
</html> 
