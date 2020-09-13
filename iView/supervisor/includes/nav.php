<style type="text/css">
	.s3-logo {
		height: 70px;
	    width: 250px;
	    margin-left: -30px;
	}
</style>

<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
	<div class="container-fluid">
		<!-- Toggler -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<!-- Brand -->
		<a class="pt-0" href="#">
			<div style="margin-left: 22px; font-size: 31px;">
				<b>iMaintain</b>
			</div>
		</a>
		
		<!-- Collapse -->
		<div class="collapse navbar-collapse" id="sidenav-collapse-main">
			<!-- Collapse header -->
			<div class="navbar-collapse-header d-md-none">
				<div class="row">
					<div class="col-6 collapse-brand">
						<a href="#">
							<div style="margin-left: 22px; font-size: 31px;">
								<b>iMaintain</b>
							</div>
						</a>
					</div>
					<div class="col-6 collapse-close">
						<button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
							<span></span>
							<span></span>
						</button>
					</div>
				</div>
			</div>
			<!-- Navigation -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link <?= ($selected[0] == 'home')?'active':'' ?>" href="<?= base_url('supervisor/home') ?>">
						<i class="ni ni-tv-2 text-primary"></i> Dashboard
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($selected[0] == 'engineer')?'active':'' ?>" href="<?= base_url('supervisor/engineers') ?>">
						<i class="ni ni-single-02 text-yellow"></i> Engineers
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($selected[0] == 'department')?'active':'' ?>" href="<?= base_url('supervisor/departments') ?>">
						<i class="ni ni-bullet-list-67 text-red"></i> Departments
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= ($selected[0] == 'equipment')?'active':'' ?>" href="<?= base_url('supervisor/equipments') ?>">
						<i class="ni ni-key-25 text-info"></i> Equipments
					</a>
				</li>
			</ul>
			<!-- Divider -->
			<hr class="my-3">
			<!-- Heading -->
			<h6 class="navbar-heading text-muted">Contact</h6>
			<!-- Navigation -->
			<ul class="navbar-nav mb-md-3">
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://tawk.to/chat/5e25496a8e78b86ed8aa1c94/default">
						<i class="ni ni-support-16"></i> General Support Team
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" target="_blank" href="https://tawk.to/chat/5e25496a8e78b86ed8aa1c94/default">
						<i class="ni ni-spaceship"></i> Technical Support Team
					</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
<div class="main-content">
	<!-- Navbar -->
	<nav class="navbar navbar-top navbar-expand-md navbar-dark" id="navbar-main">
		<div class="container-fluid">
			<!-- Brand -->
			<a class="h4 mb-0 text-white text-uppercase d-none d-lg-inline-block" href="#">Dashboard</a>
			<!-- User -->
			<ul class="navbar-nav align-items-center d-none d-md-flex">
				<li class="nav-item dropdown">
					<a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<div class="media align-items-center">
							<span class="avatar avatar-sm rounded-circle">
								<img alt="Supervisor" src="<?= base_url('res/images/supervisor.png') ?>">
							</span>
							<div class="media-body ml-2 d-none d-lg-block">
								<span class="mb-0 text-sm  font-weight-bold"><?= $this->session->sup_name ?></span>
							</div>
						</div>
					</a>
					<div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
						<div class=" dropdown-header noti-title">
							<h6 class="text-overflow m-0">Welcome <?= $this->session->sup_name ?></h6>
						</div>
						<a href="<?= base_url('supervisor/logout') ?>" class="dropdown-item">
							<i class="ni ni-user-run"></i>
							<span>Logout</span>
						</a>
					</div>
				</li>
			</ul>
		</div>
	</nav>
	<!-- End Navbar -->