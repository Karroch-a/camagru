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
    </head>
    <nav class="navbar navbar-light bg-light">
        <div class="d-inline-block align-top">
            <a class="navbar-brand" href="\index">
                <img src="/img/shutter.png" width="30" height="30"  alt="logo">
            </a>
            <a class="navbar-brand" href="/home/post">Home</a>
            <a class="navbar-brand" href="/gallery/camera">Gallery</a>
        </div>
        <a class="login-resgister">
            <div class="d-inline-block d-lg-none ml-md-0 ml-auto py-3"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 0 1 3 11h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 7h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5zm0-4A.5.5 0 0 1 3 3h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5z"/>
            </svg></div>
                <div class="d-none d-lg-block">
                    <ul class="navbar-nav ml-auto">
                    <form  method="POST" name="Logout">
                    <?php if (isset($_SESSION['username'])):?>
                        <li class="">
                        <a href="/users/profile" class="btn btn-outline-success my-2 my-sm-0" type="submit"><?php echo 'Hi ' . $_SESSION['username'] ?></a>
                        <a href="/users/login"><input type="submit"  class="btn btn-outline-success my-2 my-sm-0" name="logout" value="Logout"></a>
                        <li>
                    </form>
                    <?php else :?>
                        <a href="/users/login" class="btn btn-outline-success my-2 my-sm-0" type="submit">Login</a>
                        <a href="/users/register" class="btn btn-outline-success my-2 my-sm-0"  type ='logout'type="submit">Resgister</a>
            <?php endif; ?>
            </div>
                </ul>
    </nav>
    </html>