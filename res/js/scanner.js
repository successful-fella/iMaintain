var Toast
$(function() {
	Toast = Swal.mixin({
		toast: true,
		position: 'center',
		showConfirmButton: false,
		timer: 3000
	})
})

const support = 'mediaDevices' in navigator;
let initial = false;
var video = document.getElementById("video");
var canvasElement = document.getElementById("canvas");
var canvas = canvasElement.getContext("2d");
var loadingMessage = document.getElementById("loadingMessage");

if(support) {
	navigator.mediaDevices.enumerateDevices().then(devices => {
		const cameras = devices.filter((device) => device.kind === 'videoinput');
		if (cameras.length === 0) {
			Toast.fire({
				type: 'error',
				title: 'No camera found :('
			});
		}
		const camera = cameras[cameras.length - 1];
		navigator.mediaDevices.getUserMedia({
			video: {
				deviceId: camera.deviceId,
				facingMode: ['user', 'environment'],
				height: {ideal: 360},
				width: {ideal: 360}
			}
		}).then(stream => {
			// Video stream
			video.srcObject = stream;
			video.setAttribute("playsinline", true);
			video.play();
			requestAnimationFrame(qr);

			// Flashlight
			const track = stream.getVideoTracks()[0];
			const imageCapture = new ImageCapture(track)
			const photoCapabilities = imageCapture.getPhotoCapabilities().then(() => {
				const btn = document.querySelector('.switch');
				btn.addEventListener('click', function(){
					if(initial) {
						window.location.reload();
					}
					initial = true;
					track.applyConstraints({
						advanced: [{torch: initial}]
					});
				});
			});
		});
	});
}

function qr() {
	if (video.readyState === video.HAVE_ENOUGH_DATA) {
		loadingMessage.hidden = true;
		canvasElement.hidden = true;

		canvasElement.height = video.videoHeight;
		canvasElement.width = video.videoWidth;
		canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
		var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
		var code = jsQR(imageData.data, imageData.width, imageData.height, {
			inversionAttempts: "dontInvert",
		});

		if (code) {
			var qr_data = code.data
			if(qr_data.includes('airport_')) {
				Toast.fire({
					type: 'success',
					title: "Loading right away..."
				})
				window.location.href = base_url + 'engineer/equipment/'+qr_data.split('airport_')[1];
			} else {
				Toast.fire({
					type: 'error',
					title: "Invalid QR Code: " + qr_data
				})
			}
		}
	}
	requestAnimationFrame(qr);
}

function moveNow() {
	if($('#equipment-id').val() == '') {
		$('#equipment-id').focus()
		return
	}
	window.location.href = base_url + 'engineer/equipment/' + $('#equipment-id').val()
}