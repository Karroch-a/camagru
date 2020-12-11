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
        <div class="account">
            <form action="/users/profile" method="POST"enctype="multipart/form-data">
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
                        <button type="submit" class="btn" name="delete">Delete</button>
                    </div>
                    <button type="submit" class="btn" name="submit">Save changes</button>
                </div>
            </form>
        </div>
    </body>
</html>