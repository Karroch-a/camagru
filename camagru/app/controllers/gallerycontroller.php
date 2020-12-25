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
            if ($_POST['upload'])
            {
                $path = APP_PATH . DS . 'views' . DS .  'gallery' .DS . 'upload';
                if (!is_dir($path))
                {
                    mkdir($path, 0777, true);
                }
                $size = $_FILES['img']['size'];
                $hash = md5_file($_FILES['img']['tmp_name']);
                $type = mime_content_type($_FILES['img']['tmp_name']);
                $type_image = explode('/', $type, 2);
                $path = $path .'/'.$hash. '.'.$type_image[1];
                if(in_array($type, array('image/jpeg', 'image/jpg', 'image/png'))) 
                {
                    if ($size > 1000000)
                    {
                        $_SESSION['big_image'] = "image is so big";
                    }
                    
                    else
                    {
                        move_uploaded_file($_FILES['img']['tmp_name'], $path);
                    }
                }
                else 
                {
                   $_SESSION['image_error'] = 'please upload a real image';
                }
            }
            $this->_view();
        }
    }