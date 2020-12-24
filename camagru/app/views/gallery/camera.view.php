<?php
    if (!isset($_SESSION['username']))
     {
         $this->redirect('/users/login');
     }
   require_once APP_PATH . DS . 'views' . DS .  'users' . DS . 'bootstrap.php';
   require_once APP_PATH . DS . 'views' . DS .  'users' . DS . 'footer.php';
?>
<html>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
	</head>
	<body>
        <div class="gallery">
            <form action="/gallery/camera" method="POST" enctype="multipart/form-data">
                <div class="stickers"></div>
                <div class="picutre">
                    <div class="video"><video id="vid" style="width:300px"></video></div>
                    <br>
                    <div class="canvas"><canvas id="canvas"style="width:300px" ></canvas></div><br>
                    <button  class="btn btn-primary" onclick="picutre();">take picture</button>
                    <div class="upload">
                    <input type="file" name="img">
                    <button  class="btn btn-primary" name="upload" value="upload">uplaod</button>
                </div>
                </div>
                </form>
        </div>
        <script type="text/javascript" src="/../public/js/main.js">
		</script>
	</body>
</html>