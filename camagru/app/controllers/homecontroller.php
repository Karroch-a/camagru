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
            $num = $obj->GetcountofImage();
            $limit = 2;
            $count = ceil($num / $limit);
            $page = $_GET['start'];
            if (!$page)
            {
                $page = 0;
            }
            $start = $page * $limit;
            $this->_data['home'] = $obj->fetchallImage($start,$limit);
            $liked = $obj->checklikeByID();
            for ($i = 0; $i < count($this->_data['home']); $i++){
                $this->_data['home'][$i]['username'] = array_pop(array_pop($obj->getOwnerImage($this->_data['home'][$i]['id'])));
            }
            for ($i = 0; $i < count($this->_data['home']); $i++){
                $this->_data['home'][$i]['liked'] = false;
                for($j = 0; $j < count($liked); $j++){
                    if ($this->_data['home'][$i]['image_n'] == $liked[$j]['image_n']){
                        $this->_data['home'][$i]['liked'] = true;
                    }
                }
            }
            $cmnt = $obj->fetchCmnt();
            for ($i = 0; $i < count($this->_data['home']); $i++){
                $this->_data['home'][$i]['countofimage'] = $count;
                for($j = 0; $j < count($cmnt); $j++){
                    if ($this->_data['home'][$i]['image_n'] == $cmnt[$j]['image_n']){
                        $this->_data['home'][$i]['cmnt'] = $cmnt;
                    }
                }
            }
            for ($i = 0; $i < count($this->_data['home']); $i++){
                for($j = 0; $j < count($this->_data['home'][$i]['cmnt']); $j++){
                    $this->_data['home'][$i]['cmnt'][$j]['username'] = array_pop(array_pop($obj->getOwnerImage($this->_data['home'][$i]['cmnt'][$j]['id_user'])));;
                }
            }
            // for ($i = 0; $i < count($this->_data['home']); $i++){
            //     $this->_data['home'][$i]['cmnt'] = $obj->fetchCmnt();
            // }
            // echo "<pre>";
            // // for($j = 0; $j < count($liked); $j++){
            // //     print_r($liked[$j]['image_n']);
            // // }
            // // var_dump($obj->fetchCmnt('pic-1610373610.png'));
            // var_dump($this->_data);
            // echo "</pre>";
            // die();
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
                    $li['liked'] = 'like';
                    echo json_encode($li);
                }
                else
                {
                    $like = -1;
                    $obj->removelike($image_n, $like);
                    $li = $obj->countLike($image_n);
                    $li['liked'] = 'unlike';
                    echo json_encode($li);
                }
            }
             if (!isset($_SESSION['username']))
            {
                $this->redirect('/users/login');
            }
            if (isset($_POST['nameofimage']) && isset($_POST['cmnt']))
            {
                $cmnt = $_POST['cmnt'];
                $image_n = $_POST['nameofimage'];
                if (trim($cmnt) !==  '')
                {
                    $obj->addCmnt($image_n, trim($cmnt));
                    $li = $obj->fetchCmnt($image_n);
                }
                echo json_encode($li);
                }
        }
    }
}
