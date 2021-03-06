<?php
    if (isset($_SESSION['username']))
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
        if (isset($_SESSION['username_error'])) {
            $q = $_SESSION['username_error'] ;
            echo "<p class='alert alert-danger text-center '>$q</p>";
            echo '<br>';
            unset($_SESSION['username_error'] );
        } else if (isset($_SESSION['email_error'])) {
            $er =  $_SESSION['email_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['email_error']);
        } else if (isset($_SESSION['passowrd_error'])) {
            $er =  $_SESSION['passowrd_error'];
            echo "<p class='alert alert-danger text-center '> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error']);
        } else if (isset($_SESSION['passowrd_error'])) {
            $er =  $_SESSION['passowrd_error'];
            echo "<p class='alert alert-danger '> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error']);
        } else if (isset($_SESSION['passowrd_error'])) {
            $er =  $_SESSION['passowrd_error'];
            echo "<p class='alert alert-danger text-center'> $er</p>";
            echo '<br>';
            unset($_SESSION['passowrd_error']);
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
    <div class="respon">
        <div class="register">
            <form action="/users/register" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="text" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="confirm-password" placeholder="Confirm Password" required>
                <button type="submit" class="btn" name="submit">Register</button>
                <p> Already a member ? <a href="login" style="color: black;">Sign in</a></p>
            </form>
        </div>
    </div>
    <?php   require_once "footer.php"; ?>
</body>

</html>