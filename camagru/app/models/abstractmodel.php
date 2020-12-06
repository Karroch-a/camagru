<?php

    namespace CAMAGRU\Models;
    
    class AbstractModel
    {
        const DATA_TYPE_STR = \PDO::PARAM_STR;
        const DATA_TYPE_INT = \PDO::PARAM_INT;

        private function buildparamssql()
        {
            $nameparams='';
            foreach(static::$tableSchema as $columName => $type)
            {
                $nameparams .= $columName . '= :' . $columName . ', ';
            }
            return trim($nameparams, ', ');
        }
        public function create()
        {
            
            global $connexion;
            $sql = 'INSERT INTO ' . static::$tableName . ' SET ' . self::buildparamssql();
            $stmt = $connexion->prepare($sql);
            foreach(static::$tableSchema as $columName => $type)
            {
                $stmt->bindParam(":{$columName}", $this->$columName, $type);
            }
            return $stmt->execute();
        }
        public function checkvalidate()
        {
            global $connexion;
            $username = $_POST['username'];
            $email = $_POST['email'];
            if (isset($email))
            {
                $sql_username = 'SELECT email FROM  users WHERE username = ?';
                $sql_email = 'SELECT email FROM  users WHERE email = ?';
                $stmt_username = $connexion->prepare($sql_username);
                $stmt_email = $connexion->prepare($sql_email);
                $stmt_email->execute([$email]);
                $stmt_username->execute([$username]);
                if ($stmt_email->rowCount() >= 1)
                {
                        $_SESSION['email_already'] = 'sorry! email already exist';
                        return false;
                }
                else if ($stmt_username->rowCount() >= 1)
                {
                        $_SESSION['username_already'] = 'sorry! username already exist';
                        return false;
                }
                else
                {
                    return true;
                }
            }
        }
        // public function getall()
        // {
        //     global $connexion;
        //     $sql = 'SELECT * FROM ' . static::$tableName;
        //     $stmt = $connexion->prepare($sql);
        //     return $stmt->execute();
        // }
    }
?>