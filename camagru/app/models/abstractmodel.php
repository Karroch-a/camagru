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
            if (is_array($_POST['username']))
            {
                $username =  '';
            }
            else
            {
                $username = $_POST['username'];
            }
            $password = $_POST['password'];
            $password = md5($password);
            $q = $connexion->prepare('SELECT COUNT(id) FROM users WHERE username = "'.$username.'" AND password = "'.$password.'"');
            $q_rowcount = $connexion->prepare('SELECT COUNT(id) FROM users WHERE username = "'.$username.'" AND password = "'.$password.'" AND rowcount = 1');
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
            $q = $connexion->prepare('SELECT COUNT(id) FROM users WHERE email = "'.$email.'"');
            $q_rowcount = $connexion->prepare('SELECT COUNT(id) FROM users WHERE email = "'.$email.'" AND rowcount = 1');
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
            $id = $_SESSION['id'];
            $sql_user = 'DELETE FROM users WHERE id = "'.$id.'"';
            $sql_image = 'DELETE FROM images WHERE id = "'.$id.'"';
            $sql_cmnt = 'DELETE FROM cmnt WHERE id_user = "'.$id.'"';
            $sql_likes = 'DELETE FROM likes WHERE id_image = "'.$id.'"';
            $stmt_user = $connexion->prepare($sql_user);
            $stmt_image = $connexion->prepare($sql_image);
            $stmt_cmnt = $connexion->prepare($sql_cmnt);
            $stmt_likes = $connexion->prepare($sql_likes);
            $stmt_user->execute();
            $stmt_image->execute();
            $stmt_cmnt->execute();
            $stmt_likes->execute();
        }
        public function profileinfo($id)
        {
            global $connexion;
            $username = $_POST['username'];
            $email = $_POST['email'];
            if (($_POST['notification']))
                $not = 1;
            else
                $not = 0;
            $row_email = 'UPDATE  users SET email = "'.$email.'" WHERE id = "'.$id.'"';
            $row_user = 'UPDATE  users SET username = "'.$username.'" WHERE id = "'.$id.'"';
            $row_notif = 'UPDATE  users SET notification = "'.$not.'" WHERE id = "'.$id.'"';
            $stmt_email = $connexion->prepare($row_email);
            $stmt_user = $connexion->prepare($row_user);
            $stmt_notif = $connexion->prepare($row_notif);
            $stmt_email->execute();
            $stmt_user->execute();
            $stmt_notif->execute();
        }
        public function savechanges()
        {
            global $connexion;
            $username = $_POST['username'];
            $email = $_POST['email'];
            $usr = $_SESSION['username'];
            $pass = md5($_POST['password']);
            if (isset($email))
            {
                $sql_username = 'SELECT username FROM  users WHERE username = ? AND username != "'.$usr.'"';
                $sql_email = 'SELECT email FROM  users WHERE email = ? AND username != "'.$usr.'"';
                $stmt_username = $connexion->prepare($sql_username);
                $stmt_email = $connexion->prepare($sql_email);
                $stmt_email->execute([$email]);
                $stmt_username->execute([$username]);
                #check password
                $sql_pass = 'SELECT password FROM  users WHERE password = "'.$pass.'" AND username = "'.$usr.'"';
                $stmt_pass = $connexion->prepare($sql_pass);
                $stmt_pass->execute();
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
                    if ($stmt_pass->fetchColumn() == true)
                    {
                        #check password
                        $_SESSION['success'] = 'The information was successfully updated.';
                        return true;
                    }
                    else
                    {
                        $_SESSION['passowrd_error2'] = "The password that you've entered is incorrect.";
                        return false;
                    }
                }
            }
        }
        public function change_password()
        {
            global $connexion;
            $usr = $_SESSION['username'];
            $current = md5($_POST['current']);
            $new = md5($_POST['new']);
            $sql_check = 'SELECT password FROM  users WHERE password = "'.$current.'" AND username = "'.$usr.'"';
            $stmt_check = $connexion->prepare($sql_check);
            $stmt_check->execute();
            if ($stmt_check->fetchColumn() == true)
            {
                $sql_pass = 'UPDATE users SET password = "'.$new.'" WHERE password = "'.$current.'" AND username = "'.$usr.'"';
                $stmt_pass = $connexion->prepare($sql_pass);
                $stmt_pass->execute();
                $_SESSION['success'] = 'The password was successfully updated.';
                return true;
            }
            else
            {
                $_SESSION['passowrd_error'] = "The password that you've entered is incorrect.";
                return false;
            }
        }
        public function getall()
        {
            global $connexion;
            $usr = $_SESSION['username'];
            $sql = 'SELECT * FROM users WHERE username = "'.$usr.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            if ($info) {
                foreach ($info as static::$tableSchema) {
                    return static::$tableSchema;
                }
            }
        }
        public function confirm_password()
        {
            global $connexion;
            $usr = $_SESSION['username'];
            $pass = md5($_POST['pass']);
            if (isset($_POST['confirm']))
            {
                $sql_pass = 'SELECT password FROM  users WHERE password = "'.$pass.'" AND username = "'.$usr.'"';
                $stmt_pass = $connexion->prepare($sql_pass);
                $stmt_pass->execute();
                if ($stmt_pass->fetchColumn() == true)
                {
                    return true;
                }
                else
                {
                    $_SESSION['passowrd_error2'] = "The password that you've entered is incorrect.";
                    return false;
                }
            }
        }
        public function sendmail($token, $mail)
        {
            global $connexion;
            $sql = 'UPDATE users SET password_token = "'.$token.'" WHERE email = "'.$mail.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
        public function uploadImage($image_n)
        {
            global $connexion;
            $id = $_SESSION['id'];
            $like = 0;
            $sql_image = 'INSERT INTO images (id, image_n, like_count) VALUES ("'.$id.'", "'.$image_n.'", "'.$like.'")';
            $stmt = $connexion->prepare($sql_image);
            $stmt->execute();
        }
        public function fetchImage()
        {
            global $connexion;
            $id = $_SESSION['id'];
            $sql = 'SELECT * FROM images WHERE id = "'.$id.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function deleteImage($image_n)
        {
            global $connexion;
            $sql = 'DELETE FROM images WHERE image_n = "'.$image_n.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
        public function fetchallImage($start, $end)
        {
            global $connexion;
            $usr = $_SESSION['username'];
            $sql = "SELECT * FROM images ORDER BY image_id DESC limit $start, $end";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function like($image_n, $like)
        {
            global $connexion;
            $id = $_SESSION['id'];
            $like_sql = 'UPDATE  images SET like_count = like_count + "'.$like.'" WHERE image_n = "'.$image_n.'"';
            $like_count = 'INSERT INTO likes (id_image, image_n) VALUES ("'.$id.'", "'.$image_n.'")';
            $stmt_count = $connexion->prepare($like_count);
            $stmt_count->execute();
            $stmt = $connexion->prepare($like_sql);
            $stmt->execute();
        }
        public function checklike($image_n)
        {
            global $connexion;
            $id = $_SESSION['id'];
            $sql = 'SELECT * FROM likes WHERE id_image = "'.$id.'" AND image_n = "'.$image_n.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $count = $stmt->fetchColumn();
            if ($count >= 1)
            {
                return false;
            }
            else
            {
                return true;
            }
        }
        public function removelike($image_n, $like)
        {
            global $connexion;
            $id = $_SESSION['id'];
            $sql = 'DELETE FROM likes WHERE image_n = "'.$image_n.'" AND id_image = "'.$id.'"';
            $like_sql = 'UPDATE  images SET like_count = like_count + "'.$like.'" WHERE image_n = "'.$image_n.'"';
            $stmt_sql = $connexion->prepare($sql);
            $stmt = $connexion->prepare($like_sql);
            $stmt->execute();
            $stmt_sql->execute();
        }
        public function getOwnerImage($id)
        {
            global $connexion;
            $sql = 'SELECT  username FROM users WHERE id = "'.$id.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function countLike($image_n)
        {
            global $connexion;
            $like_count = 'SELECT like_count FROM images WHERE image_n = "'.$image_n.'"';
            $stmt = $connexion->prepare($like_count);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function checklikeByID()
        {
            global $connexion;
            $id = $_SESSION['id'];
            $sql = 'SELECT image_n FROM likes WHERE id_image = "'.$id.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function addCmnt($image_n, $comment)
        {
            global $connexion;
            $id = $_SESSION['id'];
            $comment = htmlspecialchars($comment);
            $comnt = 'INSERT INTO cmnt (id_user, image_n, comment) VALUES ("'.$id.'", "'.$image_n.'", "'.$comment.'")';
            $stmt = $connexion->prepare($comnt);
            $stmt->execute();
        }
        public function fetchCmnt()
        {
            global $connexion;
            $id = $_SESSION['id'];
            $sql = "SELECT * FROM cmnt ORDER BY id" ;
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            return $info;
        }
        public function GetcountofImage()
        {
            global $connexion;
            $sql = "SELECT COUNT(id) FROM images";
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchColumn();
            return $info;
        }
        public function getemailOfImage($id)
        {
            global $connexion;
            $sql = 'SELECT  email FROM users WHERE id = "'.$id.'" AND notification = 1';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
            $info = $stmt->fetchAll();
            if ($info) {
                foreach ($info as static::$tableSchema) {
                    return static::$tableSchema;
                }
            }
        }
        public function deletecmnt($id)
        {
            global $connexion;
            $sql = 'DELETE FROM cmnt  WHERE id = "'.$id.'"';
            $stmt = $connexion->prepare($sql);
            $stmt->execute();
        }
    }
?>