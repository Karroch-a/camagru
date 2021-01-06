<?php

    namespace CAMAGRU\Models;

    class UsersModel extends AbstractModel
    {
        public $username;
        public $email;
        public $password;
        public $rowcount;
        public $notification;
        public $token;
        public $password_token;

        protected static $tableName = 'users';
        protected static $tableSchema = array(
            'username'              => self::DATA_TYPE_STR,
            'email'                 => self::DATA_TYPE_STR,           
            'password'              => self::DATA_TYPE_STR,
            'rowcount'              => self::DATA_TYPE_INT,
            'notification'          => self::DATA_TYPE_INT,
            'token'                 => self::DATA_TYPE_STR,
            'password_token'        => self::DATA_TYPE_STR,
            // 'confirm_password'      => self::DATA_TYPE_STR,
            // 'username_error'        => self::DATA_TYPE_STR,
            // 'email_error'           => self::DATA_TYPE_STR,
            // 'passowrd_error'        => self::DATA_TYPE_STR
        );
        protected static $tableImage = array(
            'user'              => self::DATA_TYPE_STR,
            'image_n'              => self::DATA_TYPE_STR,
        );
    }
