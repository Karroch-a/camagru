<?php
 if (!isset($_SESSION['username']))
 {
     $this->redirect('/users/login');
 }
 if (isset($_POST['logout']))
 {
     session_destroy();
     $this->redirect('/users/login');
 }
    require_once "bootstrap.php";
    require_once "footer.php";
?>
<html>
<head>
    <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../public/css/style.css">
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
                <h1>Account</h1>
                <h4><?php echo ucfirst($_SESSION['username']) ?></h4>
                <div class="photo_profile">
                    <button type="submit" class="btn" name="apply">Apply</button>
                    <div class="d"><button type="submit" class="btn" name="remove">Remove</button></div>
                </div>
                <input type="file" name="upload" class="btn">
                <div class="tr"></div>
                <div class="inp">
                    <input type="text" name="username" placeholder="Username">
                    <input type="text" name="email" placeholder="Email">
                    <input type="password" name="password" placeholder="Password">
                    <input type="password" name="confirm-password" placeholder="Confirm Password">
                    <div class="tr"></div>
                    <div class="delete">
                        <h3>Delete Account</h3>By deleting your account you will lose all your data
                        <button type="submit" class="btn" name="delete">delete</button>
                    </div>
                    <button type="submit" class="btn" name="save">Save changes</button>
                </div>
            </form>
        </div>
    </body>
</html>