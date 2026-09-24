<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Homepage.php';


use modules\template\views as views;
class Homepage {
    public function execute(): void{
        new views\Homepage()->show();
    }

}