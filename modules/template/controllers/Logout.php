<?php

namespace modules\template\controllers;

class Logout{
    public function execute(){
        unset($_SESSION['suid']);
        unset($_SESSION['identifiant']);
        header('Location: ../../../index.php?page=homepage');
        exit();
    }
}