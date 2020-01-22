<footer class="footer container-fluid">
	<div class="row align-items-center">
		<div class="col-xl-6">
			<div class="copyright text-center text-xl-left text-muted">
				&copy; 2020 <a href="#" class="font-weight-bold ml-1">iMaintain</a>
			</div>
		</div>
		<div class="col-xl-6">
			<ul class="nav nav-footer justify-content-center justify-content-xl-end">
				<li class="nav-item">
					<a href="<?= base_url('about.html') ?>" class="nav-link">About Us</a>
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