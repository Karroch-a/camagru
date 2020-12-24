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
                var_dump($_FILES['img']);
                $path = __DIR__ . "\imgs\\";
                echo $path;
                if (!is_dir($path)){
                    mkdir($path, 0777, true);
                }
                move_uploaded_file($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']);
                // var_dump($_FILES['img']);
                
                // echo $path = APP_PATH . DS . 'views' . DS .  'users' .DS . 'upload' . DS ;
                // $type = mime_content_type($_FILES['img']['tmp_name']);
                // if(in_array($type, array('image/jpeg', 'image/jpg', 'image/png')))
                // {
                //     var_dump(move_uploaded_file($_FILES['img']['tmp_name'], $path . $_FILES['img']['name']));
                //     echo 'OK';
                // } 
                // else 
                // {
                //     echo 'Upload a real image';
                // }
            }
                $this->_view();
        }
    }