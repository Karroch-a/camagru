<?php
 if (!isset($_SESSION['username']))
 {
     $this->redirect('/users/login');
 }
    require_once "bootstrap.php";
    require_once "footer.php";
?>
<html>
<head>
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (isset($_SESSION['error'])) {
            $q = $_SESSION['error'] ;
            echo "<p class='alert alert-danger text-center'>$q</p>";
            echo '<br>';
            unset($_SESSION['error'] );
        } else if (isset($_SESSION['email_error'])) {
            $er =  $_SESSION['email_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['email_error']);
        } else if (isset($_SESSION['ok'])) {
            $er =  $_SESSION['ok'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['ok']);
        } else if (isset($_SESSION['passowrd_error1'])) {
            $er =  $_SESSION['passowrd_error1'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error2']);
        } else if (isset($_SESSION['passowrd_error3'])) {
            $er =  $_SESSION['passowrd_error3'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error3']);
        }
        else if (isset($_SESSION['passowrd_error4'])) {
            $er =  $_SESSION['passowrd_error4'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error4']);
        }
        else if (isset($_SESSION['passowrd_error5'])) {
            $er =  $_SESSION['passowrd_error5'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error5']);
        }
        if(isset($_SESSION['email_already']))
        {
            $er =  $_SESSION['email_already'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['email_already']);
        }
        else if(isset($_SESSION['username_already']))
        {
            $er =  $_SESSION['username_already'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['username_already']);
        }
        ?>
        <div class="account">
            <form action="/users/profile" method="POST" enctype="multipart/form-data">
                <h1>General Account Settings</h1>
                <div class="tr"></div>
                <div class="inp">
                    <h5>Username<h5>
                    <input type="text" name="username" placeholder="Username">
                    <h5>Email address<h5>
                    <input type="text" name="email" placeholder="Email">
                    <h5>Password</h5>
                    <input type="password" name="password" placeholder="Password">
                     <div class="tr"></div>
                        <div class="change"><h3>Change your password</h3>
                        <a class="btn btn-raised" href="/users/change_password" target="_blank" rel="noopener">Change password</a>
                        </div>
                    <div class="tr"></div>
                    <div class="delete">
                        <h3>Delete Account</h3><h5>By deleting your account you will lose all your data</h5>
                        <button type="submit" class="btn btn-raised btn-danger" name="delete">Delete</button>
                    </div>
                    <div class="tr"></div>
                    <div class="cmnt">
                        <h3>Comment Notification Email</h3>
                        <input type="checkbox" name="" >
                    </div>
                    <div class="inp_btn"><button type="submit" class="btn" name="save">Save changes</button></div>
                </div>
            </form>
        </div>
    </body>
</html>