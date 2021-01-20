<?php

    if (isset($_SESSION['username']))
    {
        $this->redirect('/users/profile');
    }
    $this->redirect('/users/login');
?>