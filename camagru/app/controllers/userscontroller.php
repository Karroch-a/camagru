<?php

namespace CAMAGRU\Controllers;

use CAMAGRU\Models\usersmodel;
use CAMAGRU\LIB\Helper;
use CAMAGRU\LIB\FrontController;

class UsersController extends AbstractController
{

    use Helper;
    public function defaultAction()
    {
        $this->_view();
    }
    public function registerAction()
    {
        if (isset($_POST['submit'])) 
        {
            $obj = new UsersModel();
            $obj->username = $_POST['username'];
            $obj->email = $_POST['email'];
            $obj->password = $_POST['password'];
            $obj->password2 = $_POST['confirm-password'];
            if (strlen($obj->username) < 5 || $obj->username == "" || strlen($obj->username) > 10 ||!filter_var($obj->username, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW)) {
                $_SESSION['username_error'] = 'Invalid Username';
            } 
            else if (!filter_var($obj->email, FILTER_VALIDATE_EMAIL) || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $obj->email)) {
                $_SESSION['email_error'] = 'Invalid Email';
            } 
            else if (strlen($obj->password) <= '8') {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 8 Characters!';
            }
             else if ($obj->password !== $obj->password2) {
                $_SESSION['passowrd_error'] = 'The password and confirmation password do not match.';
            } 
            elseif (!preg_match("#[0-9]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Number!!';
            } 
            elseif (!preg_match("#[A-Z]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Lowercase Letter!';
            } 
            else if (!preg_match("#[a-z]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Capital Letter!';
            } 
            else 
            {
                $obj->password = md5($obj->password);
                $obj->rowcount = 0;
                $obj->password_token = 'NULL';
                $url = "http://192.168.99.125:8000/users/verify/";
                if ($obj->checkvalidateregister() == true) 
                {
                    $_SESSION['mail'] = $obj->email;
                    $obj->token = str_shuffle('ABCDEFGHJKK1234654120');
                    $_SESSION['shuffled'] = $obj->token;
                    $subject = 'verified accounts';
                    $message = "welcome to camagru . $obj->username <br> $url" .$obj->token;
                    $header .= "Content-type: text/html\r\n";
                    $obj->create();
                    $_SESSION['message'] = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
                    $_SESSION['check'] = mail($obj->email, $subject, $message, $header);
                    $this->redirect('/users/login');
                } 
            }
        }
        $this->_view();
    }
    public function loginAction()
    {
        if (isset($_POST['username']))
        {
            $obj = new UsersModel();
            if ($obj->checkvalidatelogin() == true)
            {
                $this->redirect('/users/profile');
            }
            else
            {
                $_SESSION['username_error'] = 'Wrong Username OR Password';
            }
        }
        $this->_view();
    }
    public function profileAction()
    {
        if (isset($_POST['apply']))
        {
            global $connexion;
            $obj = new UsersModel();
            if (isset($_POST['apply']))
            {
                if(isset($_FILES['upload']) && !empty($_FILES['upload']['name']))
                {
                    $error = "";
                    $imageName = $_FILES['upload']['name'];
                    $imageTmp = $_FILES['upload']['tmp_name'];
                    $imageSize = $_FILES['upload']['size'];
                    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif');
                    $extension = pathinfo($imageName, PATHINFO_EXTENSION);
                    if (getimagesize($imageSize))
                    {
                        if ($imageSize <= MAX_SIZE)
                        {
                            if (in_array($extension, $valid_extensions))
                            {
                                $imageName = md5(uniqid()).$extension;
                                if (move_uploaded_file($imageTmp, 'upload', $imageName))
                                {
                                    echo "success";
                                }
                                else
                                {
                                    $error = "implossible upload";
                                }
                            }
                            else
                            {
                                $error = "extension isn't accepted";
                            }
                        }
                        else
                        {
                            $error = "image is so big";
                        }
                    }
                else
                {
                    $error = 'no File selected';
                }
            }
        } 
            $stmt = $connexion->prepare("UPDATE users SET image_profile = '$image_profile' WHERE username = $obj->username");
            echo $stmt->execute();
        }
        $this->_view();
    }
    public function verifyAction()
    {
        $obj = new UsersModel();
        if ($obj->token() == true)
        {
            $obj->update();
            $_SESSION['token_validate'] = 'account valid';
            $this->redirect('/users/login');
        }
        else
        {
            $_SESSION['token_not_valid'] = 'token not valid';
            $this->redirect('/users/login');
        }
        $this->_view();
    }
    public function forgetpasswordAction()
    {
        $obj = new UsersModel();
        $obj->email = $_POST['email'];
        if (isset($_POST['submit']))
        {
            if (!filter_var($obj->email, FILTER_VALIDATE_EMAIL) || !preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $obj->email))
            {
                $_SESSION['email_error'] = 'Invalid Email';
            }
            else if ($obj->checkmail() == true)
            {
                global $connexion;
                $url = "http://192.168.99.125:8000/users/verify/";
                $obj->password_token = str_shuffle('ABCDEFGHJKK1234654@2842942@!8Hd)()@$QQHE=1-1=1=][LDLD');
                $subject = 'reset password';
                $message = "welcome to camagru . $obj->username <br> $url".$obj->password_token;
                $header .= "Content-type: text/html\r\n";
                $_SESSION['forgetpassword'] = 'please verify it by clicking the reset link that has been send to your email.';
                $_SESSION['check'] = mail($obj->email, $subject, $message, $header);
                $_SESSION['email'] = $obj->email;
                $sql = "UPDATE users SET password_token = '$obj->password_token' WHERE email = '$obj->email'";
                $stmt = $connexion->prepare($sql);
                $stmt->execute();
            }
        }
        $this->_view();
    }
    public function editpasswordAction()
    {
        if (isset($_POST['submit'])) {
            $obj = new UsersModel();
            $obj->password = $_POST['new'];
            $obj->password2 = $_POST['confirm'];
            if (strlen($obj->password) <= '8') {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 8 Characters!';
            }
             else if ($obj->password !== $obj->password2) {
                $_SESSION['passowrd_error'] = 'The password and confirmation password do not match.';
            } 
            elseif (!preg_match("#[0-9]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Number!!';
            } 
            elseif (!preg_match("#[A-Z]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Lowercase Letter!';
            } 
            else if (!preg_match("#[a-z]+#", $obj->password)) {
                $_SESSION['passowrd_error'] = 'Your Password Must Contain At Least 1 Capital Letter!';
            }
            else
            {
                if ($obj->edit() == true)
                {
                    $_SESSION['success'] = 'success password is changed please login in your account';
                    $this->redirect('/users/login');
                }
                
                else
                $_SESSION['token_invalid'] = 'token_invalid';
                $this->redirect('/users/login');
            }
        }
        $this->_view();
    }
}