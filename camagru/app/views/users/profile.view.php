<?php
 if (!isset($_SESSION['username']))
 {
     $this->redirect('/users/login');
 }
 if (isset($_POST['logout']))
 {
     session_destroy();
     $this->redirect('/users/login');
 }
    require_once "bootstrap.php";
    require_once "footer.php";
?>