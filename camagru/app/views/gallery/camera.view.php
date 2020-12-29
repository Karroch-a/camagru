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
                    <img id="1" src="https://svgshare.com/i/SdS.svg" onclick="changeImage('1');">
                    <img id="2" src="https://svgshare.com/i/SdT.svg" onclick="changeImage('2');">
                    <img id="3" src="https://svgshare.com/i/Ser.svg" onclick="changeImage('3');">
                    <img id="4" src="https://svgshare.com/i/SeZ.svg" onclick="changeImage('4');">
                    <img id="5" src="https://svgshare.com/i/SfD.svg" onclick="changeImage('5');">
                </div>
                <div class="picutre">
                    <img src="" id="stk">
                    <div class="video"><video id="vid" style="width:378px"></video></div>
                    <br>
                    <div class="canvas"><canvas id="canvas"style="width:378px" ></canvas></div><br>
                    <img src="<?php ?>" style="width:378px">
                    <button class="btn btn-primary" onclick="picutre();">take picture</button>
                    <form action="/gallery/camera" method="POST" enctype="multipart/form-data">
                        <div class="upload">
                        <input type="file" name="img">
                        <button  class="btn btn-primary" name="upload" value="upload">uplaod</button>
                        </div>
                    </form>
                </div>
        </div>
        <script type="text/javascript" src="/../public/js/main.js">

		</script>
	</body>
</html>