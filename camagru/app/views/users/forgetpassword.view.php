<?php
    require_once "bootstrap.php";
    require_once "footer.php";
?>
<html>
    <head>
    <title>Camagru</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="../../public/css/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body>
        <div class="login-register">
            <h2>Find your Camagru account</h2>
            <form action="/users/forgetpassword" method="POST">
                <input class="trasn" type="text" name="email" placeholder="Email address" style="color: black;">
                <button class="btn" type="reset" value="Reset">Search</button>
        </div>
    </body>
</html>