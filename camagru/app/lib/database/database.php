<?php
    $dsn = 'mysql:host=192.168.99.120;port=6033;dbname=db_aazeroua';
    $user = 'root';
    $pass = 'myrootpass';

    $connexion = null;
        try{
            $connexion = new \PDO($dsn, $user, $pass);
            $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
