<?php

namespace modules\template\controllers;

class Logout{
    public function execute(){
        session_start();
        session_unset(); // vide toutes les variables de session
        session_destroy();
        header('Location: /index.php?page=homepage');
        exit();
    }
}