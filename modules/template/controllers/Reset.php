<?php

namespace modules\template\controllers;
require_once __DIR__ . '/../views/Reset.php';
require_once __DIR__ . '/../models/Reset.php';
use \modules\template\views as views;
use \modules\template\models as models;

class Reset{
    public function execute(): void{
        $model = new models\Reset();
        if (!empty($_POST['action'])){  // Si le formulaire est rempli
            $errors = $model->valider($_POST);  // Check les erreurs
            if (empty($errors)) {   // S'il y'a pas d'erreurs
                $model->update($_POST);
                unset($_SESSION['expire']);
                header('Location: index.php?page=homepage');
                exit();
            }
            (new views\Reset($errors))->show();
            return;
        }
        (new views\Reset())->show();
    }
}