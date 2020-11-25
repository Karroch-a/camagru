<?PHP

    namespace CAMAGRU\Controllers;

    class AbstractController
    {
        protected $_controller;
        protected $_action;
        protected $_params;

        public function notFoundAction()
        {
            echo "sorry this page is not exists";
        }
        public function setController ($controllerName)
        {
            $this->_controller = $controllerName;
        }
        public function setAction ($actionName)
        {
            $this->_action = $actionName;
        }
        public function setParams ($params)
        {
            $this->_params = $params;
        }
        protected function _view()
        {
            if ($this->_action == FrontController::NOT_FOUND_ACTION)
            {
                require_once VIEW_PATH . 'notfound' . DS . 'notfound.view.php';
            }
            else{
                $view = VIEW_PATH . $this->_controller .DS  .$this->_action . 'view.php';
                if (file_exists($view))
                {
                    require_once $view;
                }
                else
                {
                    require_once VIEW_PATH . 'notfound' . DS . 'noview.view.php';
                }
            }
        }
    }

?>