<?php

    namespace CAMAGRU\LIB;
    use CAMAGRU\LIB\Helper;

    class FrontController
    {
         use Helper;
        const NOT_FOUND_ACTION = 'notFoundAction';
        const NOT_FOUND_CONTROLLER = 'CAMAGRU\Controllers\\NotFoundController';
        private $_controller = "index";
        private $_action = "default";
        private $_params = array();

        public function __construct()
        {
            $this->_parseUrl();
        }
        private function _parseUrl()
        {
            $url = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'), 3);
            if (isset($url[0]) && $url[0] != '')
            {
                $this->_controller = $url[0];
            }
            if (isset($url[1]) && $url[1] != '')
            {
                $this->_action = $url[1];
            }
            if (isset($url[2]) && $url[2] != '')
            {
                $this->_params = explode('/' , $url[2]);
                if (count($this->_params) > 1)
                {
                    $this->redirect("/".$this->_controller."/".$this->_action);
                }
            }
        }

        public function disp()
        {
            $controllerClassName= 'CAMAGRU\Controllers\\' . ucfirst($this->_controller) . 'Controller';
            $actionName = $this->_action . 'Action';
            if (!class_exists($controllerClassName))
            {
                $controllerClassName = self::NOT_FOUND_CONTROLLER;
            }
            $controller = new $controllerClassName();
            if(!method_exists($controller, $actionName))
            {
                $this->_action = $actionName = self::NOT_FOUND_ACTION;
            }
            $controller->setController($this->_controller);
            $controller->setAction($this->_action);
            $controller->setParams($this->_params);
            $controller->$actionName();
        }
    }
