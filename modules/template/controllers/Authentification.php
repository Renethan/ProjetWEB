<?php

namespace modules\template\controllers;
require_once __DIR__ . '/../views/Authentification.php';
require_once __DIR__ . '/../models/Authentification.php';
require_once __DIR__ . '/../../../index.php';

use modules\template\models as models;
use modules\template\views as views;
class Authentification{

    public function __construct(){}
    public function execute(): void{
        session_start();
        $model = new models\Authentification();
        if (!empty($_POST['action'])) { // Si le formulaire a été rempli
            $errors = $model->valider($_POST);  // Check les erreurs
            if (empty($errors)) {   // S'il y'a pas d'erreurs
                $_SESSION['suid'] = session_id();   // Connexion
                header('Location: ../../../index.php');
                exit();
            }
            (new views\Authentification($errors))->show(); // Sinon retour au formulaire avec les erreurs
            return;
        }
        (new views\Authentification())->show();
    }
}
if (!empty($_POST['action'])) {
    (new Authentification())->execute();
}