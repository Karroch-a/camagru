<?php
    namespace CAMAGRU;
    use CAMAGRU\LIB\FrontController;
    use CAMAGRU\Models\UsersModel;
    session_start();
    if (!defined('DS'))
    {
        define('DS', DIRECTORY_SEPARATOR);    
    }
    require_once "../app/views/users/bootstrap.php";
    require_once "../app/views/users/footer.php";
    require_once '..' . DS . 'app' . DS . 'config.php';
    require_once '..' . DS . 'app' . DS . 'lib' .DS . 'database'. DS . 'database.php';
    require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';
    $frontcontroller = new FrontController();
    $frontcontroller->disp();
    $q = new UsersModel;
    $q->create();
?>