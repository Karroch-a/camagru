<!DOCTYPE html>
<html>
	<head>

	</head>
	<body>
		<video id="vid"></video>
		<canvas id="canvas"></canvas><br>
		<button onclick="picutre();">take picture</button>
		<script type="text/javascript">
			var video = document.getElementById('video');
			var canvas = document.getElementById('canvas');
			var context = canvas.getContext('2d');

			navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia || navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

			if(navigator.getUserMedia){
				navigator.getUserMedia({video:true}, streamWebCam, throwError);
			}

			function streamWebCam (stream) {
				vid.srcObject = stream;
				vid.play();
			}

			function throwError (e) {
				alert(e.name);
			}

			function picutre () {
				canvas.width = vid.clientWidth;
				canvas.height = vid.clientHeight;
				context.drawImage(vid, 0, 0);
			}
		</script>
	</body>
</html>