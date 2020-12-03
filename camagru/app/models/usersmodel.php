<?php

    namespace CAMAGRU\Models;

    class UsersModel extends AbstractModel
    {
        public $username;
        public $email;
        public $password;
        public $confirm_password;
        public $username_error;
        public $email_error;
        public $password_error;
        public $confirm_password_error;

        protected static $tableName = 'db_aazeroua';
        protected static $tableSchema = array(
            'username',
            'email',           
            'password',          
            'confirm_password',
        );
    }
?>