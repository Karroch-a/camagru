<?php
  if (isset($_SESSION['username']))
  {
      $this->redirect('/users/profile');
  }
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
        if (isset($_SESSION['message'])) {
            $q = $_SESSION['message'];
            echo "<p class='alert alert-success text-center'>$q</p>";
            unset($_SESSION['message']);
        }
        if ($_SESSION['token_validate'])
        {
            $er =  $_SESSION['token_validate'];
            echo "<p class='alert alert-success text-center'> $er</p>";
            unset($_SESSION['token_validate']);
        }
        if ($_SESSION['token_not_valid'])
        {
            $er =  $_SESSION['token_not_valid'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            unset($_SESSION['token_not_valid']);
        }
        if (isset($_SESSION['username_error']))
        {
            $er =  $_SESSION['username_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            unset($_SESSION['username_error']);
        }
        if (isset($_SESSION['token_invalid']))
        {
            $er =  $_SESSION['token_invalid'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['token_invalid']);
        }
        else if (isset($_SESSION['success']))
        {
            $er =  $_SESSION['success'];
            echo "<p class='alert alert-success text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['success']);
        }
    ?>
        <div class="login-register">
            <!-- <img src="https://img.icons8.com/ios/100/000000/gender-neutral-user.png" class="face"> -->
            <form action="/users/login" method="POST">
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <div>
                        <button type="submit" class="btn" name="button">Login</button>
                    </div>
                    <a href="forgetpassword"><p>Forget Password</p></a>
            </form>
        </div>
    </body>
</html>