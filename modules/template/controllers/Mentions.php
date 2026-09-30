<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Mentions.php';


use modules\template\views as views;
class Mentions {
    public function execute(): void{
        (new views\Mentions())->show();
    }

}