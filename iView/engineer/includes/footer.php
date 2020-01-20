<div class="w3-bottom w3-theme-d5 main-footer"></div>
<div class="w3-padding qr-holder w3-bottom">
	<div class="footer-home">
		<a href="<?= base_url('engineer/home') ?>">
			<i class="fa fa-home" style="color: #fff !important"></i>
		</a>
	</div>
	<div class="w3-col s3-btn w3-center w3-padding">
		<a href="<?= base_url('engineer/scanner') ?>">
			<i class="fa fa-qrcode" style="color: #fff !important"></i>
		</a>
	</div>
	<div class="footer-activities">
		<a href="<?= base_url('engineer/activity') ?>">
			<i class="fa fa-list" style="color: #fff !important"></i>
		</a>
	</div>
</div>

<script type="text/javascript">
	window.onbeforeunload = () => {
		$('.animated').addClass('fadeOutUp')
	}
</script>