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
        <?php
            if (file_exists($_SESSION['path']))
            {
                
            }
            else
            {
                $_SESSION['path'] = '';
            }
            if (isset($_SESSION['image_error'])) {
                $q = $_SESSION['image_error'] ;
                echo "<p class='alert alert-danger text-center'>$q</p>";
                echo '<br>';
                unset($_SESSION['image_error'] );
            }
            else if (isset( $_SESSION['big_image']))
            {
                $q = $_SESSION['big_image'];
                echo "<p class='alert alert-danger text-center'>$q</p>";
                echo '<br>';
                unset($_SESSION['big_image']);
            }            
        ?>
        <div class="gallery">
                <div class="stickers">
                    <img id="1" src="../../public/img/stickers/SdS.png" onclick="changeImage('1');">
                    <img id="2" src="../../public/img/stickers/SdT.png" onclick="changeImage('2');">
                    <img id="3" src="../../public/img/stickers/Ser.png" onclick="changeImage('3');">
                    <img id="4" src="../../public/img/stickers/SeZ.png" onclick="changeImage('4');">
                    <img id="5" src="../../public/img/stickers/SfD.png" onclick="changeImage('5');">
                </div>
                <div class="picutre">
                    <img src="" id="stk" class="old">
                    <div class="video"><video id="vid" style="width:378px"></video></div>
                    <br>
                    <div class="canvas"><canvas id="canvas"style="width:378px"></canvas></div>
                    <div class="ikhan"><img src="<?= $_SESSION['path']?>" id="picture" class="path"></div>
                    <br>
                    <img src="" id="new" class="new">
                    <button class="btn btn-primary" onclick="picutre();">take picture</button>
                    <form action="/gallery/camera" method="POST" enctype="multipart/form-data">
                        <div class="upload">
                        <input type="file" name="img">
                        <button  class="btn btn-primary" name="upload" value="upload" onclick="upload();">upload</button>
                        </div>
                    </form>
                        <button class="btn btn-primary" onclick="save();" name="save" value="save">Save image</button>
                </div>
        </div>
        <script type="text/javascript" src="/../public/js/main.js">
		</script>
	</body>
</html>