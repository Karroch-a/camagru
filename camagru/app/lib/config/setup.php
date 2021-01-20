<?php

    namespace CAMAGRU\LIB\Config;
    use CAMAGRU\Config;
    use PDO;
    use PDOException;

    $DB_DSN = "mysql:host=".DATABASE_HOST_NAME.";port=".DATABASE_PORT_NUMBER.";dbname=INFORMATION_SCHEMA";
    $DB_USER = DATABASE_USER_NAME;
    $DB_PASSWORD = DATABASE_PASSWORD;

    $connexion = null;
        try{
            $connexion = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD, [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
    $sql  = "SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = 'db_aazeroua'";
    $stmt = $connexion->prepare($sql);
    $stmt->execute();
    if ($stmt->rowCount() == 0)
    {
        $sql = "CREATE DATABASE IF NOT EXISTS db_aazeroua";
        $stmt = $connexion->prepare($sql);
        $stmt->execute();
        $connexion->exec("use db_aazeroua");
        $connexion->exec("CREATE TABLE IF NOT EXISTS `users` (
            `id` int AUTO_INCREMENT PRIMARY KEY,
            `username` varchar(300) NOT NULL,
            `email` varchar(300) NOT NULL,
            `password` varchar(300) NOT NULL,
            `rowcount` int NOT NULL,
            `notification` int NOT NULL,
            `token` varchar(300) NOT NULL,
            `password_token` varchar(300) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
          $connexion->exec("CREATE TABLE IF NOT EXISTS `likes` (
            `id_image` int NOT NULL,
            `image_n` varchar(300) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
          $connexion->exec("CREATE TABLE IF NOT EXISTS `images` (
            `image_id` int AUTO_INCREMENT PRIMARY KEY,
            `id` int NOT NULL,
            `image_n` varchar(300) NOT NULL,
            `like_count` int NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
          $connexion->exec("CREATE TABLE IF NOT EXISTS `cmnt` (
            `id` int AUTO_INCREMENT PRIMARY KEY,
            `id_user` int NOT NULL,
            `image_n` varchar(300) NOT NULL,
            `comment` varchar(300) NOT NULL
          ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;");
    }
    else
    {

    }