<?php
    namespace CAMAGRU\Config;
    if(!defined('DS'))
    {
        define('DS', DIRECTORY_SEPARATOR);    
    }
    define("APP_PATH", realpath(dirname(__FILE__)));
    define('VIEW_PATH', APP_PATH . DS . 'views' . DS);

    defined('DATABASE_HOST_NAME')  ?null : define('DATABASE_HOST_NAME', '192.168.99.144');
    defined('DATABASE_USER_NAME')  ?null : define('DATABASE_USER_NAME', 'root');
    defined('DATABASE_PASSWORD')   ?null : define('DATABASE_PASSWORD', 'myrootpass');
    defined('DATABASE_DB_NAME')  ?null : define('DATABASE_DB_NAME', 'db_aazeroua');
    defined('DATABASE_PORT_NUMBER')  ?null : define('DATABASE_PORT_NUMBER', '6033');
    defined('HTTPS_PORT_NUMBER')  ?null : define('HTTPS_PORT_NUMBER', '8081');
    defined('TARGER')  ?null : define('TARGER', 'views/users/upload/');
