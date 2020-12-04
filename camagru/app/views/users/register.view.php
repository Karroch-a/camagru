<?php
 namespace CAMAGRU\Users;
 use CAMAGRU\Models\errormodel;
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="register">
            <!-- <img src="https://img.icons8.com/ios/100/000000/gender-neutral-user.png" class="face"> -->
            <form action="/users/register" method="POST">
                <input type="text" name="username" placeholder="Username">
                <input type="text" name="email" placeholder="Email">
                <input type="password" name="password" placeholder="Password">
                <input type="password" name="confirm-password" placeholder="Confirm Password">
                <button type="submit" class="btn" name="submit">Register</button>
                <p > Already a member ? <a href="login" style="color: black;">Sign in</a></p>
            </form>
        </div>
    </body>
</html>