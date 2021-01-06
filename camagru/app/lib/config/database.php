<?php
    namespace CAMAGRU\LIB\Config;
    use CAMAGRU\Config;
    
    $DB_DSN = "mysql:host=".DATABASE_HOST_NAME.";port=".DATABASE_PORT_NUMBER.";dbname=".DATABASE_DB_NAME;
    $DB_USER = DATABASE_USER_NAME;
    $DB_PASSWORD = DATABASE_PASSWORD;

    $connexion = null;
        try{
            $connexion = new \PDO($DB_DSN, $DB_USER, $DB_PASSWORD, [
                \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC
            ]);
            $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }