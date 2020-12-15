<?php

if (isset($_POST['logout']))
{
    session_destroy();
    $this->redirect('/users/login');
}
?>
<html>
    <head>
        <title>Camagru</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <nav class="navbar navbar-light bg-light">
        <div class="d-inline-block align-top">
            <a class="navbar-brand" href="\index">
                <img src="/img/shutter.png" width="30" height="30"  alt="logo">
            </a>
            <a class="navbar-brand" href="/index">Home</a>
            <a class="navbar-brand" href="/gallery/camera">Gallery</a>
        </div>
        <a class="login-resgister">
            <div class="btn pull-right">
            <form  method="POST" name="Logout">
            <?php if (isset($_SESSION['username'])):?>
                <a href="/users/profile" class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo 'Hi ' . $_SESSION['username'] ?></a>
                <a href="/users/login"><input type="submit"  class="btn btn-outline-success my-2 my-sm-0" name="logout" value="Logout"></a>
            </form>
            <?php else :?>
                <a href="/users/login" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
                <a href="/users/register" class="btn btn-outline-success my-2 my-sm-0"  type ='logout'type="submit">Resgister</a>
            </div>
            <?php endif; ?>
    </nav>
    </html>