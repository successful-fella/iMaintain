<!DOCTYPE html>
<html>

	<?php
		$title = "iMaintain | Scanner";
		include __DIR__.'/includes/head.php';
	?>

	<style type="text/css">
		canvas {
			height: fit-content;
			width: 100%;
			position: fixed;
		}

		video {
			height: 100%;
    		width: 100%;
		}

		.s3-card {
		    box-shadow: none !important;
		    background-color: #fff !important;
		    z-index: 1 !important;
		    position: relative !important;
		    border-radius: 0px;
		}
		
		
	</style>

<body class="w3-theme-l5">

	<div class="w3-top">
		<div class="w3-col s3">
			<div class="w3-bar w3-theme-d2 w3-left-align w3-large">
				<a href="#" class="w3-bar-item w3-padding-large"><i class="fa fa-arrow-left"></i></a>
			</div>
		</div>
		<div class="w3-col s9">
			<div class="w3-bar w3-theme-d2 w3-right w3-large">
				<a class="w3-bar-item w3-right w3-padding-large">Scan QR code</a>
			</div>
		</div>
	</div>
	
	<div class="scan"></div>
	<canvas id="canvas" hidden></canvas>
	<div class="w3-center">
		<div class="w3-container s3-card w3-round-xlarge">
			<br>
			<i class="fa fa-id-card"></i>
			<input placeholder="Enter Equipment ID" id="equipment-id" class="w3-input w3-margin-left w3-margin-bottom" type="text" style="width:75%"><br>
			<button class="w3-button w3-section w3-teal w3-ripple w3-round-xxlarge no-outline" type="button" onclick="moveNow()" style="width:75%">Proceed</button></p>
		</div>
	</div>
	<div id="loadingMessage" style="visibility: hidden;"></div>
	<video id="video" autoplay></video>
	<div class="w3-bottom w3-theme-d5 main-footer" style="z-index: -1"></div>
	<div class="w3-padding qr-holder w3-bottom" style="z-index: 0">
		<div class="footer-home">
			<a href="<?= base_url('engineer/home') ?>">
				<i class="fa fa-home"></i>
			</a>
		</div>
		<div class="w3-col s3-btn w3-center w3-padding">
			<a href="#" class="switch">
				<i class="fa fa-bolt"></i>
			</a>
		</div>
		<div class="footer-activities">
			<a href="<?= base_url('engineer/home') ?>">
				<i class="fa fa-list"></i>
			</a>
		</div>
	</div>

	<script type="text/javascript">
		var base_url = "<?= $base_url ?>"
	</script>
	<script src="https://app.catriu.com/assets/js/jsQR.js"></script>
	<script type="text/javascript" src="<?= base_url('res/js/scanner.js?v=15') ?>"></script>

</body>
</html> 
