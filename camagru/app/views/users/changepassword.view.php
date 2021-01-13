<?php
  if (!isset($_SESSION['username']))
  {
      $this->redirect('/users/profile');
  }
    require_once "bootstrap.php";
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <?php
        if (isset($_SESSION['passowrd_error'])) {
            $er =  $_SESSION['passowrd_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error']);
        }
        ?>
        <div class="respon">
        <div class="login-register">
            <!-- <img src="https://img.icons8.com/ios/100/000000/gender-neutral-user.png" class="face"> -->
            <form action="/users/changepassword" method="POST">
                    <input type="password" name="current" placeholder="Current Password" required>
                    <input type="password" name="new" placeholder="New Password" required>
                    <input type="password" name="confirm" placeholder="Confirm Password" required>
                    <div>
                        <button type="submit" class="btn" name="change">Reset</button>
                    </div>
            </form>
        </div>
        </div>
        <?php require_once "footer.php"; ?>
    </body>
</html>