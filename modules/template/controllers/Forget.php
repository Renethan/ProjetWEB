<?php

namespace modules\template\controllers;
require_once __DIR__ . '/Reset.php';
require_once __DIR__ . '/../views/Forget.php';
require_once __DIR__ . '/../models/Forget.php';
use \modules\template\views as views;
use \modules\template\views as models;

class Forget{
    public function execute(): void{
        if (!empty($_POST['action'])){
            (new Reset())->execute();
        } else {
            (new views\Forget())->show();
        }
    }
}