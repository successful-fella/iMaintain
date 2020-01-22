var Toast
$(function() {
	Toast = Swal.mixin({
		toast: true,
		position: 'center',
		showConfirmButton: false,
		timer: 3000
	})
})

function validateForm() {
	if($('#eng-id').val() == '') {
		Toast.fire({
			type: 'warning',
			title: 'Please enter your id'
		})
		$('#eng-id').focus()
		return false
	}
	if($('#eng-pass').val() == '') {
		Toast.fire({
			type: 'warning',
			title: 'Please enter your password'
		})
		$('#eng-pass').focus()
		return false
	}
	return true
}

function checkLogin() {
	if(!validateForm()) {
		return
	}
	$('#eng-btn').prop('disabled', true)
	var id = $('#eng-id').val()
	var pass = $('#eng-pass').val()
	Toast.fire({
		type: 'warning',
		title: 'Please wait...'
	})
	$.ajax({
		url: base_url + 'api/checkLogin',
		type: "POST",
		data: "id="+id+"&pass="+pass,
		success: function(resp) {
			if(resp == '1') {
				Toast.fire({
					type: 'success',
					title: 'Logging you in...'
				})
				window.setTimeout(() => {
					window.location.href = base_url + 'engineer/home'
				}, 1000)
			} else if(resp == '2') {
				Toast.fire({
					type: 'error',
					title: 'Incorrect ID, please try again'
				})
				$('#eng-btn').prop('disabled', false)
			} else if(resp == '3') {
				Toast.fire({
					type: 'error',
					title: 'Incorrect password, please try again'
				})
				$('#eng-btn').prop('disabled', false)
			}
		}
	})
	$('#eng-btn').prop('disabled', false)
}