
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
					if (document.getElementById("picture").getAttribute('src') !== '' && !(vid.srcObject))
					{
						document.getElementById("abaza").disabled = true;
						document.getElementById("picture").style = 'display:block;';
						if (id == 1)
						{
							new_stk.src = a;
							new_stk.style = 'display:inline;';
						}
						else if (id == 2)
						{
							new_stk.src = b;
							new_stk.style = 'display:inline;';
						}
						else if (id == 3)
						{
							new_stk.src = c;
							new_stk.style = 'display:inline;';
						}
						else if (id == 4)
						{
							new_stk.src = d;
							new_stk.style = 'display:inline;';
						}
						else if (id == 5)
						{
							new_stk.src = e;
							new_stk.style = 'display:inline;';
						}
					}
					else
					{
						if (document.getElementById("picture").getAttribute('src') == '' && !(vid.srcObject))
						{
							return;
						}
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
				if (new_stk.src != a && new_stk.src != b && new_stk.src != c && new_stk.src != d && new_stk.src != e)
				{
					return;
				}
				else
				{
					var xhttp = new XMLHttpRequest();
					xhttp.open("POST", window.location.href, true);
					if (document.getElementById("picture").getAttribute('src') !== '' && !(vid.srcObject))
					{
						picture = stickers = "emoji=" + new_stk.src + "&pic=" +  document.getElementById("picture").src;
					}
					else
					{
						picture = stickers = "stk=" + new_stk.src + "&img=" +  canvas.toDataURL('image/jpeg');
					}
					xhttp.onreadystatechange = function() {
					  if (this.readyState == 4 && this.status == 200) {
						console.log(xhttp.responseText);
						window.location.href = "/gallery/camera";
					  }
					};
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send(picture);
				}
			  }
			  function deleteImage(image_n)
			  {
					var xhttp = new XMLHttpRequest();
					xhttp.open("POST", window.location.href, true);
					picture = "image_n=" + image_n;
					xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						console.log(xhttp.responseText);
						window.location.href = "/gallery/camera";
						}
					};
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send(picture);
				}
			function like(image_n, id)
			{
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", window.location.href, true);
				picture = "like=" + image_n;
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					console.log(xhttp);
					res = JSON.parse(xhttp.responseText);
						if (res)
						{
							console.log(res[0].like_count);
							document.getElementById(id).innerText = res[0].like_count + " Likes";
							if (res.liked == 'unlike')
							{
								document.getElementById(image_n).innerHTML = '<svg aria-label="Like" class="_8-yf5 " fill="#262626" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 6.1c5.7 0 10.4 5.2 10.4 11.5 0 6.8-5.9 11-11.5 16S25 41.3 24 41.9c-1.1-.7-4.7-4-9.5-8.3-5.7-5-11.5-9.2-11.5-16C3 11.3 7.7 6.1 13.4 6.1c4.2 0 6.5 2 8.1 4.3 1.9 2.6 2.2 3.9 2.5 3.9.3 0 .6-1.3 2.5-3.9 1.6-2.3 3.9-4.3 8.1-4.3m0-3c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5.6 0 1.1-.2 1.6-.5 1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>';
							}
							if (res.liked == 'like')
							{
								document.getElementById(image_n).innerHTML = '<svg aria-label="Unlike" class="_8-yf5 " fill="#ed4956" height="24" viewBox="0 0 48 48" width="24"><path d="M34.6 3.1c-4.5 0-7.9 1.8-10.6 5.6-2.7-3.7-6.1-5.5-10.6-5.5C6 3.1 0 9.6 0 17.6c0 7.3 5.4 12 10.6 16.5.6.5 1.3 1.1 1.9 1.7l2.3 2c4.4 3.9 6.6 5.9 7.6 6.5.5.3 1.1.5 1.6.5s1.1-.2 1.6-.5c1-.6 2.8-2.2 7.8-6.8l2-1.8c.7-.6 1.3-1.2 2-1.7C42.7 29.6 48 25 48 17.6c0-8-6-14.5-13.4-14.5z"></path></svg>';
							}
						}
					}
				};
				xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
				xhttp.send(picture);
			}
			function cmnt(image_n, i, j, username)
			{
				var xhttp = new XMLHttpRequest();
				xhttp.open("POST", window.location.href, true);
				comment = document.getElementById(i).value;
				picture = "nameofimage=" + image_n + "&cmnt=" + comment;
				xhttp.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						console.log(xhttp);
						res = JSON.parse(xhttp.responseText);
							if (res)
							{
								var div = document.createElement("DIV");
								div.setAttribute("class", "fetchcmnt");
								document.getElementById(j).appendChild(div);

								var node = document.createElement("H6");
								var textnode = document.createTextNode(username);
								node.appendChild(textnode);
								div.appendChild(node);

								var span = document.createElement("SPAN");
								var spantext = document.createTextNode(comment);
								span.appendChild(spantext);
								div.appendChild(span);
								document.getElementById(i).value = '';
							}
						}
					};
					xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					xhttp.send(picture);
			}