<?php

    namespace CAMAGRU\Models;
    use CAMAGRU\Controllers\userscontroller;

    class ErrorModel extends UsersController
    {
        public function errormodels()
        {
            if ($_SESSION[$obj->username_error] == true)
            {
               $q = $_SESSION[''];
                echo "<p class='alert alert-danger text-center'>$q</p>";
                echo '<br>';
            }
            else if ($_SESSION[$obj->email_error] == true)
            {
                $er =  $_SESSION[$obj->email];
                echo "<p class='alert alert-danger text-center'> $er</p>";
                echo '<br>';
            }
            else if ($_SESSION[$obj->password_error] == true)
            {
                $er =  $_SESSION[$obj->password_error];
                echo "<p class='alert alert-danger text-center'> $er</p>";
                echo '<br>';
            }
            else if ($_SESSION[$obj->password_error] == true)
            {
                $er =  $_SESSION[$obj->password_error];
                echo "<p class='alert alert-danger text-center'> $er</p>";
                echo '<br>';
            }
            else if ($_SESSION[$obj->passsword_error] == true)
            {
                $er =  $_SESSION[$obj->passsword_error];
                echo "<p class='alert alert-danger text-center'> $er</p>";
                echo '<br>';
            }
        }
    }


?>