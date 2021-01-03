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
            if ($_SERVER['REQUEST_METHOD'] == 'GET'){
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
                $path = $path .'/'.$hash. '.'.$type_image[1];
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
                            // $obj->uploadImage($name);
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
                    
                }
            }
        }
    }