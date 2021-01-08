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
            $this->_data['home'] = $obj->fetchallImage();
            // echo "<pre>";
            // var_dump($this->_data['home']);
            // echo "</pre>";
            // die();
            $obj->fetchallImage();
            foreach($this->_data['home'] as $key)
            {
                $this->_data['user'][] = array_pop($obj->getOwnerImage($key['id']));
                // $this->_data['user'][] = "ali";
            }
            $this->_view();   
        }
        if ($_SERVER['REQUEST_METHOD'] == 'POST'){
            if (isset($_POST['logout']))
                {
                    session_destroy();
                    $this->redirect('/users/login');
                }
            if (isset($_POST['like']))
            {
                $like =   1;
                $image_n = $_POST['like'];
                if ($obj->checklike($image_n) == true)
                {
                    $obj->like($image_n, $like);
                    $li = $obj->countLike($image_n);
                    echo json_encode($li);
                }
                else
                {
                    $like = -1;
                    $obj->removelike($image_n, $like);
                    $li = $obj->countLike($image_n);
                    echo json_encode($li);
                }
            }
        }
    }
}
