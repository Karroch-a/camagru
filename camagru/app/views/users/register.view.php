<?php
    require_once "bootstrap.php";
    require_once "footer.php";
?>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
        if ($_SESSION[$obj->username_error] == true) {
            $q = $_SESSION[$obj->username_error];
            echo "<p class='alert alert-danger text-center'>$q</p>";
            echo '<br>';
            unset($_SESSION[$obj->username_error]);
        } else if ($_SESSION[$obj->email_error] == true) {
            $er =  $_SESSION[$obj->email];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION[$obj->email_error]);
        } else if ($_SESSION[$obj->password_error] == true) {
            $er =  $_SESSION[$obj->password_error];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION[$obj->password_error]);
        } else if ($_SESSION[$obj->password_error] == true) {
            $er =  $_SESSION[$obj->password_error];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION[$obj->password_error]);
        } else if ($_SESSION[$obj->passsword_error] == true) {
            $er =  $_SESSION[$obj->passsword_error];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION[$obj->password_error]);
        }
        else if(isset($_SESSION['email_already']))
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
    <div class="register">
        <!-- <img src="https://img.icons8.com/ios/100/000000/gender-neutral-user.png" class="face"> -->
        <form action="/users/register" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="text" name="email" placeholder="Email">
            <input type="password" name="password" placeholder="Password">
            <input type="password" name="confirm-password" placeholder="Confirm Password">
            <button type="submit" class="btn" name="submit">Register</button>
            <p> Already a member ? <a href="login" style="color: black;">Sign in</a></p>
        </form>
    </div>
</body>

</html>