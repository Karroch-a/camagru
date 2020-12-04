<?php

    use CAMAGRU\Config;
    $dsn = 'mysql:host=localhost;port=81;dbname=db_aazeroua';
    $user = 'root';
    $pass = 'myrootpass';

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $password = md5($password);
        try{
            $db = new PDO($dsn, $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $q =  "INSERT INTO users (username, email, password)
                    VALUES ('$username', '$email', '$password')";
        } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>
