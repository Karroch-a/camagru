<?php
    if (isset($_SESSION['username']))
    {
        $this->redirect('/users/profile');
    }
    require_once "bootstrap.php";
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
            if ($_SESSION['forgetpassword'])
            {
                $er  = $_SESSION['forgetpassword'];
                echo "<p class='alert alert-success text-center'>$er</p>";
                unset($_SESSION['forgetpassword']);
            }
            if ($_SESSION['email_error'])
            {
                $er  = $_SESSION['email_error'];
                echo "<p class='alert alert-danger text-center'>$er</p>";
                unset($_SESSION['email_error']);
            }
            if ($_SESSION['not_found_email'])
            {
                $er  = $_SESSION['not_found_email'];
                echo "<p class='alert alert-danger text-center'>$er</p>";
                unset($_SESSION['not_found_email']);
            }
            else if ($_SESSION['validate'])
            {
                $er  = $_SESSION['validate'];
                echo "<p class='alert alert-danger text-center'>$er</p>";
                unset($_SESSION['validate']);
            }
        ?>
        <div class="respon">
            <div class="login-register">
                <h2>Find your Camagru account</h2>
                <form action="/users/forgetpassword" method="POST">
                    <input type="text" name="email" placeholder="Email" required>
                    <button type="submit" class="btn" name="submit">Search</button>
            </div>
        </div>
        <?php require_once "footer.php"; ?>
    </body>
</html>