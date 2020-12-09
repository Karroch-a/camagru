<?php
  if (isset($_SESSION['username']))
  {
      $this->redirect('/users/profile');
  }
  $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
  $check_token = $url[2];
  if ($_SESSION['shuffled1'] != $check_token)
  {
    $this->redirect('/users/login');
  }
  if ($check_token == '')
  {
    $this->redirect('/users/login');
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
        if (isset($_SESSION['passowrd_error']))
        {
            $er =  $_SESSION['passowrd_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error']);
        }
        ?>
        <div class="login-register">
            <!-- <img src="https://img.icons8.com/ios/100/000000/gender-neutral-user.png" class="face"> -->
            <form action="/users/login" method="POST">
                    <input type="password" name="new" placeholder="New Password">
                    <input type="password" name="confirm" placeholder="Confirm Password">
                    <div>
                        <button type="submit" class="btn" name="submit">Reset</button>
                    </div>
            </form>
        </div>
    </body>
</html>