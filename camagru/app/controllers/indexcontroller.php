<?php

    namespace CAMAGRU\Controllers;
    use CAMAGRU\Models\usersmodel;
    use CAMAGRU\LIB\Helper;
    use CAMAGRU\LIB\FrontController;

    class IndexController extends AbstractController
    {
        use Helper;
        public function defaultAction()
        {
            $this->_view();
        }
    }
