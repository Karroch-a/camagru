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
            'username'              => self::DATA_TYPE_STR,
            'email'                 => self::DATA_TYPE_STR,           
            'password'              => self::DATA_TYPE_STR,          
            'confirm_password'      => self::DATA_TYPE_STR,
            'username_error'        => self::DATA_TYPE_STR,
            'email_error'           => self::DATA_TYPE_STR,
            'passowrd_error'        => self::DATA_TYPE_STR
        );
    }
?>