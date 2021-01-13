<?php
    if (!isset($_SESSION['username']))
     {
         $this->redirect('/users/login');
     }
   require_once APP_PATH . DS . 'views' . DS .  'users' . DS . 'bootstrap.php';
?>
<html>
	<head>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
                <div class="direction">
                        <div class="picutre">
                            <div class="video"><video id="vid" style="width: 100%;"></video>
                                <img src="" id="stk" class="old">
                            </div>
                            <br>
                            <div class="canvas"><canvas id="canvas"style="width: 100%;"></canvas>
                            <div class="ikhan"><img src="<?= $_SESSION['path']?>" id="picture" class="path"></div>
                                <img src="" id="new" class="new">
                            </div>
                            <?php  unset($_SESSION['path'])?>
                            <br>
                            <button class="btn btn-primary" id = 'abaza' onclick="picutre();">take picture</button>
                            <form action="/gallery/camera" method="POST" enctype="multipart/form-data">
                                <div class="upload">
                                <input type="file" name="img" required>
                                <button  class="btn btn-primary" name="upload" value="upload" id = "upload">upload</button>
                                </div>
                            </form>
                                <button class="btn btn-primary" onclick="save();" name="save" value="save">Save image</button>
                        </div>
                        <div class="photos">
                            <?php extract($this->_data); ?>
                            <?php foreach($atoi as $img) : ?>
                            <div class = "save">
                                <img src=<?="../../public/img/picture/".$img['image_n']?>>
                                <i class="fa fa-trash fa-fw" aria-hidden="true" onclick="deleteImage('<?= $img['image_n']?>');"></i>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
        </div>
        <?php    require_once APP_PATH . DS . 'views' . DS .  'users' . DS . 'footer.php'; ?>
        <script type="text/javascript" src="/../public/js/main.js">
		</script>
	</body>
</html>