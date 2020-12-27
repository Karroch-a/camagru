
var video = document.getElementById('video');
			var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            canvas.width  = 300;
            canvas.height = 225;

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
				context.drawImage(vid, 0, 0, canvas.width, canvas.height);
		}
				function changeImage(id){
				var image = document.getElementById("stk");
				if (1 == id)
				{
					image.src = document.getElementById("1").src;
					document.getElementById("stk").style = 'display:inline;';
				}
				else if (2 == id)
				{
					image.src = document.getElementById("2").src;
					document.getElementById("stk").style = 'display:inline;';
				}
				else if (3 == id )
				{
					image.src = document.getElementById("3").src;
					document.getElementById("stk").style = 'display:inline;';
				}
				else if (4 == id)
				{
					image.src = document.getElementById("4").src;
					document.getElementById("stk").style = 'display:inline;';
				}
				else if (5 == id)
				{
					image.src = document.getElementById("5").src;
					document.getElementById("stk").style = 'display:inline;';
				}
		 }