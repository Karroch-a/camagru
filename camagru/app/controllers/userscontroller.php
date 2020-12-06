<?php

namespace CAMAGRU\Controllers;

use CAMAGRU\Models\usersmodel;
use CAMAGRU\LIB\Helper;

class UsersController extends AbstractController
{

    use Helper;
    public function defaultAction()
    {
        $this->_view();
    }
    public function registerAction()
    {
        if (isset($_POST['submit'])) {
            $obj = new UsersModel();
            $obj->username = $_POST['username'];
            $obj->email = $_POST['email'];
            $obj->password = $_POST['password'];
            $obj->password2 = $_POST['confirm-password'];
            if (strlen($obj->username) < 5 || $obj->username == "") {
                $_SESSION[$obj->username_error] = 'Invalid Username';
            } 
            else if (!filter_var($obj->email, FILTER_VALIDATE_EMAIL) || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $obj->email)) {
                $_SESSION[$obj->email_error] = 'Invalid Email';
            } 
            else if (strlen($obj->password) <= '8') {
                $_SESSION[$obj->passowrd_error] = 'Your Password Must Contain At Least 8 Characters!';
            }
             else if ($obj->password !== $obj->password2) {
                $_SESSION[$obj->passowrd_error] = 'The password and confirmation password do not match.';
            } 
            elseif (!preg_match("#[0-9]+#", $obj->password)) {
                $_SESSION[$obj->passowrd_error] = 'Your Password Must Contain At Least 1 Number!!';
            } 
            elseif (!preg_match("#[A-Z]+#", $obj->password)) {
                $_SESSION[$obj->passowrd_error] = 'Your Password Must Contain At Least 1 Lowercase Letter!';
            } 
            else if (!preg_match("#[a-z]+#", $obj->password)) {
                $_SESSION[$obj->passowrd_error] = 'Your Password Must Contain At Least 1 Capital Letter!';
            } 
            else 
            {
                $obj->password = md5($obj->password);
                if ($obj->checkvalidate() == true) 
                {
                    $obj->create();
                    $_SESSION['message'] = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                    $this->redirect('/users/login');
                } 
            }
        }
        $this->_view();
    }
    public function loginAction()
    {
        $this->_view();
    }
    public function profileAction()
    {
        $this->_view();
    }
    public function forgetpasswordAction()
    {
        $this->_view();
    }
}