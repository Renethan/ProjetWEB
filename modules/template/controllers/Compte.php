<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Compte.php';
require_once __DIR__ . '/../models/Compte.php';

use modules\template\models as models;
use modules\template\views as views;
class Compte{
    public function execute(){
        $model = new models\Compte();
        if(isset($_GET['type'])){
            if($_GET['type'] == 'logout'){
                session_start();
                session_unset(); // vide toutes les variables de session
                session_destroy();
                header('Location: /index.php?page=homepage');
                exit();
            }
            else if($_GET['type'] == 'delete'){
                $errors = $model->valider($_POST);  // Check les erreurs
                if (empty($errors)) {   // S'il y'a pas d'erreurs
                    //TODO
                }
                (new views\Compte($errors))->show(); // Sinon retour au formulaire avec les erreurs
            }
        }
        else{
            (new views\Compte())->show();
        }
    }
}