<?php

namespace modules\template\controllers;

require_once __DIR__ . '/../views/Sitemap.php';
use \modules\template\views as views;
class Sitemap{
    public function execute(): void{
        (new views\Sitemap())->show();
    }
}