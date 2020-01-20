<footer class="footer container-fluid">
	<div class="row align-items-center">
		<div class="col-xl-6">
			<div class="copyright text-center text-xl-left text-muted">
				&copy; 2018 <a href="#" class="font-weight-bold ml-1" target="_blank">iMaintain</a>
			</div>
		</div>
		<div class="col-xl-6">
			<ul class="nav nav-footer justify-content-center justify-content-xl-end">
				<li class="nav-item">
					<a href="#" class="nav-link" target="_blank">About Us</a>
				</li>
				<li class="nav-item">
					<a href="#" class="nav-link" target="_blank">Blog</a>
				</li>
				
			</ul>
		</div>
	</div>
</footer>
<script type="text/javascript">
	var base_url = "<?= base_url() ?>";
	<?php if(isset($_GET['error'])): ?>
		Swal.fire({
			type: 'error',
			title: '<?= $_GET['error'] ?>'
		})
	<?php endif ?>
	<?php if(isset($_GET['success'])): ?>
		Swal.fire({
			type: 'success',
			title: '<?= $_GET['success'] ?>'
		})
	<?php endif ?>
</script>