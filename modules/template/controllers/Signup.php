<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Signup.php';
require_once __DIR__ . '/../models/Signup.php';

use modules\template\models as models;
use modules\template\views as views;
class Signup {
    public function execute(): void{
        $model = new models\Signup();
        if (!empty($_POST['action'])) {
            $errors = $model->valider($_POST);
            if (empty($errors)) {
                $model->save($_POST);
                $_SESSION['suid'] = session_id();   // Connexion
                $_SESSION['identifiant'] = $_POST['identifiant'];
                header('Location: ../../../index.php');
                exit();
            }
            (new views\Signup($errors))->show();
            return;
        } else {
            (new views\Signup())->show();
        }
    }
}
