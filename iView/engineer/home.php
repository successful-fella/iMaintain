<!DOCTYPE html>
<html>

	<?php
		$title = "iMaintain | Engineer Home";
		include __DIR__.'/includes/head.php';
	?>

<body class="w3-theme-l5">

	<div class="w3-top">
		<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
			<a href="<?= base_url('engineer/logout') ?>" class="w3-bar-item w3-button w3-hide-medium w3-hide-large w3-right w3-padding-large w3-hover-white w3-large w3-theme-d2"><i class="fa fa-power-off"></i></a>
			<a href="#" class="w3-bar-item w3-button w3-padding-large w3-theme-d4">iMaintain</a>
		</div>
	</div>

	<div class="w3-container w3-content animated fadeIn faster" style="max-width:1400px;margin-top:45px">    
		<div class="w3-row">
			<p class="w3-small"><i class="fa fa-bell"></i>Notifications</p>
			<div class="w3-col m3">
			<?php foreach($notifications as $notification): ?>
					<?php if($notification->user_id == $this->session->eng_id or $notification->user_id == 0): ?>
						<div class="w3-card w3-round w3-white">
							<div class="w3-container">
								<div class="row">
									<h6 class="w3-left">
										To: 
										<?php
											if($notification->user_id == $this->session->eng_id) {
												echo "Me";
											} else {
												echo "Everyone";
											}
										?>
									</h6>
									<h6 class="w3-right"><?= date_format(date_create($notification->notification_date), 'd/m/Y') ?> <?= $notification->notification_time ?></h6>
								</div>
							</div>
							<div class="w3-padding">
								<?= $notification->notification_text ?>
							</div>
						</div>
						<br>
					<?php endif; ?>
				<?php endforeach; ?>
				<br><br><br><br><br>
			</div>
		</div>
	</div>
	
	<?php
		include __DIR__.'/includes/footer.php';
	?>
	<script>
		<?php if(!is_null($this->session->flashdata('error'))) { ?>
				Swal.fire({
					type: 'error',
					title: '<?= $this->session->flashdata('error') ?>'
				})	
			<?php } ?>
	</script>
</body>
</html> 
