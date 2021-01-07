<?php

namespace CAMAGRU\Controllers;

use CAMAGRU\Models\usersmodel;
use CAMAGRU\LIB\Helper;
use CAMAGRU\LIB\FrontController;

class HomeController extends AbstractController
{
    use Helper;
    public function postAction()
    {
        $obj = new UsersModel();
        if ($_SERVER['REQUEST_METHOD'] == 'GET'){
            // foreach($obj->fetchImage() as $img)
            // {
            //     $_SESSION['image_name'] =  $img['image_n'];
            // }
            // $_SESSION['image_name'] =  $obj->fetchImage()['image_n'];\
            // var_dump($obj->fetchImage());
            // var_dump($this->$_data);
            $this->_data['home'] = $obj->fetchallImage();
            $this->_view();   
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['like']))
            {
                // echo json_encode($_POST['like']);
                // echo json_encode($like = $this->_data['home']['like']);
               $like =  $this->_data['home']['like_m'] + 1;
                $image_n = $_POST['like'];
                $obj->like($image_n, $like);
            }
        }
    }
}
