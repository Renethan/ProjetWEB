<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Account.php';
require_once __DIR__ . '/../models/Account.php';

use modules\template\models as models;
use modules\template\views as views;
class Account{
    public function execute() : void{
        $model = new models\Account();
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
                    $model->delete($_POST);
                    session_start();
                    session_unset(); // vide toutes les variables de session
                    session_destroy();
                    header('Location: /index.php?page=homepage');
                    exit();
                }
                (new views\Account($errors))->show(); // Sinon retour au formulaire avec les erreurs
            }
        }
        else{
            (new views\Account())->show();
        }
    }
}