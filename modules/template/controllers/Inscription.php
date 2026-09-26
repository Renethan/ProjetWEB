<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Inscription.php';


use modules\template\views as views;
class inscription {
    public function execute(): void{
        $model = new InscriptionModel(); 
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = $model->validate($_POST);
            if (empty($errors)) {
                $model->save($_POST);
                header('Location: /merci');
                exit;
            }
            (new views\Inscription($errors))->show();
            return;
        }
        (new views\Inscription([]))->show();
    }
}