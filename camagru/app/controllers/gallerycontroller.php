<?php

    namespace CAMAGRU\Controllers;
    use CAMAGRU\Models\usersmodel;
    use CAMAGRU\LIB\Helper;
    use CAMAGRU\LIB\FrontController;

    class GalleryController extends AbstractController
    {
        use Helper;
        public function cameraAction()
        {
            $this->_view();
        }
    }
?>