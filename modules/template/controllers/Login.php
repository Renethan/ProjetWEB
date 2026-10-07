<?php

namespace modules\template\controllers;
require_once __DIR__ . '/../views/Login.php';
require_once __DIR__ . '/../models/Login.php';

use modules\template\models as models;
use modules\template\views as views;
class Login{

    public function __construct(){}
    public function execute(): void{
        $model = new models\Login();
        if (!empty($_POST['action'])) { // Si le formulaire a été rempli
            $errors = $model->valider($_POST);  // Check les erreurs
            if (empty($errors)) {   // S'il y'a pas d'erreurs
                $_SESSION['suid'] = session_id();   // Connexion
                $_SESSION['identifiant'] = $_POST['identifiant'];
                if ($model->pwd_has_expired($_POST)){ // Date expirée
                    $_SESSION['expire'] = true;
                    header('Location: ../../../index.php?page=reset');
                    exit();
                } else {
                    header('Location: ../../../index.php?page=homepage');
                    exit();
                }
            }
            (new views\Login($errors))->show(); // Sinon retour au formulaire avec les erreurs
            return;
        } else {
            (new views\Login())->show();
        }
    }
}
