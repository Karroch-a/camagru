<?php

namespace CAMAGRU;

use CAMAGRU\LIB\FrontController;
use CAMAGRU\Models\UsersModel;


if (!defined('DS')) {
    define('DS', DIRECTORY_SEPARATOR);
}
$path_upload = '..' .DS . 'public' . DS .'img' .DS . 'upload';
$path_stickers = '..' .DS . 'public' . DS .'img' .DS . 'stickers';
$path_picture = '..' .DS . 'public' . DS .'img' .DS . 'picture';
if (file_exists($path))
{

}
else
{
    mkdir($path_upload, 0777);
    chmod($path_upload, 0777);
    chmod($path_stickers, 0777);
    chmod($path_picture, 0777);
}

require_once '..' . DS . 'app' . DS . 'config.php';
require_once '..' . DS . 'app' . DS . 'lib' . DS . 'config' . DS . 'setup.php';
require_once '..' . DS . 'app' . DS . 'lib' . DS . 'config' . DS . 'database.php';
require_once APP_PATH . DS . 'lib' . DS . 'autoload.php';
session_start();
$frontcontroller = new FrontController();
$frontcontroller->disp();
