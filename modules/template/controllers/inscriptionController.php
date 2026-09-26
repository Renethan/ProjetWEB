<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/inscriptionView.php';

use modules\template\views\InscriptionView;
use modules\template\models\InscriptionModel;

use modules\template\views as views;
class inscriptionController {
    public function execute(): void{
        $model = new InscriptionModel(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') 
            { $errors = $model->validate($_POST); 
        if (empty($errors)) { $model->save($_POST); header('Location: /merci'); exit; } 
        (new InscriptionForm($errors, $_POST))->show(); return; }    
        (new InscriptionForm())->show(); 
        }
        }