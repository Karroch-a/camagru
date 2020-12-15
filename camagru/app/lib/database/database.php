<?php
    namespace CAMAGRU\LIB\Database;
    use CAMAGRU\Config;
    
    $dsn = "mysql:host=".DATABASE_HOST_NAME.";port=".DATABASE_PORT_NUMBER.";dbname=".DATABASE_DB_NAME;
    $user = DATABASE_USER_NAME;
    $pass = DATABASE_PASSWORD;

    $connexion = null;
        try{
            $connexion = new \PDO($dsn, $user, $pass);
            $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }