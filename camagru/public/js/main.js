
			var vid = document.getElementById('vid');
			var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            canvas.width  = 300;
			canvas.height = 225;
			var stk = document.getElementById("stk");
			var new_stk = document.getElementById("new");
			var a = document.getElementById("1").src
			var b = document.getElementById("2").src
			var c = document.getElementById("3").src
			var d = document.getElementById("4").src
			var e = document.getElementById("5").src

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
				if (stk.src != a && stk.src != b && stk.src != c && stk.src != d && stk.src != e){
					new_stk.style = 'display:none;';
					return;
				}
				else
				{
					if (!(vid.srcObject))
					{
						return;
					}
					else
					{
						context.drawImage(vid, 0, 0, canvas.width, canvas.height);
						new_stk.src = stk.src;
						stk.src = '';
						stk.style = 'display:none;';
						new_stk.style = 'display:inline;';
					}
				}
		}
				function changeImage(id){
				if (!(vid.srcObject))
				{
					return;
				}
				else
				{
					if (id == 1)
					{
						stk.src = a;
						stk.style = 'display:inline;';
					}
					else if (id == 2)
					{
						stk.src = b;
						stk.style = 'display:inline;';
					}
					else if (id == 3)
					{
						stk.src = c;
						stk.style = 'display:inline;';
					}
					else if (id == 4)
					{
						stk.src = d;
						stk.style = 'display:inline;';
					}
					else if (id == 5)
					{
						stk.src = e;
						stk.style = 'display:inline;';
					}
				}
			}
			function save() {
				var xhttp = new XMLHttpRequest();
				const url = "https://192.168.99.132:8081/gallery/camera";
				xhttp.open("POST", url);
				stickers = new_stk.src;
				image = canvas.toDataURL('image/jpeg');
				xhttp.send(stickers);
				console.log(stickers);
				xhttp.onreadystatechange = function() {
				  if (this.readyState == 4 && this.status == 200) { }
				};
			  }
			