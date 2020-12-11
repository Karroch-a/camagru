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
        public function checkvalidateregister()
        {
            global $connexion;
            $username = $_POST['username'];
            $email = $_POST['email'];
            if (isset($email))
            {
                $sql_username = 'SELECT username FROM  users WHERE username = ?';
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
        public function checkvalidatelogin()
        {
            global $connexion;
            $username = $_POST['username'];
            $password = $_POST['password'];
            $password = md5($password);
            $q = $connexion->prepare("SELECT COUNT(id) FROM users WHERE username = '$username' AND password = '$password'");
            $q_rowcount = $connexion->prepare("SELECT COUNT(id) FROM users WHERE username = '$username' AND password = '$password' AND rowcount = 1");
            $q->execute();
            $q_rowcount->execute();
            $count = $q->fetchColumn();
            $count_rowcount = $q_rowcount->fetchColumn();
            if ($count == "1")
            {
                if ($count_rowcount == "1")
                {
                   $_SESSION['username'] = $username;
                }
                else
                {
                    $_SESSION['validate_account'] = 'Please valid your account';
                }
            }
            else
            {
               $_SESSION['username_error'] = 'Wrong Username OR Password';
            }
        }
        public function token()
        {
            global $connexion;
            $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
            $check_token = $url[2];
            $q = $connexion->prepare("SELECT COUNT(id) FROM users WHERE token = '$check_token'");
            $q->execute();
            $count = $q->fetchColumn();
            if ($count == "1")
            {
                return true;
            }
            else
            {
              return false;
            }
        }
        public function update()
        {
            global $connexion;
            $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
            $check_token = $url[2];
            $row = "UPDATE  users SET rowcount = 1 WHERE token = '$check_token'";
            $tok = "UPDATE  users SET token = 'NULL'  WHERE rowcount = 1";
            $stmt_row = $connexion->prepare($row);
            $stmt_tok = $connexion->prepare($tok);
            $stmt_row->execute();
            $stmt_tok->execute();
        }
        public function editpassword()
        {
            global $connexion;
            $password = md5($_POST['new']);
            $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
            $check_token = $url[2];
            $q = $connexion->prepare("SELECT COUNT(id) FROM users WHERE rowcount = 1 AND password_token = '$check_token'");
            $q->execute();
            $count = $q->fetchColumn();
            if ($count == "1")
            {
                $row = "UPDATE users SET password = '$password' WHERE rowcount = 1 AND password_token = '$check_token'";
                $password_token = "UPDATE users SET password_token = 'NULL' WHERE password_token = '$check_token'";
                $stmt_row = $connexion->prepare($row);
                $password_token_s = $connexion->prepare($password_token);
                $stmt_row->execute();
                $password_token_s->execute();
                return true;
            }
            else
            {
              return false;
            }
        }
        public function checkmail()
        {
            global $connexion;
            $email = $_POST['email'];
            $q = $connexion->prepare("SELECT COUNT(id) FROM users WHERE email = '$email'");
            $q_rowcount = $connexion->prepare("SELECT COUNT(id) FROM users WHERE email = '$email' AND rowcount = 1");
            $q->execute();
            $q_rowcount->execute();
            $count = $q->fetchColumn();
            $count_rowcount = $q_rowcount->fetchColumn();
            if ($count == "1")
            {
                if ($count_rowcount == "1")
                {
                    return true;
                }
                else
                {
                    $_SESSION['validate'] = 'please valid your account first';
                }
            }
            else
            {
                $_SESSION['not_found_email'] = 'Your search did not return any results. Please try again with other information.';
                return false;
            }
        }
        public function delete()
        {
            global $connexion;
            $obj = new UsersModel();
            $username = $_SESSION['username'];
            $sql = "DELETE FROM users WHERE username = '$username'";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
    }
?>