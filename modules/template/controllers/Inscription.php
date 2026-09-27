<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Inscription.php';
require_once __DIR__ . '/../models/Inscription.php';

use modules\template\models as models;
use modules\template\views as views;
class inscription {
    public function execute(): void{
        $model = new models\Inscription();
        if (!empty($_POST['action'])) {
            $errors = $model->valider($_POST);
            if (empty($errors)) {
                $model->save($_POST);
            }
            (new views\Inscription($errors))->show();
            return;
        }
        (new views\Inscription())->show();
    }
}
if (!empty($_POST['action'])) {
    (new inscription())->execute();
}