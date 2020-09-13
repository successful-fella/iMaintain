<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>
		iMaintain | Login
	</title>
	<!-- Favicon -->
	<link href="<?= base_url('res/supervisor/assets/img/brand/favicon.png') ?>" rel="icon" type="image/png">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
	<!-- Icons -->
	<link href="<?= base_url('res/supervisor/assets/js/plugins/nucleo/css/nucleo.css') ?>" rel="stylesheet" />
	<link href="<?= base_url('res/supervisor/assets/js/plugins/@fortawesome/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" />
	<!-- CSS Files -->
	<link href="<?= base_url('res/supervisor/assets/css/argon-dashboard.css?v=1.1.1') ?>" rel="stylesheet" />
	<link rel="stylesheet" href="<?= base_url('res/plugin/sweetalert2/sweetalert2.min.css') ?>">
	<script type="text/javascript" src="<?= base_url('res/plugin/sweetalert2/sweetalert2.min.js') ?>"></script>
	<link rel='manifest' href='https://imaintain.drdivyalaparoscopy.com/res/supervisor.webmanifest'>
</head>

<body class="bg-default">
	<div class="main-content">
		<!-- Navbar -->

		<!-- Header -->
		<div class="header bg-gradient-primary py-7 py-lg-8">
			<div class="container">
				<div class="header-body text-center mb-7">
					<div class="row justify-content-center">
						<div class="col-lg-5 col-md-6">
							<h1 class="text-white">Welcome to iMaintain!</h1>
						 
						</div>
					</div>
				</div>
			</div>
			<div class="separator separator-bottom separator-skew zindex-100">
				<svg x="0" y="0" viewBox="0 0 2560 100" preserveAspectRatio="none" version="1.1" xmlns="http://www.w3.org/2000/svg">
					<polygon class="fill-default" points="2560 0 2560 100 0 100"></polygon>
				</svg>
			</div>
		</div>
		<!-- Page content -->
		<div class="container mt--8 pb-5">
			<div class="row justify-content-center">
				<div class="col-lg-5 col-md-7">
					<div class="card bg-secondary shadow border-0">

						<div class="card-body px-lg-5 py-lg-5">
							<div class="text-center text-muted mb-4">
								<h4>Supervisor Login</h4>
							</div>
							<form role="form">
								<div class="form-group mb-3">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="fa fa-phone"></i></span>
										</div>
										<input class="form-control" id="sup_phone" placeholder="Phone" type="tel">
									</div>
								</div>
								<div class="form-group">
									<div class="input-group input-group-alternative">
										<div class="input-group-prepend">
											<span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
										</div>
										<input class="form-control" id="password" placeholder="Password" type="password">
									</div>
								</div>
								<div class="custom-control custom-control-alternative custom-checkbox">
									<input class="custom-control-input" id=" customCheckLogin" type="checkbox">
									<label class="custom-control-label" for=" customCheckLogin">
										<span class="text-muted">Remember me</span>
									</label>
								</div>
								<div class="text-center">
									<button type="button" onclick="checkLogin()" id="login_btn" class="btn btn-primary my-4">Sign in</button>
								</div>
							</form>
						</div>
					</div>
					<div class="row mt-3">
						<div class="col-6">
							<a href="#" class="text-light"><small>Forgot password?</small></a>
						</div>
					 
					</div>
				</div>
			</div>
		</div>

	</div>
	<!--   Core   -->
	<script type="text/javascript">
		var base_url = "<?= base_url() ?>";
	</script>
	<script src="<?= base_url('res/supervisor/assets/js/plugins/jquery/dist/jquery.min.js') ?>"></script>
	<script src="<?= base_url('res/supervisor/assets/js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js') ?>"></script>
	<!--   Optional JS   -->
	<!--   Argon JS   -->
	<script src="<?= base_url('res/supervisor/assets/js/argon-dashboard.min.js?v=1.1.1') ?>"></script>
	<script type="text/javascript" src="<?= base_url('res/js/sup_login.js') ?>"></script>
	<script>
		// This is the service worker with the combined offline experience (Offline page + Offline copy of pages)

// Add this below content to your HTML page, or add the js file to your page at the very top to register service worker

// Check compatibility for the browser we're running this in
if ("serviceWorker" in navigator) {
  if (navigator.serviceWorker.controller) {
    console.log("[PWA Builder] active service worker found, no need to register");
  } else {
    // Register the service worker
    navigator.serviceWorker
      .register("../supervisor-sw.js", {
        scope: "./"
      })
      .then(function (reg) {
        console.log("[PWA Builder] Service worker has been registered for scope: " + reg.scope);
      });
  }
}

	</script>
</body>

</html>
