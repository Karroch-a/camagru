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
            $obj->fetchallImage();
            for ($i = 0; $i < count($this->_data['home']); $i++){
                $this->_data['home'][$i]['username'] = array_pop(array_pop($obj->getOwnerImage($this->_data['home'][$i]['id'])));
            }
            for ($i = 0; $i < count($this->_data['home']); $i++){
                $this->_data['home'][$i]['id_image'] = $obj->checklikeByID();
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
