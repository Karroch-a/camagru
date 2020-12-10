<?php
  if (isset($_SESSION['username']))
  {
      $this->redirect('/users/profile');
  }
    require_once "../app/views/users/bootstrap.php";
    require_once "../app/views/users/footer.php";
?>