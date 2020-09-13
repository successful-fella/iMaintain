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
	if($('#sup_phone').val() == '') {
		Toast.fire({
			type: 'warning',
			title: 'Please enter your phone number'
		})
		$('#sup_phone').focus()
		return false
	}
	if($('#password').val() == '') {
		Toast.fire({
			type: 'warning',
			title: 'Please enter your password'
		})
		$('#password').focus()
		return false
	}
	return true
}

function checkLogin() {
	if(!validateForm()) {
		return
	}
	$('#login_btn').prop('disabled', true)
	var id = $('#sup_phone').val()
	var pass = $('#password').val()
	$.ajax({
		url: base_url + 'api/checkSupervisorLogin',
		type: "POST",
		data: "phone="+id+"&pass="+pass,
		success: function(resp) {
			if(resp == '1') {
				Toast.fire({
					type: 'success',
					title: 'Logging you in...'
				})
				window.setTimeout(() => {
					window.location.href = base_url + 'supervisor/home'
				}, 1000)
			} else if(resp == '2') {
				Toast.fire({
					type: 'error',
					title: 'Incorrect Phone, please try again'
				})
				$('#login_btn').prop('disabled', false)
			} else if(resp == '3') {
				Toast.fire({
					type: 'error',
					title: 'Incorrect password, please try again'
				})
				$('#login_btn').prop('disabled', false)
			}
		}
	})
	$('#login_btn').prop('disabled', false)
}

$(document).keypress(function(e) {
	if(e.which == 13) {
		checkLogin()
	}
});