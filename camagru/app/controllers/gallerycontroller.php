<?php
    namespace CAMAGRU\Controllers;
    use CAMAGRU\Models\usersmodel;
    use CAMAGRU\LIB\Helper;
    use CAMAGRU\LIB\FrontController;

    class GalleryController extends AbstractController
    {
        use Helper;
        public function cameraAction()
        {
            $obj = new UsersModel();
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
                $this->_data['atoi'] = $obj->fetchImage();
                $this->_view();
            }
            if (isset($_POST['upload']) && $_POST['upload']){
                $obj = new UsersModel();
                $path = '..' .DS . 'public' . DS .'img' .DS . 'upload';
                if (!is_dir($path))
                {
                    mkdir($path, 0777, true);
                }
                $size = $_FILES['img']['size'];
                $hash = md5(uniqid($_FILES['img']['tmp_name'], true));
                $type = mime_content_type($_FILES['img']['tmp_name']);
                $type_image = explode('/', $type, 2);
                $path = $path .'/'.$hash. '.'. $type_image[1];
                $name = $hash. '.'.$type_image[1];
                if(in_array($type, array('image/jpeg', 'image/jpg', 'image/png'))) 
                {
                    if ($size > 1000000)
                    {
                        $_SESSION['big_image'] = "image is so big";
                    }
                    
                    else
                    {
                        if (move_uploaded_file($_FILES['img']['tmp_name'], $path) == true)
                        {
                            $_SESSION['path'] = $path;
                            $this->redirect('/gallery/camera');
                        }
                    }
                }
                else 
                {
                    $_SESSION['image_error'] = 'please upload a real image';
                }
                $this->_view();
            }
            if ($_SERVER['REQUEST_METHOD'] == 'POST'){
                if (isset($_POST['logout']))
                {
                        session_destroy();
                        $this->redirect('/users/login');
                    }
                if (isset($_POST['stk']) && isset($_POST['img'])){
                    $path = '..' .DS . 'public' . DS .'img' .DS . 'picture' . DS;
                    $emoji_path = '..' .DS . 'public' . DS .'img' .DS . 'stickers' . DS;
                    $emoji = $_POST['stk'];
                    $img = str_replace('data:image/jpeg;base64,', '', $_POST['img']);
                    $img = str_replace(' ', '+', $img);
                    $fileData = base64_decode($img);
                    $fileName = $path . "pic-".time() . '.png';
                    $emoji = explode('/', $emoji, 7);
                    $src = $emoji_path . $emoji[6];
                    list($width,$height)=getimagesize($src);
                    $newwidth=114;
                    $newheight=($height/$width)*$newwidth;
                    $src = imagecreatefrompng($src);
                    $dest = imagecreatefromstring($fileData);
                    imagecopyresampled($dest, $src, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
                    imagepng($dest, $fileName, 0);
                    $name = explode('/', $fileName, 5);
                    $obj->uploadImage($name[4]);
                }
                if (isset($_POST['emoji']) && isset($_POST['pic'])){
                    $path = '..' .DS . 'public' . DS .'img' .DS . 'picture' . DS;
                    $emoji_path = '..' .DS . 'public' . DS .'img' .DS . 'stickers' . DS;
                    $picture_path = '..' .DS . 'public' . DS .'img' .DS . 'upload' . DS;
                    $emoji = $_POST['emoji'];
                    $fileName = $path . "pic-".time() . '.png';
                    $emoji = explode('/', $emoji, 7);
                    $dest = explode('/', $_POST['pic'], 7);
                    $picture = $picture_path . $dest[6];
                    $src = $emoji_path . $emoji[6];
                    list($width,$height)=getimagesize($src);
                    $newwidth=114;
                    $newheight=($height/$width)*$newwidth;
                    $src = imagecreatefrompng($src);
                    $dest = imagecreatefromjpeg($picture);
                    imagecopyresampled($dest, $src, 0, 0, 0, 0, $newwidth,$newheight, $width, $height);
                    imagepng($dest, $fileName, 0);
                    unlink($picture);
                    $name = explode('/', $fileName, 5);
                    $obj->uploadImage($name[4]);
                }
                if (isset($_POST['image_n']))
                {
                    $image_n = $_POST['image_n'];
                    $obj->deleteImage($image_n);
                    $path = '..' .DS . 'public' . DS .'img' .DS . 'picture' . DS . $image_n;
                    unlink($path);
                }
            }
        }
        public function defaultAction()
        {
            $this->_view();
        }
    }