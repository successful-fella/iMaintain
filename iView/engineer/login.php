
 <!DOCTYPE html>
<html>

<?php
	$title = "iMaintain | Login";
	include __DIR__.'/includes/head.php';
?>

<style>
    html, body {
        height: 100%;
    }

    .w3-card-4 {
    	margin-top: 80px;
    }

    .s3-logo {
    	margin-top: 35px;
    }

    .s3-bottom {
    	width: 100%; 
    	bottom: 0; 
    	position: absolute;
    }
</style>

<body class="bg-airplane">
	<div class="w3-container s3-logo w3-col">
		<img src="<?= base_url('res/images/logo.png') ?>" style="width: inherit;">
	</div>
	
	<div class="w3-container w3-center animated fadeIn faster">
		<div class="w3-container s3-card w3-card-4 w3-round-xlarge">
			<br>
			<i class="fa fa-user"></i>
			<input placeholder="Engineer ID" id="eng-id" class="w3-input w3-margin-left w3-margin-bottom" type="text" style="width:75%"><br>
			<i class="fa fa-key"></i>
			<input placeholder="Password" id="eng-pass" class="w3-input w3-margin-left w3-margin-bottom" type="password" style="width:75%"><br>
			<button class="w3-button w3-section w3-teal w3-ripple w3-round-xxlarge no-outline" id="eng-btn" type="button" onclick="checkLogin()" style="width:75%"> Log in </button></p>

		</div>
	</div>

	<div class="s3-bottom" style="z-index: -1">
		<img src="<?= base_url('res/images/login.png') ?>" style="width: inherit;">
	</div>

	<script type="text/javascript" src="<?= base_url('res/js/login.js') ?>"></script>
	<script>
		if ("serviceWorker" in navigator) {
			if (navigator.serviceWorker.controller) {
				console.log("Service worker found, no need to register");
			} else {
				navigator.serviceWorker
				.register("../engineer-sw.js", {
					scope: "./engineer"
				})
				.then(function (reg) {
					console.log("Service worker has been registered for scope: " + reg.scope);
				});
			}
		}

	</script>
</body>
</html> 
