<?php
namespace modules\template\controllers;
require_once __DIR__ . '/../views/Notice.php';


use modules\template\views as views;
class Notice {
    public function execute(): void{
        (new views\Notice())->show();
    }

}