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
            $limit = 5;
            $count = ceil($num / $limit);
            $page = $_GET['start'];
            if (!$page)
            {
                $page = 0;
            }
            if ($_GET['start'] < 0)
            {
                $this->redirect("/home/post");
            }
            if ($_GET['start'] > $count)
            {
                $this->redirect("/home/post");
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
            if (isset($_POST['nameofimage']) && isset($_POST['cmnt']))
            {
                if (!isset($_SESSION['id']))
                {
                    $this->redirect('/users/login');
                }
                else
                {
                    $cmnt = $_POST['cmnt'];
                    $image_n = $_POST['nameofimage'];
                    if (trim($cmnt) !==  '')
                    {
                        $obj->addCmnt($image_n, trim($cmnt));
                        if ($_SESSION['id'] != $_POST['user_id'])
                        {
                            $email = $obj->getemailOfImage($_POST['user_id'])['email'];
                            $subject = 'New comment';
                            $message = '<html><body>';
                            $message .= "<h4 style='font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;'>Hi there, someone commented on your photo</h4>";
                            $message .= '</body></html>';
                            $message .= '<h4>Thank you, <br>The Camagru Team</h4>';
                            $header .= "Content-Type: text/html; charset=UTF-8\r\n";
                            mail($email, $subject, $message, $header);   
                        }
                    }
                }
            }
            if ($_SESSION['id'] == $_POST['id_user'])
            {
                $obj->deletecmnt($_POST['id_cmnt']);
                echo json_encode('cmnt is deleted');
            }
        }
    }
    public function defaultAction()
    {
        $this->_view();
    }
}
