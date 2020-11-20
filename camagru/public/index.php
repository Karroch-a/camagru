<?php

    namespace CAMAGRU;
    use CAMAGRU\LIB\FrontController;
    if (!defined('DS'))
    {
        define('DS', DIRECTORY_SEPARATOR);    
    }
    require_once "../app/bootstrap.php";
    require_once '..' . DS . 'app' . DS . 'config.php';
    require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';
    $frontcontroller = new FrontController();
    $frontcontroller->disp();

?>